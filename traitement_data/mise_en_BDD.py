import sqlite3
import sys
sys.path.insert(1, 'C:\\Users\\zhiri\\Documents\\mo\\BUT\\SAE-23\\broker_receiver')
import recuperation_data_meteo as rdm

def get_data():
    try:
        return rdm.get_weather()
    except:
        print("Erreur lors de la récupération des données")



conn = None

try:
    conn = sqlite3.connect('sqlite.sqlite')
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


insertion_data(get_data())