import requests
import json

url = "http://127.0.0.1:8000/api/car/2"

payload = json.dumps({
  "id": 9,
  "licensePlate": "ABX1722E",
  "name": "Dacia Sandero",
  "rented": False,
  "agencyId": 2
})
headers = {
  'name': 'Dacia Sandero',
  'agencyId': '2',
  'licensePlate': 'ABX1722E',
  'Content-Type': 'application/json'
}

response = requests.request("POST", url, headers=headers, data=payload)

print(response.text)
