@extends('admin.layouts.master')
@section('title', 'Progress Guidelines')
@section('content')

<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-sm-6 col-12">
                <h2>Progress Guidelines</h2>
            </div>
            <div class="col-sm-6 col-12">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="iconly-Home icli svg-color"></i></a></li>
                    <li class="breadcrumb-item">Site Management</li>
                    <li class="breadcrumb-item active">Progress Guidelines</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Manage Progress Guidelines Section</h5>
                </div>
                <div class="card-body">

                    <form action="{{ route('admin.progress-guidelines.update') }}" method="POST">
                        @csrf
                        
                        <div class="mb-4">
                            <h5 class="mb-3">Section Header</h5>
                            <div class="mb-3">
                                <label class="form-label">Title</label>
                                <input type="text" name="title" class="form-control" value="{{ $guideline->title ?? 'Important Information' }}" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Subtitle</label>
                                <input type="text" name="subtitle" class="form-control" value="{{ $guideline->subtitle ?? 'Please read carefully' }}">
                            </div>
                        </div>

                        <div class="mb-4">
                            <h5 class="mb-3">Warning Box</h5>
                            <div class="mb-3">
                                <label class="form-label">Warning Text</label>
                                <textarea name="warning_text" class="form-control" rows="2">{{ $guideline->warning_text ?? 'YOU NEVER DO A SINGLE THING - WE DO ALL THE TRADING FOR YOU.' }}</textarea>
                            </div>
                        </div>

                        <div class="mb-4">
                            <h5 class="mb-3">Guidelines</h5>
                            @for($i = 1; $i <= 7; $i++)
                            <div class="card mb-3">
                                <div class="card-header bg-light">
                                    <h6 class="mb-0">Guideline {{ $i }}</h6>
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label class="form-label">Title</label>
                                        <input type="text" name="guideline{{ $i }}_title" class="form-control" value="{{ $guideline->{"guideline{$i}_title"} ?? '' }}">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Description</label>
                                        <textarea name="guideline{{ $i }}_text" class="form-control" rows="2">{{ $guideline->{"guideline{$i}_text"} ?? '' }}</textarea>
                                    </div>
                                </div>
                            </div>
                            @endfor
                        </div>

                        <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="is_active" value="1" id="isActive" {{ ($guideline->is_active ?? true) ? 'checked' : '' }}>
                                <label class="form-check-label" for="isActive">
                                    Show Section
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
