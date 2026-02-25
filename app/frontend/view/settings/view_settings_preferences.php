<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    
    <style>
        <?php include(__DIR__ . '/../css/global_variables.css'); ?>

        #nav-bar {
            width: var(--nav-bar-width);
        }

        #content {
            margin-left: 15vw;
            display: flex;
            flex-direction: column;
            height: 100vh;
        }

        #header-container {
            height: 20vh;
            background-color: #E9E9E9;
            padding: 2em;
        }

        #header-amount {
            font-size: 1.25em;
        }


        #buttons {
            width: 10vw;
        }
        #searchBar {
            height: 5vh;
        }
        #amount-filter, #category-filter, #account-filter, #date-filter {
            display: none;
        }

        .nav-link {
            width: 100%;
        }

        .nav-link:hover {
            background-color: #eee;
        }

        #content {
            margin-left: 15vw;
        }
        #buttons {
            width: 10vw;
        }
        #searchBar {
            height: 5vh;
        }
        #amount-filter, #category-filter, #account-filter, #date-filter {
            display: none;
        }
        #submit-btn {
            margin-top: 25vh;
        }
        #clearBtn, #lockBtn, #deleteBtn {
            width: 27%;
        }

        #content-container {
            height: 100vh;
            margin-left: 15vw;
            overflow-y: auto;
            display: flex;
            flex-direction: column;
            justify-content: start;
            align-items: center;
        }

        #general-info, #budget-info {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 1em;
            margin: 1em;
            gap: 0.75em;
        }

        #general-info {
            width: 40%;
        }

        #budget-info {
            width: 50%;
        }

        .info-form {
            display: flex;
            flex-direction: column;
            gap: 0.5em;
            width: 100%;
        }

        .input-group-text {
            display: flex;
            justify-content: center;
            min-width: 4.5em;
        }

        #needs-selection, #wants-selection {
            height: auto;
            max-height: 15em;
            overflow-y: auto;
        }

    </style>
</head>
<body class="bg-light">
    <?php require(__DIR__ . '/../navigation.php'); ?>

    <div class="" id="content-container">
<!--        <div class="rounded border shadow-sm" id="general-info">-->
<!--            <h4>Account Preferences</h4>-->
<!--            <form action="/../controller/controller.php" method="post" class="needs-validation info-form" id="" novalidate>-->
<!--                <input type="hidden" name="page" value="Settings">-->
<!--                <input type="hidden" name="command" value="GeneralInfo">-->
<!---->
<!--                <div class="input-group">-->
<!--                    <span class="input-group-text" id="number-format-input">Number Format</span>-->
<!--                    <select class="form-select" id="number-input">-->
<!--                        <option selected>Choose...</option>-->
<!--                        <option value="1">1,000</option>-->
<!--                        <option value="2">1,000.00</option>-->
<!--                        <option value="3">1.000</option>-->
<!--                        <option value="3">1.000,00</option>-->
<!--                    </select>-->
<!--                </div>-->
<!--                <div class="input-group">-->
<!--                    <span class="input-group-text" id="date-format-input">Date Format</span>-->
<!--                    <select class="form-select" id="date-input">-->
<!--                        <option selected>Choose...</option>-->
<!--                        <option value="1">MM-DD-YYYY</option>-->
<!--                        <option value="2">DD-MM-YYYY</option>-->
<!--                        <option value="3">YYYY-MM-DD</option>-->
<!--                    </select>-->
<!--                </div>-->
<!---->
<!--                <input type="submit" class="btn btn-primary" value="Save">-->
<!--            </form>-->
<!--        </div>-->

        <div class="rounded border shadow-sm" id="budget-info">
            <h4>Budget Selection</h4>
            <form action="/../controller/controller.php" method="post" class="needs-validation info-form" id="" novalidate>
                <input type="hidden" name="page" value="Settings">
                <input type="hidden" name="command" value="BudgetSelection">

                <div class="mb-3">
                    <label class="form-label fw-bold">Needs</label>
                    <div class="form-control" id="needs-selection"></div>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">Wants</label>
                    <div class="form-control" id="wants-selection"></div>
                </div>

                <input type="submit" class="btn btn-primary" value="Save">
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
<script defer>
    document.addEventListener('DOMContentLoaded', function() {
        fetch_budget_categories();
    });

    function fetch_selected_categories() {
        let xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState === 4 && this.status === 200) {
                let data = JSON.parse(this.responseText);

                data.forEach(item => {
                    let section = item.sectionName.toLowerCase();
                    let categoryName = item.categoryName;
                    
                    // Find all checkboxes with this value
                    let checkboxes = document.querySelectorAll(`input[type=checkbox][value="${categoryName}"]`);
                    checkboxes.forEach(checkbox => {
                        if (checkbox.name === section + "[]") {
                            checkbox.checked = true;
                            // Trigger the change event to handle disabling the other section's checkbox
                            checkbox.dispatchEvent(new Event('change'));
                        }
                    });
                });
            }
        };
        let query = "page=Settings&command=GetBudgetCategories";
        xhttp.open("POST", "/../controller/controller.php", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send(query);
    }

    function fetch_budget_categories() {
        let xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState === 4 && this.status === 200) {
                let data = JSON.parse(this.responseText);
                populateCheckboxes(data, 'needs-selection', 'needs');
                populateCheckboxes(data, 'wants-selection', 'wants');
                fetch_selected_categories();
            }
        };
        let query = "page=Settings&command=LoadBudgetCategories";
        xhttp.open("POST", "/../controller/controller.php", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send(query);
    }

    function populateCheckboxes(data, containerId, name) {
        let container = document.getElementById(containerId);
        container.innerHTML = "";
        
        for (let i = 0; i < data.length; i += 2) {
            let row = document.createElement("div");
            row.classList.add("row", "mb-3");
            
            for (let j = 0; j < 2 && (i + j) < data.length; j++) {
                let group = data[i + j];
                let col = document.createElement("div");
                col.classList.add("col-6");
                
                let groupHeader = document.createElement("div");
                groupHeader.classList.add("fw-bold", "text-secondary", "small", "mb-1");
                groupHeader.innerText = group.groupName;
                col.appendChild(groupHeader);

                if (group.categories) {
                    let categories = group.categories.split(', ');
                    categories.forEach(categoryName => {
                        let div = document.createElement("div");
                        div.classList.add("form-check", "ms-2");
                        
                        let input = document.createElement("input");
                        input.classList.add("form-check-input");
                        input.type = "checkbox";
                        input.name = name + "[]";
                        input.value = categoryName;
                        
                        let safeGroupName = group.groupName.replace(/[^a-zA-Z0-9]/g, '');
                        let safeCategoryName = categoryName.replace(/[^a-zA-Z0-9]/g, '');
                        input.id = name + "-" + safeGroupName + "-" + safeCategoryName;
                        input.addEventListener('change', event => {
                            if (event.target.checked) {
                                if (name === 'needs') {
                                    document.getElementById(`wants-${safeGroupName}-${safeCategoryName}`).disabled = true;
                                } else {
                                    document.getElementById(`needs-${safeGroupName}-${safeCategoryName}`).disabled = true;
                                }
                            } else {
                                if (name === 'needs') {
                                    document.getElementById(`wants-${safeGroupName}-${safeCategoryName}`).disabled = false;
                                } else {
                                    document.getElementById(`needs-${safeGroupName}-${safeCategoryName}`).disabled = false;
                                }
                            }
                        });
                        
                        let label = document.createElement("label");
                        label.classList.add("form-check-label");
                        label.htmlFor = input.id;
                        label.innerText = categoryName;
                        
                        div.appendChild(input);
                        div.appendChild(label);
                        col.appendChild(div);
                    });
                }
                row.appendChild(col);
            }
            container.appendChild(row);
        }
    }

    <?php include(__DIR__ . '/../js/modal-functions.js'); ?>
</script>