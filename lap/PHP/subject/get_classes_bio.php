<?php
// إعداد الاتصال بقاعدة البيانات
$servername = "localhost";
$username = "nnaame";
$password = "";
$dbname = "main";

$conn = new mysqli($servername, $username, $password, $dbname);

// تحقق من الاتصال
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// إعداد الاستعلام
$stmt = $conn->prepare("SELECT lower1, lower2, lower3, high1, high2, high3 FROM class");
$stmt->execute();
$result = $stmt->get_result();

$row = $result->fetch_assoc(); // استرجاع الصف الأول

// الحصول على القيمة المحددة من الطلب
$selected_subject = $_POST['selected_subject'];

// تحديد النطاقات بناءً على المادة المحددة
$range = [];

if ($selected_subject === "أحياء 1" || $selected_subject === "أحياء 1-1" || $selected_subject === "أحياء 1-2" || $selected_subject === "أحياء 1-3") {
    $range = range($row["lower1"], $row["high1"]);
} elseif ($selected_subject === "أحياء 2" || $selected_subject === "أحياء 2-1" || $selected_subject === "أحياء 2-2" || $selected_subject === "أحياء 2-3") {
    $range = range($row["lower2"], $row["high2"]);
} elseif ($selected_subject === "أحياء 3" || $selected_subject === "أحياء 3-1" || $selected_subject === "أحياء 3-2" || $selected_subject === "أحياء 3-3") {
    $range = range($row["lower3"], $row["high3"]);
}

// إرجاع البيانات في شكل JSON
$options = array_map(function($num) {
    return ["num" => $num];
}, $range);

echo json_encode($options);

// إغلاق الاستعلام والاتصال
$stmt->close();
$conn->close();
?>
