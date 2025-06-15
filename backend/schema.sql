-- Active: 1744969594514@@127.0.0.1@3306@batik_alam_app
CREATE DATABASE `batik_alam_app`;

USE batik_alam_app;


CREATE TABLE produk (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(255) NOT NULL,
    harga DECIMAL(10, 2) NOT NULL,
    gambar VARCHAR(255) NOT NULL
);

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);

CREATE TABLE orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    order_name VARCHAR(255) NOT NULL,
    order_email VARCHAR(255) NOT NULL,
    order_phone VARCHAR(20) NOT NULL,
    order_address TEXT NOT NULL,
    order_product VARCHAR(255) NOT NULL,
    order_size VARCHAR(50),
    order_quantity INT NOT NULL,
    order_notes TEXT,
    order_payment VARCHAR(50) NOT NULL,
    order_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    status VARCHAR(50) DEFAULT 'Menunggu'
);

ALTER TABLE orders ADD COLUMN status VARCHAR(50) DEFAULT 'Menunggu';


DROP Table orders;