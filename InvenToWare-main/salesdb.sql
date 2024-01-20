-- CREATE DATABASE products_db


CREATE TABLE IF NOT EXISTS sales (
        ProductId INT(30) PRIMARY KEY,
        ProductName VARCHAR(255) ,
        ProductPrice INT(30),
        ProductUnit INT(255),
        Status VARCHAR(255) 
        );