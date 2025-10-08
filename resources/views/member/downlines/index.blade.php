@extends('member.layouts.app')

@section('title', 'My Downlines')

@section('content')
<div class="container">
    <div class="page-inner">
        <!-- Heading and Filter in a single row -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="mb-0">My Downline Users</h2>
            
            @if(!$downlines->isEmpty())
            <div class="d-flex align-items-center">
                <label for="downline-filter" class="form-label me-2 mb-0">Filter by:</label>
                <select id="downline-filter" class="form-select" style="width: auto;">
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
                <div class="card-body">
                    <table id="downlines-table" class="table table-striped table-bordered table-hover align-middle text-center">
                        <thead class="table-dark">
                            <tr>
                                <th style="width: 50px;">#</th>
                                <th>Username</th>
                                <th>Full Name</th>
                                <th>Email</th>
                                <th>Depth</th>
                                <th>Wallet3 ($)</th>
                                <th>Date Joined</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($downlines as $index => $downline)
                                <tr data-downline="{{ $downline->downline_name }}">
                                    <td>{{ $index + 1 }}</td>
                                    <td>
                                        <span class="me-1"
                                              style="display:inline-block; width:10px; height:10px; border-radius:50%; background-color: {{ $downline->color }};">
                                        </span>
                                        <span class="fw-bold text-primary">{{ $downline->username }}</span>
                                        <br>
                                        <small class="text-muted">{{ $downline->downline_name }}</small>
                                    </td>
                                    <td>{{ $downline->full_name }}</td>
                                    <td>{{ $downline->email }}</td>
                                    <td>
                                        <span class="badge bg-info text-white">
                                            Level {{ $downline->depth >= 15 ? 15 : $downline->depth }}
                                        </span>
                                    </td>
                                    <td class="fw-bold text-success">
                                        ${{ number_format($downline->wallet3, 2) }}
                                    </td>
                                    <td>{{ \Carbon\Carbon::parse($downline->created_at)->format('d M Y, h:i A') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
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
                                    ${{ number_format($totalBusinessDownline, 2) }} + 
                                    ${{ number_format($user->wallet3, 2) }} (My Wallet Balance) = 
                                    ${{ number_format($totalBusiness, 2) }}
                                </td>
                            </tr>
                        </tfoot>
                    </table>
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
    
    /* Responsive adjustments */
    @media (max-width: 768px) {
        .d-flex.justify-content-between.align-items-center.mb-4 {
            flex-direction: column;
            align-items: flex-start !important;
        }
        
        .d-flex.justify-content-between.align-items-center.mb-4 > * {
            margin-bottom: 10px;
        }
        
        .d-flex.align-items-center {
            width: 100%;
            justify-content: flex-end;
        }
        
        #downline-filter {
            min-width: 200px;
            width: 100% !important;
        }
    }
</style>
@endsection