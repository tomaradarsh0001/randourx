@extends('member.layouts.appadmin')

@section('title', 'Contact Messages')

@section('content')
<div class="container">
    <div class="page-inner">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Message Details</h3>
                    <a href="{{ route('admin.contacts.index') }}" class="btn btn-secondary float-right">Back to List</a>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <strong>Name:</strong>
                            <p class="text-muted">{{ $contact->name }}</p>
                        </div>
                        <div class="col-md-6">
                            <strong>Email:</strong>
                            <p class="text-muted">{{ $contact->email }}</p>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <strong>Form ID:</strong>
                            <p class="text-muted">{{ $contact->form_id ?? 'N/A' }}</p>
                        </div>
                        <div class="col-md-6">
                            <strong>Submitted At:</strong>
                            <p class="text-muted">{{ $contact->created_at->format('M d, Y h:i A') }}</p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <strong>Message:</strong>
                            <div class="border p-3 mt-2 bg-light">
                                {{ $contact->message }}
                            </div>
                        </div>
                    </div>

                    <div class="mt-3">
                        <form action="{{ route('admin.contacts.destroy', $contact) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="btn btn-danger"
                                    onclick="return confirm('Are you sure you want to delete this message?')">
                                Delete Message
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection