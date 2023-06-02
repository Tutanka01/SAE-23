DROP TABLE IF EXISTS data_meteo;

CREATE TABLE data_meteo (
    date            DATE NOT NULL,
    temperature            INTEGER NOT NULL,
    pression           INTEGER NOT NULL,
    humidite             INTEGER NOT NULL
);
INSERT INTO data_meteo (date,temperature,pression,humidite) values ('2023-05-25T09:00:00Z','18','1018.5','54.2');
INSERT INTO data_meteo (date,temperature,pression,humidite) values ('2023-05-26T09:00:00Z','20','1015.2','52.6');
INSERT INTO data_meteo (date,temperature,pression,humidite) values ('2023-05-27T09:00:00Z','22','1012.8','51.8');
INSERT INTO data_meteo (date,temperature,pression,humidite) values ('2023-05-28T09:00:00Z','21','1014.6','53.1');
INSERT INTO data_meteo (date,temperature,pression,humidite) values ('2023-05-29T09:00:00Z','19','1016.2','55.3');
INSERT INTO data_meteo (date,temperature,pression,humidite) values ('2023-05-30T09:00:00Z','23','1011.9','49.7');
INSERT INTO data_meteo (date,temperature,pression,humidite) values ('2023-05-31T09:00:00Z','25','1009.7','47.9');
INSERT INTO data_meteo (date,temperature,pression,humidite) values ('2023-06-01T09:00:00Z','24','1010.8','48.5');
INSERT INTO data_meteo (date,temperature,pression,humidite) values ('2023-06-02T09:00:00Z','22','1013.4','50.2');
INSERT INTO data_meteo (date,temperature,pression,humidite) values ('2023-06-03T09:00:00Z','20','1015','52.1');
INSERT INTO data_meteo (date,temperature,pression,humidite) values ('2023-06-04T09:00:00Z','19','1016.9','53.7');
INSERT INTO data_meteo (date,temperature,pression,humidite) values ('2023-06-05T09:00:00Z','18','1018.1','54.9');
INSERT INTO data_meteo (date,temperature,pression,humidite) values ('2023-06-06T09:00:00Z','17','1019.5','56.3');
INSERT INTO data_meteo (date,temperature,pression,humidite) values ('2023-06-07T09:00:00Z','19','1016.8','53.5');
INSERT INTO data_meteo (date,temperature,pression,humidite) values ('2023-06-08T09:00:00Z','22','1013.9','50.8');
INSERT INTO data_meteo (date,temperature,pression,humidite) values ('2023-06-09T09:00:00Z','25','1010.1','47.3');
INSERT INTO data_meteo (date,temperature,pression,humidite) values ('2023-06-10T09:00:00Z','27','1007.6','45.1');
INSERT INTO data_meteo (date,temperature,pression,humidite) values ('2023-06-11T09:00:00Z','26','1008.3','45.6');
INSERT INTO data_meteo (date,temperature,pression,humidite) values ('2023-06-12T09:00:00Z','24','1010.2','48.2');
INSERT INTO data_meteo (date,temperature,pression,humidite) values ('2023-06-13T09:00:00Z','21','1013.2','51.3');
INSERT INTO data_meteo (date,temperature,pression,humidite) values ('2023-06-14T09:00:00Z','19','1015.8','53.9');
