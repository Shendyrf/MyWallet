<div class="modal fade" id="budgetModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">

            <form action="{{ route('budgets.store') }}" method="POST">
                @csrf

                <div class="modal-header">
                    <h5 class="modal-title">Create New Budget</h5>
                </div>

                <div class="modal-body">

                    <div class="mb-3">
                        <label class="form-label">Category</label>
                        <select name="categories_id" class="form-select" required>
                            <option value="">-- Select Category --</option>
                            @foreach ($expenseCategories as $category)
                                <option value="{{ $category->categories_id }}">
                                    {{ $category->categories_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Budget Limit</label>
                        <input type="number" name="amount_limit" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Period</label>
                        <select name="period" class="form-select" required>
                            <option value="monthly">Monthly</option>
                            <option value="yearly">Yearly</option>
                        </select>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Start Date</label>
                            <input type="date" name="start_date" class="form-control" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">End Date</label>
                            <input type="date" name="end_date" class="form-control" required>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Cancel
                    </button>
                    <button type="submit" class="btn btn-primary">
                        Save Budget
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>
