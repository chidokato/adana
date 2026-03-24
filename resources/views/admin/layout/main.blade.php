<!DOCTYPE html>
<html lang="en">

<head>
    <base href="{{asset('')}}">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>SB Admin 2 - Dashboard</title>

    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"> -->

    <!-- Custom fonts for this template-->
    <link href="admin_asset/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="admin_asset/css/sb-admin-2.min.css" rel="stylesheet">
    <!-- zoom -->
    <link href="admin_asset/zoom/zoom.css" rel="stylesheet">
    <!-- select2 multiple css -->
    <link href="admin_asset/select2/css/select2.min.css" rel="stylesheet">
    <!-- CSS -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
    @yield('css')
</head>

<body id="page-top">
    <div id="wrapper">
        @include('admin.layout.navbar')
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                
                <div class="container-fluid">
                    @include('admin.layout.header')
                    @yield('content')
                </div>
                @include('admin.layout.footer')
            </div>
        </div>
        
    </div>
    <!-- Footer -->
            
            <!-- End of Footer -->

            <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>

    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>

    


    <!-- <script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
    <script>
    var options = {
        filebrowserImageBrowseUrl: 'laravel-filemanager?type=Images',
        filebrowserImageUploadUrl: 'laravel-filemanager/upload?type=Images&_token=',
        filebrowserBrowseUrl: 'laravel-filemanager?type=Files',
        filebrowserUploadUrl: 'laravel-filemanager/upload?type=Files&_token=',
        height: 450, 
        toolbar: [{
          name: 'document',
          items: ['Source']
        },
        {
          name: 'clipboard',
          items: ['Undo', 'Redo']
        },
        {
          name: 'styles',
          items: ['Format', 'Font', 'FontSize']
        },
        {
          name: 'colors',
          items: ['TextColor', 'BGColor']
        },
        {
          name: 'align',
          items: ['JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock']
        },
        {
          name: 'basicstyles',
          items: ['Bold', 'Italic', 'Underline', 'Subscript', 'Superscript', 'Strike', 'RemoveFormat']
        },
        {
          name: 'links',
          items: ['Link', 'Unlink']
        },
        {
          name: 'paragraph',
          items: ['NumberedList', 'BulletedList', '-', 'Blockquote']
        },
        {
          name: 'insert',
          items: ['Image', 'Table']
        },
        
        
      ],
    };
    </script>
    <script>
        CKEDITOR.replace('ckeditor', options);
        @for ($i = 1; $i <= 10; $i++)
            CKEDITOR.replace('ckeditor{{$i}}', options);
        @endfor
    </script> -->
    
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <!-- <script src="admin_asset/jquery/jquery.min.js"></script> -->
    <script src="admin_asset/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="admin_asset/jquery-easing/jquery.easing.min.js"></script>
    <script src="admin_asset/js/sb-admin-2.min.js"></script>
    <script src="admin_asset/js/pages/crud/file-upload/image-inpute3c3.js?v=7.2.5"></script>

    
    <script src="http://code.jquery.com/jquery-latest.js"></script>

    <!-- date -->
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    
    <script type="text/javascript">
    $(function() {
        $('input[name="datefilter"]').daterangepicker({
          autoUpdateInput: false,
          locale: {
              cancelLabel: 'Clear'
          }
        });
        $('input[name="datefilter"]').on('apply.daterangepicker', function(ev, picker) {
          $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));
        });
        $('input[name="datefilter"]').on('cancel.daterangepicker', function(ev, picker) {
          $(this).val('');
        });
    });
    </script>

    <!-- select2 multiple JavaScript -->
    <script src="admin_asset/select2/js/select2.min.js"></script>
    <script src="admin_asset/select2/js/select2-searchInputPlaceholder.js"></script>
    <script type="text/javascript">
        // $(document).ready(function() { $('.select2').select2({ placeholder: '...'}); });
        $(document).ready(function() { $('.select2').select2({ searchInputPlaceholder: 'Nhập từ khóa' }); });
    </script>

    <!-- zoom ảnh -->
    <script src="admin_asset/zoom/zoom.js"></script>
    
    <!-- <script src="admin_asset/js/js.js"></script> -->
    <script src="admin_asset/js/custom.js"></script>
    <!-- CKEditor 5 (from forexleak.com setup) -->
    <script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/super-build/ckeditor.js"></script>
    <script src="admin_asset/js/customc-keditor.js"></script>
    <script>
        const uploadUrl = "{{ route('admin.upload') }}?_token={{ csrf_token() }}";
        document.addEventListener('DOMContentLoaded', function() {
            if (typeof initEditor === 'function') {
                initEditor();
            }
        });
    </script>
    <!-- validate -->
    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js" type="text/javascript"></script>
    <script src="admin_asset/js/validate.js"></script>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        function showToast(type, message) {
            Swal.fire({
                toast: true,
                position: 'bottom-start',
                icon: type,
                title: message,
                showConfirmButton: false,
                timer: 2000,
                timerProgressBar: true
            });
        }

        document.addEventListener('DOMContentLoaded', function() {
            @if (session('success'))
                showToast('success', '{{ session('success') }}');
            @endif

            @if (session('warning'))
                showToast('warning', '{{ session('warning') }}');
            @endif

            @if (session('error'))
                showToast('error', '{{ session('error') }}');
            @endif
        });

        function showCenterError(message) {
            Swal.fire({
                icon: 'error',
                title: 'Lỗi',
                text: message,
                confirmButtonText: 'OK',
                position: 'center',
                backdrop: true
            });
        }

        document.addEventListener('DOMContentLoaded', function() {
            @if (session('center_error'))
                showCenterError('{{ session('center_error') }}');
            @endif
        });

        function showCenterWarning(message) {
            Swal.fire({
                icon: 'warning',
                title: 'Cảnh báo',
                text: message,
                confirmButtonText: 'OK',
                position: 'center',
                backdrop: true
            });
        }
        document.addEventListener('DOMContentLoaded', function() {
            @if (session('center_warning'))
                showCenterWarning('{{ session('center_warning') }}');
            @endif
        });
    </script>

    <!-- CKEditor loaded per-page -->

    @include('admin.alert')
    
    @yield('js')
</body>
</html>
