@extends('admin.layouts.master')
@section('title', 'Why Choose Section Settings')

@section('content')
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-sm-6 col-12">
                <h2>Why Choose Section Settings</h2>
            </div>
            <div class="col-sm-6 col-12">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="iconly-Home icli svg-color"></i></a></li>
                    <li class="breadcrumb-item">Site Management</li>
                    <li class="breadcrumb-item active">Why Choose Section</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Manage Why Choose Section</h5>
                </div>
                <div class="card-body">
                    

                    <form action="{{ route('admin.why-choose.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <!-- Header Section -->
                        <h5 class="mb-3 text-primary">Header Information</h5>
                        <div class="row mb-4">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Title</label>
                                <input type="text" name="title" class="form-control" value="{{ $whyChoose->title }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Subtitle</label>
                                <input type="text" name="subtitle" class="form-control" value="{{ $whyChoose->subtitle }}">
                            </div>
                        </div>

                        <hr>

                        <!-- Cards Section -->
                        <h5 class="mb-3 text-primary">Feature Cards</h5>
                        <div class="row">
                            @for($i = 1; $i <= 6; $i++)
                                <div class="col-md-6 mb-4">
                                    <div class="card shadow-sm border">
                                        <div class="card-header bg-light">
                                            <h6 class="mb-0">Card #{{ $i }}</h6>
                                        </div>
                                        <div class="card-body">
                                            <div class="mb-3">
                                                <label class="form-label">Title</label>
                                                <input type="text" name="card{{ $i }}_title" class="form-control" value="{{ $whyChoose->{"card{$i}_title"} }}">
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Description</label>
                                                <textarea name="card{{ $i }}_description" class="form-control" rows="3">{{ $whyChoose->{"card{$i}_description"} }}</textarea>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Icon/Image</label>
                                                <input type="file" name="card{{ $i }}_image" class="form-control">
                                                @if($whyChoose->{"card{$i}_image"})
                                                    <div class="mt-2">
                                                        <img src="{{ asset($whyChoose->{"card{$i}_image"}) }}" alt="Current Image" style="height: 50px;">
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endfor
                        </div>

                        <hr>

                        <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="is_active" value="1" id="isActive" {{ $whyChoose->is_active ? 'checked' : '' }}>
                                <label class="form-check-label" for="isActive">
                                    Show Why Choose Section
                                </label>
                            </div>
                        </div>

                        <div class="text-end">
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
