<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: index.html');  // إعادة التوجيه إذا لم يتم تسجيل الدخول
    exit();
}

echo "<h1>مرحباً، " . $_SESSION['username'] . "</h1>";
?>
<!-- إضافة الخوادم والتفاعل مع سكربتات أخرى -->
<a href="start_server.php">تشغيل الخادم</a>
<a href="stop_server.php">إيقاف الخادم</a>