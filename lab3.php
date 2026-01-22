<?php
/********************************
 * 📅 دوال التاريخ والوقت
 ********************************/

echo date("Y-m-d H:i:s") . "<br>";
echo time() . "<br>";

$timestamp = mktime(15, 30, 0, 12, 25, 2025);
echo date("Y-m-d H:i:s", $timestamp) . "<br>";

$ts = strtotime("next Friday");
echo date("Y-m-d", $ts) . "<br>";

print_r(getdate());
echo "<br>";

$date1 = date_create("2025-12-01");
$date2 = date_create("2025-12-19");
$diff = date_diff($date1, $date2);
echo $diff->format("%a أيام") . "<br>";

sleep(1);


/********************************
 * 📂 التعامل مع الملفات
 ********************************/

$filename = "example.txt";

file_put_contents($filename, "مرحبًا بك في PHP!\n");
echo nl2br(file_get_contents($filename));

if (file_exists($filename) && is_file($filename)) {
    echo "<br>الملف موجود<br>";
}


/********************************
 * 📁 المجلدات
 ********************************/

$folder = "myfolder";

if (!is_dir($folder)) {
    mkdir($folder);
}

print_r(scandir($folder));
echo "<br>";


/********************************
 * 🧠 مثال سجل
 ********************************/

$log = "log.txt";

if (!file_exists($log)) {
    file_put_contents($log, "تم إنشاء الملف\n");
} else {
    file_put_contents($log, "تمت إضافة سطر جديد\n", FILE_APPEND);
}


/********************************
 * 🗄️ MySQLi (حل الخطأ)
 ********************************/

$host = "localhost";
$user = "root";
$password = "";
$database = "my_database";

/* اتصال بدون تحديد قاعدة */
$conn = new mysqli($host, $user, $password);

if ($conn->connect_error) {
    die("فشل الاتصال: " . $conn->connect_error);
}

/* إنشاء قاعدة البيانات إذا لم تكن موجودة */
$sql = "CREATE DATABASE IF NOT EXISTS $database CHARACTER SET utf8 COLLATE utf8_general_ci";
$conn->query($sql);

/* اختيار قاعدة البيانات */
$conn->select_db($database);
$conn->set_charset("utf8");

echo "تم الاتصال بقاعدة البيانات باستخدام MySQLi<br>";


/********************************
 * 🗄️ PDO ( )
 ********************************/

try {
    /* الاتصال بدون قاعدة */
    $pdo = new PDO("mysql:host=$host;charset=utf8", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    /* إنشاء القاعدة */
    $pdo->exec("CREATE DATABASE IF NOT EXISTS $database CHARACTER SET utf8 COLLATE utf8_general_ci");

    /* الاتصال بالقاعدة */
    $pdo = new PDO("mysql:host=$host;dbname=$database;charset=utf8", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "تم الاتصال بقاعدة البيانات باستخدام PDO<br>";

} catch (PDOException $e) {
    echo "خطأ: " . $e->getMessage();
}

?>
