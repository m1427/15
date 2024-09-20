<!DOCTYPE html>
<html dir="rtl" lang="en">

<head>
    <meta charset="utf-8">
    <title>مختبر الاحياء</title>
    <link rel="stylesheet" href="CSS/alkma.style.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/moment-hijri@2.1.2/moment-hijri.min.js"></script>
	<script src="src/js/bootstrap-hijri-datetimepicker.js"></script>
	
		<script type="text/javascript">
	
	
		   $(function () {
	
				initHijrDatePicker();
	
				initHijrDatePickerDefault();
	
				$('.disable-date').hijriDatePicker({
	
					minDate:"2020-01-01",
					maxDate:"2021-01-01",
					viewMode:"years",
					hijri:true,
					debug:true
				});
	
			});
	
			function initHijrDatePicker() {
	
				$(".hijri-date-input").hijriDatePicker({
					locale: "en-sa",
					format: "YYYY-MM-DD",
					hijriFormat:"iYYYY-iMM-iDD",
					dayViewHeaderFormat: "MMMM YYYY",
					hijriDayViewHeaderFormat: "iMMMM iYYYY",
					showSwitcher: true,
					allowInputToggle: true,
					showTodayButton: false,
					useCurrent: true,
					isRTL: false,
					viewMode:'months',
					keepOpen: false,
					hijri: false,
					debug: true,
					showClear: true,
					showTodayButton: true,
					showClose: true
				});
			}
	
			function initHijrDatePickerDefault() {
	
				$(".hijri-date-default").hijriDatePicker();
			}
	
		</script>



    <style>
        .error {
            border-color: red;
        }

        .success {
            border-color: green;
        }

        .dynamicInput {
            width: auto;
        }

        /* تنسيق شاشة الإشعار المنبثقة */
        
#confirmation-modal {
    display: none; /* مخفي افتراضيًا */
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgb(0, 0, 0);
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

#close-button {
    color: #aaa;
    position: absolute;
    top: 0;
    right: 0;
    font-size: 28px;
    font-weight: bold;
    cursor: pointer;
}

#cancel-button {
    margin-top: 10px;
    padding: 5px 10px;
    background-color: #ccc;
    border: none;
    cursor: pointer;
}

#cancel-button:hover {
    background-color: #aaa;
}

 /* أسلوب لعرض النافذة المنبثقة */
 #confirmation-modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 1000;
            text-align: center;
            padding-top: 200px;
        }
        .modal-content {
            background-color: white;
            width: 50%;
            margin: 0 auto;
            padding: 20px;
            border-radius: 5px;
        }



        #experimentToolOptions {
    display: block;
  }
  
    </style>

</head>

<body>
    <form method="post" id="booking-form" > 
        <header>
            <h2> شكراً للدخولك لمعمل الاحياء</h2>
            <p>الإصدار التجريبي</p>
        </header>
        <main>
            <label for="teatchername"> اسم المعلم</label>
            <select id="teatchername" name="teatchername" required>
                <?php
                // تفاصيل الاتصال بقاعدة البيانات
                $servername = "localhost";
                $username = "nnaame";
                $password = "";
                $dbname = "main";
                
                // إنشاء اتصال
                $conn = new mysqli($servername, $username, $password, $dbname);

                // التحقق من الاتصال
                if ($conn->connect_error) {
                    die("فشل الاتصال: " . $conn->connect_error);
                }

                // استعلام SQL لجلب البيانات
                $sql = "SELECT teatchername FROM teatcher_name where sub= 'أحياء'"; // تعديل استعلام SQL حسب الجدول و الأعمدة لديك
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    // عرض البيانات في قائمة الخيارات
                    echo '<option value="" disabled selected>اختر</option>';
                    while ($row = $result->fetch_assoc()) {
                        echo '<option value="' . $row["teatchername"] . '">' . $row["teatchername"] . "</option>";
                    }
                } else {
                    echo '<option value="">لا توجد بيانات</option>';
                }

                // إغلاق الاتصال بقاعدة البيانات
                $conn->close();
                ?>
            </select><span class="required">*</span>

            <label for="sub">المقرر</label>
            <select id="sub" name="sub" required>
            <?php
                // تفاصيل الاتصال بقاعدة البيانات
                $servername = "localhost";
                $username = "nnaame";
                $password = "";
                $dbname = "main";
                
                // إنشاء اتصال
                $conn = new mysqli($servername, $username, $password, $dbname);

                // التحقق من الاتصال
                if ($conn->connect_error) {
                    die("فشل الاتصال: " . $conn->connect_error);
                }

                // استعلام SQL لجلب البيانات
                $sql = "SELECT sub, num FROM books where sub= 'أحياء'"; // تعديل استعلام SQL حسب الجدول و الأعمدة لديك
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    // عرض البيانات في قائمة الخيارات
                    echo '<option value="" disabled selected>اختر</option>';
                    while ($row = $result->fetch_assoc()) {
                        echo '<option value="'. $row["sub"] . ' ' . $row["num"] . '">' 
                        . $row["sub"] . ' ' . $row["num"] 
                        . "</option>";
                }
                } else {
                    echo '<option value="">لا توجد بيانات</option>';
                }

                // إغلاق الاتصال بقاعدة البيانات
                $conn->close();
                ?>
            </select>
            <span class="required">*</span>

            <label  for="your_class">الشعبة</label>
            <select  id="your_class" name="your_class" required>
            </select>      

            <p>حدد موعد حصتك</p>
            
      
<style>
    .input-group{
        width: 25% !important;
    }
</style>

<div class="input-group">
    التاريخ
    <input type="text"  name="date" class="form-control hijri-date-default" />
</div>

<link href="https://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="CSS1/bootstrap.min.css">
<link href="datepick/css1/bootstrap-datetimepicker.css?v2" rel="stylesheet" />


<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment-with-locales.min.js"></script>
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

            <label for="numberOfBoxes">عدد الأدوات: </label>
  <select id="numberOfBoxes" onchange="updateInputBoxes()">
    <option value="1">1</option>
    <option value="2">2</option>
    <option value="3">3</option>
    <option value="4">4</option>
    <option value="5">5</option>
    <option value="6">6</option>
    <option value="7">7</option>
    <option value="8">8</option>
    <option value="9">9</option>
    <option value="10">10</option>
  </select><span class="required">*</span>

  <div id="inputContainer">
 
  </div>


 

  <script>
    function updateInputBoxes() {
      var numberOfBoxes = document.getElementById('numberOfBoxes').value;
      var container = document.getElementById('inputContainer');

      // Clear existing inputs
      container.innerHTML = '';

      // Create new inputs based on the selected number
      for (var i = 0; i < numberOfBoxes; i++) {
        var newInput = document.createElement('input');
        newInput.type = 'text';
        newInput.className = 'dynamicInput';
        newInput.name = 'experimenttool' + (i + 1);
        newInput.id = 'experimenttool' + (i + 1);
        newInput.placeholder = 'أداة ' + (i + 1);
        newInput.setAttribute('list', 'experimentToolOptions');

        // Append input to container
        container.appendChild(newInput);

        // Add a line break for better spacing
      //  container.appendChild(document.createElement('br'));
      }
    }

    // Show the datalist options when the page loads
    window.onload = function() {
  // عرض datalist عند تحميل الصفحة
  document.getElementById('experimentToolOptions').style.display = 'block';

  // تحديث حقول الإدخال الأولية
  updateInputBoxes();
};

  </script>


<datalist id="experimentToolOptions">
 <?php
      // تفاصيل الاتصال بقاعدة البيانات
      $servername = "localhost";
      $username = "nnaame";
      $password = "";
      $dbname = "main";

      // إنشاء اتصال
      $conn = new mysqli($servername, $username, $password, $dbname);

      // التحقق من الاتصال
      if ($conn->connect_error) {
        die("فشل الاتصال: " . $conn->connect_error);
      }

      // استعلام SQL لجلب البيانات
      $sql = "SELECT  tool FROM experimenttool";
      $result = $conn->query($sql);

      if ($result->num_rows > 0) {
        // عرض البيانات في قائمة الخيارات
        while($row = $result->fetch_assoc()) {
          echo '<option value="' . $row["tool"] .'">';
        }
      } else {
        echo '<option value="">لا توجد بيانات</option>';
      }

      // إغلاق الاتصال بقاعدة البيانات
      $conn->close();
    ?>
    
  </datalist>
  
  
  
  <button type="submit"  name="submit" id="submit-button">إرسال</button>
  
  <div id="confirmation-modal">
    <div class="modal-content">
        <span id="close-button">&times;</span>
        <p id="modal-text">هل أنت متأكد أنك تريد إرسال النموذج؟</p>
        <button id="cancel-button">إلغاء</button>
        <button id="confirm-button">تأكيد</button>
    </div>
</div>

        </main>
    </form>


    <script>
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
                 window.location.reload(); // انتبه! قد تكون هذه الخطوة غير مطلوبة
            })
            .catch(function(error) {
                // معالجة أي أخطاء حدثت أثناء إرسال النموذج
                console.error('حدث خطأ أثناء إرسال النموذج:', error);
            });
        });
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
  document.getElementById("sub").addEventListener("change", function () {
    var selectedValue = this.value;
    var timeSelect = document.getElementById("your_class");

    // Clear existing options
    timeSelect.innerHTML = "";

    // Create AJAX request
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "php/subject/get_classes_bio.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            var options = JSON.parse(xhr.responseText);
            // Add options to the select element
            options.forEach(function(option) {
                var opt = document.createElement("option");
                opt.value = option.num; // تأكد من أن لديك num في استجابة JSON
                opt.textContent = option.num; // أو أي قيمة أخرى تريد عرضها
                timeSelect.appendChild(opt);
            });
        }
    };

    // Send selected value to server
    xhr.send("selected_subject=" + encodeURIComponent(selectedValue));
});
</script>





<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

echo !isset($_POST['teatchername']) ? "A" : "";
echo !isset($_POST['sub']) ? "B" : "";
echo !isset($_POST['your_class']) ? "C" : "";
echo !isset($_POST['date']) ? "D" : "";
echo !isset($_POST['cl']) ? "E" : "";
echo !isset($_POST['experimentName']) ? "F" : "";
echo !isset($_POST['experimenttool1']) ? "G" : "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['teatchername'], $_POST['sub'], $_POST['date'], $_POST['cl'], $_POST['experimentName'])) {
        // Process form data
        $teachername = $_POST['teatchername'];
        $sub = $_POST['sub'];
        $class = $_POST['your_class'];
        $date = $_POST['date'];
        $cl = $_POST['cl'];
        $experimentName = $_POST['experimentName'];
        
        // Initialize experiment tools with null
        $experimenttool1 = $_POST['experimenttool1'];
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

        // Prepare and execute SQL statements
        $stmt = $conn->prepare("SELECT * FROM alkma WHERE date = ? AND cl = ?");
        $stmt->bind_param("ss", $date, $cl);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            // Record already exists
            $message = "الحجز غير متاح في هذا التاريخ والحصة";
        } else {
            // Insert new record
            $stmt = $conn->prepare("INSERT INTO alkma (teatchername, sub, class, date, cl, experimentName, experimenttool1, experimenttool2, experimenttool3, experimenttool4, experimenttool5, experimenttool6, experimenttool7, experimenttool8, experimenttool9, experimenttool10) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssssssssssssssss", $teachername, $sub, $class, $date, $cl, $experimentName, $experimenttool1, $experimenttool2, $experimenttool3, $experimenttool4, $experimenttool5, $experimenttool6, $experimenttool7, $experimenttool8, $experimenttool9, $experimenttool10);

            if ($stmt->execute()) {
                // Successful insertion
                $message = "تم حجز التجربة بنجاح";
            } else {
                // Error in insertion
                $message = "Error: " . $stmt->error;
            }
        }

        $stmt->close();
        $conn->close();
    } else {
        // Form fields not properly submitted
        $message = "الرجاء ملء جميع الحقول المطلوبة";
    }
}

// Display message at the end of the script
if ($message) {
    echo "<script>alert('$message');</script>";
}
}
?>

</body>
</html>