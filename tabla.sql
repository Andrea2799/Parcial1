CREATE TABLE orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    client_name VARCHAR(255),
    product VARCHAR(255),
    quantity INT,
    order_date DATE,
    status VARCHAR(50),
    category VARCHAR(50),
    price DECIMAL(10, 2)
);
