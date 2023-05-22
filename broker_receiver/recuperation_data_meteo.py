import json, requests

headers = {'User-Agent': 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:35.0) Gecko/20100101 Firefox/35.0'}
url = requests.get("https://api.met.no/weatherapi/locationforecast/2.0/compact?lat=43.88566272770907&lon=-0.5092243304975015", headers=headers)
text = url.text

# Get JSON data
data = json.loads(text)

print(data)

def get_weather():
    return data["properties"]["timeseries"][0]["data"]["instant"]["details"]
