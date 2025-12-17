@extends('admin.layouts.master')
@section('title','Admin List')
@section('content')

<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-sm-6 col-12">
                <h2>Admin List</h2>
            </div>
            <div class="col-sm-6 col-12">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('dashboard') }}">
                            <i class="iconly-Home icli svg-color"></i>
                        </a>
                    </li>
                    <li class="breadcrumb-item">Pages</li>
                    <li class="breadcrumb-item active">Admin</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<!-- Container-fluid starts-->
<div class="container-fluid">
    <div class="row justify-content-center">
        <!-- Admin List Starts -->
        <div class="col-sm-6">
            <div class="card">
                <div class="card-body">
                    @if(canView('admin', 'create'))
                        <div class="list-product-header">
                            <div> 
                            <a class="btn btn-primary" href="{{ route('admin.create') }}">
                                <i class="fa-solid fa-plus"></i> Add Admin
                            </a>
                            </div>
                        </div>
                    @endif
                    <div class="table-responsive">
                        <table class="display table" id="basic-1">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($admins as $index => $admin)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $admin->name }}</td>
                                        <td>{{ $admin->email }}</td>
                                        <td>{{ $admin->role }}</td>
                                        <td>
                                            <ul class="action">
                                                @if(canView('admin', 'edit'))
                                                <li class="edit">
                                                    <a href="{{ route('admin.edit', $admin->id) }}">
                                                        <i class="icon-pencil-alt"></i>
                                                    </a>
                                                </li>
                                                @endif
                                                @if(canView('admin', 'delete'))
                                                <li class="delete">
                                                    <form action="{{ route('admin.destroy', $admin->id) }}" method="POST" class="d-inline"
                                                          onsubmit="return confirm('Are you sure you want to delete this admin?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn p-0 border-0 bg-transparent text-danger">
                                                            <i class="icon-trash"></i>
                                                        </button>
                                                    </form>
                                                </li>
                                                @endif
                                            </ul>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div> <!-- table-responsive -->
                </div>
            </div>
        </div>
        <!-- Admin List Ends -->
    </div>
</div>
<!-- Container-fluid Ends -->

@endsection
