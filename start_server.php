<?php
// تأكد من أن المستخدم قد سجل الدخول
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: index.html');
    exit();
}

$command = 'sh /path/to/samp-server/start_samp.sh';  // تأكد من المسار الصحيح لخادم SAMP
exec($command, $output, $status);

if ($status === 0) {
    echo "تم تشغيل الخادم بنجاح!";
} else {
    echo "فشل تشغيل الخادم.";
}
?>