@extends('member.layouts.app')

@section('title', 'My Downlines')

@section('content')
<div class="container">
    <div class="page-inner mb-5">
        <!-- Heading and Filter in a single row -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="mb-0">My Downline Users</h2>
            
            
        </div>
        
        <div class="balance-card mb-4">
            <div class="d-flex justify-content-between align-items-center">
                <span class="balance-label">Your Balance</span>
                <span class="balance-amount">${{ number_format($user->wallet3, 2) }}</span>
            </div>
            <div class="balance-progress">
                <div class="progress-bar" style="width: 100%"></div>
            </div>
        </div>
        
        @if($downlines->isEmpty())
            <div class="empty-state">
                <div class="empty-icon">📊</div>
                <h3>No Downline Users Yet</h3>
                <p>Start building your network to see downline users here</p>
            </div>
        @else
            <!-- Desktop Table View -->
            <div class="card shadow-sm rounded-3 d-none d-md-block">
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
                        <tfoot id="downlines-tfoot" style="display: table-row-group;">
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
                                    ${{ number_format($totalBusinessDownline, 2) }}
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>

            <!-- Mobile Card View -->
            <div class="d-block d-md-none">
                <!-- Quick Stats -->
                <div class="quick-stats mb-4">
                    <div class="stats-grid">
                        <div class="stat-item">
                            <div class="stat-icon">👥</div>
                            <div class="stat-content">
                                <div class="stat-value">{{ $level1Count }}</div>
                                <div class="stat-label">Downline Count</div>
                            </div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-icon">📈</div>
                            <div class="stat-content">
                                <div class="stat-value">{{ $downlineCount }}</div>
                                <div class="stat-label">Total</div>
                            </div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-icon">💰</div>
                            <div class="stat-content">
                                <div class="stat-value">${{ number_format($totalBusinessDownline, 2) }}</div>
                                <div class="stat-label">Business</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Filter for Mobile -->
                <div class="filter-card card mb-4">
                    <div class="card-body">
                        <div class="filter-header">
                            <i class="filter-icon">🔍</i>
                            <span class="filter-title">Filter Downlines</span>
                        </div>
                        <select id="mobile-downline-filter" class="form-select filter-select">
                            <option value="">All Downlines</option>
                            @foreach($level1Groups as $id => $group)
                                <option value="{{ $group['label'] }}">
                                    {{ $group['label'] }} - {{ $group['username'] }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Results Counter -->
                <div class="results-counter mb-3">
                    <span id="mobile-results-count" class="badge bg-primary">{{ count($downlines) }}</span>
                    <span class="results-text">downline users</span>
                </div>

                <!-- Downline Cards -->
                <div id="mobile-downlines-container">
                    @foreach($downlines as $index => $downline)
                    <div class="downline-card card mb-3" data-downline="{{ $downline->downline_name }}">
                        <div class="card-header">
                            <div class="user-header">
                                <div class="user-avatar">
                                    <div class="avatar-circle" style="background-color: {{ $downline->color }};"></div>
                                    <div class="user-badge">
                                        <span class="badge-level">L{{ $downline->depth >= 15 ? 15 : $downline->depth }}</span>
                                    </div>
                                </div>
                                <div class="user-info">
                                    <h5 class="username">{{ $downline->username }}</h5>
                                    <p class="user-downline">{{ $downline->downline_name }}</p>
                                </div>
                                <div class="user-actions">
                                    <button class="btn-more">⋯</button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="info-grid">
                                <div class="info-item">
                                    <div class="info-icon">👤</div>
                                    <div class="info-content">
                                        <div class="info-label">Full Name</div>
                                        <div class="info-value">{{ $downline->full_name }}</div>
                                    </div>
                                </div>
                                <div class="info-item">
                                    <div class="info-icon">📧</div>
                                    <div class="info-content">
                                        <div class="info-label">Email</div>
                                        <div class="info-value email-value">{{ $downline->email }}</div>
                                    </div>
                                </div>
                                <div class="info-item">
                                    <div class="info-icon">💳</div>
                                    <div class="info-content">
                                        <div class="info-label">Wallet Balance</div>
                                        <div class="info-value wallet-value">${{ number_format($downline->wallet3, 2) }}</div>
                                    </div>
                                </div>
                                <div class="info-item">
                                    <div class="info-icon">📅</div>
                                    <div class="info-content">
                                        <div class="info-label">Joined</div>
                                        <div class="info-value">{{ \Carbon\Carbon::parse($downline->created_at)->format('d M Y') }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="footer-content">
                                <span class="member-id">#{{ $index + 1 }}</span>
                                <span class="join-time">{{ \Carbon\Carbon::parse($downline->created_at)->format('h:i A') }}</span>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- Load More Button -->
                <!--<div class="load-more-container mt-4">-->
                <!--    <button class="btn btn-outline-primary btn-load-more" id="mobile-load-more">-->
                <!--        <span class="load-text">Load More</span>-->
                <!--        <span class="spinner spinner-border spinner-border-sm d-none"></span>-->
                <!--    </button>-->
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
        // Initialize DataTable for desktop
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
            ],
            "drawCallback": function(settings) {
                // Show/hide footer based on filter selection
                var selectedDownline = $('#downline-filter').val();
                if (!selectedDownline) {
                    $('#downlines-tfoot').show();
                } else {
                    $('#downlines-tfoot').hide();
                }
            }
        });
        
        // Add custom filtering function for downline groups (Desktop)
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
        
        // Handle filter change event (Desktop)
        $('#downline-filter').on('change', function() {
            table.draw();
            
            // Update the count of visible rows in the table info
            var info = table.page.info();
            $('#downlines-table_info').html(
                'Showing ' + (info.recordsDisplay) + ' entries'
            );
        });
        
        // Mobile Filter Functionality
        $('#mobile-downline-filter').on('change', function() {
            var selectedDownline = $(this).val();
            var visibleCount = 0;
            
            if (!selectedDownline) {
                // Show all cards with animation
                $('.downline-card').each(function(index) {
                    $(this).delay(index * 50).fadeIn(300);
                    visibleCount++;
                });
            } else {
                // Extract just the downline label
                var downlineLabel = selectedDownline.split(' - ')[0];
                
                // Hide/show cards based on filter with animation
                $('.downline-card').each(function(index) {
                    var cardDownline = $(this).data('downline');
                    if (cardDownline === downlineLabel) {
                        $(this).delay(index * 50).fadeIn(300);
                        visibleCount++;
                    } else {
                        $(this).fadeOut(200);
                    }
                });
            }
            
            // Update results counter
            $('#mobile-results-count').text(visibleCount);
        });
        
        // Simulate load more functionality
        $('#mobile-load-more').on('click', function() {
            var $btn = $(this);
            var $spinner = $btn.find('.spinner');
            var $loadText = $btn.find('.load-text');
            
            $btn.prop('disabled', true);
            $loadText.text('Loading...');
            $spinner.removeClass('d-none');
            
            // Simulate API call
            setTimeout(function() {
                $btn.prop('disabled', false);
                $loadText.text('Load More');
                $spinner.addClass('d-none');
                
                // Show toast notification
                showToast('More downlines loaded successfully!', 'success');
            }, 1500);
        });
        
        // Card click animation
        $('.downline-card').on('click', function() {
            $(this).addClass('card-active');
            setTimeout(() => {
                $(this).removeClass('card-active');
            }, 300);
        });
        
        // Toast notification function
        function showToast(message, type) {
            const toast = $(`
                <div class="mobile-toast toast-${type}">
                    <div class="toast-content">
                        <span class="toast-message">${message}</span>
                    </div>
                </div>
            `);
            
            $('body').append(toast);
            
            toast.fadeIn(300);
            setTimeout(() => {
                toast.fadeOut(300, function() {
                    $(this).remove();
                });
            }, 3000);
        }
    });
</script>

<style>
    /* Base Styles */
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
    
    /* Balance Card */
    .balance-card {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 1.25rem;
        border-radius: 16px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.1);
        margin-bottom: 1.5rem;
    }
    
    .balance-label {
        font-size: 0.9rem;
        opacity: 0.9;
    }
    
    .balance-amount {
        font-size: 1.5rem;
        font-weight: 700;
    }
    
    .balance-progress {
        margin-top: 0.75rem;
        height: 6px;
        background: rgba(255,255,255,0.3);
        border-radius: 3px;
        overflow: hidden;
    }
    
    .progress-bar {
        height: 100%;
        background: rgba(255,255,255,0.8);
        border-radius: 3px;
        transition: width 0.8s ease;
    }
    
    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 3rem 1rem;
    }
    
    .empty-icon {
        font-size: 4rem;
        margin-bottom: 1rem;
        opacity: 0.7;
    }
    
    .empty-state h3 {
        color: #6c757d;
        margin-bottom: 0.5rem;
    }
    
    .empty-state p {
        color: #868e96;
    }
    
    /* Quick Stats */
    .quick-stats {
        margin-bottom: 1.5rem;
    }
    
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 0.75rem;
    }
    
    .stat-item {
        background: white;
        padding: 1rem;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        display: flex;
        align-items: center;
        gap: 0.75rem;
        transition: transform 0.2s ease;
    }
    
    .stat-item:hover {
        transform: translateY(-2px);
    }
    
    .stat-icon {
        font-size: 1.5rem;
        opacity: 0.8;
    }
    
    .stat-value {
        font-size: 1.25rem;
        font-weight: 700;
        color: #2c3e50;
    }
    
    .stat-label {
        font-size: 0.75rem;
        color: #6c757d;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    
    /* Filter Card */
    .filter-card {
        border: none;
        border-radius: 16px;
        box-shadow: 0 2px 12px rgba(0,0,0,0.08);
    }
    
    .filter-header {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        margin-bottom: 0.75rem;
    }
    
    .filter-icon {
        font-size: 1.1rem;
    }
    
    .filter-title {
        font-weight: 600;
        color: #2c3e50;
    }
    
    .filter-select {
        border-radius: 12px;
        border: 1.5px solid #e9ecef;
        padding: 0.75rem;
    }
    
    /* Results Counter */
    .results-counter {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0 0.5rem;
    }
    
    .results-text {
        font-size: 0.9rem;
        color: #6c757d;
    }
    
    /* Downline Cards */
    .downline-card {
        border: none;
        border-radius: 16px;
        box-shadow: 0 2px 12px rgba(0,0,0,0.08);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        overflow: hidden;
    }
    
    .downline-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.15);
    }
    
    .downline-card.card-active {
        transform: scale(0.98);
    }
    
    .card-header {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        border-bottom: 1px solid rgba(0,0,0,0.05);
        padding: 1.25rem;
    }
    
    .user-header {
        display: flex;
        align-items: center;
        gap: 1rem;
    }
    
    .user-avatar {
        position: relative;
    }
    
    .avatar-circle {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: 600;
        box-shadow: 0 2px 8px rgba(0,0,0,0.15);
    }
    
    .user-badge {
        position: absolute;
        bottom: -2px;
        right: -2px;
    }
    
    .badge-level {
        background: #007bff;
        color: white;
        padding: 2px 6px;
        border-radius: 8px;
        font-size: 0.7rem;
        font-weight: 600;
    }
    
    .user-info {
        flex: 1;
    }
    
    .username {
        font-size: 1.1rem;
        font-weight: 700;
        color: #2c3e50;
        margin: 0;
    }
    
    .user-downline {
        font-size: 0.85rem;
        color: #6c757d;
        margin: 0;
    }
    
    .user-actions .btn-more {
        background: none;
        border: none;
        font-size: 1.2rem;
        color: #6c757d;
        cursor: pointer;
        padding: 0.25rem;
        border-radius: 6px;
        transition: background 0.2s ease;
    }
    
    .user-actions .btn-more:hover {
        background: rgba(0,0,0,0.05);
    }
    
    .card-body {
        padding: 1.25rem;
    }
    
    .info-grid {
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }
    
    .info-item {
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }
    
    .info-icon {
        font-size: 1rem;
        opacity: 0.7;
        min-width: 20px;
    }
    
    .info-content {
        flex: 1;
    }
    
    .info-label {
        font-size: 0.8rem;
        color: #6c757d;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 0.25rem;
    }
    
    .info-value {
        font-size: 0.95rem;
        font-weight: 600;
        color: #2c3e50;
    }
    
    .wallet-value {
        color: #28a745;
        font-weight: 700;
    }
    
    .email-value {
        word-break: break-all;
    }
    
    .card-footer {
        background: rgba(0,0,0,0.02);
        border-top: 1px solid rgba(0,0,0,0.05);
        padding: 0.75rem 1.25rem;
    }
    
    .footer-content {
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-size: 0.8rem;
        color: #6c757d;
    }
    
    /* Load More Button */
    .load-more-container {
        text-align: center;
    }
    
    .btn-load-more {
        border-radius: 25px;
        padding: 0.75rem 2rem;
        border: 2px solid #007bff;
        font-weight: 600;
        transition: all 0.3s ease;
    }
    
    .btn-load-more:hover {
        background: #007bff;
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0,123,255,0.3);
    }
    
    /* Toast Notifications */
    .mobile-toast {
        position: fixed;
        bottom: 20px;
        left: 50%;
        transform: translateX(-50%);
        background: white;
        padding: 1rem 1.5rem;
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.15);
        z-index: 1050;
        max-width: 90%;
        display: none;
    }
    
    .toast-success {
        border-left: 4px solid #28a745;
    }
    
    .toast-content {
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    
    .toast-message {
        font-weight: 500;
        color: #2c3e50;
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
        
        /* Mobile-specific improvements */
        .container {
            padding-left: 1rem;
            padding-right: 1rem;
        }
        
        .stats-grid {
            gap: 0.5rem;
        }
        
        .stat-item {
            padding: 0.75rem;
        }
        
        .stat-icon {
            font-size: 1.25rem;
        }
        
        .stat-value {
            font-size: 1.1rem;
        }
    }
    
    /* Extra small devices */
    @media (max-width: 576px) {
        .d-flex.align-items-center {
            flex-direction: column;
            align-items: flex-start !important;
        }
        
        #downline-filter {
            margin-top: 5px;
        }
        
        .user-header {
            gap: 0.75rem;
        }
        
        .avatar-circle {
            width: 45px;
            height: 45px;
        }
        
        .username {
            font-size: 1rem;
        }
        
        .info-item {
            gap: 0.5rem;
        }
        
        .stats-grid {
            grid-template-columns: 1fr;
            gap: 0.5rem;
        }
    }
    
    /* Animation keyframes */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    .downline-card {
        animation: fadeInUp 0.5s ease-out;
    }
</style>
@endsection