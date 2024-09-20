<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    $code = $_POST['code'];

    // تحويل المستخدم بناءً على الرمز المدخل
    switch ($code) {
        case 'رمز1':
            header("Location: alkma.php");
            break;
        case 'رمز2':
            header("Location: pioy.php");
            break;
        case 'رمز3':
            header("Location: pyh.php");
            break;
        case 'رمز4':
           header("Location: admin.php");
            break;
        default:
            echo "الرمز غير صحيح.";
            break;
    }
    exit();
}
?>