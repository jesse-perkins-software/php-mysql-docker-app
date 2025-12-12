<div class="modal fade" id="newTransactionModel">
    <form action="/controller.php" method="post" class="needs-validation" novalidate>
        <input type="hidden" name="page" value="Transactions">
        <input type="hidden" name="command" value="NewTransaction">
        <input type="hidden" id="subpage" name="subpage" value="">

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
                            <input type="date" name="date" class="form-control select-date" placeholder="MM-DD-YYYY" aria-label="date-selection" id="date-entry" required>
                        </div>
                    </div>

                    <div class="transaction-info">
                        <div class="input-group">
                            <span class="input-group-text" id="category-input">Category</span>
                            <select class="form-select select-category" id="category-options" name="category" aria-label="category-selection" required>
                                <option value="" selected>Select...</option>

                            </select>
                        </div>
                    </div>

                    <div class="transaction-info">
                        <div class="input-group">
                            <span class="input-group-text" id="description-input">Description</span>
                            <select class="form-select select-description" id="description-options" name="description" aria-label="description-selection" required>
                                <option value="" selected>Select...</option>

                            </select>
                        </div>
                    </div>

                    <div class="transaction-info">
                        <div class="input-group">
                            <span class="input-group-text" id="account-input">Account</span>
                            <select class="form-select select-account" id="account-options" name="account" aria-label="account-selection" required>
                                <option value="" selected>Select...</option>

                            </select>
                        </div>
                    </div>

                    <div class="transaction-info">
                        <div class="input-group">
                            <span class="input-group-text" id="amount-input">Amount</span>
                            <input type="number" name="amount" id="amount-entry" class="form-control select-amount" placeholder="$" step="0.01" aria-label="amount-selection" required>
                        </div>
                    </div>

                    <div class="transaction-info">
                        <div class="input-group">
                            <span class="input-group-text" id="notes-input">Notes</span>
                            <textarea name="notes" id="notes-entry" class="form-control select-notes" aria-label="notes-selection"></textarea>
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