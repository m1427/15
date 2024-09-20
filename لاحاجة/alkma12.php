<!DOCTYPE html>
<html dir="rtl">

<head>
    <meta charset="utf-8">
    <title>مختبر الكيمياء</title>
    <link rel="stylesheet" href="CSS/alkma.style.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/hijri-js@latest/dist/hijri.js"></script>

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

        #confirmation-modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            text-align: center;
        }

        #close-button {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        #close-button:hover,
        #close-button:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        #experimentToolOptions {
            display: block;
        }

    </style>

</head>

<body>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <header>
            <h2> شكراً للدخولك لمعمل الكيمياء</h2>
            <p>الإصدار التجريبي</p>
        </header>
        <main>
            <label for="teatchername"> اسم المعلم</label>
            <select id="teatchername" name="teatchername">
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
                $sql = "SELECT teatchername FROM teatcher_name"; // تعديل استعلام SQL حسب الجدول والأعمدة لديك
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
                <option value="" disabled selected>اختر</option>
                <option value="chemistry 1">كيمياء 1</option>
                <option value="chemistry 2-1">كيمياء 1-2</option>
                <option value="chemistry 2-2">كيمياء 2-2</option>
                <option value="chemistry 2-3">كيمياء 3-2</option>
                <option value="chemistry 3">كيمياء 3</option>
            </select><span class="required">*</span>

            <label for="your_class">الشعبة</label>
            <select id="your_class" name="your_class" required></select>
            <br>

            <p>حدد موعد حصتك</p><br>

            <label for="datein">التاريخ</label>
            <input type="date" name="date12" id="datein" required>
            <br><br>

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
                    }
                }

                // Show the datalist options when the page loads
                window.onload = function () {
                    // عرض datalist عند تحميل الصفحة
                    document.getElementById('experimentToolOptions').style.display = 'block';

                    // تحديث حقول الإدخال الأولية
                    updateInputBoxes();
                };

            </script>

            <input type="submit" name="submit" id="submit-button" value="حجز">
        </main>
    </form>

    <script>
        document.getElementById("sub").addEventListener("change", function () {
            var selectedValue = this.value;
            var timeSelect = document.getElementById("your_class");

            // Clear existing options
            timeSelect.innerHTML = "";

            if (selectedValue === "chemistry 1") {
                // Add options for chemistry 1
                for (var i = 101; i <= 108; i++) {
                    var option = document.createElement("option");
                    option.value = i;
                    option.textContent = i;
                    timeSelect.appendChild(option);
                }
            } else if (selectedValue === "chemistry 2-1" || selectedValue === "chemistry 2-2" || selectedValue === "chemistry 2-3") {
                // Add options for chemistry 2
                for (var j = 201; j <= 206; j++) {
                    var option2 = document.createElement("option");
                    option2.value = j;
                    option2.textContent = j;
                    timeSelect.appendChild(option2);
                }
            } else if (selectedValue === "chemistry 3") {
                // Add options for chemistry 3
                for (var k = 301; k <= 309; k++) {
                    var option3 = document.createElement("option");
                    option3.value = k;
                    option3.textContent = k;
                    timeSelect.appendChild(option3);
                }
            } else {
                // If no valid option is selected
                var defaultOption = document.createElement("option");
                defaultOption.disabled = true;
                defaultOption.selected = true;
                defaultOption.textContent = "Please select";
                timeSelect.appendChild(defaultOption);
            }
        });
    </script>
</body>

</html>

<?php
// التحقق من أن النموذج تم إرساله
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // التحقق من أن جميع الحقول الإلزامية مملوءة
    if (isset($_POST['teatchername'], $_POST['sub'], $_POST['your_class'], $_POST['date12'], $_POST['cl'], $_POST['experimentName'])) {

        // البيانات المرسلة من النموذج
        $teatchername = $_POST['teatchername'];
        $sub = $_POST['sub'];
        $your_class = $_POST['your_class'];
        $date12 = $_POST['date12'];
        $cl = $_POST['cl'];
        $experimentName = $_POST['experimentName'];
        $experimentTools = [];

        // جمع أدوات التجربة المحتملة
        for ($i = 1; $i <= 10; $i++) {
            if (isset($_POST['experimenttool' . $i])) {
                $experimentTools[] = $_POST['experimenttool' . $i];
            }
        }

        // تحضير البيانات لإدراجها في قاعدة البيانات
        $servername = "localhost";
        $username = "nnaame"; // استبداله بمعرف المستخدم الخاص بك
        $password = ""; // استبدله بكلمة مرور قاعدة البيانات الخاصة بك
        $dbname = "main"; // استبدله باسم قاعدة البيانات الخاصة بك

        // إنشاء اتصال بقاعدة البيانات
        $conn = new mysqli($servername, $username, $password, $dbname);

        // التحقق من الاتصال
        if ($conn->connect_error) {
            die("فشل الاتصال: " . $conn->connect_error);
        }

        // استعداد استعلام SQL لإدراج البيانات
        $sql = "INSERT INTO alkma (teatchername, sub, class, date, cl, experimentName, experimentTool1) 
                VALUES (?, ?, ?, ?, ?, ?, ?)";

        // استخدام استعلام محضر لزيادة الأمان
        $stmt = $conn->prepare($sql);

        // ربط المتغيرات ببيانات الاستعلام
        $stmt->bind_param("ssisiss", $teatchername, $sub, $your_class, $date12, $cl, $experimentName, json_encode($experimentTools));

        // تنفيذ الاستعلام والتحقق من نجاح التنفيذ
        if ($stmt->execute()) {
            echo "<script>
                    Swal.fire({
                        title: 'تم الحجز بنجاح!',
                        icon: 'success',
                        confirmButtonText: 'موافق'
                    });
                </script>";
        } else {
            echo "<script>
                    Swal.fire({
                        title: 'حدث خطأ أثناء عملية الحجز!',
                        icon: 'error',
                        confirmButtonText: 'موافق'
                    });
                </script>";
        }

        // إغلاق اتصال قاعدة البيانات
        $stmt->close();
        $conn->close();
    } else {
        // إذا كانت الحقول الإلزامية غير مملوءة
        echo "<script>
                Swal.fire({
                    title: 'يرجى تعبئة جميع الحقول الإلزامية!',
                    icon: 'error',
                    confirmButtonText: 'موافق'
                });
            </script>";
    }
}
?>
