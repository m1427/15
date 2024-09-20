<?php
// يجب استخدام المسار الكامل لملف قاعدة البيانات Access
$db_path = "C:\xampp\htdocs\lab web\lap\gff\Teachers_be.accdb";

// إنشاء اتصال
$conn = new COM ("ADODB.Connection");
$conn->Open("Provider=Microsoft.ACE.OLEDB.12.0;Data Source=$db_path");

// استقبال البيانات من نموذج تسجيل الدخول
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $enteredUsername = $_POST["username"];
    $enteredPassword = $_POST["password"];

    // يمكنك تنفيذ استعلام SQL هنا للتحقق من صحة المستخدم وكلمة المرور
    $sql = "SELECT * FROM users WHERE username='$enteredUsername' AND password='$enteredPassword'";
    $result = $conn->Execute($sql);

    if ($result->RecordCount() > 0) {
        // عملية التحقق نجحت، قم بتوجيه المستخدم إلى main.html
        header("Location: main.html");
        exit();
    } else {
        // عملية التحقق فشلت، يمكنك إظهار رسالة خطأ أو إعادة توجيه المستخدم لصفحة تسجيل الدخول
        echo "خطأ: اسم المستخدم أو كلمة المرور غير صحيحة";
    }
}

// إغلاق اتصال قاعدة البيانات
$conn->Close();
?>