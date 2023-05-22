# python3.6

import random

from paho.mqtt import client as mqtt_client

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
        fichier_data = open("C:\\Users\\zhiri\\Documents\\mo\\BUT\\SAE-23\\data_meteo.json", "w")
        s = str(msg.payload.decode("utf-8"))
        print(f"Received `{s}` from `{msg.topic}` topic")
        fichier_data.write(s)
        fichier_data.close()
        
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