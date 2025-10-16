@extends('member.layouts.app')

@section('title', 'My Downlines')

@section('content')
<div class="container">
    <div class="page-inner justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create New Ticket</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('tickets.store') }}">
                        @csrf

                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" 
                                   id="title" name="title" value="{{ old('title') }}" required>
                            @error('title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" 
                                      id="description" name="description" rows="5" required>{{ old('description') }}</textarea>
                            @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group mb-0">
                            <button type="submit" class="btn btn-primary">Submit Ticket</button>
                            <a href="{{ route('tickets.index') }}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
