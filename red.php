<?php
$servername = "localhost";
$username = "nnaame"; // أدخل اسم المستخدم لقاعدة البيانات
$password = ""; // أدخل كلمة المرور
$dbname = "main";   // أدخل اسم قاعدة البيانات

// إنشاء الاتصال
$conn = new mysqli($servername, $username, $password, $dbname);

// التحقق من الاتصال
if ($conn->connect_error) {
    die("فشل الاتصال: " . $conn->connect_error);
}

// التحقق من وجود كلمة المرور المدخلة
if (isset($_POST['password'])) {
    $inputPassword = $_POST['password'];

    // استعلام للحصول على URL المرتبط بكلمة المرور
    $sql = "SELECT url, password FROM redirects WHERE password = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $inputPassword);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // الحصول على الرابط
        $row = $result->fetch_assoc();
        $url = $row['url'];
        
        // إعادة التوجيه إلى الرابط
        header("Location: ../lap/$url");
        exit();
    } else {
        echo "رمز غير صحيح.";
    }

    $stmt->close();
} else {
    echo "يرجى إدخال كلمة المرور.";
}

$conn->close();
?>
