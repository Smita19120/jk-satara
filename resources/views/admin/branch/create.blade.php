@extends('dashboard_layout.layout')

@section('content')
<div class="container mt-4">
    <h3>Add Branch</h3>
    <form action="{{ route('branch.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Branch Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="contact" class="form-label">Contact</label>
            <input type="text" name="contact" value="{{ old('contact', $branch->contact ?? '') }}">
        </div>
        <div class="mb-3">
            <label for="established" class="form-label">Established</label>
            <input type="text" name="established" value="{{ old('established', $branch->established ?? '') }}">
        </div>
        <button type="submit" class="btn btn-primary">Add Branch</button>

        


    </form>

    <hr>

    <h4 class="mt-5">All Branches</h4>
    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>ID</th>
                <th>Branch Name</th>
                <th>Contact</th>
                <th>Established</th>
            </tr>
        </thead>
        <tbody>
            @foreach($branches as $branch)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $branch->name }}</td>
                    <td>{{ $branch->contact }}</td>
                    <td>{{ $branch->established }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
