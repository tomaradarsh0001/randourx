@extends('member.layouts.app')

@section('title', 'Deposit Funds')

@section('content')
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        .progress-bar {
            transition: width 0.8s ease-in-out;
        }
        .card-hover {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        .card-hover:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
        /* Responsive adjustments for 5-column grid */
        @media (min-width: 1280px) {
            .grid-cols-5 {
                grid-template-columns: repeat(5, minmax(0, 1fr));
            }
        }
    </style>
    <div class="container">
      <div class="page-inner">
        <!-- Header -->
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Salary Progress</h1>
                <p class="text-gray-600 mt-1">Track your earnings and progression milestones</p>
            </div>
         
        </div>

        <!-- Progress Levels Grid - Updated to 5 columns -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 gap-4 mb-8">
            @foreach($progress['levels'] as $level)
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-4 card-hover">
                <div class="flex justify-between items-start mb-3">
                    <div>
                        <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium 
                            @if($level['status']=='achieved') bg-green-100 text-green-800
                            @elseif($level['status']=='pending') bg-yellow-100 text-yellow-800
                            @else bg-gray-100 text-gray-800
                            @endif">
                            @if($level['status']=='achieved')
                                <i class="fas fa-check-circle mr-1"></i>
                            @elseif($level['status']=='pending')
                                <i class="fas fa-clock mr-1"></i>
                            @else
                                <i class="fas fa-lock mr-1"></i>
                            @endif
                            {{ ucfirst($level['status']) }}
                        </span>
                        <h3 class="text-md font-semibold text-gray-900 mt-2">Level {{ $level['level'] }}</h3>
                    </div>
                    <div class="bg-blue-50 w-8 h-8 rounded-lg flex items-center justify-center">
                        <i class="fas fa-chart-line text-blue-500 text-sm"></i>
                    </div>
                </div>
                
                <div class="mb-2">
                    <div class="flex justify-between text-xs text-gray-600 mb-1">
                        <span>Progress</span>
                        <span>{{ $level['percent'] }}%</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2 overflow-hidden">
                        <div class="h-2 rounded-full progress-bar
                            @if($level['status']=='achieved') bg-green-500
                            @elseif($level['status']=='pending') bg-yellow-500
                            @else bg-gray-300
                            @endif"
                            style="width: {{ $level['percent'] }}%">
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Next Target Card -->
        <div class="bg-gradient-to-r from-blue-500 to-blue-600 rounded-xl shadow-lg p-4 text-white mb-6">
    <div class="flex justify-between items-start">
        <div class="flex-1">
            <h2 class="text-lg font-bold mb-1">Next Target</h2>
            <p class="text-blue-100 text-sm mb-3">You're making great progress! Keep it up to reach your next milestone.</p>
            <div class="bg-blue-400 bg-opacity-30 inline-flex items-center px-3 py-1 rounded-md">
                <i class="fas fa-bullseye mr-1 text-sm"></i>
                <span class="font-semibold text-sm">{{ $progress['nextTarget'] }}</span>
            </div>
        </div>
        <div class="bg-white bg-opacity-20 p-2 rounded-full ml-4">
            <i class="fas fa-trophy text-lg"></i>
        </div>
    </div>
    
    <div class="grid grid-cols-2 md:grid-cols-5 gap-3 mt-4">
        <div class="text-center">
            <p class="text-blue-200 text-xs">Total Business</p>
            <p class="font-bold text-md">{{ $progress['totalBusiness'] }}</p>
        </div>
        <div class="text-center">
            <p class="text-blue-200 text-xs">Days Elapsed</p>
            <p class="font-bold text-md">{{ $progress['daysElapsed'] }}</p>
        </div>
        <div class="text-center">
            <p class="text-blue-200 text-xs">30-Day Window</p>
            <p class="font-bold text-md">{{ $progress['daysLeft30'] }} days left</p>
        </div>
        <div class="text-center">
            <p class="text-blue-200 text-xs">60-Day Window</p>
            <p class="font-bold text-md">{{ $progress['daysLeft60'] }} days left</p>
        </div>
        <div class="text-center">
            <p class="text-blue-200 text-xs">90-Day Window</p>
            <p class="font-bold text-md">{{ $progress['daysLeft90'] }} days left</p>
        </div>
    </div>
</div>

        <!-- Salary Records -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden mb-8">
            <div class="px-6 py-4 border-b border-gray-100">
                <div class="flex justify-between items-center">
                    <h2 class="text-xl font-semibold text-gray-900">Salary Records</h2>
                </div>
            </div>
            
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Amount</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Threshold</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Percentage</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Eligible At</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Description</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($salaryIncomes as $income)
                        <tr class="hover:bg-gray-50 transition-colors duration-150">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">${{ number_format($income->amount, 2) }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">${{ number_format($income->threshold, 2) }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $income->percentage }}%</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                    @if($income->status=='paid') bg-green-100 text-green-800
                                    @elseif($income->status=='pending') bg-yellow-100 text-yellow-800
                                    @else bg-gray-100 text-gray-800
                                    @endif">
                                    @if($income->status=='paid')
                                        <i class="fas fa-check-circle mr-1"></i>
                                    @elseif($income->status=='pending')
                                        <i class="fas fa-clock mr-1"></i>
                                    @else
                                        <i class="fas fa-times-circle mr-1"></i>
                                    @endif
                                    {{ ucfirst($income->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                {{ $income->eligible_at->format('d M Y') }}
                            </td>
                           <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            @if($income->status == 'paid')
                                <span class="text-green-600 font-semibold">
                                    <i class="fas fa-check-circle mr-1"></i>
                                    Salary Income Received
                                </span>
                            @elseif($income->status == 'pending')
                                <span class="text-yellow-600 font-semibold">
                                    <i class="fas fa-clock mr-1"></i>
                                    Your Direct User is pending to Join
                                </span>
                            @else
                                <span class="text-gray-600 font-semibold">
                                    <i class="fas fa-times-circle mr-1"></i>
                                    Not Eligible
                                </span>
                            @endif
                        </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <div class="px-6 py-4 border-t border-gray-200 bg-gray-50">
                {{ $salaryIncomes->links() }}
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
    </script>
@endsection