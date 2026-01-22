<?php

$pdo = null;

try {

  
    $dsn  = "mysql:host=localhost;dbname=banks;charset=utf8";
    $user = "root";
    $pass = "";

    // الاتصال بقاعدة البيانات
    $pdo = new PDO($dsn, $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // بيانات التحويل
    $fromAccount = 1;
    $toAccount   = 2;
    $amount      = 500;

    $pdo->beginTransaction();

    $stmt = $pdo->prepare("SELECT balance FROM accounts WHERE id = ?");
    $stmt->execute([$fromAccount]);
    $fromBalance = $stmt->fetchColumn();

    if ($fromBalance === false) {
        throw new Exception("الحساب الأول غير موجود");
    }

    if ($fromBalance < $amount) {
        throw new Exception("الرصيد غير كافٍ");
    }

    $stmt = $pdo->prepare(
        "UPDATE accounts SET balance = balance - ? WHERE id = ?"
    );
    $stmt->execute([$amount, $fromAccount]);

    $stmt = $pdo->prepare(
        "UPDATE accounts SET balance = balance + ? WHERE id = ?"
    );
    $stmt->execute([$amount, $toAccount]);

    $stmt = $pdo->prepare(
        "INSERT INTO transactions (from_account, to_account, amount, created_at)
         VALUES (?, ?, ?, NOW())"
    );
    $stmt->execute([$fromAccount, $toAccount, $amount]);

    // تأكيد جميع العمليات
    $pdo->commit();

    echo " تم تحويل المبلغ بنجاح";

} catch (Exception $e) {

    // التراجع عن العمليات في حال الخطأ
    if ($pdo !== null && $pdo->inTransaction()) {
        $pdo->rollBack();
    }

    // تسجيل الخطأ في ملف logs
    error_log(
        date("Y-m-d H:i:s") . " | " . $e->getMessage() . PHP_EOL,
        3,
        "transactions.log"
    );

    // رسالة آمنة للمستخدم
    echo " حدث خطأ أثناء تنفيذ العملي";
}
?>
