@extends('member.layouts.appadmin')

@section('title', 'My Downlines')

@section('content')
<div class="container">
    <div class="page-inner justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>{{ auth()->user()->isAdmin() ? 'All Tickets' : 'My Tickets' }}</span>
                    @if(!auth()->user()->isAdmin())
                        <a href="{{ route('tickets.create') }}" class="btn btn-primary">Create New Ticket</a>
                    @endif
                </div>

                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Title</th>
                                    @if(auth()->user()->isAdmin())
                                        <th>User</th>
                                    @endif
                                    <th>Status</th>
                                    <th>Created At</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($tickets as $ticket)
                                    <tr>
                                        <td>#{{ $ticket->id }}</td>
                                        <td>{{ Str::limit($ticket->title, 50) }}</td>
                                        @if(auth()->user()->isAdmin())
                                            <td>{{ $ticket->user->name }}</td>
                                        @endif
                                        <td>
                                            <span class="badge badge-{{ $ticket->status === 'pending' ? 'warning' : 'success' }}">
                                                {{ ucfirst($ticket->status) }}
                                            </span>
                                        </td>
                                        <td>{{ $ticket->created_at->format('M d, Y H:i') }}</td>
                                        <td>
                                            <a href="{{ route('tickets.show', $ticket) }}" class="btn btn-sm btn-info">View</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="{{ auth()->user()->isAdmin() ? '6' : '5' }}" class="text-center">No tickets found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
