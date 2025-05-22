@extends('dashboard_layout.layout')

@section('content')
<div class="container mt-4">
    <h3>Edit Branch</h3>

    <form action="{{ route('branch.update', $branch->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Branch Name</label>
            <input type="text" name="name" class="form-control" value="{{ $branch->name }}" required>
        </div>

        <div class="mb-3">
        <label for="contact" class="form-label">Contact</label>
        <input type="text" name="contact" class="form-control" value="{{ $branch->contact }}">
    </div>

    <div class="mb-3">
        <label for="established" class="form-label">Established</label>
        <input type="text" name="established" class="form-control" value="{{ $branch->established }}">
    </div>

        <button type="submit" class="btn btn-success">Update Branch</button>
        <a href="{{ route('branch.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection
