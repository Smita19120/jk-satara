@extends('dashboard_layout.layout')

@section('content')
<div class="container mt-4">
    <h3>Edit Sub Branch</h3>

    <form action="{{ route('sub_branch.update', $subBranch->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="branch_id" class="form-label">Select Branch</label>
            <select name="branch_id" class="form-control" required>
                @foreach($branches as $branch)
                    <option value="{{ $branch->id }}" {{ $subBranch->branch_id == $branch->id ? 'selected' : '' }}>
                        {{ $branch->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="name" class="form-label">Sub Branch Name</label>
            <input type="text" name="name" class="form-control" value="{{ $subBranch->name }}" required>
        </div>

        <div class="mb-3">
    <label for="contact" class="form-label">Contact</label>
    <input type="text" name="contact" class="form-control" value="{{ $subBranch->contact }}" required>
</div>

<div class="mb-3">
    <label for="address" class="form-label">Address</label>
    <input type="text" name="address" class="form-control" value="{{ $subBranch->address }}" required>
</div>

        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ route('sub_branch.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection
