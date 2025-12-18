@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-6">
                <h3>Dashboard</h3>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h5>Menu</h5>
                </div>
                <div class="card-body">
                    <a href="{{ route('admin.topbars.index') }}" class="btn btn-primary">Manage Topbar</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
