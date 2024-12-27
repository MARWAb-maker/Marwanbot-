<?php
// تأكد من أن المستخدم قد سجل الدخول
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: index.html');
    exit();
}

$command = 'sh /path/to/samp-server/stop_samp.sh';  // تأكد من المسار الصحيح لإيقاف الخادم
exec($command, $output, $status);

if ($status === 0) {
    echo "تم إيقاف الخادم بنجاح!";
} else {
    echo "فشل إيقاف الخادم.";
}
?>