@extends('dashboard_layout.layout')
@section('pageContent')

<div class="pagetitle">
    <h1>Trainer List</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active">Trainer List</li>
        </ol>
    </nav>
</div>

<section class="section" style="margin-left: 23%">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">All Trainers</h5>
                    
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Designation</th>
                                   <th>Branch</th>
                                   <th>SubBranch</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($trainers as $key => $trainer)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    
                                    <td>
                                        <img src="{{ asset('uploads/trainer_images/' . $trainer->image) }}" alt="Gallery Image" width="100" height="100">
                                   </td>
                                    <td>{{ $trainer->name }}</td>
                                    <td>{{ $trainer->designation }}</td>
                                    <td>{{ $trainer->branch->name ?? 'N/A' }}</td>
                                    <td>{{ $trainer->subBranch->name ?? 'N/A' }}</td>

                                    <td>
                                        <a href="{{ route('admin.trainer.edit', $trainer->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                        <a href="{{ route('admin.trainer.delete', $trainer->id) }}" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection