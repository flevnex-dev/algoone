@extends('admin.layouts.master')
@section('title','Activity Logs')
@section('content')
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-sm-6 col-12">
                <h2>Activity Logs List</h2>
            </div>
            <div class="col-sm-6 col-12">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i
                                class="iconly-Home icli svg-color"></i></a></li>
                    <li class="breadcrumb-item">Pages</li>
                    <li class="breadcrumb-item active">Activity Logs</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<!-- Container-fluid starts-->
<div class="container-fluid">
    <div class="row justify-content-center">
      <div class="col-sm-12">
        <div class="card">
          <div class="card-body">
            <div class="list-product-header mb-3">
                <div class="d-flex">
                    <div class="light-box">
                        <a data-bs-toggle="collapse" href="#collapseProduct" role="button" aria-expanded="false" aria-controls="collapseProduct">
                          <i class="filter-icon show" data-feather="filter"></i>
                          <i class="icon-close filter-close hide"></i>
                        </a>
                      </div>
                </div>
            
                <div class="collapse mt-3 {{ request()->hasAny(['user_id', 'monthYear']) ? 'show' : '' }}" id="collapseProduct">
                    <form method="GET" action="{{ route('filterActivityLogs') }}" class="row g-3">
                        <div class="col-md-4">
                            <select class="form-select js-example-basic-single" name="user_id" id="user_id">
                                <option value="">Choose User</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}" {{ request('user_id') == $user->id ? 'selected' : '' }}>
                                        {{ $user->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
            
                        <div class="col-md-4">
                            <input name="monthYear" id="datepickerMonth" class="form-control" placeholder="Select month and year" value="{{ request('monthYear') }}">
                        </div>
            
                        <div class="col-md-2 d-flex gap-2 align-items-end">
                            <button type="submit" class="btn btn-primary w-100">Filter</button>
                            <a href="{{ route('activityLogs') }}" class="btn btn-outline-secondary w-100">Reset</a>
                        </div>
                    </form>
                </div>
            </div>
            
            <div class="list-product">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover" id="basic-1" style="min-width: 1200px;">
                        <thead class="table-light text-center">
                            <tr>
                                <th>#</th>
                                <th>Event</th>
                                <th>User</th>
                                <th>Model</th>
                                <th>Changes</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($logs as $index => $log)
                                <tr>
                                    <td class="text-center">{{ $index + 1 }}</td>
                                    <td>{{ $log->description }}</td>
                                    <td>
                                        @if($log->causer)
                                            {{ $log->causer->name ?? 'User ID: '.$log->causer_id }}
                                        @else
                                            System
                                        @endif
                                    </td>
                                    <td>
                                        {{ class_basename($log->subject_type) }} (ID: {{ $log->subject_id }})
                                    </td>
                                    <td>
                                        @php $changes = $log->properties->toArray(); @endphp
                                        <ul class="mb-0 ps-3">
                                            @foreach(($changes['attributes'] ?? []) as $key => $value)
                                                <li>
                                                    <strong>{{ ucfirst($key) }}:</strong>
                                                    @if(isset($changes['old'][$key]))
                                                        <span class="text-danger text-decoration-line-through">{{ $changes['old'][$key] }}</span>
                                                        →
                                                        <span class="text-success">{{ $value }}</span>
                                                    @else
                                                        <span>{{ $value }}</span>
                                                    @endif
                                                </li>
                                            @endforeach
                                        </ul>
                                    </td>
                                    <td>{{ $log->created_at->format('Y-m-d H:i:s') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            
          </div>
        </div>
      </div>
    </div>
  </div>
<!-- Container-fluid Ends-->
@endsection()