{{-- satart modal Income --}}
<div class="modal fade" id="incomeModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content bg-white text-dark">

            <div class="modal-header border-0">
                <h5 class="modal-title fw-semibold">Add Income</h5>
            </div>

            <form action="{{ route('transactions.store') }}" method="POST">
                @csrf

                <input type="hidden" name="type" value="income">

                <div class="modal-body">

                    <div class="mb-3">
                        <label class="form-label">Amount</label>
                        <input type="number" name="amount" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Category</label>
                        <select name="categories_id" class="form-select" required>
                            <option value="">-- Select Category --</option>
                            @foreach ($incomeCategories as $category)
                                <option value="{{ $category->categories_id }}">
                                    {{ $category->categories_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Transaction Date</label>
                        <input type="date" name="transaction_date" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Note</label>
                        <textarea name="note" class="form-control" rows="2"></textarea>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>

            </form>

        </div>
    </div>
</div>
{{-- end modal Income --}}

{{-- satart modal expense --}}
<div class="modal fade" id="expenseModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content bg-white text-dark">

            <div class="modal-header border-0">
                <h5 class="modal-title fw-semibold">Add Expense</h5>
            </div>

            <form action="{{ route('transactions.store') }}" method="POST">
                @csrf

                <input type="hidden" name="type" value="expense">

                <div class="modal-body">

                    <div class="mb-3">
                        <label class="form-label">Amount</label>
                        <input type="number" name="amount" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Category</label>
                        <select name="categories_id" class="form-select" aria-label="Default select example" required>
                            <option selected disabled class="text-muted">Open this select category</option>
                            @foreach ($expenseCategories as $category)
                                <option value="{{ $category->categories_id }}">
                                    {{ $category->categories_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Transaction Date</label>
                        <input type="date" name="transaction_date" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Note</label>
                        <textarea name="note" class="form-control" rows="2"></textarea>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>

            </form>

        </div>
    </div>
</div>
{{-- end modal expense --}}
