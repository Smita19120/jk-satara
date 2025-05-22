@extends('dashboard_layout.layout')

@section('content')
<div class="container mt-4">
    <h3>All Sub Branches</h3>

    <div class="d-flex justify-content-between mb-3">
        <a href="{{ route('sub_branch.create') }}" class="btn btn-primary">+ Add Sub Branch</a>
        
        <div class="col-md-4">
            <form action="{{ route('sub_branch.index') }}" method="GET">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Search sub branches..." 
                           value="{{ request('search') }}">
                    <button class="btn btn-outline-secondary" type="submit">Search</button>
                </div>
            </form>
        </div>
    </div>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Main Branch</th>
                <th>Sub Branch</th>
                <th>Contact</th>
                <th>Address</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($subBranches as $subBranch)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $subBranch->branch->name }}</td>
                    <td>{{ $subBranch->name }}</td>
                    <td>{{ $subBranch->contact }}</td>
                    <td>{{ $subBranch->address }}</td>
                    <td>
                        <a href="{{ route('sub_branch.edit', $subBranch->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('sub_branch.destroy', $subBranch->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this sub branch?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">No sub branches found</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Pagination links -->
    {{ $subBranches->appends(request()->query())->links() }}
</div>
@endsection