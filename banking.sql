CREATE DATABASE IF NOT EXISTS Banking;
USE Banking;

-- @block
CREATE TABLE Users(
    id INT PRIMARY KEY AUTO_INCREMENT,
    firstname VARCHAR(255) NOT NULL,
    lastname VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);

-- @block
CREATE TABLE Accounts(
    id INT AUTO_INCREMENT,
    checking_balance DECIMAL(10, 2) NOT NULL,
    savings_balance DECIMAL(10, 2) NOT NULL,
    user_id INT NOT NULL,
    PRIMARY KEY(id),
    FOREIGN KEY(user_id) REFERENCES Users(id)
);

-- @block
CREATE TABLE History(
    id INT AUTO_INCREMENT,
    transaction_type VARCHAR(255) NOT NULL,
    amount DECIMAL(10, 2) NOT NULL,
    user_id INT NOT NULL,
    PRIMARY KEY(id),
    FOREIGN KEY(user_id) REFERENCES Users(id)
);