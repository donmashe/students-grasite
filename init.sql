CREATE DATABASE test;
use test;
CREATE TABLE users( 
    id INT (11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR (30) NOT NULL,
    email VARCHAR (30) NOT NULL,
    password VARCHAR (30) NOT NULL,
    phone  INT (15) NOT NULL,
    address VARCHAR (30) NOT NULL
);