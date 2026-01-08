USE finance_app_db;

-- Insert user
INSERT INTO users (firstName, lastName, email, username, password) VALUES
    ('Jesse', 'Perkins', 'jperkins@gmail.com', 'jp', 'testuser');

-- Get the inserted user ID for reference
SET @userID = LAST_INSERT_ID();

-- Insert banks
INSERT INTO banks (bankName) VALUES
    ('CIBC'),
    ('RBC'),
    ('TD'),
    ('BMO');

-- Insert accounts for the user
INSERT INTO accounts (userID, bankID, accountTypeID, accountName) VALUES
    (@userID, (SELECT bankID FROM banks WHERE bankName = 'CIBC'), 1, 'CIBC Savings'),
    (@userID, (SELECT bankID FROM banks WHERE bankName = 'CIBC'), 2, 'CIBC Chequing'),
    (@userID, (SELECT bankID FROM banks WHERE bankName = 'TD'), 3, 'TD Credit Card'),
    (@userID, (SELECT bankID FROM banks WHERE bankName = 'RBC'), 1, 'RBC TFSA');

-- Insert category groups
INSERT INTO categoryGroups (userID, groupName) VALUES
    (@userID, 'Income'),
    (@userID, 'Savings'),
    (@userID, 'Housing'),
    (@userID, 'Utilities'),
    (@userID, 'Transportation'),
    (@userID, 'Food'),
    (@userID, 'Healthcare'),
    (@userID, 'Personal Care'),
    (@userID, 'Entertainment'),
    (@userID, 'Travel');


-- Get category group IDs
SET @incomeGroupID = (SELECT groupID FROM categoryGroups WHERE userID = @userID AND groupName = 'Income');
SET @savingsGroupID = (SELECT groupID FROM categoryGroups WHERE userID = @userID AND groupName = 'Savings');
SET @housingGroupID = (SELECT groupID FROM categoryGroups WHERE userID = @userID AND groupName = 'Housing');
SET @utilitiesGroupID = (SELECT groupID FROM categoryGroups WHERE userID = @userID AND groupName = 'Utilities');
SET @transportationGroupID = (SELECT groupID FROM categoryGroups WHERE userID = @userID AND groupName = 'Transportation');
SET @foodGroupID = (SELECT groupID FROM categoryGroups WHERE userID = @userID AND groupName = 'Food');
SET @healthcareGroupID = (SELECT groupID FROM categoryGroups WHERE userID = @userID AND groupName = 'Healthcare');
SET @personalcareGroupID = (SELECT groupID FROM categoryGroups WHERE userID = @userID AND groupName = 'Personal Care');
SET @entertainmentGroupID = (SELECT groupID FROM categoryGroups WHERE userID = @userID AND groupName = 'Entertainment');
SET @travelGroupID = (SELECT groupID FROM categoryGroups WHERE userID = @userID AND groupName = 'Travel');

-- Insert categories
INSERT INTO categories (groupID, categoryName) VALUES
    (@incomeGroupID, 'Salary/Wages'),
    (@incomeGroupID, 'Investments'),
    (@incomeGroupID, 'Gifts'),
    (@savingsGroupID, 'Retirement'),
    (@savingsGroupID, 'Investments'),
    (@savingsGroupID, 'Emergency Fund'),
    (@housingGroupID, 'Mortgage/Rent'),
    (@housingGroupID, 'Home Insurance'),
    (@housingGroupID, 'Property Taxes'),
    (@utilitiesGroupID, 'Electricity'),
    (@utilitiesGroupID, 'Internet'),
    (@utilitiesGroupID, 'Water'),
    (@transportationGroupID, 'Car Insurance'),
    (@transportationGroupID, 'Gas'),
    (@transportationGroupID, 'Car Maintenance'),
    (@foodGroupID, 'Groceries'),
    (@foodGroupID, 'Dining Out'),
    (@foodGroupID, 'Takeout/Delivery'),
    (@healthcareGroupID, 'Health Insurance'),
    (@healthcareGroupID, 'Dental Care'),
    (@healthcareGroupID, 'Therapy/Counseling'),
    (@personalcareGroupID, 'Salon Services'),
    (@personalcareGroupID, 'Toiletries'),
    (@personalcareGroupID, 'Gym Membership'),
    (@entertainmentGroupID, 'Movies'),
    (@entertainmentGroupID, 'Hobbies'),
    (@entertainmentGroupID, 'Subscriptions'),
    (@travelGroupID, 'Airfare'),
    (@travelGroupID, 'Hotel Accommodations'),
    (@travelGroupID, 'Travel Insurance');

-- Get account IDs
SET @savingsAccountID = (SELECT accountID FROM accounts WHERE userID = @userID AND accountName = 'CIBC Savings');
SET @chequingAccountID = (SELECT accountID FROM accounts WHERE userID = @userID AND accountName = 'CIBC Chequing');
SET @creditCardAccountID = (SELECT accountID FROM accounts WHERE userID = @userID AND accountName = 'TD Credit Card');

-- Insert transactions
INSERT INTO transactions (userID, accountID, categoryID, date, description, amount, notes) VALUES
    (@userID, @chequingAccountID, (SELECT categoryID FROM categories WHERE categoryName = 'Employer A' AND groupID = @salaryGroupID), '2025-11-01', 'Employer A', 3500.00, 'Regular salary deposit'),
    (@userID, @chequingAccountID, (SELECT categoryID FROM categories WHERE categoryName = 'Walmart' AND groupID = @groceryGroupID), '2025-11-02', 'Walmart', -125.50, 'Weekly groceries'),
    (@userID, @creditCardAccountID, (SELECT categoryID FROM categories WHERE categoryName = 'Movies' AND groupID = @entertainmentGroupID), '2025-11-03', 'Movies', -15.99, 'Monthly subscription'),
    (@userID, @chequingAccountID, (SELECT categoryID FROM categories WHERE categoryName = 'Gas' AND groupID = @transportationGroupID), '2025-11-04', 'Gas', -65.00, 'Fill up'),
    (@userID, @savingsAccountID, (SELECT categoryID FROM categories WHERE categoryName = 'Costco' AND groupID = @groceryGroupID), '2025-11-05', 'Costco', -200.00, 'Monthly bulk shopping'),
    (@userID, @creditCardAccountID, (SELECT categoryID FROM categories WHERE categoryName = 'Restaurants' AND groupID = @entertainmentGroupID), '2025-11-06', 'Restaurants', -45.75, 'Dinner with friends'),
    (@userID, @chequingAccountID, (SELECT categoryID FROM categories WHERE categoryName = 'Electricity' AND groupID = @utilitiesGroupID), '2025-11-07', 'Electricity', -120.00, 'Monthly utility'),
    (@userID, @chequingAccountID, (SELECT categoryID FROM categories WHERE categoryName = 'Internet' AND groupID = @utilitiesGroupID), '2025-11-08', 'Internet', -79.99, 'Monthly internet'),
    (@userID, @creditCardAccountID, (SELECT categoryID FROM categories WHERE categoryName = 'Gaming' AND groupID = @entertainmentGroupID), '2025-11-09', 'Gaming', -29.99, 'Video game'),
    (@userID, @savingsAccountID, (SELECT categoryID FROM categories WHERE categoryName = 'Freelance' AND groupID = @salaryGroupID), '2025-11-10', 'Freelance', 500.00, 'Web design project'),
    (@userID, @chequingAccountID, (SELECT categoryID FROM categories WHERE categoryName = 'Car Maintenance' AND groupID = @transportationGroupID), '2025-11-12', 'Car Maintenance', -85.00, 'Routine maintenance'),
    (@userID, @creditCardAccountID, (SELECT categoryID FROM categories WHERE categoryName = 'Local Market' AND groupID = @groceryGroupID), '2025-11-14', 'Local Market', -35.50, 'Fresh produce'),
    (@userID, @chequingAccountID, (SELECT categoryID FROM categories WHERE categoryName = 'Water' AND groupID = @utilitiesGroupID), '2025-11-15', 'Water', -45.00, 'Monthly water'),
    (@userID, @creditCardAccountID, (SELECT categoryID FROM categories WHERE categoryName = 'Restaurants' AND groupID = @entertainmentGroupID), '2025-11-16', 'Restaurants', -6.50, 'Morning coffee'),
    (@userID, @savingsAccountID, (SELECT categoryID FROM categories WHERE categoryName = 'Transit' AND groupID = @transportationGroupID), '2025-11-18', 'Transit', -150.00, 'Monthly transit pass');

-- Insert budgets
INSERT INTO budgets (userID, categoryGroupID, budgetType, amount, period) VALUES
    (@userID, @groceryGroupID, 'expense', 600.00, 'monthly'),
    (@userID, @entertainmentGroupID, 'expense', 200.00, 'monthly'),
    (@userID, @transportationGroupID, 'expense', 400.00, 'monthly'),
    (@userID, @utilitiesGroupID, 'expense', 300.00, 'monthly'),
    (@userID, @salaryGroupID, 'income', 4000.00, 'monthly');