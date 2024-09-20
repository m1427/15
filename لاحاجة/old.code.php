<head>
<!--script src="alkma.js"></script>
<script src="https://cdn.jsdelivr.net/npm/hijri-js@latest/dist/hijri.js"></script-->


<!--script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment-with-locales.min.js"></script-->
</head>


<body>


      <!--label for="userInput">التاريخ بالأرقام العربية (التنسيق: يوم-شهر-سنة)</label>
    <input type="text" name="date" class="form-control hijri-date-default" id="userInput" oninput="translateInput()" placeholder="ادخل التاريخ بالأرقام العربية (مثال: ٢٣-٠٧-٢٠٢٤)">
    <p>التاريخ بالإنجليزية: <span id="translatedOutput"></span></p-->


    <!--label for="arabicDate">أدخل التاريخ بالأرقام العربية</label>
    <!--Input name="date" type="date" id="arabicDate" onblur="convertDate()">
    <input type="text"  id="arabicDate" class="form-control hijri-date-default" onblur="convertDate()">
    <!--p id="result"></p>
    <div id="output" name="date"></div-->
 <!--label for="arabicDate">أدخل التاريخ بالأرقام العربية</label>
    <input type="text" id="arabicDate" class="form-control hijri-date-default" onblur="convertDate()">
    <div name="date" id="output"></div>

    <script>
        // JavaScript النص البرمجي 
        function convertDate() {
            var inputDate = document.getElementById('arabicDate').value;
            var convertedDate = arToEn(inputDate);  // يفترض أن تكون arToEn() دالة تقوم بتحويل التاريخ من العربية إلى الإنجليزية
            document.getElementById('output').innerText = convertedDate;
        }
    </script>

                      

<label for="arabicDate">أدخل التاريخ بالأرقام العربية</label>
<input type="text" id="arabicDate" class="form-control hijri-date-default" onblur="saveDate()">
<div id="output"></div>




                        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
                        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
                        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
                        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment-with-locales.min.js"></script>
                        <script src="moment-hijri.min.js"></script>
                        <script src="src/js/bootstrap-hijri-datetimepicker.js"></script>

                       
                        <link rel="stylesheet" href="CSS/bootstrap.min.css">
                        <link href="src/css/bootstrap-datetimepicker.css" rel="stylesheet"-->
                        
                        

<!--action="<!?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"-->
    <!--input type="text" id= "hdate"-->
    <!--input type="text" id= "hdate" class="form-control hijri-date-default"-->
    <!--link href="css/jquerysctipttop.css" rel="stylesheet" type="text/css"-->

    <!--script>
    document.addEventListener('DOMContentLoaded', function () {
        document.getElementById('submit-button').addEventListener('click', function (event) {
            event.preventDefault();

            if (validateForm()) {
                document.getElementById('confirmation-modal').style.display = 'block';
            } else {
                // يمكنك هنا إضافة رسالة خطأ أو تركها فارغة
            }
        });

        document.getElementById('close-button').addEventListener('click', function () {
            closeConfirmationModal();
        });

        document.getElementById('cancel-button').addEventListener('click', function () {
            closeConfirmationModal();
        });

        document.getElementById('confirm-button').addEventListener('click', function () {
            document.getElementById('booking-form').submit();
        });
    });

    .then(function(response) {
                // معالجة إرسال النموذج بنجاح
                console.log('تم إرسال النموذج بنجاح!');
                closeConfirmationModal();
                // إعادة تحميل الصفحة إذا كانت هناك حاجة لذلك
                // window.location.reload(); // انتبه! قد تكون هذه الخطوة غير مطلوبة
            })
            .catch(function(error) {
                // معالجة أي أخطاء حدثت أثناء إرسال النموذج
                console.error('حدث خطأ أثناء إرسال النموذج:', error);
            });
        

    function validateForm() {
        var experimentName = document.getElementById('experimentName').value.trim();

        if (experimentName === '') {
            return false;
        }

        return true;
    }

    function closeConfirmationModal() {
        document.getElementById('confirmation-modal').style.display = 'none';
    }
</script>


<script>
    document.addEventListener('DOMContentLoaded', function () {
        // إضافة استماع لنقرة زر "تأكيد" في النافذة المنبثقة
        document.getElementById('confirm-button').addEventListener('click', function () {
            // الحصول على عنصر النموذج
            var form = document.getElementById('booking-form');

            // إنشاء كائن FormData جديد وإضافة بيانات النموذج إليه
            var formData = new FormData(form);

            // إرسال النموذج باستخدام واجهة برمجة تطبيقات Fetch
            fetch(form.action, {
                method: 'POST',
                body: formData
            })
            .then(function(response) {
                // معالجة إرسال النموذج بنجاح
                console.log('تم إرسال النموذج بنجاح!');
                closeConfirmationModal();
                // إعادة تحميل الصفحة إذا كانت هناك حاجة لذلك
                // window.location.reload(); // انتبه! قد تكون هذه الخطوة غير مطلوبة
            })
            .catch(function(error) {
                // معالجة أي أخطاء حدثت أثناء إرسال النموذج
                console.error('حدث خطأ أثناء إرسال النموذج:', error);
            });
        });

        // التحقق من صحة النموذج قبل الإرسال
        document.getElementById('submit-button').addEventListener('click', function (event) {
            // فحص صحة الحقول هنا باستخدام وظيفة validateForm()
            if (!validateForm()) {
                event.preventDefault(); // إذا لم تكن البيانات صحيحة، منع السلوك الافتراضي للزر
            }
        });

        // إغلاق النافذة المنبثقة عند الضغط على زر الإغلاق أو الإلغاء
        document.getElementById('close-button').addEventListener('click', function () {
            closeConfirmationModal();
        });

        document.getElementById('cancel-button').addEventListener('click', function () {
            closeConfirmationModal();
        });

        // وظيفة لإغلاق النافذة المنبثقة
        function closeConfirmationModal() {
            document.getElementById('confirmation-modal').style.display = 'none';
        }

        // وظيفة للتحقق من صحة النموذج
        function validateForm() {
            var experimentName = document.getElementById('experimentName').value.trim();

            if (experimentName === '') {
                // إذا كان أي من الحقول فارغًا
                return false;
            }

            return true; // إذا كانت جميع الحقول صحيحة
        }
    });
</script> 
    
    <script>
    document.getElementById('confirm-button').addEventListener('click', function () {
    // الحصول على عنصر النموذج
    var form = document.getElementById('booking-form');

    // إنشاء كائن FormData جديد وإضافة بيانات النموذج إليه
    var formData = new FormData(form);

    // إرسال النموذج باستخدام واجهة برمجة تطبيقات Fetch
    fetch(form.action, {
        method: 'POST',
        body: formData
    })
    .then(function(response) {
        // معالجة إرسال النموذج بنجاح
        console.log('تم إرسال النموذج بنجاح!');
        closeConfirmationModal();
    })
    .catch(function(error) {
        // معالجة أي أخطاء حدثت أثناء إرسال النموذج
        console.error('حدث خطأ أثناء إرسال النموذج:', error);
    });
});
    </script>

<script>
        document.addEventListener('DOMContentLoaded', function () {
            // التحقق من صحة النموذج قبل الإرسال
            document.getElementById('submit-button').addEventListener('click', function (event) {
                event.preventDefault(); // منع السلوك الافتراضي للزر

                // فحص صحة الحقول هنا
                if (validateForm()) {
                    // إذا كانت البيانات صحيحة، عرض النافذة المنبثقة
                    document.getElementById('confirmation-modal').style.display = 'block';
                } else {
                    // إذا لم تكن البيانات صحيحة، يمكنك هنا إضافة رسالة خطأ أو اتركها فارغة
                }
            });

            // إغلاق النافذة المنبثقة عند الضغط على زر الإغلاق أو الإلغاء
            document.getElementById('close-button').addEventListener('click', function () {
                closeConfirmationModal();
            });

            document.getElementById('cancel-button').addEventListener('click', function () {
                closeConfirmationModal();
            });

            // إرسال النموذج عند الضغط على زر التأكيد في النافذة المنبثقة
            document.getElementById('confirm-button').addEventListener('click', function () {
                // تأكيد الإرسال بدون فحص إضافي لأنه تم فحصه مسبقًا
                document.getElementById('booking-form').submit();
            });
        });

        // وظيفة للتحقق من صحة النموذج
        function validateForm() {
            var experimentName = document.getElementById('experimentName').value.trim();

            if (experimentName === '') {
                // إذا كان أي من الحقول فارغًا
                return false;
            }

            return true; // إذا كانت جميع الحقول صحيحة
        }

        // وظيفة لإغلاق النافذة المنبثقة
        function closeConfirmationModal() {
            document.getElementById('confirmation-modal').style.display = 'none';
        }
    </script-->

    <!--script>
        
       document.getElementById("sub").addEventListener("change", function () {
    var selectedValue = this.value;
    var timeSelect = document.getElementById("your_class");

    // Clear existing options
    timeSelect.innerHTML = "";

    if (selectedValue === "أحياء 1") {
        // Add options for أحياء 1
        for (var i = 101; i <= 108; i++) {
            var option = document.createElement("option");
            option.value = i;
            option.textContent = i;
            timeSelect.appendChild(option);
        }
    } else if (selectedValue === "أحياء 2-1" || selectedValue === "أحياء 2-2" || selectedValue === "أحياء 2-3") {
        // Add options for أحياء 2
        for (var i = 201; i <= 209; i++) {
            var option = document.createElement("option");
            option.value = i;
            option.textContent = i;
            timeSelect.appendChild(option);
        }
    } else if (selectedValue === "أحياء 3") {
        // Add options for أحياء 3
        for (var i = 301; i <= 310; i++) {
            var option = document.createElement("option");
            option.value = i;
            option.textContent = i;
            timeSelect.appendChild(option);
        }
    }
});-->

<!--script>

        document.getElementById("datein").addEventListener("change", function () {
            convertDateFormat();
        });

        function convertDateFormat() {
            var date = document.getElementById("datein").value;
            var parts = date.split("-");
            var yyyy = parts[0];
            var mm = parts[1];
            var dd = parts[2];
            var convertedDate = yyyy + "/" + mm + "/" + dd;
            //document.getElementById("convertedDate").innerHTML = "التاريخ بالتنسيق الجديد: " + convertedDate;
        };

        //function updateInputBoxes() {
          //  var numberOfBoxes = document.getElementById('numberOfBoxes').value;
            //var container = document.getElementById('inputContainer');

            // Clear existing inputs
            //container.innerHTML = '';

            // Create new inputs based on the selected number
             //for (var i = 0; i < numberOfBoxes; i++) {
            //var newInput = document.createElement('input');
            //newInput.type = 'text';
            //newInput.className = 'dynamicInput';
            //newInput.name = 'experimenttool1' + (i);
            //newInput.placeholder = 'اداة ' + (i + 1);

            // Add datalist options
            //newInput.setAttribute('list', 'experimentToolOptions');

            // Append input to container
            //container.appendChild(newInput);
        //}
        //}
    </script>

<1?php
//echo isset($_POST['teatchername']) ;
//echo isset($_POST['sub']) + 1;
//echo isset($_POST['date12']) + 2;
//echo isset($_POST['cl']) + 3;
//echo isset($_POST['experimentName']) + 4;

if (isset($_POST['teatchername']) && isset($_POST['sub']) && isset($_POST['date12']) && isset($_POST['cl']) && isset($_POST['experimentName'])) {
    // Process form data
    $teachername = $_POST['teatchername'];
    $sub = $_POST['sub'];
    $class = $_POST['your_class'];
    $date = $_POST['date12'];
    $cl = $_POST['cl'];
    $experimentName = $_POST['experimentName'];
    
    // Initialize experiment tools with null
    $experimenttool1 = $_POST['experimenttool1'] ?? null;
    $experimenttool2 = $_POST['experimenttool2'] ?? null;
    $experimenttool3 = $_POST['experimenttool3'] ?? null;
    $experimenttool4 = $_POST['experimenttool4'] ?? null;
    $experimenttool5 = $_POST['experimenttool5'] ?? null;
    $experimenttool6 = $_POST['experimenttool6'] ?? null;
    $experimenttool7 = $_POST['experimenttool7'] ?? null;
    $experimenttool8 = $_POST['experimenttool8'] ?? null;
    $experimenttool9 = $_POST['experimenttool9'] ?? null;
    $experimenttool10 = $_POST['experimenttool10'] ?? null;

    // Database connection
    $servername = "localhost";
    $username = "nnaame";
    $password = "";
    $dbname = "main";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Generate unique ID
    //$unique_id = uniqid();

    // Prepare and execute SQL statements (use prepared statements for security)
    $stmt = $conn->prepare("SELECT * FROM alkma WHERE date = ? AND cl = ?");
    $stmt->bind_param("si", $date, $cl);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        // Record already exists
        echo '<script>alert("الحجز غير متاح في هذا التاريخ والوقت");</script>';
    } else {
        // Insert new record
        $stmt = $conn->prepare("INSERT INTO alkma (id, teatchername, sub, class, date, cl, experimentName, experimenttool1, experimenttool2, experimenttool3, experimenttool4, experimenttool5, experimenttool6, experimenttool7, experimenttool8, experimenttool9, experimenttool10) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssssssssssssss", $unique_id, $teachername, $sub, $class, $date, $cl, $experimentName, $experimenttool1, $experimenttool2, $experimenttool3, $experimenttool4, $experimenttool5, $experimenttool6, $experimenttool7, $experimenttool8, $experimenttool9, $experimenttool10);

        if ($stmt->execute()) {
            // Successful insertion
            echo '<script>alert("تم حجز التجربة بنجاح");</script>';
        } else {

            // Error in insertion
            echo "Error: " . $stmt->error;
        }
    }

    $stmt->close();
    $conn->close();
} else {
    // Form fields not properly submitted
    echo '<script>alert("الرجاء ملء جميع الحقول المطلوبة");</script>';
}
?-->

<!--input type= "submit" name="submit" id="submit-button"  value="حجز"-->


</body>


<!--DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>مختبر الأحياء</title>
    <link rel="stylesheet" href="CSS/alkma.style.css">
    <style>
        /* تنسيق الأسلوب */
        .error {
            border-color: red;
        }
        .success {
            border-color: green;
        }
        .dynamicInput {
            width: auto;
        }
    </style>
</head>
<body>
    <form id="booking-form"  method="POST">
        <!--label for="teatchername">اسم المعلم:</label>
        <select id="teatchername" name="teatchername">
            <!-- خيارات اسماء المعلمين >
        </select><br><br>

        <label for="sub">الموضوع:</label>
        <input type="text" id="sub" name="sub"><br><br>

        <label for="date">تاريخ الفحص:</label>
        <input type="date" id="date" name="date"><br><br>

        <label for="cl">الفصل:</label>
        <input type="text" id="cl" name="cl"><br><br>

        <label for="experimentName">اسم التجربة:</label>
        <input type="text" id="experimentName" name="experimentName"><br><br>

        <!-- حقول الادخال الديناميكية >
        <div id="dynamicInputContainer">
            <!-- هنا ستظهر الحقول الديناميكية >
        </div>
        
        <!-- أزرار التحكم >
        <button type="button" onclick="addDynamicInput()">إضافة حقل</button>
        <button type="button" onclick="removeDynamicInput()">إزالة حقل</button><br><br>

        <button type="submit" id="submit-button">إرسال</button>
    </form>

    <!-- نافذة الاكد >
    <div id="confirmation-modal" style="display: none;">
        <p>تم إرسال النموذج بنجاح!</p>
        <button id="close-button">إغلاق</button>
    </div>

    <!-- السكريبت >
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment-with-locales.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/moment-hijri@2.1.2/moment-hijri.min.js"></script>
    <script src="src/js/bootstrap-hijri-datetimepicker.js"></script>
    <script>
        // الكود النصي
        var maxFields = 10; // الحد الأقصى لعدد الحقول الديناميكية
        var dynamicInputCount = 0;

        // أضف حقل ديناميكي عند تحميل الصفحة
        document.addEventListener('DOMContentLoaded', function () {
            addDynamicInput();
        });

        function addDynamicInput() {
            if (dynamicInputCount < maxFields) {
                // توليد مرتبة جديدة للادخال الديناميكية
                var container = document.getElementById('dynamicInputContainer');
                var newInput = document.createElement('input');
                newInput.type = 'text';
                newInput.className = 'dynamicInput';
                newInput.name = 'experimenttool[]';
                container.appendChild(newInput);
                dynamicInputCount++;
            } else {
                alert('لا يمكنك إضافة المزيد من الحقول. الحد الأقصى هو ' + maxFields);
            }
        }

        function removeDynamicInput() {
            var container = document.getElementById('dynamicInputContainer');
            var inputs = container.getElementsByClassName('dynamicInput');
            if (inputs.length > 0) {
                container.removeChild(inputs[inputs.length - 1]);
                dynamicInputCount--;
            }
        }

        document.addEventListener('DOMContentLoaded', function () {
            // إضافة رد فعل النموذج
            document.getElementById('submit-button').addEventListener('click', function (event) {
                event.preventDefault();

                if (validateForm()) {
                    document.getElementById('confirmation-modal').style.display = 'block';
                } else {
                    // إمكانية إضافة رسالة الخطأ
                }
            });

            // أغلق النموذج
            document.getElementById('close-button').addEventListener('click', function () {
                closeConfirmationModal();
            });
        });

        // التأكد من النموذج
        function validateForm() {
            var experimentName = document.getElementById('experimentName').value.trim();

            if (experimentName === '') {
                return false;
            }

            return true;
        }

        // أغلق النموذج
        function closeConfirmationModal() {
            document.getElementById('confirmation-modal').style.display = 'none';
        }
    </script>
</body>
</html>

<!?php
// process_form.php

// فحص الفورم
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['teatchername'], $_POST['sub'], $_POST['date'], $_POST['cl'], $_POST['experimentName'])) {
        // معالجة بيانات النموذج
        $teachername = $_POST['teatchername'];
        $sub = $_POST['sub'];
        $class = $_POST['your_class'];
        $date = $_POST['date12'];
        $cl = $_POST['cl'];
        $experimentName = $_POST['experimentName'];
        
        // بداية أدوات التجربة بقيمة فارغة
        $experimenttool = $_POST['experimenttool'] ?? [];

        // ربط قاعدة البيانات
        $servername = "localhost";
        $username = "nnaame";
        $password = "";
        $dbname = "main";

        $conn = new mysqli($servername, $username, $password, $dbname);

        // التأكد من الاتصال
        if ($conn->connect_error) {
            die("فشل الاتصال: " . $conn->connect_error);
        }

        // استخدام استعلام معدل لإدخال البيانات
        $stmt = $conn->prepare("INSERT INTO experiments (teachername, sub, class, date, cl, experimentName, experimenttool) VALUES (?, ?, ?, ?, ?, ?, ?)");

        // ربط المعاملات والإدخال
        $stmt->bind_pam("sssssss", $teachername, $sub, $class, $date, $cl, $experimentName, $experimenttool);

        // تنفيذ الاستعلام
        $stmt->execute();

        echo "تم إرسال النموذج بنجاح!";
        
        // إغلاق البيانات
        $stmt->close();
        $conn->close();
    } else {
        echo "الرجاء ملء جميع الحقول المطلوبة";
    }
}
?>
