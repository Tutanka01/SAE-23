import json, requests

headers = {'User-Agent': 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:35.0) Gecko/20100101 Firefox/35.0'}
url = requests.get("https://api.met.no/weatherapi/locationforecast/2.0/compact?lat=43.88566272770907&lon=-0.5092243304975015", headers=headers)
text = url.text

# Get JSON data
data = json.loads(text)

def get_all():
    return data

def get_date():
    return data['properties']['timeseries'][0]['time']

def get_air_temperature():
    return data['properties']['timeseries'][0]['data']['instant']['details']['air_temperature']

def get_pressure():
    return data['properties']['timeseries'][0]['data']['instant']['details']['air_pressure_at_sea_level']

def get_humidity():
    return data['properties']['timeseries'][0]['data']['instant']['details']['relative_humidity']

def get_weather():
    return (get_date(),get_air_temperature(), get_pressure(), get_humidity())