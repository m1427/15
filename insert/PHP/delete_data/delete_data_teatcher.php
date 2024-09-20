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

// استقبال بيانات الحذف من الطلب POST
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete']) && isset($_POST['id'])) {
    $id = $_POST['id'];

    // تنفيذ استعلام SQL لحذف السجل
    $sql_delete = "DELETE FROM teatcher_name WHERE id = $id";

    if ($conn->query($sql_delete) === TRUE) {
        echo "تم حذف السجل بنجاح";
    } else {
        echo "حدث خطأ أثناء حذف السجل: " . $conn->error;
    }
}

// إغلاق الاتصال بقاعدة البيانات
$conn->close();
?>
