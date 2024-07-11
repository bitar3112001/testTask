<x-sidebar>
    <div class="container mt-5">
        <h1 class="text-center mb-4" style="color: #FCA311;">Create Payment</h1>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <form action="{{ route('payments.store') }}" method="POST" class="bg-light p-4 shadow-sm rounded">
            @csrf
            <div class="form-group mb-3">
                <label for="revenue_id" class="form-label">Revenue ID:</label>
                <input type="text" id="revenue_id" name="revenue_id" class="form-control" required>
            </div>
            <div class="form-group mb-3">
                <label for="amount" class="form-label">Amount:</label>
                <input type="text" id="amount" name="amount" class="form-control" required>
            </div>
            <div class="form-group mb-3">
                <label for="date" class="form-label">Date:</label>
                <input type="date" id="date" name="date" class="form-control" required>
            </div>
            <div class="form-group mb-3">
                <label class="form-label">Select source:</label>
                <div class="d-flex justify-content-start align-items-center">
                    <div class="form-check form-check-inline me-3">
                        <input class="form-check-input" type="radio" name="category" id="students" value="students" required>
                        <label class="form-check-label" for="students">Students</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="category" id="tasks" value="tasks" required>
                        <label class="form-check-label" for="tasks">Tasks</label>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary custom-btn">Submit</button>
        </form>
    </div>
</x-sidebar>

<style>
    .btn.custom-btn {
        background-color: #FCA311;
        border-color: #FCA311;
    }
    .btn.custom-btn:hover {
        background-color: grey !important;
        border-color: grey !important;
    }
</style>
