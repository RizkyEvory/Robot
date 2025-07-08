<?php
// === Konfigurasi Telegram ===
$botToken = '5441940388:AAGMwLVf99E87OMVr4RQ9IXOGkohds5KQn0';
$chatId   = '1975187896';

$ip        = $_SERVER['REMOTE_ADDR'];
$userAgent = $_SERVER['HTTP_USER_AGENT'] ?? 'unknown';
$time      = date("Y-m-d H:i:s");

$message = "📥 *New Visit*\n".
           "🕒 Time: $time\n".
           "🌐 IP: `$ip`\n".
           "📱 Agent: `$userAgent`";

$apiUrl = "https://api.telegram.org/bot$botToken/sendMessage";
$data = [
    'chat_id' => $chatId,
    'text' => $message,
    'parse_mode' => 'Markdown'
];

$options = [
    'http' => [
        'method'  => 'POST',
        'header'  => "Content-Type: application/x-www-form-urlencoded",
        'content' => http_build_query($data)
    ]
];
$context = stream_context_create($options);
$result = file_get_contents($apiUrl, false, $context);

// === Balasan ke browser ===
header("Content-Type: application/json");
echo json_encode(["status" => "ok"]);
