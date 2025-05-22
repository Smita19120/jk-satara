@extends('dashboard_layout.layout')

@section('content')
<div class="container mt-4">
    <h3>Add Sub Branch</h3>

    <form action="{{ route('sub_branch.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="branch_id" class="form-label">Select Branch</label>
            <select name="branch_id" class="form-control" required>
                <option value="">-- Select Branch --</option>
                @foreach($branches as $branch)
                    <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="name" class="form-label">Sub Branch Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="mb-3">
    <label for="contact" class="form-label">Contact</label>
    <input type="text" name="contact" class="form-control" required>
</div>

<div class="mb-3">
    <label for="address" class="form-label">Address</label>
    <input type="text" name="address" class="form-control" required>
</div>


        <button type="submit" class="btn btn-primary">Add Sub Branch</button>
    </form>
</div>
@endsection
