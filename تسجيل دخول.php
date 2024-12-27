<?php
session_start();
require_once 'vendor/autoload.php';  // تضمين مكتبة Google API

// إعدادات Google OAuth
$client = new Google_Client();
$client->setClientId('YOUR_GOOGLE_CLIENT_ID');  // استبدل بـ Client ID الخاص بك
$client->setClientSecret('YOUR_GOOGLE_CLIENT_SECRET');  // استبدل بـ Client Secret الخاص بك
$client->setRedirectUri('http://yourdomain.com/google-login.php');  // استبدل بـ URI الخاص بك
$client->addScope('email');

// إذا كانت هناك رموز لتسجيل الدخول من Google
if (isset($_GET['code'])) {
    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
    $client->setAccessToken($token['access_token']);

    // الحصول على بيانات المستخدم من Google
    $google_service = new Google_Service_Oauth2($client);
    $google_user = $google_service->userinfo->get();

    // استخراج بيانات المستخدم
    $email = $google_user->email;
    $username = $google_user->name;
    $profile_picture = $google_user->picture;  // يمكنك إضافة صورة الملف الشخصي إذا أردت

    // حفظ بيانات المستخدم في الجلسة
    $_SESSION['username'] = $username;
    $_SESSION['email'] = $email;
    $_SESSION['profile_picture'] = $profile_picture;

    // إعادة توجيه المستخدم إلى الصفحة الرئيسية بعد تسجيل الدخول
    header('Location: dashboard.php');
    exit;
}

// إذا لم يكن قد تم التوثيق، يتم توجيه المستخدم إلى Google OAuth
if (!isset($_SESSION['username'])) {
    $auth_url = $client->createAuthUrl();
    echo "<a href='$auth_url'>تسجيل الدخول باستخدام حساب Google</a>";
}
?>