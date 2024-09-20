<!DOCTYPE html>
<html dir="rtl">

<head>
    <meta charset="utf-8">
    <title>إضافة المعلمين</title>
    <link rel="stylesheet" href="CSS/admin.test.style.css">
    <style>
        /* أي CSS إضافي يمكن إضافته هنا */
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <form id="saveForm" method="POST">
        <label for="teachername">اسم المعلم</label>
        <input type="text" name="teachername" id="teachername">
        <label for="sub">المقرر الدراسي</label>
        <select id="sub" name="sub" required>
            <option value="كيمياء">كيمياء</option>
            <option value="فيزياء">فيزياء</option>
            <option value="أحياء">أحياء</option>
        </select>
        <input type="submit" name="submit" id="submit-button" value="حفظ">
    </form>
    <br>

    <table id="experimentsTable">
        <thead>
            <tr>
                <th>اسم المعلم</th>
                <th>المقرر الدراسي</th>
                <th>حذف</th>
            </tr>
        </thead>
        <tbody>
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

            // معالجة إرسال النموذج لإضافة المعلم
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $teachername = $_POST['teachername'];
                $sub = $_POST['sub'];

                $sql_insert = "INSERT INTO teatcher_name (teatchername, sub) VALUES ('$teachername', '$sub')";

                if ($conn->query($sql_insert) === TRUE) {
                    echo "تم إدخال بيانات المعلم بنجاح" . "<hr>";
                } else {
                    echo "حدث خطأ أثناء إدخال بيانات المعلم: " . $conn->error;
                }
            }

            // استعلام SQL لاسترداد البيانات
            $sql_select = "SELECT id, teatchername, sub FROM teatcher_name";
            $result = $conn->query($sql_select);

            if ($result->num_rows > 0) {
                // عرض البيانات كجدول HTML
                while ($row = $result->fetch_assoc()) {
                    echo "<tr><td>" . htmlspecialchars($row["teatchername"]) . "</td><td>" . htmlspecialchars($row["sub"]) . "</td><td>
                        <button class='deleteButton' data-id='" . $row["id"] . "'>حذف</button></td></tr>";
                }
            } else {
                echo "<tr><td colspan='3'>لا توجد بيانات لعرضها</td></tr>";
            }

            // إغلاق الاتصال بقاعدة البيانات
            $conn->close();
            ?>
        </tbody>
    </table>

    <script>
        $(document).ready(function() {
            // التفاعل مع نموذج الحفظ
            $("#saveForm").submit(function(event) {
                event.preventDefault(); // منع إرسال النموذج بشكل تلقائي

                var formData = $(this).serialize(); // جمع بيانات النموذج

                $.ajax({
                    url: "PHP/insert_teatcher.php", // استبدلها بعنوان الصفحة التي تقوم بمعالجة طلب الحفظ
                    type: "POST",
                    data: formData,
                    success: function(response) {
                        alert(response); // عرض أي رسائل نصية من الخادم
                        // تحديث الجدول بعد الحفظ
                        location.reload();
                    },
                    error: function(xhr, status, error) {
                        console.error('Error:', error);
                        alert('حدث خطأ أثناء إضافة المعلم');
                    }
                });
            });

            // التفاعل مع زر الحذف
            $(".deleteButton").click(function() {
                if (confirm("هل أنت متأكد من رغبتك في حذف هذا الصف؟")) {
                    var id = $(this).data("id"); // استرداد معرّف الصف

                    $.ajax({
                        url: "PHP/delete_data/delete_data_teatcher.php", // استبدلها بعنوان الصفحة التي تقوم بمعالجة طلب الحذف
                        type: "POST",
                        data: { delete: true, id: id }, // إضافة معرّف الصف إلى البيانات المرسلة
                        success: function(response) {
                            alert(response); // عرض رسالة الحذف الناجحة
                            // تحديث الجدول بإزالة الصف المحذوف
                            location.reload();
                        },
                        error: function(xhr, status, error) {
                            console.error('Error:', error);
                            alert('حدث خطأ أثناء حذف الصف');
                        }
                    });
                }
            });
        });
    </script>
</body>

</html>
