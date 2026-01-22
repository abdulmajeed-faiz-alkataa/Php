<?php
$conn = new mysqli('localhost', 'root', '');
if ($conn->connect_error) {
    die("فشل الاتصال بقاعدة البيانات");
}

$conn->query("CREATE DATABASE IF NOT EXISTS bank_lab5");
$conn->select_db("bank_lab5");

$conn->query("CREATE TABLE IF NOT EXISTS accounts (
    id INT PRIMARY KEY,
    name VARCHAR(50),
    balance DECIMAL(10,2)
)");

$conn->query("CREATE TABLE IF NOT EXISTS transactions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    from_acc INT,
    to_acc INT,
    amount DECIMAL(10,2),
    date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)");

$conn->query("DELETE FROM accounts");
$conn->query("INSERT INTO accounts (id, name, balance) VALUES
    (1, 'محمد', 70000),
    (2, 'عبدالمجيد', 60000),
    (3, 'جوهر', 50000)
");

$message = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $from   = filter_var($_POST['from'], FILTER_VALIDATE_INT);
    $to     = filter_var($_POST['to'], FILTER_VALIDATE_INT);
    $amount = filter_var($_POST['amount'], FILTER_VALIDATE_FLOAT);

    if (!$from || !$to || $amount <= 0) {
        $message = "<p style='color:red;'>❌ لا يمكن إدخال قيم سالبة أو غير صحيحة</p>";
    }
    elseif ($from == $to) {
        $message = "<p style='color:orange;'>⚠️ لا يمكن التحويل لنفس الحساب</p>";
    }
    else {

        $conn->begin_transaction();

        try {
            $stmt = $conn->prepare("SELECT balance FROM accounts WHERE id = ?");
            $stmt->bind_param("i", $from);
            $stmt->execute();
            $result = $stmt->get_result();
            $account = $result->fetch_assoc();

            if (!$account || $account['balance'] < $amount) {
                throw new Exception("الرصيد غير كافٍ");
            }

            $stmt1 = $conn->prepare(
                "UPDATE accounts SET balance = balance - ? WHERE id = ?"
            );
            $stmt1->bind_param("di", $amount, $from);
            $stmt1->execute();

            $stmt2 = $conn->prepare(
                "UPDATE accounts SET balance = balance + ? WHERE id = ?"
            );
            $stmt2->bind_param("di", $amount, $to);
            $stmt2->execute();
            $stmt3 = $conn->prepare(
                "INSERT INTO transactions (from_acc, to_acc, amount) VALUES (?, ?, ?)"
            );
            $stmt3->bind_param("iid", $from, $to, $amount);
            $stmt3->execute();

            $conn->commit();
            $message = "<p style='color:green;'>✅ تم التحويل بنجاح</p>";

        } catch (Exception $e) {
            $conn->rollback();
            $message = "<p style='color:red;'>❌ فشل التحويل: {$e->getMessage()}</p>";
        }
    }
}

$accounts = $conn->query("SELECT * FROM accounts");
$transactions = $conn->query("SELECT * FROM transactions ORDER BY date DESC LIMIT 5");
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>نظام تحويل الأموال الآمن</title>
    <style>
        body { font-family: Arial; background: #f0f0f0; }
        .container { max-width: 600px; margin: auto; background: white; padding: 20px; border-radius: 10px; }
        h1 { text-align: center; }
        form { background: #f9f9f9; padding: 15px; border-radius: 8px; }
        select, input, button { width: 100%; padding: 8px; margin: 5px 0; }
        button { background: #27ae60; color: white; border: none; border-radius: 5px; }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: center; }
        th { background: #34495e; color: white; }
    </style>
</head>

<body>
<div class="container">
    <h1>🏦 نظام تحويل الأموال</h1>

    <?php echo $message; ?>

    <form method="POST">
        <h3>💰 تحويل أموال</h3>

        <label>من حساب:</label>
        <select name="from" required>
            <option value="">اختر</option>
            <?php while($row = $accounts->fetch_assoc()): ?>
                <option value="<?php echo $row['id']; ?>">
                    <?php echo $row['name'] . " ({$row['balance']} ريال)"; ?>
                </option>
            <?php endwhile; ?>
        </select>

        <?php $accounts->data_seek(0); ?>

        <label>إلى حساب:</label>
        <select name="to" required>
            <option value="">اختر</option>
            <?php while($row = $accounts->fetch_assoc()): ?>
                <option value="<?php echo $row['id']; ?>">
                    <?php echo $row['name']; ?>
                </option>
            <?php endwhile; ?>
        </select>

        <label>المبلغ:</label>
        <input type="number" name="amount" min="1" step="0.01" required>

        <button type="submit">🔁 تحويل</button>
    </form>

    <h3>📊 الحسابات</h3>
    <?php $accounts->data_seek(0); ?>
    <table>
        <tr><th>الاسم</th><th>الرصيد</th></tr>
        <?php while($row = $accounts->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['balance']; ?> ريال</td>
            </tr>
        <?php endwhile; ?>
    </table>

    <h3>📋 آخر العمليات</h3>
    <table>
        <tr><th>من</th><th>إلى</th><th>المبلغ</th><th>الوقت</th></tr>
        <?php if($transactions->num_rows > 0): ?>
            <?php while($row = $transactions->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['from_acc']; ?></td>
                    <td><?php echo $row['to_acc']; ?></td>
                    <td><?php echo $row['amount']; ?> ريال</td>
                    <td><?php echo $row['date']; ?></td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr><td colspan="4">لا توجد عمليات</td></tr>
        <?php endif; ?>
    </table>
</div>
</body>
</html>
