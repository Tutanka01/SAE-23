
# importing the library
import numpy as np
import matplotlib.pyplot as plt
import sqlite3
import datetime as dt

try:
    conn = sqlite3.connect('C:\\Users\\zhiri\\Documents\\mo\\BUT\\SAE-23\\Site\\sqlite.sqlite') # On met le path qui depend du PC
    print("Connexion réussie")
except:
    print("Erreur de connexion à la base de données")

def get_data():
    sql = "SELECT * FROM data_meteo ORDER BY date ASC"
    cur = conn.cursor()
    cur.execute(sql)
    rows = cur.fetchall()
    return rows

def parse_data_sql(data):
    x = []
    y = []
    for row in data:
        # format de la date : 2023-05-26T09:00:00Z mais on va la convertir au format 2023-05-26 09:00:00... cmieux
        x.append(row[0])
        y.append(row[1])
    # changer le format de la date
    for i in range(len(x)):
        x[i] = dt.datetime.strptime(x[i], '%Y-%m-%dT%H:%M:%SZ')
    return (x,y)
 
# plotting
plt.plot(parse_data_sql(get_data())[0], parse_data_sql(get_data())[1])
plt.xlabel('Date')
plt.xticks(rotation=45, size=7)

plt.ylabel('Température')
plt.title('Température en fonction du temps')
plt.savefig("C:\\Users\\zhiri\\Documents\\mo\\BUT\\SAE-23\\Site\\Site_graphy_py\\graph.png")
print("Graphique généré")