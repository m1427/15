<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تقرير الأدوات</title>
    <link rel="stylesheet" href="CSS/bootstrap.min.css">
    <link href="datepick/css1/bootstrap-datetimepicker.css?v2" rel="stylesheet">
    <link rel="stylesheet" href="CSS/rep2.style.css">
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
                    });})
            </script>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        td {
            background-color: #ffffff;
            color: #000000;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: right;
        }

        th {
            background-color: #ffffff;
            color: #000000;
        }

        .print-button {
            margin-top: 10px;
        }

        .input-group {
            margin-bottom: 20px;
        }

        #h4 {
            margin-top: 1px;
            width: 100%;
            position: relative; /* تحديد موضع العناصر بالنسبة لهذا العنصر */
            padding: 20px; /* إضافة بعض المسافة حول المحتوى */
        }

        #teat, #teat1, #prince, #prince1 {
            position: absolute; /* تحديد موضع العناصر بدقة */
            width: 50%; /* عرض العناصر بالنسبة للحاوية */
            box-sizing: border-box; /* احتساب الحشوة والحدود ضمن العرض والارتفاع */
            padding: 10px; /* إضافة بعض الحشوة داخل العناصر */
        }

        #teat, #teat1 {
            right: 5%; /* المسافة من اليمين */
            text-align: right; /* محاذاة النص إلى اليمين */
        }

        #teat {
            top: 0%; /* المسافة من أعلى الحاوية */
        }

        #teat1 {
            top: 70%; /* المسافة من أعلى الحاوية */
        }

        #prince, #prince1 {
            left: 5%; /* المسافة من اليسار */
            text-align: left; /* محاذاة النص في المركز */
        }

        #prince {
            top: 0%; /* المسافة من أسفل الحاوية */
        }

        #prince1 {
            top: 70%; /* المسافة من أسفل الحاوية */
        }

    </style>
</head>

<body>

<div class="first_div">
    <!-- شعار وزارة التعليم -->
    <img src="picture/moe.png" class="moe" alt="شعار وزارة التعليم"> <br>
    <class class="h31">
        المملكة العربية السعودية<br><br>
        وزارة التعليم<br><br>
        الإدارة العامة للتعليم بمحافظة الأحساء<br><br>
        مدرسة الملك خالد الثانوية<br>
    </class>
    <!-- شعار ثانوية الملك خالد -->
    <img src="picture/school.jpg" class="school" alt="شعار ثانوية الملك خالد">
</div>

<form method="POST">
    <div id="input-group" class="input-group">
        <div class="input-group-prepend">
        <span class="input-group-text">تحديد الفترة:</span>
        <div class="input-group-prepend">
            <input type="text" id="startDate" name="startDate" class="form-control hijri-date-input" placeholder="تاريخ البداية" required>
        </div>
        <div class="input-group-append">
            <input type="text" id="endDate" name="endDate" class="form-control hijri-date-input" placeholder="تاريخ النهاية">
        </div>
    </div>
        <button type="submit" class="btn btn-primary">عرض</button>
        <button type="button" class="btn btn-secondary" onclick="window.location.href='rep2.php'">إعادة تحميل</button>
        <button id="print-button" class="btn btn-primary" onclick="printTable()">طباعة</button>
    </div>
</form>

<table>
    <thead>
        <tr>
            <th>اسم المعلم</th>
            <th>المقرر الدراسي</th>
            <th>التاريخ</th>
            <th>اسم التجربة</th>
            <th colspan="10">الأدوات</th>
        </tr>
    </thead>
    <tbody>
    <?php
// الاتصال بقاعدة البيانات
$conn = new mysqli("localhost", "nnaame", "", "main"); // تحديث المعلومات بشكل صحيح

if ($conn->connect_error) {
    die("فشل الاتصال: " . $conn->connect_error);
}

// استرداد التواريخ من الإدخال
$startDate = isset($_POST["startDate"]) ? mysqli_real_escape_string($conn, $_POST["startDate"]) : null;
$endDate = isset($_POST["endDate"]) ? mysqli_real_escape_string($conn, $_POST["endDate"]) : null;

// بناء الاستعلام الأساسي مع شرط للمواد
$sql = "SELECT teatchername, sub, date, experimentName, experimenttool1, experimenttool2, experimenttool3, experimenttool4, experimenttool5, experimenttool6, experimenttool7, experimenttool8, experimenttool9, experimenttool10 FROM alkma";

// إضافة شروط البحث بناءً على التواريخ المدخلة
$conditions = [];
if (!empty($startDate) && !empty($endDate)) {
    $conditions[] = "date BETWEEN '$startDate' AND '$endDate'";
} elseif (!empty($startDate)) {
    $conditions[] = "date = '$startDate'";
}

// إذا كانت هناك شروط، قم بإضافتها إلى الاستعلام
if (count($conditions) > 0) {
    $sql .= " WHERE " . implode(" AND ", $conditions);
}

// تنفيذ الاستعلام
if ($stmt = $conn->prepare($sql)) {
    $stmt->execute();
    $result = $stmt->get_result();

    // التحقق من وجود نتائج
    if ($result->num_rows > 0) {
        // إذا كانت هناك نتائج
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . htmlspecialchars($row["teatchername"]) . "</td>
                    <td>" . htmlspecialchars($row["sub"]) . "</td>
                    <td>" . htmlspecialchars($row["date"]) . "</td>
                    <td>" . htmlspecialchars($row["experimentName"]) . "</td>
                    <td>" . htmlspecialchars($row["experimenttool1"]) . "</td>
                    <td>" . htmlspecialchars($row["experimenttool2"]) . "</td>
                    <td>" . htmlspecialchars($row["experimenttool3"]) . "</td>
                    <td>" . htmlspecialchars($row["experimenttool4"]) . "</td>
                    <td>" . htmlspecialchars($row["experimenttool5"]) . "</td>
                    <td>" . htmlspecialchars($row["experimenttool6"]) . "</td>
                    <td>" . htmlspecialchars($row["experimenttool7"]) . "</td>
                    <td>" . htmlspecialchars($row["experimenttool8"]) . "</td>
                    <td>" . htmlspecialchars($row["experimenttool9"]) . "</td>
                    <td>" . htmlspecialchars($row["experimenttool10"]) . "</td>
                </tr>";
        }
    } else {
        // إذا لم تكن هناك نتائج
        echo "<tr><td colspan='14'>لا توجد بيانات لعرضها</td></tr>";
    }

    $stmt->close();
} else {
    echo "خطأ في الاستعلام: " . $conn->error;
}

// إغلاق الاتصال بقاعدة البيانات
$conn->close();
?>
</tbody>
</table>

<div id="h4">
    <label id="teat">محضر المختبر</label>
    <label id="teat1">أ. عبداللة العبيدان</label>
    <label id="prince">مدير المدرسة</label>
    <label id="prince1">أ. بدر المجحم</label>
</div>


<script>
    function printTable() {
        //var printButton = document.getElementById('print-button');
        var targetDateInput = document.getElementById('input-group');

       // printButton.style.display = 'none';
        targetDateInput.style.display = 'none';

        window.print();

       // printButton.style.display = 'block';
        targetDateInput.style.display = 'inline-block';
    }
</script>

</body>
</html>
