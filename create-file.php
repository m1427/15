<?php
// تابع لإنشاء ملف
function createFile($filename) {
    // تحديد اسم الملف
    $file = $filename;
    
    // محتوى HTML كـ نص
    $content = <<<HTML
<!DOCTYPE html>
<html dir="rtl" lang="en">
<head>
    <meta charset="utf-8">
    <title>مختبر الكيمياء</title>
    <link rel="stylesheet" href="CSS/alkma.style.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/moment-hijri@2.1.2/moment-hijri.min.js"></script>
    <script src="datepick/js/bootstrap-hijri-datetimepicker.js"></script>
    <style>
        .error { border-color: red; }
        .success { border-color: green; }
        .dynamicInput { width: auto; }
        #confirmation-modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.4);
        }
        #modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            text-align: center;
            position: relative;
        }
        #close-button { color: #aaa; position: absolute; top: 0; right: 0; font-size: 28px; font-weight: bold; cursor: pointer; }
        #cancel-button { margin-top: 10px; padding: 5px 10px; background-color: #ccc; border: none; cursor: pointer; }
        #cancel-button:hover { background-color: #aaa; }
        #experimentToolOptions { display: block; }
    </style>
</head>
<body>
    <form method="post" id="booking-form"> 
        <header>
            <h2>شكراً للدخولك لمعمل الكيمياء</h2>
            <p>الإصدار التجريبي</p>
        </header>
        <main>
            <label for="teatchername">اسم المعلم</label>
            <select id="teatchername" name="teatchername" required>
                <?php
                // تفاصيل الاتصال بقاعدة البيانات
                \$servername = "localhost";
                \$username = "nnaame";
                \$password = "";
                \$dbname = "main";
                
                // إنشاء اتصال
                \$conn = new mysqli(\$servername, \$username, \$password, \$dbname);

                // التحقق من الاتصال
                if (\$conn->connect_error) {
                    die("فشل الاتصال: " . \$conn->connect_error);
                }

                // استعلام SQL لجلب البيانات
                \$sql = "SELECT teatchername FROM teatcher_name where sub= 'كيمياء'"; // تعديل استعلام SQL حسب الجدول و الأعمدة لديك
                \$result = \$conn->query(\$sql);

                if (\$result->num_rows > 0) {
                    // عرض البيانات في قائمة الخيارات
                    echo '<option value="" disabled selected>اختر</option>';
                    while (\$row = \$result->fetch_assoc()) {
                        echo '<option value="' . \$row["teatchername"] . '">' . \$row["teatchername"] . "</option>";
                    }
                } else {
                    echo '<option value="">لا توجد بيانات</option>';
                }

                // إغلاق الاتصال بقاعدة البيانات
                \$conn->close();
                ?>
            </select><span class="required">*</span>

            <label style="margin-right: 100px;" for="sub">المقرر</label>
            <select id="sub" name="sub" required>
                <?php
                // تفاصيل الاتصال بقاعدة البيانات
                \$servername = "localhost";
                \$username = "nnaame";
                \$password = "";
                \$dbname = "main";
                
                // إنشاء اتصال
                \$conn = new mysqli(\$servername, \$username, \$password, \$dbname);

                // التحقق من الاتصال
                if (\$conn->connect_error) {
                    die("فشل الاتصال: " . \$conn->connect_error);
                }

                // استعلام SQL لجلب البيانات
                \$sql = "SELECT sub, num FROM books where sub= 'كيمياء'"; // تعديل استعلام SQL حسب الجدول و الأعمدة لديك
                \$result = \$conn->query(\$sql);

                if (\$result->num_rows > 0) {
                    // عرض البيانات في قائمة الخيارات
                    echo '<option value="" disabled selected>اختر</option>';
                    while (\$row = \$result->fetch_assoc()) {
                        echo '<option value="'. \$row["sub"] . ' ' . \$row["num"] . '">' 
                        . \$row["sub"] . ' ' . \$row["num"] 
                        . "</option>";
                }
                } else {
                    echo '<option value="">لا توجد بيانات</option>';
                }

                // إغلاق الاتصال بقاعدة البيانات
                \$conn->close();
                ?>
            </select><span class="required">*</span>

            <label style="margin-right: 100px;" for="your_class">الشعبة</label>
            <select id="your_class" name="your_class" required></select>      

            <p>حدد موعد حصتك</p>
            <div class="input-group">
                التاريخ
                <input type="text" id="date" name="date" class="form-control hijri-date-default" />
            </div>

            <link href="https://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
            <link rel="stylesheet" href="CSS1/bootstrap.min.css">
            <link href="datepick/css1/bootstrap-datetimepicker.css?v2" rel="stylesheet" />

            <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment-with-locales.min.js"></script>
            <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/moment-hijri@2.1.2/moment-hijri.min.js"></script>
            <script src="datepick/java/bootstrap-hijri-datetimepicker.js?v2"></script>
                        
            <br>
            <label for="time1">الحصة <span class="required">*</span></label>
            <select id="time1" name="cl" required>
                <option value="0" disabled selected>اختر</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
            </select><span class="required">*</span><br>

            <p>اسم التجربة <span class="required">*</span></p>
            <input type="text" id="experimentName" name="experimentName" required>

            <p>ادوات التجربة</p>
            <div id="experimentToolOptions">
                <!-- أدوات التجربة الديناميكية ستُضاف هنا -->
            </div>

            <button type="button" id="addToolButton">إضافة أداة تجربة</button>
            <button type="button" id="submitForm">حفظ</button>
        </main>
    </form>

    <!-- مودال التأكيد -->
    <div id="confirmation-modal">
        <div id="modal-content">
            <span id="close-button">&times;</span>
            <h2>تأكيد</h2>
            <p>هل أنت متأكد أنك تريد حفظ التعديلات؟</p>
            <button id="confirm-button">تأكيد</button>
            <button id="cancel-button">إلغاء</button>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // تفعيل DatePicker
            $('#date').datetimepicker({
                hijri: true,
                format: 'iYYYY/iMM/iDD',
                locale: 'ar'
            });

            // إضافة أدوات التجربة
            function addExperimentTool() {
                var container = document.getElementById('experimentToolOptions');
                var input = document.createElement('input');
                input.type = 'text';
                input.name = 'experimentTool[]';
                input.className = 'dynamicInput';
                container.appendChild(input);
                container.appendChild(document.createElement('br'));
            }

            document.getElementById('addToolButton').addEventListener('click', addExperimentTool);

            // إدارة مودال التأكيد
            var modal = document.getElementById("confirmation-modal");
            var closeButton = document.getElementById("close-button");
            var confirmButton = document.getElementById("confirm-button");
            var cancelButton = document.getElementById("cancel-button");
            var submitButton = document.getElementById("submitForm");

            submitButton.onclick = function() {
                modal.style.display = "block";
            };

            closeButton.onclick = function() {
                modal.style.display = "none";
            };

            cancelButton.onclick = function() {
                modal.style.display = "none";
            };

            confirmButton.onclick = function() {
                // قم هنا بإضافة الكود اللازم لإرسال النموذج
                document.getElementById("booking-form").submit();
            };
        });
    </script>
</body>
</html>
HTML;

    // كتابة المحتوى إلى الملف
    file_put_contents($file, $content);
}

// تابع لحذف ملف
function deleteFile($filename) {
    if (file_exists($filename)) {
        unlink($filename);
        echo "الملف $filename تم حذفه بنجاح.";
    } else {
        echo "الملف $filename غير موجود.";
    }
}

// مثال على كيفية إنشاء ملف جديد
createFile('newfile1.html');

// مثال على كيفية حذف ملف
deleteFile('newfile1.html');
?>
