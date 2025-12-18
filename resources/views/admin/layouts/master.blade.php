<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Optimum Meditred Ltd">
    <meta name="keywords" content="Optimum Meditred Ltd">
    <meta name="author" content="fkhrl">
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">
@php
    $setting = \App\Models\SiteSetting::first();
@endphp
    <title>@yield('title') | Optimum Meditred Ltd </title>
    <!-- Favicon icon-->
    @if($setting && $setting->favicon)
        <link rel="icon" href="{{ asset($setting->favicon) }}" type="image/x-icon">
        <link rel="shortcut icon" href="{{ asset($setting->favicon) }}" type="image/x-icon">
    @else
        <link rel="icon" href="{{ url('/admin/assets') }}/images/icon.png" type="image/x-icon">
        <link rel="shortcut icon" href="{{ url('/admin/assets') }}/images/icon.png" type="image/x-icon">
    @endif
    <!-- Google font-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="">
    <link
        href="https://fonts.googleapis.com/css2?family=Nunito+Sans:opsz,wght@6..12,200;6..12,300;6..12,400;6..12,500;6..12,600;6..12,700;6..12,800;6..12,900;6..12,1000&amp;display=swap"
        rel="stylesheet">
    <!-- Flag icon css -->
    <link rel="stylesheet" href="{{ url('/admin/assets') }}/css/vendors/flag-icon.css">
    <!-- iconly-icon-->
    <link rel="stylesheet" href="{{ url('/admin/assets') }}/css/iconly-icon.css">
    <link rel="stylesheet" href="{{ url('/admin/assets') }}/css/bulk-style.css">
    <!-- iconly-icon-->
    <link rel="stylesheet" href="{{ url('/admin/assets') }}/css/themify.css">
    <!--fontawesome-->
    <link rel="stylesheet" href="{{ url('/admin/assets') }}/css/fontawesome-min.css">
    <!-- Whether Icon css-->
    <link rel="stylesheet" type="text/css" href="{{ url('/admin/assets') }}/css/vendors/weather-icons/weather-icons.min.css">
    <link rel="stylesheet" type="text/css" href="{{ url('/admin/assets') }}/css/vendors/dropzone.css">
    <link rel="stylesheet" type="text/css" href="{{ url('/admin/assets') }}/css/vendors/scrollbar.css">
    <link rel="stylesheet" type="text/css" href="{{ url('/admin/assets') }}/css/vendors/quill.snow.css">
    <link rel="stylesheet" type="text/css" href="{{ url('/admin/assets') }}/css/vendors/choices.js/public/assets/styles/choices.min.css">
    <link rel="stylesheet" type="text/css" href="{{ url('/admin/assets') }}/css/vendors/slick.css">
    <link rel="stylesheet" type="text/css" href="{{ url('/admin/assets') }}/css/vendors/slick-theme.css">
    <link rel="stylesheet" type="text/css" href="{{ url('/admin/assets') }}/css/vendors/datatables.css">
    <!-- App css -->
    <link id="color" rel="stylesheet" href="{{ url('/admin/assets') }}/css/color-1.css" media="screen">
    <link rel="stylesheet" href="{{ url('/admin/assets') }}/css/style.css">
    
    <!-- Custom CSS Override for Sidebar -->
    <style>
        /* Override horizontal-sidebar CSS that hides sidebar-main-title */
        .page-wrapper .page-sidebar .main-sidebar .sidebar-menu .sidebar-main-title {
            display: block !important;
            visibility: visible !important;
            opacity: 1 !important;
        }
        /* Force show all sidebar sections */
        .sidebar-main-title {
            display: block !important;
            visibility: visible !important;
            opacity: 1 !important;
        }
        /* Additional override for any conflicting styles */
        .page-wrapper.compact-wrapper .page-sidebar .main-sidebar .sidebar-menu .sidebar-main-title {
            display: block !important;
            visibility: visible !important;
            opacity: 1 !important;
        }
        .form-label{
            color: #000 !important;
        }
        .card-header h6{
            color: #000 !important;
            font-weight: 600 !important;    
            font-size: 18px !important;
        }
    </style>
    
    <!-- Add this before your own styles -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/plugins/monthSelect/style.css" />
    <style>
        /* Modern Select2 Styling */
        .select2-container {
            width: 100% !important;
        }

        .select2-container--default .select2-selection--single {
            border: 2px solid #e5e7eb !important;
            background: #ffffff !important;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
            border: none;
            height:37px !important;
        }

        .select2-container--default .select2-selection--single:hover {
         
       
        }

        .select2-container--default.select2-container--focus .select2-selection--single {
     
            outline: none !important;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            color: #374151 !important;
            font-weight: 500 !important;
            font-size: 1rem !important;
            line-height: 15px;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 48px !important;
            right: 15px !important;
            top: 2px !important;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow b {
            border-color: #6b7280 transparent transparent transparent !important;
            border-width: 6px 5px 0 5px !important;
            transition: all 0.3s ease !important;
            top: 15px;
        }

        .select2-container--default.select2-container--open .select2-selection--single .select2-selection__arrow b {
            transform: rotate(180deg) !important;
        }

        /* Multiple Select Styling */
        .select2-container--default .select2-selection--multiple {
            border: 2px solid #e5e7eb !important;
            border-radius: 16px !important;
            background: #ffffff !important;
            min-height: 52px !important;
            padding: 8px 12px !important;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
        }

        .select2-container--default .select2-selection--multiple:hover {
            
            transform: translateY(-1px) !important;
        }

        .select2-container--default.select2-container--focus .select2-selection--multiple {
 
            box-shadow: 0 0 0 4px rgba(147, 51, 234, 0.1), 0 8px 25px rgba(147, 51, 234, 0.15) !important;
            outline: none !important;
        }

        /* Selected item tags */
        .select2-container--default .select2-selection--multiple .select2-selection__choice {
            
            border: none !important;
            border-radius: 12px !important;
            color: white !important;
            padding: 6px 12px !important;
            margin: 4px 6px 4px 0 !important;
            font-weight: 500 !important;
            font-size: 13px !important;
            transition: all 0.2s ease !important;
        }

        .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
            color: rgba(255, 255, 255, 0.8) !important;
            margin-right: 8px !important;
            font-weight: bold !important;
            transition: color 0.2s ease !important;
        }

        .select2-container--default .select2-selection--multiple .select2-selection__choice__remove:hover {
            color: white !important;
        }

        /* Dropdown styling */
        .select2-dropdown {
            border: 2px solid #e5e7eb !important;
            border-radius: 16px !important;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15) !important;
            backdrop-filter: blur(20px) !important;
            background: rgba(255, 255, 255, 0.98) !important;
            overflow: hidden !important;
        }

        .select2-container--default .select2-results__option {
            padding: 12px 20px !important;
            font-weight: 500 !important;
            transition: all 0.2s ease !important;
            border-bottom: 1px solid rgba(229, 231, 235, 0.5) !important;
        }

        .select2-container--default .select2-results__option:last-child {
            border-bottom: none !important;
        }

        .select2-container--default .select2-results__option--highlighted[aria-selected] {
           
            color: white !important;
            transform: translateX(4px) !important;
        }

        .select2-container--default .select2-results__option[aria-selected=true] {
            background: rgba(204, 203, 204, 0.1) !important;
            color: #000000 !important;
            font-weight: 600 !important;
        }

        /* Search input styling */
        .select2-container--default .select2-search--dropdown .select2-search__field {
            border: 2px solid #e5e7eb !important;
            border-radius: 5px !important;
            padding: 5px !important;
            margin: 12px !important;
            width: calc(100% - 24px) !important;
            font-weight: 500 !important;
            transition: all 0.3s ease !important;
        }

        .select2-container--default .select2-search--dropdown .select2-search__field:focus {
            
            box-shadow: 0 0 0 3px rgba(12, 12, 12, 0.1) !important;
            outline: none !important;
        }

        /* Placeholder styling */
        .select2-container--default .select2-selection--single .select2-selection__placeholder {
            color: #9ca3af !important;
            font-weight: 400 !important;
            height:37px !important;
            border:none;
        }

        .select2-container--default .select2-selection--multiple .select2-selection__placeholder {
            color: #9ca3af !important;
            font-weight: 400 !important;
        }

        /* Custom animations */
        .select2-dropdown {
            animation: slideIn 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
        }

        
    </style>
    @yield('css')
</head>

<body>
    <!-- page-wrapper Start-->
    <!-- tap on top starts-->
    <div class="tap-top"><i class="iconly-Arrow-Up icli"></i></div>
    <!-- tap on tap ends-->
    <!-- loader-->
    <div class="loader-wrapper">
        <div class="loader"><span></span><span></span><span></span><span></span><span></span></div>
    </div>
    <div class="page-wrapper compact-wrapper" id="pageWrapper">
        @include('admin.include.header')
        <!-- Page Body Start-->
        <div class="page-body-wrapper">
            <!-- Page sidebar start-->
            @include('admin.include.sidebar')
            <!-- Page sidebar end-->
            <div class="page-body">
                @if(session('success'))
                    <div class="toast-container position-fixed top-0 end-0 p-3" style="z-index: 1055;">
                        <div class="toast align-items-center text-bg-success border-0 show" role="alert">
                            <div class="d-flex">
                                <div class="toast-body">
                                    {{ session('success') }}
                                </div>
                                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
                            </div>
                        </div>
                    </div>
                @endif

                @if(session('error'))
                    <div class="toast-container position-fixed top-0 end-0 p-3" style="z-index: 1055;">
                        <div class="toast align-items-center text-bg-danger border-0 show" role="alert">
                            <div class="d-flex">
                                <div class="toast-body">
                                    {{ session('error') }}
                                </div>
                                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
                            </div>
                        </div>
                    </div>
                @endif

                @yield('content')
            </div>
            @include('admin.include.footer')
        </div>
    </div>
    <!-- jquery-->
    <script src="{{ url('/admin/assets') }}/js/vendors/jquery/jquery.min.js"></script>
    <!-- bootstrap js-->
    <script src="{{ url('/admin/assets') }}/js/vendors/bootstrap/dist/js/bootstrap.bundle.min.js" defer=""></script>
    <script src="{{ url('/admin/assets') }}/js/vendors/bootstrap/dist/js/popper.min.js" defer=""></script>
    <!--fontawesome-->
    <script src="{{ url('/admin/assets') }}/js/vendors/font-awesome/fontawesome-min.js"></script>

    <!-- feather-->
    <script src="{{ url('/admin/assets') }}/js/vendors/feather-icon/feather.min.js"></script>
    <script src="{{ url('/admin/assets') }}/js/vendors/feather-icon/custom-script.js"></script>

    <!-- sidebar -->
    <script src="{{ url('/admin/assets') }}/js/sidebar.js"></script>
    <script src="{{ url('/admin/assets') }}/js/dropzone/dropzone.js"></script>
    <script src="{{ url('/admin/assets') }}/js/dropzone/dropzone-script.js"></script>
    <script src="{{ url('/admin/assets') }}/js/vendors/choices.js/public/assets/scripts/choices.js"></script>
    <script src="{{ url('/admin/assets') }}/js/editors/quill.js"></script>
    <!-- scrollbar--> 
    <script src="{{ url('/admin/assets') }}/js/scrollbar/simplebar.js"></script>
    <script src="{{ url('/admin/assets') }}/js/scrollbar/custom.js"></script>
    <!-- slick-->
    <script src="{{ url('/admin/assets') }}/js/slick/slick.min.js"></script>
    <script src="{{ url('/admin/assets') }}/js/slick/slick.js"></script>
    <!-- datatable-->
    <script src="{{ url('/admin/assets') }}/js/datatable/datatables/jquery.dataTables.min.js"></script>
    <!-- page_datatable-->
    <script src="{{ url('/admin/assets') }}/js/js-datatables/datatables/datatable.custom.js"></script>
    <!-- page_datatable-->
    <script src="{{ url('/admin/assets') }}/js/datatable/datatables/datatable.custom.js"></script>
    <!-- theme_customizer-->
    <script src="{{ url('/admin/assets') }}/js/theme-customizer/customizer.js"></script>
    <!-- custom script -->
    <script src="{{ url('/admin/assets') }}/js/script.js"></script>
    
    <script src="{{ url('/admin/assets') }}/js/select2/select2.full.min.js"></script>
    <script src="{{ url('/admin/assets') }}/js/select2/select2-custom.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/plugins/monthSelect/index.js"></script>

    <script>
        flatpickr("#datepicker", {});
        flatpickr("#datepickerMonth", {
            dateFormat: "F Y", // e.g., July 2025
            plugins: [
                new monthSelectPlugin({
                    shorthand: false, // show full month name
                    dateFormat: "F Y",
                    altFormat: "F Y"
                })
            ]
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const toastElList = [].slice.call(document.querySelectorAll('.toast'))
            const toastList = toastElList.map(function (toastEl) {
                return new bootstrap.Toast(toastEl, {
                    delay: 4000,     
                    autohide: true   
                });
            });
            toastList.forEach(toast => toast.show());
        });
    </script>
    
    
    @yield('js')
</body>

</html>
