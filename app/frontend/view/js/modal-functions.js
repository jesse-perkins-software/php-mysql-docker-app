// When adding these functions, you need to manually make a function that
// fetches the transactions of the page.

function makeTransactions(data) {
    let transactionData = data;

    let total_amount = 0;
    for (let i = 0; i < transactionData.length; i++) {
        let div = document.createElement('div');
        div.className = "row border-bottom individual-transactions";
        div.id = transactionData[i]['transactionID'];

        let dateColumn = document.createElement('div');
        dateColumn.className = "col";
        dateColumn.textContent = transactionData[i]['date'];
        dateColumn.value = transactionData[i]['date'];

        let descriptionColumn = document.createElement('div');
        descriptionColumn.className = "col-3";
        descriptionColumn.textContent = transactionData[i]['description'];
        descriptionColumn.value = transactionData[i]['description'];

        let amountColumn = document.createElement('div');
        let amount = Number(transactionData[i]['amount']);
        if (amount < 0) {
            amountColumn.className = "col individual-transaction-amount text-red";
            amountColumn.textContent = "($" + Math.abs(amount).toLocaleString(undefined, {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            }) + ")";
            amountColumn.value = transactionData[i]['amount'];
        } else {
            amountColumn.className = "col individual-transaction-amount text-green";
            amountColumn.textContent = "$" + amount.toLocaleString(undefined, {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            });
            amountColumn.value = transactionData[i]['amount'];
        }
        total_amount += amount;

        let accountColumn = document.createElement('div');
        accountColumn.className = "col-2";
        accountColumn.textContent = transactionData[i]['accountName'];
        accountColumn.value = transactionData[i]['accountName'];

        let categoryColumn = document.createElement('div');
        categoryColumn.className = "col";
        categoryColumn.textContent = transactionData[i]['groupName'];
        categoryColumn.value = transactionData[i]['groupName'];

        let notesColumn = document.createElement('div');
        notesColumn.className = "col-3";
        notesColumn.textContent = transactionData[i]['notes'];
        notesColumn.value = transactionData[i]['notes'];

        div.appendChild(dateColumn);
        div.appendChild(descriptionColumn)
        div.appendChild(amountColumn);
        div.appendChild(accountColumn);
        div.appendChild(categoryColumn);
        div.appendChild(notesColumn);

        div.addEventListener('click', function() {
            let transaction = transactionData[i];

            document.getElementById('transaction-id').value = div.id;
            document.getElementById('date-edit').value = transaction['date'];
            document.getElementById('category-edit').value = transaction['groupName'];
            document.getElementById('account-edit').value = transaction['accountName'];
            document.getElementById('amount-edit').value = transaction['amount'];
            document.getElementById('notes-edit').value = transaction['notes'];

            fetchDescriptionForEdit(transaction['groupName'], transaction['description']);

            let modal = new bootstrap.Modal(document.getElementById('editTransactionModel'));
            modal.show();
        });
        document.getElementById('transactions-container').appendChild((div));
    }
    let total = document.getElementById('account-amount');
    if (total_amount < 0) {
        total.className = "text-red";
        total.textContent = "($" + Math.abs(total_amount).toLocaleString(undefined, {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2
        }) + ")";
    } else if (total_amount > 0) {
        total.className = "text-green";
        total.textContent = "$" + total_amount.toLocaleString(undefined, {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2
        });
    } else {
        total.textContent = "$" + total_amount.toLocaleString(undefined, {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2
        });
    }
}

function fetchDescriptionForEdit(selectedCategory, descriptionValue) {
    let xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            let data = JSON.parse(this.responseText);
            let descriptionOptions = document.getElementById('description-edit');
            descriptionOptions.replaceChildren();

            let baseOption = document.createElement('option');
            baseOption.textContent = "Select...";
            baseOption.value = "";
            descriptionOptions.appendChild(baseOption);

            assignDescriptions(data);

            document.getElementById('description-edit').value = descriptionValue;
        }
    };

    let query = "page=Transactions&command=FetchDescriptionSelectionOptions&selectedCategory=" + selectedCategory;
    xhttp.open("POST", "/controller.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send(query);
}

function addAccountOptions(data) {
    let accountOptions = document.querySelectorAll(".select-account");

    accountOptions.forEach(field => {
        for (let i = 0; i < data.length; i++) {
            let accountOption = document.createElement('option');
            accountOption.textContent = data[i];
            accountOption.value = data[i];
            field.appendChild(accountOption);
        }
    });
}

function fetchAccounts() {
    let xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            let data = JSON.parse(this.responseText);
            addAccountOptions(data);
        }
    };
    let query = "page=Transactions&command=FetchAccountOptions";
    xhttp.open("POST", "/controller.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send(query);
}

function assignDescriptions(data) {
    let descriptionOptions = document.querySelectorAll('.select-description');

    descriptionOptions.forEach(field => {
        for (let i = 0; i < data.length; i++) {
            let descriptionOption = document.createElement('option');
            descriptionOption.textContent = data[i];
            descriptionOption.value = data[i];
            field.appendChild(descriptionOption);
        }
    });
}

function fetchDescriptionSelectionOptions(selectedCategory) {
    let xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            let data = JSON.parse(this.responseText);
            assignDescriptions(data);
        }
    };

    let query = "page=Transactions&command=FetchDescriptionSelectionOptions&selectedCategory=" + selectedCategory;
    xhttp.open("POST", "/controller.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send(query);
}

function assignCategories(data) {
    let categoryOptions = document.querySelectorAll('.select-category');

    categoryOptions.forEach(field => {
        for (let i = 0; i < data.length; i++) {
            let categoryOption = document.createElement('option');
            categoryOption.textContent = data[i];
            categoryOption.value = data[i];
            field.appendChild(categoryOption);
        }

        field.addEventListener('change', (event) => {
            const selectedCategory = event.target.value;
            let descriptionOptions;

            descriptionOptions = document.querySelectorAll('.select-description');
            descriptionOptions.forEach(i => {
                i.replaceChildren(i.options[0]);
            });

            fetchDescriptionSelectionOptions(selectedCategory);
        });
    });
}

function fetchCategorySelectionOptions() {
    let xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            let data = JSON.parse(this.responseText);
            assignCategories(data);
        }
    };
    let query = "page=Transactions&command=FetchCategorySelectionOptions";
    xhttp.open("POST", "/controller.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send(query);
}

function clearTransactionData() {
    document.getElementById('date-entry').value = "";
    document.getElementById('category-options').value = "";
    document.getElementById('description-options').value = "";
    document.getElementById('account-options').value = "";
    document.getElementById('amount-entry').value = "";
    document.getElementById('notes-entry').value = "";

    let baseOption = document.createElement('option');
    baseOption.textContent = "Select...";
    baseOption.setAttribute('value', "");

    document.getElementById('description-options').replaceChildren(baseOption);
}