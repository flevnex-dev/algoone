@extends('admin.layouts.master')
@section('title', 'Official Myfxbooks Section Settings')

@section('content')
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-sm-6 col-12">
                <h2>Official Myfxbooks Section Settings</h2>
            </div>
            <div class="col-sm-6 col-12">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="iconly-Home icli svg-color"></i></a></li>
                    <li class="breadcrumb-item">Site Management</li>
                    <li class="breadcrumb-item active">Official Myfxbooks</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <form action="{{ route('admin.official-myfxbooks.update') }}" method="POST">
                @csrf
                
                <!-- Section 1: Verified Badge & Page Title -->
                <div class="card mb-4">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Section 1: Verified Badge & Page Title</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label">Verified Badge Text</label>
                            <input type="text" name="verified_badge_text" class="form-control" value="{{ $section->verified_badge_text ?? 'VERIFIED BY MYFXBOOK' }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Page Title</label>
                            <input type="text" name="page_title" class="form-control" value="{{ $section->page_title ?? 'Official Myfxbooks' }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Page Subtitle</label>
                            <textarea name="page_subtitle" class="form-control" rows="2">{{ $section->page_subtitle ?? 'Designed Specifically for Prop Firms. 100% Rule Compliant. Never Breaks Trading Guidelines.' }}</textarea>
                        </div>
                    </div>
                </div>

                <!-- Section 2: Introduction -->
                <div class="card mb-4">
                    <div class="card-header bg-success text-white">
                        <h5 class="mb-0">Section 2: Introduction</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label">Introduction Text 1</label>
                            <textarea name="intro_text1" class="form-control" rows="3">{{ $section->intro_text1 ?? 'Myfxbook is the world\'s most trusted third-party verification platform for trading results.' }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Introduction Text 2</label>
                            <textarea name="intro_text2" class="form-control" rows="3">{{ $section->intro_text2 ?? 'Every account below is independently verified and tracked in real-time. Click any account to view the official Myfxbook link for complete transparency and detailed performance metrics.' }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Disclaimer Note</label>
                            <textarea name="disclaimer_note" class="form-control" rows="2">{{ $section->disclaimer_note ?? '*All accounts shown are demo accounts. Results do not represent real money trading.' }}</textarea>
                        </div>
                    </div>
                </div>

                <!-- Section 3: Call to Action -->
                <div class="card mb-4">
                    <div class="card-header bg-info text-white">
                        <h5 class="mb-0">Section 3: Call to Action</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label">CTA Title</label>
                            <input type="text" name="cta_title" class="form-control" value="{{ $section->cta_title ?? 'Want Results Like These?' }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">CTA Text</label>
                            <textarea name="cta_text" class="form-control" rows="3">{{ $section->cta_text ?? 'Join hundreds of traders who trust AlgoOne with their prop firm challenges. We only profit when you profit.' }}</textarea>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">CTA Button Text</label>
                                <input type="text" name="cta_button_text" class="form-control" value="{{ $section->cta_button_text ?? 'Get Started Today' }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">CTA Button Link</label>
                                <input type="text" name="cta_button_link" class="form-control" value="{{ $section->cta_button_link ?? '' }}" placeholder="https://example.com">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Active Status -->
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="is_active" value="1" id="isActive" {{ ($section->is_active ?? true) ? 'checked' : '' }}>
                            <label class="form-check-label" for="isActive">
                                Show Official Myfxbooks Sections
                            </label>
                        </div>
                    </div>
                </div>

                <div class="text-end mb-4">
                    <button type="submit" class="btn btn-primary btn-lg">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
