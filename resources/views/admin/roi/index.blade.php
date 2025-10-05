@extends('member.layouts.appadmin')

@section('title', 'ROI Rates')

@section('content')
<div class="container py-3">
    <div class="page-inner">
        <div class="col-12">
            <!-- Header Card -->
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-body p-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h2 class="h4 mb-0">
                                <i class="fas fa-chart-line text-primary me-2"></i>ROI Rates
                            </h2>
                            <p class="text-muted mb-0 d-none d-md-block">Manage your Return on Investment rates</p>
                        </div>
                        <div>
                            <form action="/admin/roi/manual" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-warning btn-sm">
                                    <i class="fas fa-play-circle me-1"></i>
                                    <span class="d-none d-md-inline">Run ROI Now</span>
                                    <span class="d-md-none">Run Now</span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-circle me-2"></i> {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <!-- Desktop Table -->
            <div class="card shadow-sm rounded-3 d-none d-lg-block">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped align-middle mb-0">
                            <thead class="table-dark">
                                <tr>
                                    <th class="text-center">ID</th>
                                    <th>ROI Rate</th>
                                    <th>Created At</th>
                                    <th>Updated At</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($roiRates as $roi)
                                <tr>
                                    <td class="text-center"><strong>#{{ $roi->id }}</strong></td>
                                    <td>
                                        <span class="badge bg-success fs-6">{{ $roi->rate }}%</span>
                                    </td>
                                    <td>{{ $roi->created_at->format('M j, Y g:i A') }}</td>
                                    <td>{{ $roi->updated_at->format('M j, Y g:i A') }}</td>
                                    <td class="text-center">
                                        <button class="btn btn-primary btn-sm edit-btn"
                                            data-id="{{ $roi->id }}"
                                            data-rate="{{ $roi->rate }}"
                                            data-bs-toggle="modal"
                                            data-bs-target="#editModal">
                                            <i class="fas fa-edit me-1"></i>Update
                                        </button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Mobile Cards -->
            <div class="d-lg-none">
                @foreach($roiRates as $roi)
                <div class="card shadow-sm border-0 mb-3">
                    <div class="card-body">
                        <div class="row g-2">
                            <div class="col-6">
                                <small class="text-muted">ID</small>
                                <div class="fw-bold text-primary">#{{ $roi->id }}</div>
                            </div>
                            <div class="col-6">
                                <small class="text-muted">ROI Rate</small>
                                <div>
                                    <span class="badge bg-success">{{ $roi->rate }}%</span>
                                </div>
                            </div>
                            <div class="col-6">
                                <small class="text-muted">Created</small>
                                <div class="small">{{ $roi->created_at->format('M j, Y') }}</div>
                            </div>
                            <div class="col-6">
                                <small class="text-muted">Updated</small>
                                <div class="small">{{ $roi->updated_at->format('M j, Y') }}</div>
                            </div>
                            <div class="col-12 mt-2">
                                <button class="btn btn-primary btn-sm w-100 edit-btn"
                                    data-id="{{ $roi->id }}"
                                    data-rate="{{ $roi->rate }}"
                                    data-bs-toggle="modal"
                                    data-bs-target="#editModal">
                                    <i class="fas fa-edit me-1"></i>Update Rate
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Empty State -->
            @if($roiRates->isEmpty())
            <div class="card shadow-sm border-0">
                <div class="card-body text-center py-5">
                    <i class="fas fa-chart-line fa-3x text-muted mb-3"></i>
                    <h5 class="text-muted">No ROI Rates Found</h5>
                    <p class="text-muted">No ROI rates have been configured yet.</p>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>

<!-- Edit ROI Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <form method="POST" id="editForm">
            @csrf
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="editModalLabel">
                        <i class="fas fa-edit me-2"></i>Edit ROI Rate
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" id="roiId">
                    <div class="mb-3">
                        <label for="roiRate" class="form-label fw-semibold">ROI Rate (%)</label>
                        <div class="input-group">
                            <input type="number" 
                                   name="rate" 
                                   id="roiRate" 
                                   class="form-control form-control-lg" 
                                   step="0.01" 
                                   min="0.01" 
                                   max="10" 
                                   placeholder="Enter ROI rate..."
                                   required>
                            <span class="input-group-text">%</span>
                        </div>
                        <div class="form-text">
                            Enter a value between 0.01% and 10%
                        </div>
                        <div id="errorMsg" class="invalid-feedback d-block d-none"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-times me-1"></i>Cancel
                    </button>
                    <button type="submit" class="btn btn-success" id="saveBtn">
                        <i class="fas fa-save me-1"></i>Save Changes
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@section('styles')
<style>
    .card {
        border-radius: 12px;
    }
    
    .table th {
        border-top: none;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.8rem;
        letter-spacing: 0.5px;
    }
    
    .badge {
        font-size: 0.8rem;
        padding: 0.5em 0.75em;
    }
    
    .btn {
        border-radius: 8px;
        font-weight: 500;
        transition: all 0.3s ease;
    }
    
    .btn-sm {
        padding: 0.5rem 1rem;
    }
    
    /* Mobile card styles */
    @media (max-width: 991.98px) {
        .container-fluid {
            padding-left: 10px;
            padding-right: 10px;
        }
        
        .card-body {
            padding: 1rem;
        }
        
        .h4 {
            font-size: 1.25rem;
        }
    }
    
    @media (max-width: 575.98px) {
        .card-body {
            padding: 0.75rem;
        }
        
        .btn-sm {
            padding: 0.4rem 0.8rem;
            font-size: 0.8rem;
        }
        
        .badge {
            font-size: 0.75rem;
            padding: 0.4em 0.6em;
        }
        
        .modal-content {
            margin: 10px;
        }
        
        .form-control-lg {
            font-size: 1rem;
            padding: 0.75rem;
        }
    }
    
    /* Very small screens */
    @media (max-width: 360px) {
        .container-fluid {
            padding-left: 5px;
            padding-right: 5px;
        }
        
        .card-body {
            padding: 0.5rem;
        }
        
        .btn-sm {
            padding: 0.35rem 0.7rem;
            font-size: 0.75rem;
        }
        
        .modal-dialog {
            margin: 5px;
        }
    }
    
    /* Animation for modal */
    .modal.fade .modal-dialog {
        transform: scale(0.9);
        transition: transform 0.3s ease-out;
    }
    
    .modal.show .modal-dialog {
        transform: scale(1);
    }
    
    /* Hover effects */
    .btn:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.15);
    }
    
    .card:hover {
        box-shadow: 0 8px 25px rgba(0,0,0,0.1);
    }
</style>
@endsection

@section('scripts')
<script>
document.addEventListener("DOMContentLoaded", function () {
    const editBtns = document.querySelectorAll(".edit-btn");
    const form = document.getElementById("editForm");
    const roiIdInput = document.getElementById("roiId");
    const roiRateInput = document.getElementById("roiRate");
    const errorMsg = document.getElementById("errorMsg");
    const saveBtn = document.getElementById("saveBtn");

    // Edit button click handler
    editBtns.forEach(btn => {
        btn.addEventListener("click", function () {
            const id = this.getAttribute("data-id");
            const rate = this.getAttribute("data-rate");

            roiIdInput.value = id;
            roiRateInput.value = rate;

            form.setAttribute("action", `/admin/roi/${id}/update`);
            
            // Clear previous validation
            roiRateInput.classList.remove('is-invalid');
            errorMsg.classList.add('d-none');
            saveBtn.disabled = false;
            
            // Focus on input
            setTimeout(() => {
                roiRateInput.focus();
                roiRateInput.select();
            }, 500);
        });
    });

    // Input validation
    function validateInput() {
        let value = parseFloat(roiRateInput.value);
        roiRateInput.classList.remove('is-invalid');
        errorMsg.classList.add('d-none');

        // Check if empty
        if (isNaN(value) || roiRateInput.value.trim() === "") {
            showError("ROI Rate cannot be empty.");
            return false;
        }

        // Check if zero or negative
        if (value <= 0) {
            showError("ROI Rate must be greater than 0.");
            return false;
        }

        // Check if exceeds maximum
        if (value > 10) {
            showError("ROI Rate cannot exceed 10%.");
            return false;
        }

        // Check if too many decimal places
        if (roiRateInput.value.split('.')[1]?.length > 2) {
            showError("ROI Rate can have maximum 2 decimal places.");
            return false;
        }

        saveBtn.disabled = false;
        return true;
    }

    function showError(message) {
        errorMsg.innerText = message;
        errorMsg.classList.remove("d-none");
        roiRateInput.classList.add('is-invalid');
        saveBtn.disabled = true;
    }

    // Event listeners
    roiRateInput.addEventListener("input", validateInput);
    roiRateInput.addEventListener("blur", validateInput);

    // Form submission
    form.addEventListener("submit", function (e) {
        if (!validateInput()) {
            e.preventDefault();
            // Add shake animation to modal
            const modalContent = document.querySelector('.modal-content');
            modalContent.classList.add('shake');
            setTimeout(() => {
                modalContent.classList.remove('shake');
            }, 500);
        }
    });

    // Modal shown event - reset validation
    const editModal = document.getElementById('editModal');
    editModal.addEventListener('show.bs.modal', function () {
        roiRateInput.classList.remove('is-invalid');
        errorMsg.classList.add('d-none');
        saveBtn.disabled = false;
    });

    // Keyboard shortcuts
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && editModal.classList.contains('show')) {
            const modalInstance = bootstrap.Modal.getInstance(editModal);
            modalInstance.hide();
        }
    });
});

// Add shake animation
const style = document.createElement('style');
style.textContent = `
    @keyframes shake {
        0%, 100% { transform: translateX(0); }
        25% { transform: translateX(-5px); }
        75% { transform: translateX(5px); }
    }
    .shake {
        animation: shake 0.3s ease-in-out;
    }
`;
document.head.appendChild(style);
</script>
@endsection