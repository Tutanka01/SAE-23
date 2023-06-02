# python3.6

import random
import json
from paho.mqtt import client as mqtt_client
import sys
sys.path.insert(1, 'C:\\Users\\zhiri\\Documents\\mo\\BUT\\SAE-23\\traitement_data')
import mise_en_BDD as mbdd

# --------------------------------------------------


broker = 'test.mosquitto.org'
port = 1883
topic = "/sujet1"
# generate client ID with pub prefix randomly
client_id = f'python-mqtt-{random.randint(0, 100)}'

# --------------------------------------------------

def connect_mqtt() -> mqtt_client:
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

def subscribe(client: mqtt_client):
    def on_message(client, userdata, msg):
        s = str(msg.payload.decode("utf-8"))
        print("Données reçues :", s)
        if mbdd.get_data(s) != None:
            mbdd.insertion_data(mbdd.get_data(s))
        else:
            print("Erreur lors du traitement des données")
        
    client.subscribe(topic)
    client.on_message = on_message

# --------------------------------------------------

def run():
    client = connect_mqtt()
    subscribe(client)
    client.loop_forever()

# --------------------------------------------------

if __name__ == '__main__':
    run()

# --------------------------------------------------