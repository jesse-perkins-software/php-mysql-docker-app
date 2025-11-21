<div class="modal fade" id="newTransactionModel">
    <form action="/controller.php" method="post" class="needs-validation" novalidate>
        <input type="hidden" name="page" value="Transactions_Income">
        <input type="hidden" name="command" value="NewTransaction">

        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">New Transaction</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="transaction-info">
                        <div class="input-group">
                            <span class="input-group-text" id="date-input">Date</span>
                            <input type="date" name="date" class="form-control" placeholder="MM-DD-YYYY" required>
                        </div>
                    </div>

                    <div class="transaction-info">
                        <div class="input-group">
                            <span class="input-group-text" id="description-input">Description</span>
                            <input type="text" name="description" class="form-control" placeholder="Recipient" required>
                        </div>
                    </div>

                    <div class="transaction-info">
                        <div class="input-group">
                            <span class="input-group-text" id="amount-input">Amount</span>
                            <input type="number" name="amount" class="form-control" placeholder="$" step="0.01" required>
                        </div>
                    </div>

                    <div class="transaction-info">
                        <div class="input-group">
                            <span class="input-group-text" id="account-input">Account</span>
                            <input type="text" name="account" class="form-control" placeholder="Chequing" required>
                        </div>
                    </div>

                    <div class="transaction-info">
                        <div class="input-group">
                            <span class="input-group-text" id="category-input">Category</span>
                            <input type="text" name="category" class="form-control" placeholder="Needs/Wants/Savings" required>
                        </div>
                    </div>

                    <div class="transaction-info">
                        <div class="input-group">
                            <span class="input-group-text" id="notes-input">Notes</span>
                            <textarea name="notes" class="form-control"></textarea>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <input type="submit" class="btn btn-primary" value="Save">
                </div>
            </div>
        </div>
    </form>
</div>