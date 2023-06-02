import sqlite3
import sys
import json
sys.path.insert(1, 'C:\\Users\\zhiri\\Documents\\mo\\BUT\\SAE-23\\broker_receiver')
import recuperation_data_meteo as rdm

def get_data(data):
    try:
        data = json.loads(data)
        data = rdm.parse_data(data)
        print("Données récupérées avec succès :", data)
        return data
    except:
        print("Erreur lors de la récupération des données")

def parse_data(data):
    try:
        parsed_data = (get_date(data), get_air_temperature(data), get_pressure(data), get_humidity(data))
        print("Données analysées avec succès :", parsed_data)
        return parsed_data
    except:
        print("Erreur lors du traitement des données")


conn = None

try:
    conn = sqlite3.connect('C:\\Users\\zhiri\\Documents\\mo\\BUT\\SAE-23\\Site\\sqlite.sqlite')
    print("Connexion réussie")
except:
    print(KeyError)


def insertion_data(data):
    sql = "INSERT INTO data_meteo (date,temperature, pression, humidite) VALUES (?,?,?,?)"

    date, temp, press, hum = data # Depaqueter le tuple
    
    cur = conn.cursor()
    cur.execute(sql, (date, temp, press, hum))
    conn.commit()
    print("Données insérées")
    return cur.lastrowid
