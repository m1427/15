<?php
// الاتصال بقاعدة البيانات
$servername = "localhost";
$username = "nnaame";
$password = "";
$dbname = "main";

$conn = new mysqli($servername, $username, $password, $dbname);

// التحقق من الاتصال
if ($conn->connect_error) {
    die("فشل الاتصال بقاعدة البيانات: " . $conn->connect_error);
}

// استقبال بيانات النموذج من الطلب POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $teachername = $_POST['teachername'];
    $sub = $_POST['sub'];

    // تنفيذ استعلام SQL لإدخال بيانات المعلم
    $sql_insert = "INSERT INTO teatcher_name (teatchername, sub) VALUES ('$teachername', '$sub')";

    if ($conn->query($sql_insert) === TRUE) {
        echo "تم إدخال بيانات المعلم بنجاح";
    } else {
        echo "حدث خطأ أثناء إدخال بيانات المعلم: " . $conn->error;
    }
}

// إغلاق الاتصال بقاعدة البيانات
$conn->close();
?>
