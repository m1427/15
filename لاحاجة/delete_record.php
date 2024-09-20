<?php
// إعداد الاتصال بقاعدة البيانات
$servername = "localhost";
$username = "nnaame";
$password = "";
$dbname = "main";

$conn = new mysqli($servername, $username, $password, $dbname);

// التحقق من الاتصال
if ($conn->connect_error) {
    die("فشل الاتصال: " . $conn->connect_error);
}

// استخراج معرف السجل المراد حذفه من الطلب
$id = $_GET['id'];

// استعلام SQL لحذف السجل
$sql = "DELETE FROM teatcher_name WHERE id = $id";

if ($conn->query($sql) === TRUE) {
    echo "تم حذف السجل بنجاح";
} else {
    echo "حدث خطأ أثناء حذف السجل: " . $conn->error;
}

// إغلاق الاتصال بقاعدة البيانات
$conn->close();
?>
