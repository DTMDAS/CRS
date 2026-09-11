<?php
$host = "localhost";
$username = "root";
$password = "";
$dbname = "certificate_portal";

$conn = new mysqli($host, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Telegram Configuration
define('TELEGRAM_BOT_TOKEN', '8873914554:AAGTblEBmofkZ0PRntlzmyww3X3AETm5Op0');
define('TELEGRAM_CHAT_ID', '7742143795');

function sendTelegramMessage($message) {
    $url = "https://api.telegram.org/bot" . TELEGRAM_BOT_TOKEN . "/sendMessage?chat_id=" . TELEGRAM_CHAT_ID . "&text=" . urlencode($message) . "&parse_mode=HTML";
    file_get_contents($url);
}

function sendTelegramPhoto($photo_path, $caption) {
    $url = "https://api.telegram.org/bot" . TELEGRAM_BOT_TOKEN . "/sendPhoto";
    $post_fields = array('chat_id' => TELEGRAM_CHAT_ID, 'photo' => new CURLFile(realpath($photo_path)), 'caption' => $caption, 'parse_mode' => 'HTML');
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post_fields);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_exec($ch);
    curl_close($ch);
}
?>
