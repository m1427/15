<?php
// تأكد من أن طلب POST يحتوي على المعرّف وأنه مرسل لحذف الصف
if (isset($_POST['delete']) && isset($_POST['id'])) {
    $conn = mysqli_connect("localhost", "nnaame", "", "main");

    if ($conn->connect_error) {
        die("فشل الاتصال: " . $conn->connect_error);
    }

    // استرجاع معرّف الصف المراد حذفه من البيانات المُرسلة
    $id = $_POST['id'];

    // إعداد استعلام SQL لحذف الصف بناءً على المعرّف المحدد
    $sql = "DELETE FROM redirects WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        echo "تم حذف الصف بنجاح!";
    } else {
        echo "حدث خطأ أثناء حذف الصف: " . $conn->error;
    }

    $conn->close();
}
?>
