CREATE DATABASE greenhouse;
USE greenhouse;

CREATE TABLE products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255),
    price INT
);

INSERT INTO products (name, price) VALUES
('Butter Elle Vire', 78000),
('Gulaku Hijau', 20500),
('Cream Cheese', 160000);
