<!DOCTYPE html>
<html dir="rtl" lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>الشعب</title>
    <link rel="stylesheet" href="CSS/table.style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <h1>إدخال بيانات الصف</h1>
    <form action="" method="post">
        <label for="lower1">اولى ثانوي:</label>
        <input type="number" id="lower1" name="lower1" required> إلى 
        <input type="number" id="high1" name="high1" required><br><br>

        <label for="lower2">ثاني ثانوي:</label>
        <input type="number" id="lower2" name="lower2" required> إلى   
        <input type="number" id="high2" name="high2" required><br><br>

        <label for="lower3">ثالث ثانوي:</label>
        <input type="number" id="lower3" name="lower3" required> إلى    
        <input type="number" id="high3" name="high3" required><br><br>
        
        <input type="submit" value="إدخال البيانات">
    </form>

    <table>
        <tr>
            <th>اول ثانوي</th>
            <th>ثاني ثانوي</th>
            <th>ثالث ثانوي</th>
            <th>حذف</th>
        </tr>
        <?php
        // إعداد الاتصال بقاعدة البيانات
        $conn = new mysqli("localhost", "nnaame", "", "main");

        if ($conn->connect_error) {
            die("فشل الاتصال: " . $conn->connect_error);
        }

        // استعلام لاسترجاع البيانات
        $sql = "SELECT id, lower1, high1, lower2, high2, lower3, high3 FROM class";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<tr>';
                echo '<td>' . $row["lower1"] . ' - ' . $row["high1"] . '</td>';
                echo '<td>' . $row["lower2"] . ' - ' . $row["high2"] . '</td>';
                echo '<td>' . $row["lower3"] . ' - ' . $row["high3"] . '</td>';
                echo '<td><button class="deleteButton" data-id="' . $row["id"] . '">حذف</button></td>';
                echo '</tr>';
            }
        }
        ?>
    </table>

    <script>
        $(".deleteButton").click(function() {
            if (confirm("هل أنت متأكد من رغبتك في حذف هذا الصف؟")) {
                var id = $(this).data("id");

                $.ajax({
                    url: "PHP/delete_data/delete_data_class.php",
                    type: "POST",
                    data: { delete: true, id: id },
                    success: function(response) {
                        alert(response);
                        location.reload();
                    },
                    error: function(xhr, status, error) {
                        console.error('Error:', error);
                        alert('حدث خطأ أثناء حذف الصف');
                    }
                });
            }
        });
    </script>

    <?php
    // التحقق مما إذا كانت البيانات قد أُرسلت
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $lower1 = $_POST['lower1'];
        $lower2 = $_POST['lower2'];
        $lower3 = $_POST['lower3'];
        $high1 = $_POST['high1'];
        $high2 = $_POST['high2'];
        $high3 = $_POST['high3'];

        // تحقق من وجود الأرقام بالفعل في قاعدة البيانات
        $stmt = $conn->prepare("SELECT COUNT(*) FROM class WHERE (lower1 = ? OR high1 = ? OR lower2 = ? OR high2 = ? OR lower3 = ? OR high3 = ?)");
        $stmt->bind_param("iiiiii", $lower1, $high1, $lower2, $high2, $lower3, $high3);
        $stmt->execute();
        $stmt->bind_result($count);
        $stmt->fetch();
        $stmt->close();

        // إذا كانت الأرقام موجودة، أظهر رسالة
        if ($count > 0) {
            echo "<script>alert('البيانات المدخلة موجودة بالفعل، يرجى إدخال أرقام مختلفة.');</script>";
        } else {
            // إعداد الاستعلام لإدخال البيانات
            $stmt = $conn->prepare("INSERT INTO class (lower1, lower2, lower3, high1, high2, high3) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("iiiiii", $lower1, $lower2, $lower3, $high1, $high2, $high3);

            // تنفيذ الاستعلام
            if ($stmt->execute()) {
                echo "<script>alert('تم إدخال البيانات بنجاح!');</script>";
            } else {
                echo "<script>alert('خطأ في الإدخال: " . $stmt->error . "');</script>";
            }

            // إغلاق الاستعلام
            $stmt->close();
        }
    }

    // إغلاق الاتصال
    $conn->close();
    ?>
</body>
</html>
