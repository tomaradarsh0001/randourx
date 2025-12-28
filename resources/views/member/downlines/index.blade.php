@extends('member.layouts.app')

@section('title', 'My Downlines')

@section('content')
<div class="container ">
    <div class="page-inner">
        <!-- Heading and Filter in a single row -->
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center ">
            <h2 class="mb-3 mb-md-0">My Downline Users</h2>
            
            @if(!$downlines->isEmpty())
            <div class="d-flex align-items-center w-50 w-md-auto">
                <label for="downline-filter" class="form-label">Filter:&nbsp;&nbsp;</label>
                <select id="downline-filter" class="form-select w-100 w-md-auto">
                    <option value="">All Downlines</option>
                    @foreach($level1Groups as $id => $group)
                        <option value="{{ $group['label'] }}">
                            {{ $group['label'] }} - {{ $group['username'] }} ({{ $group['full_name'] }})
                        </option>
                    @endforeach
                </select>
            </div>
            @endif
        </div>

        @if($downlines->isEmpty())
            <div class="alert alert-info">No downline users yet.</div>
        @else
            <div class="card shadow-sm rounded-3">
                <div class="card-body p-0 p-md-3">
                    <div class="table-responsive">
                        <table id="downlines-table" class="table table-striped table-bordered table-hover align-middle text-center w-100">
                            <thead class="table-dark d-none d-md-table-header-group">
                                <tr>
                                    <th style="width: 100px;">#</th>
                                    <th>Username</th>
                                    <th>Full Name</th>
                                   
                                    <th>Depth</th>
                                    <th>Wallet3 ($)</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($downlines as $index => $downline)
                                    <tr data-downline="{{ $downline->downline_name }}" class="downline-row">
                                        <td class="d-none d-md-table-cell">{{ $index + 1 }}</td>
                                        <td>
                                            <!-- Mobile view -->
                                            <div class="d-md-none">
                                                <div class="d-flex align-items-center mb-2">
                                                    <span class="me-2"
                                                          style="display:inline-block; width:10px; height:10px; border-radius:50%; background-color: {{ $downline->color }};">
                                                    </span>
                                                    <span class="fw-bold text-primary">{{ $downline->username }}</span>
                                                </div>
                                                <div class="small text-muted mb-2">{{ $downline->downline_name }}</div>
                                                <div class="d-flex justify-content-between">
                                                    <span class="fw-bold">Full Name:</span>
                                                    <span>{{ $downline->full_name }}</span>
                                                </div>
                                                
                                                <div class="d-flex justify-content-between">
                                                    <span class="fw-bold">Depth:</span>
                                                    <span class="badge bg-info text-white">
                                                        Level {{ $downline->depth >= 15 ? 15 : $downline->depth }}
                                                    </span>
                                                </div>
                                                <div class="d-flex justify-content-between">
                                                    <span class="fw-bold">Wallet3:</span>
                                                    <span class="fw-bold text-success">
                                                        ${{ number_format($downline->wallet3, 2) }}
                                                    </span>
                                                </div>
                                              
                                            </div>
                                            
                                            <!-- Desktop view -->
                                            <div class="d-none d-md-block">
                                                <span class="me-1"
                                                      style="display:inline-block; width:10px; height:10px; border-radius:50%; background-color: {{ $downline->color }};">
                                                </span>
                                                <span class="fw-bold text-primary">{{ $downline->username }}</span>
                                                <br>
                                                <small class="text-muted">{{ $downline->downline_name }}</small>
                                            </div>
                                        </td>
                                        <td class="d-none d-md-table-cell">{{ $downline->full_name }}</td>
                                       

                                        <td class="d-none d-md-table-cell">
                                            <span class="badge bg-info text-white">
                                                Level {{ $downline->depth >= 15 ? 15 : $downline->depth }}
                                            </span>
                                        </td>
                                        <td class="d-none d-md-table-cell fw-bold text-success">
                                            ${{ number_format($downline->wallet3, 2) }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot class="d-none d-md-table-footer-group">
                                <tr class="table-dark">
                                    <td class="text-end fw-bold" colspan="5">Total Level-1 Downlines</td>
                                    <td class="fw-bold text-success" colspan="2">{{ $level1Count }}</td>
                                </tr>
                                <tr class="table-dark">
                                    <td class="text-end fw-bold" colspan="5">Total Downline Members</td>
                                    <td class="fw-bold text-success" colspan="2">{{ $downlineCount }}</td>
                                </tr>
                                <tr class="table-dark">
                                    <td class="text-end fw-bold" colspan="5">Total Downline Business</td>
                                    <td class="fw-bold text-success" colspan="2">
                                        ${{ number_format($totalBusinessDownline  - $user->wallet3, 2) }} + 
                                        ${{ number_format($user->wallet3, 2) }} (My Wallet Balance) = 
                                        ${{ number_format($totalBusiness - $user->wallet3, 2) }}
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    
                    <!-- Mobile footer summary -->
                    <div class="d-md-none card-footer bg-dark text-white p-3">
                        <div class="d-flex justify-content-between mb-2">
                            <span>Total Level-1 Downlines:</span>
                            <span class="fw-bold text-success">{{ $level1Count }}</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Total Downline Members:</span>
                            <span class="fw-bold text-success">{{ $downlineCount }}</span>
                        </div>
                        <div class="d-flex flex-column">
                            <span class="mb-1">Total Downline Business:</span>
                            <div class="text-success fw-bold">
                                <div>${{ number_format($totalBusinessDownline - $user->wallet3, 2) }} (Downline)</div>
                                <div>+ ${{ number_format($user->wallet3, 2) }} (My Wallet)</div>
                                <div>= ${{ number_format($totalBusiness - $user->wallet3, 2) }} (Total)</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>

<!-- Include DataTables CSS -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css">

<!-- Include jQuery and DataTables JS -->
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js"></script>

<script>
    $(document).ready(function() {
        // Initialize DataTable
        var table = $('#downlines-table').DataTable({
            "pageLength": 10,
            "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
            "order": [[0, 'asc']],
            "responsive": true,
            "searching": true,
            "paging": true,
            "info": true,
            "autoWidth": false,
            "language": {
                "search": "Filter:",
                "lengthMenu": "Show _MENU_ entries",
                "info": "Showing _START_ to _END_ of _TOTAL_ entries",
                "paginate": {
                    "first": "First",
                    "last": "Last",
                    "next": "Next",
                    "previous": "Previous"
                }
            },
            "columnDefs": [
                { "orderable": true, "targets": [0, 1, 2, 3, 4, 5, 6] }
            ]
        });
        
        // Add custom filtering function for downline groups
        $.fn.dataTable.ext.search.push(
            function(settings, data, dataIndex) {
                var selectedDownline = $('#downline-filter').val();
                if (!selectedDownline) {
                    return true; // Show all if no filter selected
                }
                
                // Extract just the downline label (e.g., "Downline 1") from the option value
                var downlineLabel = selectedDownline.split(' - ')[0];
                var rowDownline = $(table.row(dataIndex).node()).data('downline');
                return rowDownline === downlineLabel;
            }
        );
        
        // Handle filter change event
        $('#downline-filter').on('change', function() {
            table.draw();
            
            // Update the count of visible rows in the table info
            var info = table.page.info();
            $('#downlines-table_info').html(
                'Showing ' + (info.recordsDisplay) + ' entries'
            );
        });
    });
</script>

<style>
    .dataTables_wrapper .dataTables_paginate .paginate_button {
        padding: 0.5em 1em;
        margin-left: 2px;
        border: 1px solid #dee2e6;
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button.current {
        background: #0d6efd;
        color: white !important;
        border: 1px solid #0d6efd;
    }
    .dataTables_filter input {
        border: 1px solid #ced4da;
        border-radius: 0.375rem;
        padding: 0.375rem 0.75rem;
    }
    #downlines-table tfoot {
        display: table-row-group;
    }
    .card, .card-light {
        margin-bottom: 120px !important;
    }
    
    /* Make dropdown wider to accommodate the additional text */
    #downline-filter {
        min-width: 300px;
    }
    
    /* Mobile-specific styles */
    @media (max-width: 767.98px) {
        .container-fluid {
            padding-left: 10px;
            padding-right: 10px;
        }
        
        .card-body {
            padding: 0.75rem !important;
        }
        
        .downline-row {
            border-bottom: 1px solid #dee2e6;
            padding: 10px 0;
        }
        
        .downline-row:last-child {
            border-bottom: none;
        }
        
        /* Hide table borders on mobile */
        .table-responsive .table {
            border: none;
        }
        
        /* Adjust DataTables elements for mobile */
        .dataTables_wrapper .dataTables_info,
        .dataTables_wrapper .dataTables_paginate {
            text-align: center;
            margin-top: 10px;
        }
        
        .dataTables_wrapper .dataTables_paginate .paginate_button {
            padding: 0.3em 0.6em;
            font-size: 0.875rem;
        }
        
        /* Make filter dropdown full width on mobile */
        #downline-filter {
            min-width: 100%;
            width: 100% !important;
        }
    }
    
    /* Tablet and desktop adjustments */
    @media (min-width: 768px) {
        .d-md-table-header-group {
            display: table-header-group !important;
        }
        
        .d-md-table-cell {
            display: table-cell !important;
        }
        
        .d-md-table-footer-group {
            display: table-footer-group !important;
        }
    }
</style>
@endsection