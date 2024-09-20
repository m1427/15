<?php
// اتصال بقاعدة البيانات
$db_path = "C:\\Users\\user\\Desktop\\lab web\\lap\\gff\\Teachers.accdb";
$conn = new COM("ADODB.Connection");
$conn->Open("Provider=Microsoft.ACE.OLEDB.12.0;Data Source=$db_path");

// استلام البيانات من النموذج
$name = isset($_POST['name']) ? $_POST['name'] : '';
$email = isset($_POST['email']) ? $_POST['email'] : '';
$phone = isset($_POST['phone']) ? $_POST['phone'] : '';
$subject = isset($_POST['subject']) ? $_POST['subject'] : '';
$username = isset($_POST['username']) ? $_POST['username'] : '';
$password = isset($_POST['password']) ? $_POST['password'] : '';

// إجراء استعلام SQL لإدراج البيانات (استخدام استعلام معلمات مستعدة)
$sql = "INSERT INTO Teachers (Name, Email, Phone, Subject, Username, Password) VALUES (?, ?, ?, ?, ?, ?)";
$stmt = $conn->Prepare($sql);

// ربط قيم المعلمات
$stmt->bindParam(1, $name);
$stmt->bindParam(2, $email);
$stmt->bindParam(3, $phone);
$stmt->bindParam(4, $subject);
$stmt->bindParam(5, $username);
$stmt->bindParam(6, $password);

// تنفيذ الاستعلام
$stmt->Execute();

// التحقق من وجود أخطاء
if ($stmt->Errors->Count > 0) {
    echo "حدث خطأ: " . $stmt->Errors->Item(0)->Description;
} else {
    echo "تم إضافة المعلم بنجاح";
}

// إغلاق اتصال قاعدة البيانات
$conn->Close();
?>
