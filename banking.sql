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

-- @block
INSERT INTO Users(firstname, lastname, email, password) VALUES('John', 'Doe', 'johndoe@gmail.com', 'password');
INSERT INTO Users(firstname, lastname, email, password) VALUES('Jane', 'Doe', 'janedoe@gmail.com', 'password');
-- @block
INSERT INTO Accounts(checking_balance, savings_balance, user_id) VALUES(1000.00, 5000.00, 1);
INSERT INTO Accounts(checking_balance, savings_balance, user_id) VALUES(2000.00, 3000.00, 2);

-- @block
INSERT INTO History(transaction_type, account_type, amount, user_id) VALUES('Deposit', 'Checking', 1000.00, 1);
INSERT INTO History(transaction_type, amount, user_id) VALUES('Deposit', 'Savings', 5000.00, 1);
INSERT INTO History(transaction_type, account_type, amount, user_id) VALUES('Deposit', 'Checking', 2000.00, 2);
INSERT INTO History(transaction_type, amount, user_id) VALUES('Deposit', 'Savings', 3000.00, 2);