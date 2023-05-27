
# importing the library
import numpy as np
import matplotlib.pyplot as plt
import sqlite3
import datetime as dt

try:
    conn = sqlite3.connect('C:\\Users\\zhiri\\Documents\\mo\\BUT\\SAE-23\\Site\\sqlite.sqlite')
    print("Connexion réussie")
except:
    print(KeyError)

def get_data():
    sql = "SELECT * FROM data_meteo"
    cur = conn.cursor()
    cur.execute(sql)
    rows = cur.fetchall()
    return rows

def parse_data_sql(data):
    x = []
    y = []
    for row in data:
        # format de ma date : 2023-05-26T09:00:00Z
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