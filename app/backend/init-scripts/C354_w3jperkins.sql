USE finance_app_db;
-- Users table
CREATE TABLE IF NOT EXISTS users (
    userID INT AUTO_INCREMENT PRIMARY KEY,
    firstName VARCHAR(100) NOT NULL,
    lastName VARCHAR(100) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    username VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    createdAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updatedAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Bank institutions table
CREATE TABLE IF NOT EXISTS banks (
    bankID INT AUTO_INCREMENT PRIMARY KEY,
    bankName VARCHAR(100) UNIQUE NOT NULL,
    createdAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Account types table
CREATE TABLE IF NOT EXISTS accountTypes (
    accountTypeID INT AUTO_INCREMENT PRIMARY KEY,
    typeName VARCHAR(50) UNIQUE NOT NULL,
    createdAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Accounts table
CREATE TABLE IF NOT EXISTS accounts (
    accountID INT AUTO_INCREMENT PRIMARY KEY,
    userID INT NOT NULL,
    bankID INT NOT NULL,
    accountTypeID INT NOT NULL,
    accountName VARCHAR(100) NOT NULL,
    createdAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updatedAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (userID) REFERENCES users(userID) ON DELETE CASCADE,
    FOREIGN KEY (bankID) REFERENCES banks(bankID),
    FOREIGN KEY (accountTypeID) REFERENCES accountTypes(accountTypeID),
    UNIQUE KEY unique_user_account (userID, accountName)
);

-- Category groups table
CREATE TABLE IF NOT EXISTS categoryGroups (
    groupID INT AUTO_INCREMENT PRIMARY KEY,
    userID INT NOT NULL,
    groupName VARCHAR(100) NOT NULL,
    createdAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updatedAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (userID) REFERENCES users(userID) ON DELETE CASCADE,
    UNIQUE KEY unique_user_group (userID, groupName)
);

-- Categories table (subcategories under groups)
CREATE TABLE IF NOT EXISTS categories (
    categoryID INT AUTO_INCREMENT PRIMARY KEY,
    groupID INT NOT NULL,
    categoryName VARCHAR(100) NOT NULL,
    createdAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updatedAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (groupID) REFERENCES categoryGroups(groupID) ON DELETE CASCADE,
    UNIQUE KEY unique_group_category (groupID, categoryName)
);

-- Transactions table
CREATE TABLE IF NOT EXISTS transactions (
    transactionID INT AUTO_INCREMENT PRIMARY KEY,
    userID INT NOT NULL,
    accountID INT NOT NULL,
    categoryID INT,
    date DATE NOT NULL,
    description VARCHAR(255) NOT NULL,
    amount DECIMAL(10, 2) NOT NULL,
    notes TEXT,
    createdAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updatedAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (userID) REFERENCES users(userID) ON DELETE CASCADE,
    FOREIGN KEY (accountID) REFERENCES accounts(accountID),
    FOREIGN KEY (categoryID) REFERENCES categories(categoryID) ON DELETE SET NULL,
    INDEX idx_user_date (userID, date),
    INDEX idx_account_date (accountID, date)
);

-- Budgets table
CREATE TABLE IF NOT EXISTS budgets (
    budgetID INT AUTO_INCREMENT PRIMARY KEY,
    userID INT NOT NULL,
    categoryGroupID INT NOT NULL,
    budgetType ENUM('income', 'expense') NOT NULL,
    amount DECIMAL(10, 2) NOT NULL,
    period ENUM('monthly', 'yearly') DEFAULT 'monthly',
    createdAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updatedAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (userID) REFERENCES users(userID) ON DELETE CASCADE,
    FOREIGN KEY (categoryGroupID) REFERENCES categoryGroups(groupID) ON DELETE CASCADE,
    UNIQUE KEY unique_user_group_budget (userID, categoryGroupID, budgetType, period)
);

-- Insert default account types
INSERT INTO accountTypes (typeName) VALUES ('Savings'), ('Chequing'), ('Credit Card')
ON DUPLICATE KEY UPDATE typeName=VALUES(typeName);

-- Insert default bank (for ungrouped accounts)
INSERT INTO banks (bankName) VALUES ('Banking')
ON DUPLICATE KEY UPDATE bankName=VALUES(bankName);