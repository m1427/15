<!DOCTYPE html>
<html dir="rtl">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>حذف التجارب</title>
    <link rel="stylesheet" href="CSS/admin.test.style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootswatch/4.3.1/flatly/bootstrap.min.css">
    <link href="datepick/css1/bootstrap-datetimepicker.css?v2" rel="stylesheet" />
    <style>
        .input-group-prepend, .input-group-append {
            width: 25% !important;
        }
        .input-group {
            margin-bottom: 15px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: center;
        }
    </style>
</head>

<body>
    <br><br>
    <form method="POST">
    <div class="input-group">
            <span class="input-group-text">تحديد الفترة:</span>
            <div class="input-group-prepend">
                <input type="text" id="startDate" name="startDate" class="form-control hijri-date-input" placeholder="تاريخ البداية" required>
            </div>
            <div class="input-group-append">
                <input type="text" id="endDate" name="endDate" class="form-control hijri-date-input" placeholder="تاريخ النهاية">
            </div>
            <div>
                <button type="submit">عرض</button>
                <button type="button" onclick="window.location.href='delete.c.php'">إعادة تحميل</button>
            </div>
        </div>
    </form>

     <!-- تحميل المكتبات الضرورية -->
     <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/moment-hijri@2.1.2/moment-hijri.min.js"></script>
    <script src="datepick/java/bootstrap-hijri-datetimepicker.js"></script>

    <!-- تهيئة التاريخ الهجري وتفعيل عملية الحذف -->
    <script>
        $(document).ready(function() {
            // تهيئة محدد التاريخ الهجري
            $('.hijri-date-input').hijriDatePicker({
                hijri: true,
                format: "هـ YYYY-MM-DD",
                locale: "en"
            });

            // التعامل مع عملية الحذف باستخدام AJAX
            $(".deleteButton").click(function() {
                if (confirm("هل أنت متأكد من رغبتك في حذف هذا الصف؟")) {
                    var id = $(this).data("id");

                    $.ajax({
                        url: "PHP/delete_data/delete_data.php",
                        type: "POST",
                        data: {
                            delete: true,
                            id: id
                        },
                        success: function(response) {
                            alert(response);
                            location.reload();
                        },
                        error: function(xhr, status, error) {
                            console.log(error);
                        }
                    });
                }
            });
        });
    </script>

    <table>
        <tr>
            <th>اسم المعلم</th>
            <th>المقرر الدراسي</th>
            <th>التاريخ</th>
            <th>الشعبة</th>
            <th>الحصة</th>
            <th>اسم التجربة</th>
            <th>حذف</th>
        </tr>
        <?php

// اتصال بقاعدة البيانات
$conn = mysqli_connect("localhost", "nnaame", "", "main");

if ($conn->connect_error) {
    die("فشل الاتصال: " . $conn->connect_error);
}

// استرداد التواريخ من الإدخال
$startDate = isset($_POST["startDate"]) ? mysqli_real_escape_string($conn, $_POST["startDate"]) : null;
$endDate = isset($_POST["endDate"]) ? mysqli_real_escape_string($conn, $_POST["endDate"]) : null;

// بناء الاستعلام الأساسي مع شرط للمواد
$sql = "SELECT id, teatchername, sub, date, class, cl, experimentName FROM alkma WHERE sub IN (
    'كيمياء 1','كيمياء 1-1','كيمياء 1-2','كيمياء 1-3',
    'كيمياء 2','كيمياء 2-1','كيمياء 2-2','كيمياء 2-3',
    'كيمياء 3','كيمياء 3-1','كيمياء 3-2','كيمياء 3-3'
)";

// إضافة شروط البحث بناءً على التواريخ المدخلة
$conditions = [];
if (!empty($startDate) && !empty($endDate)) {
    $conditions[] = "date BETWEEN '$startDate' AND '$endDate'";
} elseif (!empty($startDate)) {
    $conditions[] = "date = '$startDate'";
}

// إذا كانت هناك شروط، قم بإضافتها إلى الاستعلام
if (count($conditions) > 0) {
    $sql .= " AND " . implode(" AND ", $conditions);
}

// تنفيذ الاستعلام
$result = $conn->query($sql);

// التحقق من وجود نتائج
if ($result && $result->num_rows > 0) {
    // إذا كانت هناك نتائج
    while ($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["teatchername"] . "</td><td>" . $row["sub"] . "</td><td>" . $row["date"] . "</td><td>" .
            $row["class"] . "</td><td>" . $row["cl"] . "</td><td>" . $row["experimentName"] . "</td><td>
        <button class='deleteButton' data-id='" . $row["id"] . "'>حذف</button></td></tr>";
    }
} else {
    // إذا لم تكن هناك نتائج
    echo "<tr><td colspan='7'>لا توجد بيانات لعرضها</td></tr>";
}

// إغلاق الاتصال بقاعدة البيانات
$conn->close();
?>


    </table>
</body>

</html>