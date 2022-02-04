/* 1. Create database */
CREATE DATABASE orders_php;

/* 2. Create product table */
CREATE TABLE products (
    id int(10) NOT NULL AUTO_INCREMENT,
    title varchar(255) NOT NULL,
    price int(155) NOT NULL,
    PRIMARY KEY (id)
)

/* 3. Create order table */
CREATE TABLE orders (
    id int(10) NOT NULL AUTO_INCREMENT,
    name varchar(255) NOT NULL,
    address varchar(255) NOT NULL,
    phone varchar(11) DEFAULT NULL,
    create_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    product_id int,
    FOREIGN KEY (product_id)  REFERENCES products(id),
    PRIMARY KEY (id)
)

/* 4. Add 3 products into the products table */
INSERT INTO products (title, price) VALUES ('phone', 13213);
INSERT INTO products (title, price) VALUES ('laptop', 4324);
INSERT INTO products (title, price) VALUES ('tv', 54534);
