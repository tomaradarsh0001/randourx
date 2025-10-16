@extends('member.layouts.app')

@section('title', 'My Downlines')

@section('content')
<div class="container">
    <div class="page-inner justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>Ticket #{{ $ticket->id }}</span>
                    <span class="badge badge-{{ $ticket->status === 'pending' ? 'warning' : 'success' }}">
                        {{ ucfirst($ticket->status) }}
                    </span>
                </div>

                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <div class="mb-4">
                        <h5>{{ $ticket->title }}</h5>
                        <p class="text-muted">Created by: {{ $ticket->user->name }} on {{ $ticket->created_at->format('M d, Y H:i') }}</p>
                    </div>

                    <div class="mb-4">
                        <h6>Description:</h6>
                        <p>{{ $ticket->description }}</p>
                    </div>

                    @if($ticket->isResolved())
                        <div class="alert alert-success">
                            <h6>Admin Response:</h6>
                            <p>{{ $ticket->admin_response }}</p>
                            <small class="text-muted">
                                Resolved by: {{ $ticket->admin->name ?? 'Admin' }} 
                                on {{ $ticket->resolved_at->format('M d, Y H:i') }}
                            </small>
                        </div>
                    @endif

                    @if(auth()->user()->isAdmin() && $ticket->isPending())
                        <hr>
                        <form method="POST" action="{{ route('tickets.resolve', $ticket) }}">
                            @csrf
                            <div class="form-group">
                                <label for="admin_response">Response</label>
                                <textarea class="form-control @error('admin_response') is-invalid @enderror" 
                                          id="admin_response" name="admin_response" rows="4" required 
                                          placeholder="Enter your response to resolve this ticket...">{{ old('admin_response') }}</textarea>
                                @error('admin_response')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-success">Mark as Resolved</button>
                        </form>
                    @endif

                    <div class="mt-3">
                        <a href="{{ route('tickets.index') }}" class="btn btn-secondary">Back to Tickets</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection