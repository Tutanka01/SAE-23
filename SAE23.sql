DROP TABLE IF EXISTS data_meteo;

CREATE TABLE data_meteo (
    date            DATE NOT NULL,
    temperature            INTEGER NOT NULL,
    pression           INTEGER NOT NULL,
    humidite             INTEGER NOT NULL
);