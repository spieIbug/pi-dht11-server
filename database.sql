CREATE DATABASE pi;
USE pi;

CREATE TABLE dht11_sensor_mesures (
  id       VARCHAR(11) NOT NULL,
  temp     VARCHAR(10) NOT NULL,
  humidity VARCHAR(10) NOT NULL,
  instant  DATETIME
);
