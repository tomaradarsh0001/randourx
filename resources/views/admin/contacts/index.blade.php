@extends('member.layouts.appadmin')

@section('title', 'Contact Messages')

@section('content')
<div class="container">
    <div class="page-inner">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Contact Messages</h3>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Message Preview</th>
                                    <th>Submitted At</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($contacts as $contact)
                                    <tr>
                                        <td>{{ $contact->id }}</td>
                                        <td>{{ $contact->name }}</td>
                                        <td>{{ $contact->email }}</td>
                                        <td>{{ Str::limit($contact->message, 50) }}</td>
                                        <td>{{ $contact->created_at->format('M d, Y h:i A') }}</td>
                                        <td>
                                            <a href="{{ route('admin.contacts.show', $contact) }}" 
                                               class="btn btn-info btn-sm">View</a>
                                            <form action="{{ route('admin.contacts.destroy', $contact) }}" 
                                                  method="POST" 
                                                  style="display: inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                        class="btn btn-danger btn-sm"
                                                        onclick="return confirm('Are you sure you want to delete this message?')">
                                                    Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">No contact messages found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{ $contacts->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection