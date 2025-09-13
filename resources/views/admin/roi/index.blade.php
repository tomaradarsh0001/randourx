@extends('member.layouts.appadmin')

@section('title', 'ROI Rates')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">ROI Rates</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow-sm rounded-3">
        <div class="card-body">
            <table class="table table-bordered table-striped align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>ROI Rate</th>
                        <th>Created At</th>
                        <th>Updated At</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($roiRates as $roi)
                    <tr>
                        <td>{{ $roi->id }}</td>
                        <td>{{ $roi->rate }}</td>
                        <td>{{ $roi->created_at }}</td>
                        <td>{{ $roi->updated_at }}</td>
                        <td>
                          <button class="btn btn-primary edit-btn"
                                data-id="{{ $roi->id }}"
                                data-rate="{{ $roi->rate }}"
                                data-bs-toggle="modal"
                                data-bs-target="#editModal">
                            Update
                        </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <form action="/admin/roi/manual" method="POST" class="mb-3">
    @csrf
    <button type="submit" class="btn btn-warning">Run ROI Now</button>
</form>

        </div>
    </div>
</div>

<!-- Edit ROI Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form method="POST" id="editForm">
        @csrf
        <div class="modal-content">
          <div class="modal-header bg-primary text-white">
            <h5 class="modal-title" id="editModalLabel">Edit ROI Rate</h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
              <input type="hidden" name="id" id="roiId">
              <div class="mb-3">
                  <label for="roiRate" class="form-label">ROI Rate</label>
                  <input type="number" name="rate" id="roiRate" 
                         class="form-control" 
                         step="any" min="0.01" max="10" required>
                  <div id="errorMsg" class="invalid-feedback d-block d-none"></div>
              </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-success" id="saveBtn">Save</button>
          </div>
        </div>
    </form>
  </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const editBtns = document.querySelectorAll(".edit-btn");
    const form = document.getElementById("editForm");
    const roiIdInput = document.getElementById("roiId");
    const roiRateInput = document.getElementById("roiRate");
    const errorMsg = document.getElementById("errorMsg");
    const saveBtn = document.getElementById("saveBtn");

    editBtns.forEach(btn => {
        btn.addEventListener("click", function () {
            const id = this.getAttribute("data-id");
            const rate = this.getAttribute("data-rate");

            roiIdInput.value = id;
            roiRateInput.value = rate;

            form.setAttribute("action", `/admin/roi/${id}/update`);
            validateInput();
        });
    });

    function validateInput() {
        let value = parseFloat(roiRateInput.value);

        if (isNaN(value) || roiRateInput.value.trim() === "") {
            errorMsg.innerText = "ROI Rate cannot be empty.";
            errorMsg.classList.remove("d-none");
            saveBtn.disabled = true;
            return false;
        }

        if (value <= 0) {
            errorMsg.innerText = "ROI Rate must be greater than 0.";
            errorMsg.classList.remove("d-none");
            saveBtn.disabled = true;
            return false;
        }

        if (value > 10) {
            errorMsg.innerText = "ROI Rate cannot exceed 10.";
            errorMsg.classList.remove("d-none");
            saveBtn.disabled = true;
            return false;
        }

        errorMsg.classList.add("d-none");
        saveBtn.disabled = false;
        return true;
    }

    roiRateInput.addEventListener("input", validateInput);
});
</script>
@endsection
