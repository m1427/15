<!DOCTYPE html>
<html dir="rtl">

<head>
    <meta charset="utf-8">
    <title>حذف التجارب</title>
    <link rel="stylesheet" href="CSS/admin.test.style.css">
    <style>
        /* أي CSS إضافي يمكن إضافته هنا */
    </style>
</head>

<body>
    <form id="saveForm" method="POST">
        <label for="teatchername">اسم المعلم</label>
        <input type="text" name="teatchername" id="teatchername">
        <label for="sub">المقرر الدراسي</label>
        <select id="sub" name="sub" required>
            <option value="كيمياء">كيمياء</option>
            <option value="فيزياء">فيزياء</option>
            <option value="أحياء">أحياء</option>
        </select>
        <input type="submit" name="submit" id="submit-button" value="حفظ">
    </form>

    <table id="experimentsTable">
        <tr>
            <th>اسم المعلم</th>
            <th>المقرر الدراسي</th>
            <th>حذف</th>
        </tr>
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

        // استعلام SQL لاسترداد البيانات
        $sql = "SELECT id, 	teatchername, sub FROM teatcher_name";
        $result = $conn->query($sql);

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
    </table>

    <script>
        // التفاعل مع نموذج الحفظ
        document.getElementById("saveForm").addEventListener("submit", function(event) {
            event.preventDefault(); // منع إرسال النموذج بشكل تلقائي

            var formData = new FormData(this); // جمع بيانات النموذج

            fetch("insert_teacher.php", {
                    method: "POST",
                    body: formData
                })
                .then(response => response.text())
                .then(data => {
                    alert(data); // عرض أي رسائل نصية من الخادم
                    // تحديث الجدول بعد الحفظ
                    updateTable();
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('حدث خطأ أثناء إضافة المعلم');
                });
        });

        // التفاعل مع زر الحذف
        document.querySelectorAll('.deleteButton').forEach(item => {
            item.addEventListener('click', function() {
                var id = this.getAttribute('data-id');
                if (confirm('هل أنت متأكد أنك تريد حذف هذا السجل؟')) {
                    // إرسال طلب حذف السجل إلى الخادم
                    fetch('delete_record.php?id=' + id, {
                            method: 'DELETE'
                        })
                        .then(response => {
                            if (!response.ok) {
                                throw new Error('حدث خطأ أثناء حذف السجل');
                            }
                            return response.text();
                        })
                        .then(data => {
                            alert(data); // عرض أي رسائل نصية من الخادم
                            // تحديث الجدول بعد الحذف
                            updateTable();
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            alert('حدث خطأ أثناء حذف السجل');
                        });
                }
            });
        });

        // تحديث الجدول بعد الحفظ أو الحذف
        function updateTable() {
            fetch("update_table.php")
                .then(response => response.text())
                .then(html => {
                    document.getElementById("experimentsTable").innerHTML = html;
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('حدث خطأ أثناء تحديث الجدول');
                });
        }
    </script>
</body>

</html>
