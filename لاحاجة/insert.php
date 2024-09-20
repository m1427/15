<?php

if (isset($_POST['teatchername']) && isset($_POST['sub']) && isset($_POST['date12']) && isset($_POST['cl'])
&& isset($_POST['experimentName']) && isset($_POST['numberOfBoxes']) && isset($_POST['experimenttool']))
{
echo "inside";
   
$teatchername = $_POST['teatchername'];
$sub = $_POST['sub'];
$date = $_POST['date12'];
$cl = $_POST['cl'];
$experimentName = $_POST['experimentName'];
$numberOfBoxes = $_POST['numberOfBoxes'];
$experimenttool = $_POST['experimenttool'];



    if (!empty($teatchername) && !empty($sub) && !empty($date) 
    && !empty($cl) && !empty($experimentName) && !empty($numberOfBoxes)
    && !empty($experimenttool)) {
        echo "inside1";
        // تفاصيل اتصال قاعدة البيانات
        $servername = "localhost";
        $dbUsername = "nnaame";
        $dbPassword = "";
        $dbname = "main";

        // إنشاء اتصال بقاعدة البيانات
        $conn = new mysqli($servername, $dbUsername, $dbPassword, $dbname);

        if (mysqli_connect_error()) {
            die('Connect Error('. mysqli_connect_errno().')'. mysqli_connect_error());
        } else {
            // استعلام SQL لفحص ما إذا كان هناك سجل موجود بنفس التاريخ والوقت
            $SELECT = "SELECT * FROM alkma WHERE date = ? AND cl = ?";
            $stmt_select = $conn->prepare($SELECT);
            $stmt_select->bind_param("ss", $date, $cl);
            $stmt_select->execute();
            $stmt_select->store_result();
            $num_rows = $stmt_select->num_rows;

echo "inside2";

            if ($num_rows == 0) {
                // إدخال سجل جديد في جدول alkma
                $INSERT = "INSERT INTO alkma (teatchername, sub, date, cl, experimentName, numberOfBoxes, experimenttool)
                 VALUES (?, ?, ?, ?, ?, ?, ?)";
                $stmt_insert = $conn->prepare($INSERT);
                $stmt_insert->bind_param("ssdssis", $teatchername, $sub, $date, $cl, $experimentName, $numberOfBoxes, $experimenttool);
                $stmt_insert->execute();
                
echo "inside3";

                if ($stmt_insert->affected_rows > 0) {
                    echo "NEW";
                } else {
                    echo "Failed to insert record";
                }
            } else {
                echo "Already exists";
            }

            $stmt_select->close();
            $stmt_insert->close();
            $conn->close();
        }
    } else {
        echo "All fields are required";
    }
} else {
    echo "ero";
    echo (isset($_POST['teatchername']));
}

?>