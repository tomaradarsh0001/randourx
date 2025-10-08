@extends('member.layouts.app')

@section('title', 'Salary Progress')

@section('content')
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .salary-progress-container {
            font-family: 'Inter', sans-serif;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 12px;
        }
        .page-inner {
            padding: 16px 0;
        }
        .page-header {
            margin-bottom: 24px;
        }
        .page-title {
            font-size: 24px;
            font-weight: 700;
            color: #111827;
            margin: 0;
        }
        .page-subtitle {
            color: #6b7280;
            margin-top: 4px;
            font-size: 14px;
        }
        
        /* Progress Grid - No Scroll */
        .progress-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 12px;
            margin-bottom: 24px;
        }
        
        .progress-card {
            background: white;
            border-radius: 12px;
            border: 1px solid #f3f4f6;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1);
            padding: 12px;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            height: 100%;
        }
        .progress-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 8px;
        }
        .card-title {
            font-size: 14px;
            font-weight: 600;
            color: #111827;
            margin-top: 8px;
        }
        .status-badge {
            display: inline-flex;
            align-items: center;
            padding: 4px 8px;
            border-radius: 9999px;
            font-size: 12px;
            font-weight: 500;
        }
        .status-achieved {
            background-color: #dcfce7;
            color: #166534;
        }
        .status-pending {
            background-color: #fef3c7;
            color: #92400e;
        }
        .status-locked {
            background-color: #f3f4f6;
            color: #374151;
        }
        .icon-container {
            background-color: #dbeafe;
            width: 28px;
            height: 28px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            margin-left: 8px;
        }
        .icon-container i {
            color: #3b82f6;
            font-size: 12px;
        }
        .progress-info {
            margin-bottom: 8px;
        }
        .progress-labels {
            display: flex;
            justify-content: space-between;
            font-size: 12px;
            color: #6b7280;
            margin-bottom: 4px;
        }
        .progress-bar-container {
            width: 100%;
            background-color: #e5e7eb;
            border-radius: 9999px;
            height: 8px;
            overflow: hidden;
        }
        .progress-bar {
            height: 8px;
            border-radius: 9999px;
            transition: width 0.8s ease-in-out;
        }
        .progress-achieved { background-color: #10b981; }
        .progress-pending { background-color: #f59e0b; }
        .progress-locked { background-color: #d1d5db; }
        
        /* Next Target Card */
        .next-target-card {
            background: linear-gradient(to right, #3b82f6, #2563eb);
            border-radius: 12px;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
            padding: 12px;
            color: white;
            margin-bottom: 16px;
        }
        .target-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 12px;
        }
        .target-title {
            font-size: 18px;
            font-weight: 700;
            margin-bottom: 4px;
        }
        .target-subtitle {
            color: #bfdbfe;
            font-size: 12px;
            margin-bottom: 8px;
        }
        .target-badge {
            background-color: rgba(255, 255, 255, 0.2);
            display: inline-flex;
            align-items: center;
            padding: 4px 8px;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 600;
        }
        .target-icon {
            background-color: rgba(255, 255, 255, 0.2);
            padding: 8px;
            border-radius: 9999px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .target-stats {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 8px;
            margin-top: 12px;
        }
        .stat-item {
            text-align: center;
        }
        .stat-label {
            font-size: 12px;
            color: #bfdbfe;
        }
        .stat-value {
            font-size: 14px;
            font-weight: 700;
        }
        
        /* Salary Records Table */
        .salary-records {
            background: white;
            border-radius: 12px;
            border: 1px solid #f3f4f6;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1);
            overflow: hidden;
            margin-bottom: 24px;
        }
        .table-header {
            padding: 12px 16px;
            border-bottom: 1px solid #f3f4f6;
        }
        .table-title {
            font-size: 18px;
            font-weight: 600;
            color: #111827;
        }
        .table-container {
            overflow-x: auto;
        }
        .data-table {
            width: 100%;
            border-collapse: collapse;
        }
        .data-table th {
            background-color: #f9fafb;
            padding: 8px 12px;
            text-align: left;
            font-size: 12px;
            font-weight: 500;
            color: #6b7280;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            border-bottom: 1px solid #e5e7eb;
        }
        .data-table td {
            padding: 12px;
            font-size: 14px;
            color: #111827;
            border-bottom: 1px solid #e5e7eb;
        }
        .data-table tr:hover {
            background-color: #f9fafb;
        }
        .status-paid { background-color: #dcfce7; color: #166534; }
        .status-pending-table { background-color: #fef3c7; color: #92400e; }
        .status-not-eligible { background-color: #f3f4f6; color: #374151; }
        
        .table-footer {
            padding: 12px 16px;
            border-top: 1px solid #e5e7eb;
            background-color: #f9fafb;
        }

        /* Mobile Card View for Salary Records */
        .mobile-salary-cards {
            display: none;
        }
        .salary-card {
            background: white;
            border-radius: 12px;
            border: 1px solid #f3f4f6;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1);
            padding: 16px;
            margin-bottom: 12px;
        }
        .salary-card-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 12px;
        }
        .salary-amount {
            font-size: 18px;
            font-weight: 700;
            color: #111827;
        }
        .salary-details {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }
        .detail-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 4px 0;
        }
        .detail-label {
            font-size: 12px;
            color: #6b7280;
            font-weight: 500;
        }
        .detail-value {
            font-size: 14px;
            color: #111827;
            font-weight: 600;
        }
        .salary-description {
            margin-top: 12px;
            padding-top: 12px;
            border-top: 1px solid #f3f4f6;
        }
        .desc-text {
            font-size: 14px;
            color: #374151;
            line-height: 1.4;
        }

        /* Responsive Design */
        @media (min-width: 640px) {
            .salary-progress-container {
                padding: 0 16px;
            }
            .page-inner {
                padding: 20px 0;
            }
            .page-header {
                margin-bottom: 32px;
            }
            .page-title {
                font-size: 30px;
            }
            .progress-grid {
                gap: 16px;
                margin-bottom: 32px;
                grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            }
            .progress-card {
                padding: 16px;
            }
            .next-target-card {
                padding: 16px;
                margin-bottom: 24px;
            }
            .target-stats {
                grid-template-columns: repeat(5, 1fr);
                gap: 12px;
            }
            .table-header {
                padding: 16px 24px;
            }
            .data-table th,
            .data-table td {
                padding: 12px 24px;
            }
            .table-footer {
                padding: 12px 24px;
            }
        }
        
        @media (min-width: 768px) {
            .page-title {
                font-size: 32px;
            }
            .progress-grid {
                grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            }
            .mobile-salary-cards {
                display: none !important;
            }
            .table-container {
                display: block !important;
            }
        }
        
        @media (min-width: 1024px) {
            .progress-grid {
                margin-bottom: 40px;
            }
            .next-target-card {
                margin-bottom: 32px;
            }
            .salary-records {
                margin-bottom: 32px;
            }
        }
        
        @media (max-width: 767px) {
            .table-container {
                display: none;
            }
            .mobile-salary-cards {
                display: block;
                padding: 16px;
            }
            .target-stats {
                grid-template-columns: repeat(2, 1fr);
            }
            .data-table {
                min-width: 800px;
            }
        }
        
        /* Special layout for exactly 5 items */
        @media (min-width: 1280px) {
            .progress-grid-5 {
                grid-template-columns: repeat(5, 1fr);
            }
        }
        
        @media (min-width: 1024px) and (max-width: 1279px) {
            .progress-grid-5 {
                grid-template-columns: repeat(4, 1fr);
            }
        }
        
        @media (min-width: 768px) and (max-width: 1023px) {
            .progress-grid-5 {
                grid-template-columns: repeat(3, 1fr);
            }
        }
        
        @media (min-width: 640px) and (max-width: 767px) {
            .progress-grid-5 {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 639px) {
            .progress-grid-5 {
                grid-template-columns: 1fr;
            }
            .page-title {
                font-size: 22px;
            }
            .target-title {
                font-size: 16px;
            }
            .target-stats {
                grid-template-columns: repeat(2, 1fr);
            }
            .stat-value {
                font-size: 12px;
            }
        }

        /* Pagination Styling for Mobile */
        .custom-pagination-mobile .pagination {
            margin-bottom: 0;
            flex-wrap: wrap;
            justify-content: center;
        }
        
        .custom-pagination-mobile .page-link {
            padding: 0.4rem 0.6rem;
            font-size: 0.8rem;
            border-radius: 4px;
            margin: 1px;
        }
    </style>

    <div class="salary-progress-container">
        <div class="page-inner" >
            <!-- Header -->
            <div class="page-header">
                <h1 class="page-title">Salary Progress</h1>
                <p class="page-subtitle">Track your earnings and progression milestones</p>
            </div>

            <!-- Progress Levels Grid - Responsive without scroll -->
            <div class="progress-grid progress-grid-5">
                @foreach($progress['levels'] as $level)
                <div class="progress-card">
                    <div class="card-header">
                        <div style="flex: 1; min-width: 0;">
                            <span class="status-badge 
                                @if($level['status']=='achieved') status-achieved
                                @elseif($level['status']=='pending') status-pending
                                @else status-locked
                                @endif">
                                @if($level['status']=='achieved')
                                    <i class="fas fa-check-circle" style="margin-right: 4px;"></i>
                                @elseif($level['status']=='pending')
                                    <i class="fas fa-clock" style="margin-right: 4px;"></i>
                                @else
                                    <i class="fas fa-lock" style="margin-right: 4px;"></i>
                                @endif
                                {{ ucfirst($level['status']) }}
                            </span>
                            <h3 class="card-title">Level {{ $level['level'] }}</h3>
                        </div>
                        <div class="icon-container">
                            <i class="fas fa-chart-line"></i>
                        </div>
                    </div>
                    
                    <div class="progress-info">
                        <div class="progress-labels">
                            <span>Progress</span>
                            <span>{{ $level['percent'] }}%</span>
                        </div>
                        <div class="progress-bar-container">
                            <div class="progress-bar 
                                @if($level['status']=='achieved') progress-achieved
                                @elseif($level['status']=='pending') progress-pending
                                @else progress-locked
                                @endif"
                                style="width: {{ $level['percent'] }}%">
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Next Target Card -->
            <div class="next-target-card">
                <div class="target-header">
                    <div style="flex: 1; min-width: 0; margin-right: 8px;">
                        <h2 class="target-title">Next Target</h2>
                        <p class="target-subtitle">You're making great progress! Keep it up to reach your next milestone.</p>
                        <div class="target-badge">
                            <i class="fas fa-bullseye" style="margin-right: 4px; font-size: 10px;"></i>
                            <span style="font-weight: 600; font-size: 12px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">{{ $progress['nextTarget'] }}</span>
                        </div>
                    </div>
                    <div class="target-icon">
                        <i class="fas fa-trophy"></i>
                    </div>
                </div>
                
                <div class="target-stats">
                    <div class="stat-item">
                        <p class="stat-label">Total Business</p>
                        <p class="stat-value">{{ $progress['totalBusiness'] }}</p>
                    </div>
                    <div class="stat-item">
                        <p class="stat-label">Days Elapsed</p>
                        <p class="stat-value">{{ $progress['daysElapsed'] }}</p>
                    </div>
                    <div class="stat-item">
                        <p class="stat-label">30-Day Window</p>
                        <p class="stat-value">{{ $progress['daysLeft30'] }} days left</p>
                    </div>
                    <div class="stat-item">
                        <p class="stat-label">60-Day Window</p>
                        <p class="stat-value">{{ $progress['daysLeft60'] }} days left</p>
                    </div>
                    <div class="stat-item">
                        <p class="stat-label">90-Day Window</p>
                        <p class="stat-value">{{ $progress['daysLeft90'] }} days left</p>
                    </div>
                </div>
            </div>

            <!-- Salary Records - Desktop Table -->
            <div class="salary-records" style="margin-bottom: 65px !important;">
                <div class="table-header">
                    <h2 class="table-title">Salary Records</h2>
                </div>
                
                <div class="table-container">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>Amount</th>
                                <th>Threshold</th>
                                <th>Percentage</th>
                                <th>Status</th>
                                <th>Eligible At</th>
                                <th>Description</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($salaryIncomes as $income)
                            <tr>
                                <td>${{ number_format($income->amount, 2) }}</td>
                                <td>${{ number_format($income->threshold, 2) }}</td>
                                <td>{{ $income->percentage }}%</td>
                                <td>
                                    <span class="status-badge 
                                        @if($income->status=='paid') status-paid
                                        @elseif($income->status=='pending') status-pending-table
                                        @else status-not-eligible
                                        @endif" style="font-size: 11px;">
                                        @if($income->status=='paid')
                                            <i class="fas fa-check-circle" style="margin-right: 4px;"></i>
                                        @elseif($income->status=='pending')
                                            <i class="fas fa-clock" style="margin-right: 4px;"></i>
                                        @else
                                            <i class="fas fa-times-circle" style="margin-right: 4px;"></i>
                                        @endif
                                        {{ ucfirst($income->status) }}
                                    </span>
                                </td>
                                <td>{{ $income->eligible_at->format('d M Y') }}</td>
                                <td>
                                    @if($income->status == 'paid')
                                        <span style="color: #166534; font-weight: 600;">
                                            <i class="fas fa-check-circle" style="margin-right: 4px;"></i>
                                            Salary Income Received
                                        </span>
                                    @elseif($income->status == 'pending')
                                        <span style="color: #92400e; font-weight: 600;">
                                            <i class="fas fa-clock" style="margin-right: 4px;"></i>
                                            Your Direct User is pending to Join
                                        </span>
                                    @else
                                        <span style="color: #374151; font-weight: 600;">
                                            <i class="fas fa-times-circle" style="margin-right: 4px;"></i>
                                            Not Eligible
                                        </span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                <div class="table-footer">
                    <div class="custom-pagination-mobile">
                        {{ $salaryIncomes->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>

            <!-- Salary Records - Mobile Cards -->
            <div class="mobile-salary-cards"  style="margin-bottom: 65px !important;">
                <div class="table-header">
                    <h2 class="table-title">Salary Records</h2>
                </div>
                
                <div class="mobile-cards-container">
                    @foreach($salaryIncomes as $income)
                    <div class="salary-card">
                        <div class="salary-card-header">
                            <div class="salary-amount">
                                ${{ number_format($income->amount, 2) }}
                            </div>
                            <span class="status-badge 
                                @if($income->status=='paid') status-paid
                                @elseif($income->status=='pending') status-pending-table
                                @else status-not-eligible
                                @endif" style="font-size: 11px;">
                                @if($income->status=='paid')
                                    <i class="fas fa-check-circle" style="margin-right: 4px;"></i>
                                @elseif($income->status=='pending')
                                    <i class="fas fa-clock" style="margin-right: 4px;"></i>
                                @else
                                    <i class="fas fa-times-circle" style="margin-right: 4px;"></i>
                                @endif
                                {{ ucfirst($income->status) }}
                            </span>
                        </div>
                        
                        <div class="salary-details">
                            <div class="detail-row">
                                <span class="detail-label">Threshold:</span>
                                <span class="detail-value">${{ number_format($income->threshold, 2) }}</span>
                            </div>
                            <div class="detail-row">
                                <span class="detail-label">Percentage:</span>
                                <span class="detail-value">{{ $income->percentage }}%</span>
                            </div>
                            <div class="detail-row">
                                <span class="detail-label">Eligible At:</span>
                                <span class="detail-value">{{ $income->eligible_at->format('d M Y') }}</span>
                            </div>
                        </div>
                        
                        <div class="salary-description">
                            <p class="desc-text">
                                @if($income->status == 'paid')
                                    <i class="fas fa-check-circle" style="color: #166534; margin-right: 6px;"></i>
                                    Salary Income Received
                                @elseif($income->status == 'pending')
                                    <i class="fas fa-clock" style="color: #92400e; margin-right: 6px;"></i>
                                    Your Direct User is pending to Join
                                @else
                                    <i class="fas fa-times-circle" style="color: #374151; margin-right: 6px;"></i>
                                    Not Eligible
                                @endif
                            </p>
                        </div>
                    </div>
                    @endforeach
                </div>
                
                <div class="table-footer">
                    <div class="custom-pagination-mobile">
                        {{ $salaryIncomes->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Simple animation for progress bars on page load
        document.addEventListener('DOMContentLoaded', function() {
            const progressBars = document.querySelectorAll('.progress-bar');
            progressBars.forEach(bar => {
                const width = bar.style.width;
                bar.style.width = '0';
                setTimeout(() => {
                    bar.style.width = width;
                }, 300);
            });
        });

        // Mobile card click feedback
        document.querySelectorAll('.salary-card').forEach(card => {
            card.addEventListener('click', function() {
                this.style.backgroundColor = '#f8f9fa';
                setTimeout(() => {
                    this.style.backgroundColor = '';
                }, 200);
            });
        });
    </script>
@endsection