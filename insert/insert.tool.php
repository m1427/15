<!DOCTYPE html>
<html dir="rtl">

<head>
    <meta charset="utf-8">
    <title>إضافة المواد والأدوات</title>
    <link rel="stylesheet" href="CSS/admin.test.style.css">
    <style>
        /* أي CSS إضافي يمكن إضافته هنا */
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <form id="saveForm" method="POST">
        <label for="tool">المواد أو الأدوات</label>
        <input type="text" name="tool" id="tool">
        <input type="submit" name="submit" id="submit-button" value="حفظ">
    </form>
    <br>

    <table id="tool-table">
        <thead>
            <tr>
                <th>المواد أو الأدوات</th>
                <th>حذف</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // إعداد الاتصال بقاعدة البيانات
            $servername = "localhost";
            $username = "nnaame"; // اسم المستخدم لقاعدة البيانات
            $password = ""; // كلمة المرور لقاعدة البيانات
            $dbname = "main"; // اسم قاعدة البيانات

            $conn = new mysqli($servername, $username, $password, $dbname);

            // التحقق من الاتصال
            if ($conn->connect_error) {
                die("فشل الاتصال: " . $conn->connect_error);
            }

            // معالجة إرسال النموذج لإضافة المادة أو الأداة
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $tool = $_POST['tool'];

                $sql_insert = "INSERT INTO experimenttool (tool) VALUES ('$tool')";

                if ($conn->query($sql_insert) === TRUE) {
                    echo "تم إدخال بيانات المادة أو الأداة بنجاح" . "<hr>";
                } else {
                    echo "حدث خطأ أثناء إدخال بيانات المادة أو الأداة: " . $conn->error;
                }
            }

            // استعلام SQL لاسترداد البيانات
            $sql_select = "SELECT id, tool FROM experimenttool";
            $result = $conn->query($sql_select);

            if ($result->num_rows > 0) {
                // عرض البيانات كجدول HTML
                while ($row = $result->fetch_assoc()) {
                    echo "<tr><td>" . htmlspecialchars($row["tool"]) . "</td><td>" . "<button class='deleteButton' data-id='" . $row["id"] . "'>حذف</button></td></tr>";
                }
            } else {
                echo "<tr><td colspan='2'>لا توجد بيانات لعرضها</td></tr>";
            }

            // إغلاق الاتصال بقاعدة البيانات
            $conn->close();
            ?>
        </tbody>
    </table>

    <script>
        $(document).ready(function () {
            // التفاعل مع نموذج الحفظ
            $("#saveForm").submit(function (event) {
                event.preventDefault(); // منع إرسال النموذج بشكل تلقائي

                var formData = $(this).serialize(); // جمع بيانات النموذج

                $.ajax({
                    url: "PHP/insert_tool.php", // استبدلها بعنوان الصفحة التي تقوم بمعالجة طلب الحفظ
                    type: "POST",
                    data: formData,
                    success: function (response) {
                        alert(response); // عرض أي رسائل نصية من الخادم
                        // تحديث الجدول بعد الحفظ
                        location.reload();
                    },
                    error: function (xhr, status, error) {
                        console.error('Error:', error);
                        alert('حدث خطأ أثناء إضافة المادة أو الأداة');
                    }
                });
            });

            // التفاعل مع زر الحذف
            $(".deleteButton").click(function () {
                if (confirm("هل أنت متأكد من رغبتك في حذف هذا الصف؟")) {
                    var id = $(this).data("id"); // استرداد معرّف الصف

                    $.ajax({
                        url: "PHP/delete_data/delete_data_tool.php", // استبدلها بعنوان الصفحة التي تقوم بمعالجة طلب الحذف
                        type: "POST",
                        data: { delete: true, id: id }, // إضافة معرّف الصف إلى البيانات المرسلة
                        success: function (response) {
                            alert(response); // عرض رسالة الحذف الناجحة
                            // تحديث الجدول بإزالة الصف المحذوف
                            location.reload();
                        },
                        error: function (xhr, status, error) {
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
