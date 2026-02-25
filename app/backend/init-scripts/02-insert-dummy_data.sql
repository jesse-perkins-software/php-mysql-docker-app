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
    (@userID, (SELECT bankID FROM banks WHERE bankName = 'RBC'), 4, 'RBC TFSA');

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
    -- Income transactions
    (@userID, @chequingAccountID, (SELECT categoryID FROM categories WHERE categoryName = 'Salary/Wages' AND groupID = @incomeGroupID), '2025-12-01', 'Salary/Wages', 3500.00, 'Regular salary deposit'),
    (@userID, @chequingAccountID, (SELECT categoryID FROM categories WHERE categoryName = 'Salary/Wages' AND groupID = @incomeGroupID), '2026-01-01', 'Salary/Wages', 3500.00, 'Regular salary deposit'),
    (@userID, @chequingAccountID, (SELECT categoryID FROM categories WHERE categoryName = 'Salary/Wages' AND groupID = @incomeGroupID), '2026-02-01', 'Salary/Wages', 3500.00, 'Regular salary deposit'),

    (@userID, @savingsAccountID, (SELECT categoryID FROM categories WHERE categoryName = 'Investments' AND groupID = @incomeGroupID), '2025-12-05', 'Investments', 150.00, 'Quarterly dividend'),
    (@userID, @savingsAccountID, (SELECT categoryID FROM categories WHERE categoryName = 'Investments' AND groupID = @incomeGroupID), '2026-01-05', 'Investments', 150.00, 'Quarterly dividend'),

    (@userID, @chequingAccountID, (SELECT categoryID FROM categories WHERE categoryName = 'Gifts' AND groupID = @incomeGroupID), '2025-12-15', 'Gifts', 100.00, 'Birthday gift from parents'),
    (@userID, @chequingAccountID, (SELECT categoryID FROM categories WHERE categoryName = 'Gifts' AND groupID = @incomeGroupID), '2026-01-15', 'Gifts', 100.00, 'Gift'),

    (@userID, @chequingAccountID, (SELECT categoryID FROM categories WHERE categoryName = 'Salary/Wages' AND groupID = @incomeGroupID), '2025-12-15', 'Salary/Wages', 3500.00, 'Regular salary deposit'),
    (@userID, @chequingAccountID, (SELECT categoryID FROM categories WHERE categoryName = 'Salary/Wages' AND groupID = @incomeGroupID), '2026-01-15', 'Salary/Wages', 3500.00, 'Regular salary deposit'),

    (@userID, @savingsAccountID, (SELECT categoryID FROM categories WHERE categoryName = 'Investments' AND groupID = @incomeGroupID), '2025-12-20', 'Investments', 250.00, 'Stock dividend payout'),
    (@userID, @savingsAccountID, (SELECT categoryID FROM categories WHERE categoryName = 'Investments' AND groupID = @incomeGroupID), '2026-01-20', 'Investments', 250.00, 'Stock dividend payout'),

    -- Savings transactions
    (@userID, @savingsAccountID, (SELECT categoryID FROM categories WHERE categoryName = 'Emergency Fund' AND groupID = @savingsGroupID), '2025-12-01', 'Emergency Fund', -200.00, 'Monthly emergency fund contribution'),
    (@userID, @savingsAccountID, (SELECT categoryID FROM categories WHERE categoryName = 'Emergency Fund' AND groupID = @savingsGroupID), '2026-01-01', 'Emergency Fund', -200.00, 'Monthly emergency fund contribution'),
    (@userID, @savingsAccountID, (SELECT categoryID FROM categories WHERE categoryName = 'Emergency Fund' AND groupID = @savingsGroupID), '2026-02-01', 'Emergency Fund', -200.00, 'Monthly emergency fund contribution'),

    (@userID, @savingsAccountID, (SELECT categoryID FROM categories WHERE categoryName = 'Retirement' AND groupID = @savingsGroupID), '2025-12-01', 'Retirement', -500.00, 'Monthly RRSP contribution'),
    (@userID, @savingsAccountID, (SELECT categoryID FROM categories WHERE categoryName = 'Retirement' AND groupID = @savingsGroupID), '2026-01-01', 'Retirement', -500.00, 'Monthly RRSP contribution'),
    (@userID, @savingsAccountID, (SELECT categoryID FROM categories WHERE categoryName = 'Retirement' AND groupID = @savingsGroupID), '2026-02-01', 'Retirement', -500.00, 'Monthly RRSP contribution'),

    (@userID, @savingsAccountID, (SELECT categoryID FROM categories WHERE categoryName = 'Investments' AND groupID = @savingsGroupID), '2025-12-10', 'Investments', -300.00, 'ETF purchase'),
    (@userID, @savingsAccountID, (SELECT categoryID FROM categories WHERE categoryName = 'Investments' AND groupID = @savingsGroupID), '2026-01-10', 'Investments', -300.00, 'ETF purchase'),

    (@userID, @savingsAccountID, (SELECT categoryID FROM categories WHERE categoryName = 'Retirement' AND groupID = @savingsGroupID), '2025-12-15', 'Retirement', -250.00, 'Additional RRSP contribution'),
    (@userID, @savingsAccountID, (SELECT categoryID FROM categories WHERE categoryName = 'Retirement' AND groupID = @savingsGroupID), '2026-01-15', 'Retirement', -250.00, 'Additional RRSP contribution'),

    -- Housing transactions
    (@userID, @chequingAccountID, (SELECT categoryID FROM categories WHERE categoryName = 'Mortgage/Rent' AND groupID = @housingGroupID), '2025-12-01', 'Mortgage/Rent', -1800.00, 'Monthly rent payment'),
    (@userID, @chequingAccountID, (SELECT categoryID FROM categories WHERE categoryName = 'Mortgage/Rent' AND groupID = @housingGroupID), '2026-01-01', 'Mortgage/Rent', -1800.00, 'Monthly rent payment'),
    (@userID, @chequingAccountID, (SELECT categoryID FROM categories WHERE categoryName = 'Mortgage/Rent' AND groupID = @housingGroupID), '2026-02-01', 'Mortgage/Rent', -1800.00, 'Monthly rent payment'),

    (@userID, @chequingAccountID, (SELECT categoryID FROM categories WHERE categoryName = 'Home Insurance' AND groupID = @housingGroupID), '2025-12-05', 'Home Insurance', -125.00, 'Monthly home insurance premium'),
    (@userID, @chequingAccountID, (SELECT categoryID FROM categories WHERE categoryName = 'Home Insurance' AND groupID = @housingGroupID), '2026-01-05', 'Home Insurance', -125.00, 'Monthly home insurance premium'),
    (@userID, @chequingAccountID, (SELECT categoryID FROM categories WHERE categoryName = 'Home Insurance' AND groupID = @housingGroupID), '2026-02-05', 'Home Insurance', -125.00, 'Monthly home insurance premium'),

    (@userID, @chequingAccountID, (SELECT categoryID FROM categories WHERE categoryName = 'Property Taxes' AND groupID = @housingGroupID), '2025-12-20', 'Property Taxes', -400.00, 'Quarterly property tax payment'),
    (@userID, @chequingAccountID, (SELECT categoryID FROM categories WHERE categoryName = 'Property Taxes' AND groupID = @housingGroupID), '2026-01-20', 'Property Taxes', -400.00, 'Quarterly property tax payment'),

    -- Utilities transactions
    (@userID, @chequingAccountID, (SELECT categoryID FROM categories WHERE categoryName = 'Electricity' AND groupID = @utilitiesGroupID), '2025-12-07', 'Electricity', -120.00, 'Monthly electricity bill'),
    (@userID, @chequingAccountID, (SELECT categoryID FROM categories WHERE categoryName = 'Electricity' AND groupID = @utilitiesGroupID), '2026-01-07', 'Electricity', -120.00, 'Monthly electricity bill'),

    (@userID, @chequingAccountID, (SELECT categoryID FROM categories WHERE categoryName = 'Internet' AND groupID = @utilitiesGroupID), '2025-12-08', 'Internet', -79.99, 'Monthly internet service'),
    (@userID, @chequingAccountID, (SELECT categoryID FROM categories WHERE categoryName = 'Internet' AND groupID = @utilitiesGroupID), '2026-01-08', 'Internet', -79.99, 'Monthly internet service'),

    (@userID, @chequingAccountID, (SELECT categoryID FROM categories WHERE categoryName = 'Water' AND groupID = @utilitiesGroupID), '2025-12-15', 'Water', -45.00, 'Monthly water bill'),
    (@userID, @chequingAccountID, (SELECT categoryID FROM categories WHERE categoryName = 'Water' AND groupID = @utilitiesGroupID), '2026-01-15', 'Water', -45.00, 'Monthly water bill'),

    (@userID, @chequingAccountID, (SELECT categoryID FROM categories WHERE categoryName = 'Electricity' AND groupID = @utilitiesGroupID), '2025-12-25', 'Electricity', -15.00, 'Electricity adjustment'),
    (@userID, @chequingAccountID, (SELECT categoryID FROM categories WHERE categoryName = 'Electricity' AND groupID = @utilitiesGroupID), '2026-01-25', 'Electricity', -15.00, 'Electricity adjustment'),

    -- Transportation transactions
    (@userID, @creditCardAccountID, (SELECT categoryID FROM categories WHERE categoryName = 'Gas' AND groupID = @transportationGroupID), '2025-12-04', 'Gas', -65.00, 'Gas fill-up'),
    (@userID, @creditCardAccountID, (SELECT categoryID FROM categories WHERE categoryName = 'Gas' AND groupID = @transportationGroupID), '2026-01-04', 'Gas', -65.00, 'Gas fill-up'),
    (@userID, @creditCardAccountID, (SELECT categoryID FROM categories WHERE categoryName = 'Gas' AND groupID = @transportationGroupID), '2026-02-04', 'Gas', -65.00, 'Gas fill-up'),

    (@userID, @chequingAccountID, (SELECT categoryID FROM categories WHERE categoryName = 'Car Insurance' AND groupID = @transportationGroupID), '2025-12-01', 'Car Insurance', -180.00, 'Monthly car insurance'),
    (@userID, @chequingAccountID, (SELECT categoryID FROM categories WHERE categoryName = 'Car Insurance' AND groupID = @transportationGroupID), '2026-01-01', 'Car Insurance', -180.00, 'Monthly car insurance'),
    (@userID, @chequingAccountID, (SELECT categoryID FROM categories WHERE categoryName = 'Car Insurance' AND groupID = @transportationGroupID), '2026-02-01', 'Car Insurance', -180.00, 'Monthly car insurance'),

    (@userID, @chequingAccountID, (SELECT categoryID FROM categories WHERE categoryName = 'Car Maintenance' AND groupID = @transportationGroupID), '2025-12-12', 'Car Maintenance', -85.00, 'Oil change service'),
    (@userID, @chequingAccountID, (SELECT categoryID FROM categories WHERE categoryName = 'Car Maintenance' AND groupID = @transportationGroupID), '2026-01-12', 'Car Maintenance', -85.00, 'Oil change service'),

    (@userID, @creditCardAccountID, (SELECT categoryID FROM categories WHERE categoryName = 'Gas' AND groupID = @transportationGroupID), '2025-12-18', 'Gas', -55.00, 'Gas fill-up'),
    (@userID, @creditCardAccountID, (SELECT categoryID FROM categories WHERE categoryName = 'Gas' AND groupID = @transportationGroupID), '2026-01-18', 'Gas', -55.00, 'Gas fill-up'),

    (@userID, @creditCardAccountID, (SELECT categoryID FROM categories WHERE categoryName = 'Car Maintenance' AND groupID = @transportationGroupID), '2025-12-25', 'Car Maintenance', -450.00, 'Winter tire installation'),
    (@userID, @creditCardAccountID, (SELECT categoryID FROM categories WHERE categoryName = 'Car Maintenance' AND groupID = @transportationGroupID), '2026-01-25', 'Car Maintenance', -450.00, 'Maintenance'),

    (@userID, @creditCardAccountID, (SELECT categoryID FROM categories WHERE categoryName = 'Gas' AND groupID = @transportationGroupID), '2025-12-28', 'Gas', -60.00, 'Gas fill-up'),
    (@userID, @creditCardAccountID, (SELECT categoryID FROM categories WHERE categoryName = 'Gas' AND groupID = @transportationGroupID), '2026-01-28', 'Gas', -60.00, 'Gas fill-up'),

    -- Food transactions
    (@userID, @chequingAccountID, (SELECT categoryID FROM categories WHERE categoryName = 'Groceries' AND groupID = @foodGroupID), '2025-12-02', 'Groceries', -125.50, 'Weekly grocery shopping'),
    (@userID, @chequingAccountID, (SELECT categoryID FROM categories WHERE categoryName = 'Groceries' AND groupID = @foodGroupID), '2026-01-02', 'Groceries', -125.50, 'Weekly grocery shopping'),
    (@userID, @chequingAccountID, (SELECT categoryID FROM categories WHERE categoryName = 'Groceries' AND groupID = @foodGroupID), '2026-02-02', 'Groceries', -125.50, 'Weekly grocery shopping'),

    (@userID, @creditCardAccountID, (SELECT categoryID FROM categories WHERE categoryName = 'Groceries' AND groupID = @foodGroupID), '2025-12-09', 'Groceries', -185.00, 'Bulk shopping trip'),
    (@userID, @creditCardAccountID, (SELECT categoryID FROM categories WHERE categoryName = 'Groceries' AND groupID = @foodGroupID), '2026-01-09', 'Groceries', -185.00, 'Bulk shopping trip'),

    (@userID, @creditCardAccountID, (SELECT categoryID FROM categories WHERE categoryName = 'Groceries' AND groupID = @foodGroupID), '2025-12-14', 'Groceries', -35.50, 'Fresh produce'),
    (@userID, @creditCardAccountID, (SELECT categoryID FROM categories WHERE categoryName = 'Groceries' AND groupID = @foodGroupID), '2026-01-14', 'Groceries', -35.50, 'Fresh produce'),

    (@userID, @creditCardAccountID, (SELECT categoryID FROM categories WHERE categoryName = 'Groceries' AND groupID = @foodGroupID), '2025-12-23', 'Groceries', -110.75, 'Weekly grocery shopping'),
    (@userID, @creditCardAccountID, (SELECT categoryID FROM categories WHERE categoryName = 'Groceries' AND groupID = @foodGroupID), '2026-01-23', 'Groceries', -110.75, 'Weekly grocery shopping'),

    (@userID, @creditCardAccountID, (SELECT categoryID FROM categories WHERE categoryName = 'Dining Out' AND groupID = @foodGroupID), '2025-12-06', 'Dining Out', -45.75, 'Dinner with friends'),
    (@userID, @creditCardAccountID, (SELECT categoryID FROM categories WHERE categoryName = 'Dining Out' AND groupID = @foodGroupID), '2026-01-06', 'Dining Out', -45.75, 'Dinner with friends'),
    (@userID, @creditCardAccountID, (SELECT categoryID FROM categories WHERE categoryName = 'Dining Out' AND groupID = @foodGroupID), '2026-02-06', 'Dining Out', -45.75, 'Dinner with friends'),

    (@userID, @creditCardAccountID, (SELECT categoryID FROM categories WHERE categoryName = 'Dining Out' AND groupID = @foodGroupID), '2025-12-13', 'Dining Out', -68.50, 'Date night dinner'),
    (@userID, @creditCardAccountID, (SELECT categoryID FROM categories WHERE categoryName = 'Dining Out' AND groupID = @foodGroupID), '2026-01-13', 'Dining Out', -68.50, 'Date night dinner'),

    (@userID, @creditCardAccountID, (SELECT categoryID FROM categories WHERE categoryName = 'Dining Out' AND groupID = @foodGroupID), '2025-12-27', 'Dining Out', -52.00, 'Weekend brunch'),
    (@userID, @creditCardAccountID, (SELECT categoryID FROM categories WHERE categoryName = 'Dining Out' AND groupID = @foodGroupID), '2026-01-27', 'Dining Out', -52.00, 'Weekend brunch'),

    (@userID, @creditCardAccountID, (SELECT categoryID FROM categories WHERE categoryName = 'Takeout/Delivery' AND groupID = @foodGroupID), '2025-12-16', 'Takeout/Delivery', -16.50, 'Morning coffee'),
    (@userID, @creditCardAccountID, (SELECT categoryID FROM categories WHERE categoryName = 'Takeout/Delivery' AND groupID = @foodGroupID), '2026-01-16', 'Takeout/Delivery', -16.50, 'Morning coffee'),

    (@userID, @creditCardAccountID, (SELECT categoryID FROM categories WHERE categoryName = 'Takeout/Delivery' AND groupID = @foodGroupID), '2025-12-22', 'Takeout/Delivery', -32.00, 'Pizza delivery'),
    (@userID, @creditCardAccountID, (SELECT categoryID FROM categories WHERE categoryName = 'Takeout/Delivery' AND groupID = @foodGroupID), '2026-01-22', 'Takeout/Delivery', -32.00, 'Pizza delivery'),

    -- Healthcare transactions
    (@userID, @chequingAccountID, (SELECT categoryID FROM categories WHERE categoryName = 'Health Insurance' AND groupID = @healthcareGroupID), '2025-12-01', 'Health Insurance', -95.00, 'Monthly health insurance premium'),
    (@userID, @chequingAccountID, (SELECT categoryID FROM categories WHERE categoryName = 'Health Insurance' AND groupID = @healthcareGroupID), '2026-01-01', 'Health Insurance', -95.00, 'Monthly health insurance premium'),
    (@userID, @chequingAccountID, (SELECT categoryID FROM categories WHERE categoryName = 'Health Insurance' AND groupID = @healthcareGroupID), '2026-02-01', 'Health Insurance', -95.00, 'Monthly health insurance premium'),

    (@userID, @creditCardAccountID, (SELECT categoryID FROM categories WHERE categoryName = 'Dental Care' AND groupID = @healthcareGroupID), '2025-12-11', 'Dental Care', -150.00, 'Dental cleaning appointment'),
    (@userID, @creditCardAccountID, (SELECT categoryID FROM categories WHERE categoryName = 'Dental Care' AND groupID = @healthcareGroupID), '2026-01-11', 'Dental Care', -150.00, 'Dental cleaning appointment'),

    (@userID, @creditCardAccountID, (SELECT categoryID FROM categories WHERE categoryName = 'Therapy/Counseling' AND groupID = @healthcareGroupID), '2025-12-19', 'Therapy/Counseling', -120.00, 'Therapy session'),
    (@userID, @creditCardAccountID, (SELECT categoryID FROM categories WHERE categoryName = 'Therapy/Counseling' AND groupID = @healthcareGroupID), '2026-01-19', 'Therapy/Counseling', -120.00, 'Therapy session'),

    -- Personal Care transactions
    (@userID, @creditCardAccountID, (SELECT categoryID FROM categories WHERE categoryName = 'Salon Services' AND groupID = @personalcareGroupID), '2025-12-08', 'Salon Services', -65.00, 'Haircut and styling'),
    (@userID, @creditCardAccountID, (SELECT categoryID FROM categories WHERE categoryName = 'Salon Services' AND groupID = @personalcareGroupID), '2026-01-08', 'Salon Services', -65.00, 'Haircut and styling'),

    (@userID, @creditCardAccountID, (SELECT categoryID FROM categories WHERE categoryName = 'Toiletries' AND groupID = @personalcareGroupID), '2025-12-12', 'Toiletries', -42.50, 'Personal care products'),
    (@userID, @creditCardAccountID, (SELECT categoryID FROM categories WHERE categoryName = 'Toiletries' AND groupID = @personalcareGroupID), '2026-01-12', 'Toiletries', -42.50, 'Personal care products'),

    (@userID, @chequingAccountID, (SELECT categoryID FROM categories WHERE categoryName = 'Gym Membership' AND groupID = @personalcareGroupID), '2025-12-01', 'Gym Membership', -55.00, 'Monthly gym membership'),
    (@userID, @chequingAccountID, (SELECT categoryID FROM categories WHERE categoryName = 'Gym Membership' AND groupID = @personalcareGroupID), '2026-01-01', 'Gym Membership', -55.00, 'Monthly gym membership'),
    (@userID, @chequingAccountID, (SELECT categoryID FROM categories WHERE categoryName = 'Gym Membership' AND groupID = @personalcareGroupID), '2026-02-01', 'Gym Membership', -55.00, 'Monthly gym membership'),

    (@userID, @creditCardAccountID, (SELECT categoryID FROM categories WHERE categoryName = 'Toiletries' AND groupID = @personalcareGroupID), '2025-12-24', 'Toiletries', -28.00, 'Shampoo and soap'),
    (@userID, @creditCardAccountID, (SELECT categoryID FROM categories WHERE categoryName = 'Toiletries' AND groupID = @personalcareGroupID), '2026-01-24', 'Toiletries', -28.00, 'Shampoo and soap'),

    -- Entertainment transactions
    (@userID, @creditCardAccountID, (SELECT categoryID FROM categories WHERE categoryName = 'Movies' AND groupID = @entertainmentGroupID), '2025-12-03', 'Movies', -28.00, 'Movie tickets for two'),
    (@userID, @creditCardAccountID, (SELECT categoryID FROM categories WHERE categoryName = 'Movies' AND groupID = @entertainmentGroupID), '2026-01-03', 'Movies', -28.00, 'Movie tickets for two'),
    (@userID, @creditCardAccountID, (SELECT categoryID FROM categories WHERE categoryName = 'Movies' AND groupID = @entertainmentGroupID), '2026-02-03', 'Movies', -28.00, 'Movie tickets for two'),

    (@userID, @creditCardAccountID, (SELECT categoryID FROM categories WHERE categoryName = 'Hobbies' AND groupID = @entertainmentGroupID), '2025-12-09', 'Hobbies', -29.99, 'Video game purchase'),
    (@userID, @creditCardAccountID, (SELECT categoryID FROM categories WHERE categoryName = 'Hobbies' AND groupID = @entertainmentGroupID), '2026-01-09', 'Hobbies', -29.99, 'Video game purchase'),

    (@userID, @creditCardAccountID, (SELECT categoryID FROM categories WHERE categoryName = 'Hobbies' AND groupID = @entertainmentGroupID), '2025-12-17', 'Hobbies', -75.00, 'Art supplies'),
    (@userID, @creditCardAccountID, (SELECT categoryID FROM categories WHERE categoryName = 'Hobbies' AND groupID = @entertainmentGroupID), '2026-01-17', 'Hobbies', -75.00, 'Art supplies'),

    (@userID, @creditCardAccountID, (SELECT categoryID FROM categories WHERE categoryName = 'Subscriptions' AND groupID = @entertainmentGroupID), '2025-12-01', 'Subscriptions', -16.99, 'Streaming service'),
    (@userID, @creditCardAccountID, (SELECT categoryID FROM categories WHERE categoryName = 'Subscriptions' AND groupID = @entertainmentGroupID), '2026-01-01', 'Subscriptions', -16.99, 'Streaming service'),
    (@userID, @creditCardAccountID, (SELECT categoryID FROM categories WHERE categoryName = 'Subscriptions' AND groupID = @entertainmentGroupID), '2026-02-01', 'Subscriptions', -16.99, 'Streaming service'),

    (@userID, @creditCardAccountID, (SELECT categoryID FROM categories WHERE categoryName = 'Subscriptions' AND groupID = @entertainmentGroupID), '2025-12-01', 'Subscriptions', -10.99, 'Music streaming'),
    (@userID, @creditCardAccountID, (SELECT categoryID FROM categories WHERE categoryName = 'Subscriptions' AND groupID = @entertainmentGroupID), '2026-01-01', 'Subscriptions', -10.99, 'Music streaming'),
    (@userID, @creditCardAccountID, (SELECT categoryID FROM categories WHERE categoryName = 'Subscriptions' AND groupID = @entertainmentGroupID), '2026-02-01', 'Subscriptions', -10.99, 'Music streaming'),

    (@userID, @creditCardAccountID, (SELECT categoryID FROM categories WHERE categoryName = 'Movies' AND groupID = @entertainmentGroupID), '2025-12-21', 'Movies', -15.00, 'Movie rental'),
    (@userID, @creditCardAccountID, (SELECT categoryID FROM categories WHERE categoryName = 'Movies' AND groupID = @entertainmentGroupID), '2026-01-21', 'Movies', -15.00, 'Movie rental'),

    -- Travel transactions
    (@userID, @creditCardAccountID, (SELECT categoryID FROM categories WHERE categoryName = 'Airfare' AND groupID = @travelGroupID), '2025-12-20', 'Airfare', -450.00, 'Flight booking'),
    (@userID, @creditCardAccountID, (SELECT categoryID FROM categories WHERE categoryName = 'Airfare' AND groupID = @travelGroupID), '2026-01-20', 'Airfare', -450.00, 'Flight booking'),

    (@userID, @creditCardAccountID, (SELECT categoryID FROM categories WHERE categoryName = 'Hotel Accommodations' AND groupID = @travelGroupID), '2025-12-21', 'Hotel Accommodations', -320.00, 'Hotel reservation'),
    (@userID, @creditCardAccountID, (SELECT categoryID FROM categories WHERE categoryName = 'Hotel Accommodations' AND groupID = @travelGroupID), '2026-01-21', 'Hotel Accommodations', -320.00, 'Hotel reservation'),

    (@userID, @creditCardAccountID, (SELECT categoryID FROM categories WHERE categoryName = 'Travel Insurance' AND groupID = @travelGroupID), '2025-12-20', 'Travel Insurance', -45.00, 'Trip insurance policy'),
    (@userID, @creditCardAccountID, (SELECT categoryID FROM categories WHERE categoryName = 'Travel Insurance' AND groupID = @travelGroupID), '2026-01-20', 'Travel Insurance', -45.00, 'Trip insurance policy');

-- Get budget section IDs
SET @needsSectionID = (SELECT sectionID FROM budgetSections WHERE sectionName = 'Needs');
SET @wantsSectionID = (SELECT sectionID FROM budgetSections WHERE sectionName = 'Wants');

-- Insert budget category selections
INSERT INTO budgetCategorySelections (userID, categoryID, sectionID) VALUES
    -- Needs
    (@userID, (SELECT categoryID FROM categories WHERE categoryName = 'Mortgage/Rent' AND groupID = @housingGroupID), @needsSectionID),
    (@userID, (SELECT categoryID FROM categories WHERE categoryName = 'Home Insurance' AND groupID = @housingGroupID), @needsSectionID),
    (@userID, (SELECT categoryID FROM categories WHERE categoryName = 'Property Taxes' AND groupID = @housingGroupID), @needsSectionID),
    (@userID, (SELECT categoryID FROM categories WHERE categoryName = 'Electricity' AND groupID = @utilitiesGroupID), @needsSectionID),
    (@userID, (SELECT categoryID FROM categories WHERE categoryName = 'Internet' AND groupID = @utilitiesGroupID), @needsSectionID),
    (@userID, (SELECT categoryID FROM categories WHERE categoryName = 'Water' AND groupID = @utilitiesGroupID), @needsSectionID),
    (@userID, (SELECT categoryID FROM categories WHERE categoryName = 'Groceries' AND groupID = @foodGroupID), @needsSectionID),
    (@userID, (SELECT categoryID FROM categories WHERE categoryName = 'Health Insurance' AND groupID = @healthcareGroupID), @needsSectionID),
    (@userID, (SELECT categoryID FROM categories WHERE categoryName = 'Car Insurance' AND groupID = @transportationGroupID), @needsSectionID),
    (@userID, (SELECT categoryID FROM categories WHERE categoryName = 'Gas' AND groupID = @transportationGroupID), @needsSectionID),

    -- Wants
    (@userID, (SELECT categoryID FROM categories WHERE categoryName = 'Dining Out' AND groupID = @foodGroupID), @wantsSectionID),
    (@userID, (SELECT categoryID FROM categories WHERE categoryName = 'Takeout/Delivery' AND groupID = @foodGroupID), @wantsSectionID),
    (@userID, (SELECT categoryID FROM categories WHERE categoryName = 'Movies' AND groupID = @entertainmentGroupID), @wantsSectionID),
    (@userID, (SELECT categoryID FROM categories WHERE categoryName = 'Hobbies' AND groupID = @entertainmentGroupID), @wantsSectionID),
    (@userID, (SELECT categoryID FROM categories WHERE categoryName = 'Subscriptions' AND groupID = @entertainmentGroupID), @wantsSectionID),
    (@userID, (SELECT categoryID FROM categories WHERE categoryName = 'Travel Insurance' AND groupID = @travelGroupID), @wantsSectionID),
    (@userID, (SELECT categoryID FROM categories WHERE categoryName = 'Airfare' AND groupID = @travelGroupID), @wantsSectionID),
    (@userID, (SELECT categoryID FROM categories WHERE categoryName = 'Hotel Accommodations' AND groupID = @travelGroupID), @wantsSectionID);

-- Insert budget allocations
INSERT INTO budgetAllocation (userID, categoryID, amount, area) VALUES
    -- Income
    (@userID, (SELECT categoryID FROM categories WHERE categoryName = 'Salary/Wages' AND groupID = @incomeGroupID), 7000.00, 'Income'),
    (@userID, (SELECT categoryID FROM categories WHERE categoryName = 'Investments' AND groupID = @incomeGroupID), 500.00, 'Income'),
    (@userID, (SELECT categoryID FROM categories WHERE categoryName = 'Gifts' AND groupID = @incomeGroupID), 100.00, 'Income'),

    -- Savings
    (@userID, (SELECT categoryID FROM categories WHERE categoryName = 'Emergency Fund' AND groupID = @savingsGroupID), 200.00, 'Savings'),
    (@userID, (SELECT categoryID FROM categories WHERE categoryName = 'Retirement' AND groupID = @savingsGroupID), 750.00, 'Savings'),
    (@userID, (SELECT categoryID FROM categories WHERE categoryName = 'Investments' AND groupID = @savingsGroupID), 300.00, 'Savings'),

    -- Expenses (Needs)
    (@userID, (SELECT categoryID FROM categories WHERE categoryName = 'Mortgage/Rent' AND groupID = @housingGroupID), 1800.00, 'Expenses'),
    (@userID, (SELECT categoryID FROM categories WHERE categoryName = 'Home Insurance' AND groupID = @housingGroupID), 125.00, 'Expenses'),
    (@userID, (SELECT categoryID FROM categories WHERE categoryName = 'Property Taxes' AND groupID = @housingGroupID), 400.00, 'Expenses'),
    (@userID, (SELECT categoryID FROM categories WHERE categoryName = 'Electricity' AND groupID = @utilitiesGroupID), 135.00, 'Expenses'),
    (@userID, (SELECT categoryID FROM categories WHERE categoryName = 'Internet' AND groupID = @utilitiesGroupID), 80.00, 'Expenses'),
    (@userID, (SELECT categoryID FROM categories WHERE categoryName = 'Water' AND groupID = @utilitiesGroupID), 45.00, 'Expenses'),
    (@userID, (SELECT categoryID FROM categories WHERE categoryName = 'Groceries' AND groupID = @foodGroupID), 600.00, 'Expenses'),
    (@userID, (SELECT categoryID FROM categories WHERE categoryName = 'Health Insurance' AND groupID = @healthcareGroupID), 95.00, 'Expenses'),
    (@userID, (SELECT categoryID FROM categories WHERE categoryName = 'Car Insurance' AND groupID = @transportationGroupID), 180.00, 'Expenses'),
    (@userID, (SELECT categoryID FROM categories WHERE categoryName = 'Gas' AND groupID = @transportationGroupID), 250.00, 'Expenses'),

    -- Expenses (Wants)
    (@userID, (SELECT categoryID FROM categories WHERE categoryName = 'Dining Out' AND groupID = @foodGroupID), 200.00, 'Expenses'),
    (@userID, (SELECT categoryID FROM categories WHERE categoryName = 'Takeout/Delivery' AND groupID = @foodGroupID), 100.00, 'Expenses'),
    (@userID, (SELECT categoryID FROM categories WHERE categoryName = 'Movies' AND groupID = @entertainmentGroupID), 50.00, 'Expenses'),
    (@userID, (SELECT categoryID FROM categories WHERE categoryName = 'Hobbies' AND groupID = @entertainmentGroupID), 150.00, 'Expenses'),
    (@userID, (SELECT categoryID FROM categories WHERE categoryName = 'Subscriptions' AND groupID = @entertainmentGroupID), 30.00, 'Expenses'),
    (@userID, (SELECT categoryID FROM categories WHERE categoryName = 'Travel Insurance' AND groupID = @travelGroupID), 50.00, 'Expenses'),
    (@userID, (SELECT categoryID FROM categories WHERE categoryName = 'Airfare' AND groupID = @travelGroupID), 500.00, 'Expenses'),
    (@userID, (SELECT categoryID FROM categories WHERE categoryName = 'Hotel Accommodations' AND groupID = @travelGroupID), 400.00, 'Expenses');