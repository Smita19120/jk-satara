@extends('dashboard_layout.layout')

@section('content')
<div class="container mt-4">
    <h3>All Branches</h3>

    <a href="{{ route('branch.create') }}" class="btn btn-primary mb-3">+ Add New Branch</a>

    <table class="table table-bordered">
        <thead>
    <tr>
        <th>ID</th>
        <th>Branch Name</th>
        <th>Contact</th>
        <th>Established</th>
        <th>Actions</th>
    </tr>
</thead>

        <tbody>
    @foreach($branches as $branch)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $branch->name }}</td>
            <td>{{ $branch->contact }}</td>
            <td>{{ $branch->established }}</td>
            <td>
                <a href="{{ route('branch.edit', $branch->id) }}" class="btn btn-sm btn-warning">Edit</a>
                <form action="{{ route('branch.destroy', $branch->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                </form>
            </td>
        </tr>
    @endforeach
</tbody>

    </table>
</div>
@endsection
