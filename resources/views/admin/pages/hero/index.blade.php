@extends('admin.layouts.master')
@section('title', 'Hero Section Settings')
@section('content')

<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-sm-6 col-12">
                <h2>Hero Section Settings</h2>
            </div>
            <div class="col-sm-6 col-12">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="iconly-Home icli svg-color"></i></a></li>
                    <li class="breadcrumb-item">Site Management</li>
                    <li class="breadcrumb-item active">Hero Section</li>
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
                    <h5 class="mb-0">Manage Hero Section</h5>
                </div>
                <div class="card-body">

                    <form action="{{ route('admin.hero.update') }}" method="POST">
                        @csrf
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Badge Text</label>
                                <input type="text" name="badge_text" class="form-control" value="{{ $hero->badge_text }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Rating Text</label>
                                <input type="text" name="rating" class="form-control" value="{{ $hero->rating }}">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Title (HTML allowed)</label>
                            <textarea name="title" class="form-control" rows="3">{{ $hero->title }}</textarea>
                            <small class="text-muted">Use &lt;span&gt; tags for styling as needed.</small>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea name="description" class="form-control" rows="3">{{ $hero->description }}</textarea>
                        </div>

                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Traders Count Text</label>
                                <input type="text" name="traders_count" class="form-control" value="{{ $hero->traders_count }}">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="form-label">Primary CTA Text</label>
                                <input type="text" name="primary_cta_text" class="form-control" value="{{ $hero->primary_cta_text }}">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="form-label">Primary CTA Link</label>
                                <input type="text" name="primary_cta_link" class="form-control" value="{{ $hero->primary_cta_link }}">
                            </div>
                             <div class="col-md-3 mb-3">
                                <label class="form-label">Sign In CTA Text</label>
                                <input type="text" name="signin_cta_text" class="form-control" value="{{ $hero->signin_cta_text }}">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="form-label">Sign In Link</label>
                                <input type="text" name="signin_cta_link" class="form-control" value="{{ $hero->signin_cta_link }}">
                            </div>
                        </div>

                         <div class="row">
                            <div class="col-md-3 mb-3">
                                <label class="form-label">Myfxbook Link Text</label>
                                <input type="text" name="myfxbook_text" class="form-control" value="{{ $hero->myfxbook_text }}">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="form-label">Myfxbook Link URL</label>
                                <input type="text" name="myfxbook_link" class="form-control" value="{{ $hero->myfxbook_link }}">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="form-label">Payout Link Text</label>
                                <input type="text" name="payout_text" class="form-control" value="{{ $hero->payout_text }}">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="form-label">Payout Link URL</label>
                                <input type="text" name="payout_link" class="form-control" value="{{ $hero->payout_link }}">
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="is_active" value="1" id="isActive" {{ $hero->is_active ? 'checked' : '' }}>
                                <label class="form-check-label" for="isActive">
                                    Show Hero Section
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
