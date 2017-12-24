CREATE DATABASE pi;
USE pi;

CREATE TABLE dht11_sensor_mesures (
  id       VARCHAR(11) NOT NULL,
  temp     VARCHAR(10) NOT NULL,
  humidity VARCHAR(10) NOT NULL,
  instant  DATETIME NOT NULL
);

create table users (
  id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(50) UNIQUE NOT NULL,
  password VARCHAR(255) NOT NULL
);
