CREATE DATABASE IF NOT EXISTS samochody;
USE samochody;

CREATE TABLE IF NOT EXISTS samochody (
    id INT AUTO_INCREMENT PRIMARY KEY,
    marka VARCHAR(100) NOT NULL,
    model VARCHAR(100) NOT NULL,
    cena DECIMAL(10,2) NOT NULL,
    rok INT NOT NULL,
    opis TEXT
);
