<div class="modal fade" id="newTransactionModel">
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
                        <input type="date" class="form-control" placeholder="MM-DD-YYYY">
                    </div>
                </div>

                <div class="transaction-info">
                    <div class="input-group">
                        <span class="input-group-text" id="description-input">Description</span>
                        <input type="text" class="form-control" placeholder="Recipient">
                    </div>
                </div>

                <div class="transaction-info">
                    <div class="input-group">
                        <span class="input-group-text" id="amount-input">Amount</span>
                        <input type="text" class="form-control" placeholder="$">
                    </div>
                </div>

                <div class="transaction-info">
                    <div class="input-group">
                        <span class="input-group-text" id="account-input">Account</span>
                        <input type="text" class="form-control" placeholder="Chequing">
                    </div>
                </div>

                <div class="transaction-info">
                    <div class="input-group">
                        <span class="input-group-text" id="category-input">Category</span>
                        <input type="text" class="form-control" placeholder="Needs/Wants/Savings">
                    </div>
                </div>

                <div class="transaction-info">
                    <div class="input-group">
                        <span class="input-group-text" id="notes-input">Notes</span>
                        <textarea class="form-control"></textarea>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>