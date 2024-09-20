<?php
session_start();

// Configuration
$host = 'localhost';
$db = 'main';
$user = 'nnaame';
$pass = '';

// Create a secure connection to the database
$conn = new mysqli($host, $user, $pass, $db);

// Check connection
if ($conn->connect_error) {
    error_log("Connection failed: ". $conn->connect_error);
    die("Error connecting to database");
}

// Process form submissions
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ensure the database connection is established
    // $conn = new mysqli($servername, $username, $password, $dbname);

    $password = $_POST['password'];
    $url = $_POST['url'];
    $id = isset($_POST['id']) ? $_POST['id'] : null;

    if (isset($_POST['update'])) {
        // Check if URL exists (excluding the current ID)
        $stmt = $conn->prepare("SELECT COUNT(*) FROM redirects WHERE url = ? AND id != ?");
        $stmt->bind_param("si", $url, $id);
        $stmt->execute();
        $stmt->bind_result($count);
        $stmt->fetch();
        $stmt->close();

        if ($count > 0) {
            echo "<script>alert('هذا الرابط موجود بالفعل.');</script>";
        } else {
            // Update password and URL
            $stmt = $conn->prepare("UPDATE redirects SET password = ?, url = ? WHERE id = ?");
            $stmt->bind_param("ssi", $password, $url, $id);
            $stmt->execute();
            $stmt->close();
            echo "<script>alert('تم تحديث كلمة المرور والتوجيه بنجاح.');</script>";
        }
    } elseif (isset($_POST['add'])) {
        // Check if URL exists
        $stmt = $conn->prepare("SELECT COUNT(*) FROM redirects WHERE url = ?");
        $stmt->bind_param("s", $url);
        $stmt->execute();
        $stmt->bind_result($count);
        $stmt->fetch();
        $stmt->close();
    
        if ($count > 0) {
            echo "<script>alert('هذا الرابط موجود بالفعل.');</script>";
        } else {
            // Check if password exists
            $stmt = $conn->prepare("SELECT COUNT(*) FROM redirects WHERE password = ?");
            $stmt->bind_param("s", $password);
            $stmt->execute();
            $stmt->bind_result($count);
            $stmt->fetch();
            $stmt->close();
    
            if ($count > 0) {
                echo "<script>alert('هذا الرمز موجود بالفعل.');</script>";
            } else {
                // Insert new password and URL
                $stmt = $conn->prepare("INSERT INTO redirects (password, url) VALUES (?, ?)");
                $stmt->bind_param("ss", $password, $url);
                $stmt->execute();
                $stmt->close();
                echo "<script>alert('تم إضافة كلمة المرور والتوجيه بنجاح.');</script>";
            }
        }
    }
}

// Retrieve existing passwords
$result = $conn->query("SELECT * FROM redirects");

// Close database connection
$conn->close();
?>

<!-- HTML code remains the same -->

<!DOCTYPE html>
<html dir="rtl" lang="ar">
<head>
    <meta charset="UTF-8">
    <title>تعديل كلمات المرور </title>
    <link rel="stylesheet" href="css/table.style.css">
</head>
<body>
<div class="container">
    <h1>إضافة أو تعديل كلمات المرور </h1>
    <form method="POST">
        <div class="form-group">
            <label for="id">ID:</label>
            <input type="number" name="id"  class="form-control" placeholder="أدخل ID">
        </div>
        <div class="form-group">
            <label for="password">كلمة المرور:</label>
            <input type="password" name="password" required class="form-control" placeholder="أدخل كلمة المرور">
        </div>
        <div class="form-group">
            <label for="url">رابط التوجيه:</label>
            <select name="url" required class="form-control">
                <option disabled selected>اختر</option>
                <option value="../admin.html">الادمن</option>
                <option value="alkma.php">كيمياء</option>
                <option value="phy.php">فيزياء</option>
                <option value="bio.php">أحياء</option>
            </select>
        </div>
        <button type="submit" name="add" class="btn btn-success">إضافة كلمة المرور</button>
        <button type="submit" name="update" class="btn btn-primary">تحديث كلمة المرور</button>
        <button type="button" onclick="window.location.href='edit_password.php'">إعادة تحميل</button>
    </form>

    <h2>كلمات المرور الحالية</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>كلمة المرور</th>
            <th>رابط التوجيه</th>
            <th>حذف</th>
        </tr>
        <?php
        while ($row = $result->fetch_assoc()) {
            $url = htmlspecialchars($row["url"]);
            // تحديد الرابط الذي سيتم عرضه بناءً على القيمة
            
            $displayUrl = '';
            if ($url === "admin.html") {
                $displayUrl = "الادمن";
            } else {
                switch ($url) {
                    case "alkma.php":
                        $displayUrl = "كيمياء";
                        break;
                        case "phy.php":
                            $displayUrl = "فيزياء";
                            break;
                            case "bio.php":
                                $displayUrl = "أحياء";
                                break;
                                default:
                                $displayUrl = $url;
                                break;
                            }
                        }
                        
                        // عرض صف الجدول مع البيانات المعالجة
                        echo "<tr><td>" . htmlspecialchars($row["id"])
                        . "</td><td>" . htmlspecialchars($row["password"])
                        . "</td><td>" . $displayUrl 
                        . "</td><td>"
                        . "<button class='deleteButton' data-id='" . htmlspecialchars($row["id"]) . "'>حذف</button></td></tr>";
                    }
                    ?>
   
    </table>
</div>
</body>
</html>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    $(document).ready(function() {
        $(".deleteButton").click(function() {
            if (confirm("هل أنت متأكد من رغبتك في حذف هذا الصف؟")) {
                var id = $(this).data("id"); // استرداد معرّف الصف

                $.ajax({
                    url: "PHP/delete_data/delete_data_url.php", // استبدلها بعنوان الصفحة التي تقوم بمعالجة طلب الحذف
                    type: "POST",
                    data: { delete: true, id: id }, // إضافة معرّف الصف إلى البيانات المرسلة
                    success: function(response) {
                        // عرض رسالة الحذف الناجحة
                        alert(response);
                        // تحديث الجدول بإزالة الصف المحذوف
                        location.reload();
                    },
                    error: function(xhr, status, error) {
                        // أدخل هنا الإجراءات التي ترغب في تنفيذها في حالة حدوث خطأ
                        console.log(error);
                    }
                });
            }
        });
    });
    </script>


<!--?php
$conn->close();
?>
