import json, requests

headers = {'User-Agent': 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:35.0) Gecko/20100101 Firefox/35.0'}
url = requests.get("https://api.met.no/weatherapi/locationforecast/2.0/compact?lat=43.88566272770907&lon=-0.5092243304975015", headers=headers)
text = url.text

# Get JSON data

def get_weather_api():
    return json.loads(text)

def get_all(data):
    return data

def get_date(data):
    return data['properties']['timeseries'][0]['time']

def get_air_temperature(data):
    return data['properties']['timeseries'][0]['data']['instant']['details']['air_temperature']

def get_pressure(data):
    return data['properties']['timeseries'][0]['data']['instant']['details']['air_pressure_at_sea_level']

def get_humidity(data):
    return data['properties']['timeseries'][0]['data']['instant']['details']['relative_humidity']

def parse_data(data):
    return (get_date(data), get_air_temperature(data), get_pressure(data), get_humidity(data))