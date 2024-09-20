<?php
$conn = mysqli_connect("localhost", "nnaame", "", "main");

if ($conn->connect_error) {
    die("فشل الاتصال: " . $conn->connect_error);
}

if (isset($_POST["delete"]) && isset($_POST["id"])) {
    $rowId = $_POST["id"]; // الحصول على معرّف الصف الذي ترغب في حذفه من الجدول

    // قم بتنفيذ عملية الحذف هنا
    $sql = "DELETE FROM alkma WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $rowId);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo "تم حذف البيانات بنجاح!";
    } else {
        echo "لم يتم العثور على صف يحمل هذا المعرّف.";
    }

    $stmt->close();
}

$conn->close();
?>