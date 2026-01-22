<div class="modal fade" id="editTransactionModel">
    <form action="/../controller/controller.php" method="post" id="editTransactionForm" class="needs-validation" novalidate>
        <input type="hidden" name="page" value="Transactions">
        <input type="hidden" name="command" value="EditTransaction">
        <input type="hidden" id="subpage-edit-transactions" name="subpage-edit" value="">
        <input type="hidden" id="action-input" name="action" value="">
        <input type="hidden" id="transaction-id" name="transaction-id" value="">

        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Transaction</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="transaction-info">
                        <div class="input-group">
                            <span class="input-group-text" id="date-input">Date</span>
                            <input type="date" name="date" class="form-control select-date" placeholder="MM-DD-YYYY" aria-label="date-selection" id="date-edit" required>
                        </div>
                    </div>

                    <div class="transaction-info">
                        <div class="input-group">
                            <span class="input-group-text" id="category-input">Category</span>
                            <select class="form-select select-category" id="category-edit" name="category" aria-label="category-selection" required>
                                <option value="" selected>Select...</option>

                            </select>
                        </div>
                    </div>

                    <div class="transaction-info">
                        <div class="input-group">
                            <span class="input-group-text" id="description-input">Description</span>
                            <select class="form-select select-description" id="description-edit" name="description" aria-label="description-selection" required>
                                <option value="" selected>Select...</option>

                            </select>
                        </div>
                    </div>

                    <div class="transaction-info">
                        <div class="input-group">
                            <span class="input-group-text" id="account-input">Account</span>
                            <select class="form-select select-account" id="account-edit" name="account" aria-label="account-selection" required>
                                <option id="account-new-selection" value="" selected>Select...</option>

                            </select>
                        </div>
                    </div>

                    <div class="transaction-info">
                        <div class="input-group">
                            <span class="input-group-text" id="amount-input">Amount</span>
                            <input type="number" name="amount" id="amount-edit" class="form-control select-amount" placeholder="$" step="0.01" aria-label="amount-selection" required>
                        </div>
                    </div>

                    <div class="transaction-info">
                        <div class="input-group">
                            <span class="input-group-text" id="notes-input">Notes</span>
                            <textarea name="notes" id="notes-edit" class="form-control select-notes" aria-label="notes-selection"></textarea>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <input type="submit" class="btn btn-danger" value="Delete" onclick="submitAction('delete')">
                    <input type="submit" class="btn btn-primary" value="Save" onclick="submitAction('save')">
                </div>
            </div>
        </div>
    </form>
</div>