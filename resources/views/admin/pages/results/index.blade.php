@extends('admin.layouts.master')
@section('title', 'Results Section Settings')
@section('css')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
@endsection

@section('content')
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-sm-6 col-12">
                <h2>Results Section Settings</h2>
            </div>
            <div class="col-sm-6 col-12">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="iconly-Home icli svg-color"></i></a></li>
                    <li class="breadcrumb-item">Site Management</li>
                    <li class="breadcrumb-item active">Results Section</li>
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
                    <h5 class="mb-0">Manage Results Section</h5>
                </div>
                <div class="card-body">
                    
                    <form action="{{ route('admin.results.update') }}" method="POST">
                        @csrf
                        
                        <!-- Header Section -->
                        <h5 class="mb-3 text-primary">Header Information</h5>
                        <div class="row mb-4">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Badge Text</label>
                                <input type="text" name="badge_text" class="form-control" value="{{ $results->badge_text }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Main Title</label>
                                <input type="text" name="title" class="form-control" value="{{ $results->title }}">
                            </div>
                            <div class="col-12 mb-3">
                                <label class="form-label">Subtitle</label>
                                <textarea name="subtitle" class="form-control" rows="2">{{ $results->subtitle }}</textarea>
                            </div>
                            <div class="col-12">
                                <label class="form-label">Disclaimer</label>
                                <input type="text" name="disclaimer" class="form-control" value="{{ $results->disclaimer }}">
                            </div>
                        </div>

                        <hr>

                        <!-- Account 1 -->
                        <h5 class="mb-3 text-primary">Account #1 Stats</h5>
                        <div class="row mb-3">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Name</label>
                                <input type="text" name="acc1_name" class="form-control" value="{{ $results->acc1_name }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Subtext (e.g., Verified)</label>
                                <input type="text" name="acc1_subtext" class="form-control" value="{{ $results->acc1_subtext }}">
                            </div>
                            <!-- <div class="col-md-3 mb-3">
                                <label class="form-label">Total Gain</label>
                                <input type="text" name="acc1_total_gain" class="form-control" value="{{ $results->acc1_total_gain }}">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="form-label">Balance</label>
                                <input type="text" name="acc1_balance" class="form-control" value="{{ $results->acc1_balance }}">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="form-label">Daily %</label>
                                <input type="text" name="acc1_daily" class="form-control" value="{{ $results->acc1_daily }}">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="form-label">Monthly %</label>
                                <input type="text" name="acc1_monthly" class="form-control" value="{{ $results->acc1_monthly }}">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="form-label">Drawdown</label>
                                <input type="text" name="acc1_drawdown" class="form-control" value="{{ $results->acc1_drawdown }}">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="form-label">Profit</label>
                                <input type="text" name="acc1_profit" class="form-control" value="{{ $results->acc1_profit }}">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="form-label">Deposits</label>
                                <input type="text" name="acc1_deposits" class="form-control" value="{{ $results->acc1_deposits }}">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="form-label">Platform</label>
                                <input type="text" name="acc1_platform" class="form-control" value="{{ $results->acc1_platform }}">
                            </div> -->
                        </div>

                        <hr>

                        <!-- Account 2 -->
                        <h5 class="mb-3 text-primary">Account #2 Stats</h5>
                         <div class="row mb-3">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Name</label>
                                <input type="text" name="acc2_name" class="form-control" value="{{ $results->acc2_name }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Subtext</label>
                                <input type="text" name="acc2_subtext" class="form-control" value="{{ $results->acc2_subtext }}">
                            </div>
                            <!-- <div class="col-md-3 mb-3">
                                <label class="form-label">Total Gain</label>
                                <input type="text" name="acc2_total_gain" class="form-control" value="{{ $results->acc2_total_gain }}">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="form-label">Balance</label>
                                <input type="text" name="acc2_balance" class="form-control" value="{{ $results->acc2_balance }}">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="form-label">Daily %</label>
                                <input type="text" name="acc2_daily" class="form-control" value="{{ $results->acc2_daily }}">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="form-label">Monthly %</label>
                                <input type="text" name="acc2_monthly" class="form-control" value="{{ $results->acc2_monthly }}">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="form-label">Drawdown</label>
                                <input type="text" name="acc2_drawdown" class="form-control" value="{{ $results->acc2_drawdown }}">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="form-label">Profit</label>
                                <input type="text" name="acc2_profit" class="form-control" value="{{ $results->acc2_profit }}">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="form-label">Deposits</label>
                                <input type="text" name="acc2_deposits" class="form-control" value="{{ $results->acc2_deposits }}">
                            </div>
                             <div class="col-md-3 mb-3">
                                <label class="form-label">Platform</label>
                                <input type="text" name="acc2_platform" class="form-control" value="{{ $results->acc2_platform }}">
                            </div> -->
                        </div>

                        <hr>

                        <!-- Account 3 -->
                        <h5 class="mb-3 text-primary">Account #3 Stats</h5>
                         <div class="row mb-3">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Name</label>
                                <input type="text" name="acc3_name" class="form-control" value="{{ $results->acc3_name }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Subtext</label>
                                <input type="text" name="acc3_subtext" class="form-control" value="{{ $results->acc3_subtext }}">
                            </div>
                            <!-- <div class="col-md-3 mb-3">
                                <label class="form-label">Total Gain</label>
                                <input type="text" name="acc3_total_gain" class="form-control" value="{{ $results->acc3_total_gain }}">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="form-label">Balance</label>
                                <input type="text" name="acc3_balance" class="form-control" value="{{ $results->acc3_balance }}">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="form-label">Daily %</label>
                                <input type="text" name="acc3_daily" class="form-control" value="{{ $results->acc3_daily }}">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="form-label">Monthly %</label>
                                <input type="text" name="acc3_monthly" class="form-control" value="{{ $results->acc3_monthly }}">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="form-label">Drawdown</label>
                                <input type="text" name="acc3_drawdown" class="form-control" value="{{ $results->acc3_drawdown }}">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="form-label">Profit</label>
                                <input type="text" name="acc3_profit" class="form-control" value="{{ $results->acc3_profit }}">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="form-label">Deposits</label>
                                <input type="text" name="acc3_deposits" class="form-control" value="{{ $results->acc3_deposits }}">
                            </div>
                             <div class="col-md-3 mb-3">
                                <label class="form-label">Platform</label>
                                <input type="text" name="acc3_platform" class="form-control" value="{{ $results->acc3_platform }}">
                            </div> -->
                        </div>

                        <hr>

                        <!-- Summary Section -->
                         <h5 class="mb-3 text-primary">Performance Summary</h5>
                         <div class="mb-3">
                            <label class="form-label">Summary Title (HTML allowed)</label>
                            <textarea name="summary_title" class="form-control summernote">{{ $results->summary_title }}</textarea>
                         </div>
                         <div class="mb-3">
                            <label class="form-label">Summary Description</label>
                            <textarea name="summary_description" class="form-control summernote">{{ $results->summary_description }}</textarea>
                         </div>
                         <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">View Results Button Text</label>
                                <input type="text" name="view_results_text" class="form-control" value="{{ $results->view_results_text }}">
                            </div>
                             <div class="col-md-6 mb-3">
                                <label class="form-label">View Results Button Link</label>
                                <input type="text" name="view_results_link" class="form-control" value="{{ $results->view_results_link }}">
                            </div>
                         </div>

                        <hr>

                        <!-- Action Buttons -->
                        <h5 class="mb-3 text-primary">Bottom Action Buttons</h5>
                         <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">MyFxBook Button Text</label>
                                <input type="text" name="myfxbook_text" class="form-control" value="{{ $results->myfxbook_text }}">
                            </div>
                             <div class="col-md-6 mb-3">
                                <label class="form-label">MyFxBook Button Link</label>
                                <input type="text" name="myfxbook_link" class="form-control" value="{{ $results->myfxbook_link }}">
                            </div>
                             <div class="col-md-6 mb-3">
                                <label class="form-label">Payout Button Text</label>
                                <input type="text" name="payout_text" class="form-control" value="{{ $results->payout_text }}">
                            </div>
                             <div class="col-md-6 mb-3">
                                <label class="form-label">Payout Button Link</label>
                                <input type="text" name="payout_link" class="form-control" value="{{ $results->payout_link }}">
                            </div>
                         </div>


                        <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="is_active" value="1" id="isActive" {{ $results->is_active ? 'checked' : '' }}>
                                <label class="form-check-label" for="isActive">
                                    Show Results Section
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

@section('js')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
<script>
    $(document).ready(function() {
        $('.summernote').summernote({
             height: 100,
             toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'italic', 'underline', 'clear', 'strikethrough', 'superscript', 'subscript']],
                ['fontname', ['fontname']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['height', ['height']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'video', 'hr']],
                ['view', ['fullscreen', 'codeview', 'help', 'undo', 'redo']]
            ]
        });
    });
</script>
@endsection
