<?php
session_start();

// إعداد الاتصال بقاعدة البيانات
$host = 'localhost';
$db = 'main';
$user = 'nnaame';
$pass = '';

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("فشل الاتصال: " . $conn->connect_error);
}

// وظيفة لتشفير كلمة المرور
/*function hashPassword($password) {
    return password_hash($password, PASSWORD_BCRYPT);
}
*/


// وظيفة لتسجيل الدخول
function loginUser($input) {
    $users = [
        '1' => 'http://localhost/10/admin.html',
        '2' => 'http://localhost/10/alkma.php',
        '3' => 'http://localhost/10/bio.html',
        '4' => 'http://localhost/10/phy.html',
    ];

    if (array_key_exists($input, $users)) {
        $_SESSION['loggedin'] = true;
        $_SESSION['role'] = $input; // تخزين الرمز في الجلسة
        header("Location: " . $users[$input]);
        exit;
    } else {
        echo "<script>alert('الرمز أو كلمة المرور غير صحيحة'); window.history.back();</script>";
    }
}

// معالجة تسجيل الدخول
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['input'])) {
    $input = $_POST['input'];
    loginUser($input);
} elseif (!isset($_SESSION['loggedin'])) {
    header("Location: http://localhost/10/alkma21.html");
    exit;
}

// معالجة الطلبات لإضافة أو تحديث كلمات المرور
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $code = $_POST['code'];
    $password = /*hashPassword*/($_POST['password']);
    $redirect_url = $_POST['redirect_url'];

    if (isset($_POST['update'])) {
        $stmt = $conn->prepare("UPDATE users SET password = ?, redirect_url = ? WHERE code = ?");
        $stmt->bind_param("sss", $password, $redirect_url, $code);
        $stmt->execute();
        $stmt->close();
        echo "<script>alert('تم تحديث كلمة المرور والتوجيه بنجاح.');</script>";
    } elseif (isset($_POST['add'])) {
        $stmt = $conn->prepare("INSERT INTO users (code, password, redirect_url) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $code, $password, $redirect_url);
        $stmt->execute();
        $stmt->close();
        echo "<script>alert('تم إضافة كلمة المرور والتوجيه بنجاح.');</script>";
        // إعادة توجيه بعد الإضافة
        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
    }
}

// استرجاع كلمات المرور الحالية
$result = $conn->query("SELECT * FROM users");
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>تعديل كلمات المرور والتوجيه</title>
    <link rel="stylesheet" href="css/scs/bootstrap.min.css">
</head>
<body>
<div class="container">
    <h1>إضافة أو تعديل كلمات المرور والتوجيه</h1>
    <form method="POST">
        <div class="form-group">
            <label for="code">الرمز:</label>
            <input type="text" name="code" required class="form-control" placeholder="أدخل الرمز">
        </div>
        <div class="form-group">
            <label for="password">كلمة المرور:</label>
            <input type="password" name="password" required class="form-control" placeholder="أدخل كلمة المرور">
        </div>
        <div class="form-group">
            <label for="redirect_url">رابط التوجيه:</label>
            <input type="text" name="redirect_url" required class="form-control" placeholder="أدخل رابط التوجيه">
        </div>
        <button type="submit" name="add" class="btn btn-success">إضافة كلمة المرور</button>
        <button type="submit" name="update" class="btn btn-primary">تحديث كلمة المرور</button>
    </form>

    <h2>كلمات المرور الحالية</h2>
    <table class="table">
        <thead>
            <tr>
                <th>الرمز</th>
                <th>كلمة المرور</th>
                <th>رابط التوجيه</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo htmlspecialchars($row['code']); ?></td>
                <td><?php echo htmlspecialchars($row['password']); ?></td>
                <td><?php echo htmlspecialchars($row['redirect_url']); ?></td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>
</body>
</html>

<?php
$conn->close();
?>
