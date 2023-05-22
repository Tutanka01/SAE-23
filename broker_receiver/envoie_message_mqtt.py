# python 3.6

import random
import time
import recuperation_data_meteo
import json

from paho.mqtt import client as mqtt_client

# --------------------------------------------------

data = recuperation_data_meteo.get_weather()


broker = 'test.mosquitto.org'
port = 1883
topic = "/sujet1"
# generate client ID with pub prefix randomly
client_id = f'python-mqtt-{random.randint(0, 1000)}'

# --------------------------------------------------

def connect_mqtt():
    def on_connect(client, userdata, flags, rc):
        if rc == 0:
            print("Connected to MQTT Broker!")
        else:
            print("Failed to connect, return code %d\n", rc)

    client = mqtt_client.Client(client_id)
    client.on_connect = on_connect
    client.connect(broker, port)
    return client

# --------------------------------------------------

def publish(client):
    time.sleep(1)

    msg = json.dumps(data) # convert to JSON

    print(msg)
    result = client.publish(topic, msg)
    status = result[0]
    if status == 0:
        print(f"Send `{msg}` to topic `{topic}`")
    else:
        print(f"Failed to send message to topic {topic}")

# --------------------------------------------------

def run():
    client = connect_mqtt()
    client.loop_start()
    publish(client)

# --------------------------------------------------

if __name__ == '__main__':
    run()

# --------------------------------------------------