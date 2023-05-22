DROP TABLE IF EXISTS data_meteo;

CREATE TABLE data_meteo (
    date            DATE NOT NULL,
    temperature     INTEGER NOT NULL,
    temp_min        INTEGER NOT NULL,
    temp_max        INTEGER NOT NULL,
    pressure        INTEGER NOT NULL,
    humidite        INTEGER NOT NULL
);

INSERT INTO data_meteo (date, temperature, temp_min, temp_max, pressure, humidite) VALUES ('2019-01-01', 10, 5, 15, 1020, 50);
