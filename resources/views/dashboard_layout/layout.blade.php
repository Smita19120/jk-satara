
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title> Admin || Dashboard </title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
  <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.3/font/bootstrap-icons.min.css"
    integrity="sha512-dPXYcDub/aeb08c63jRq/k6GaKccl256JQy/AnOq7CAnEZ9FzSL9wSbcZkMp4R26vBsMLFYH4kQ67/bbV8XaCQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/boxicons/2.1.4/css/boxicons.min.css"
    integrity="sha512-cn16Qw8mzTBKpu08X0fwhTSv02kK/FojjNLz0bwp2xJ4H+yalwzXKFw/5cLzuBZCxGWIA+95X4skzvo8STNtSg=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link href="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.snow.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.bubble.css" />
  <link href="https://cdn.jsdelivr.net/npm/remixicon@4.5.0/fonts/remixicon.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/simple-datatables@10.0.0/dist/style.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="{{ asset('dashboard_theme/css/style.css')}}" rel="stylesheet">

</head>

<body>
<div class="container-fluid">
    <!-- Begin page -->

    <div id="layout-wrapper">
        @include("dashboard_layout.header")
        @include("dashboard_layout.sidebar")

        @yield('pageContent')
        <body>
    @include('dashboard_layout.sidebar')
    
    <main id="main" class="main">
        @yield('content')
    </main>
</body>

    </div>
    <!-- END layout-wrapper -->
</div>
<!-- end container-fluid -->





  @include("dashboard_layout.footer")
<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
@yield("js")
<!-- Vendor JS Files -->

<script src="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/4.5.0/apexcharts.min.js" integrity="sha512-yMnvLee1a5S9nemgCoMth5YvOchnQMFMOSao/bH6SLAXZnauuHs1gd92DnE9+sVQ5aglei3LZDelg8LauSlWkw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.bundle.min.js" integrity="sha512-7Pi/otdlbbCR+LnW+F7PwFcSDJOuUJB3OxtEHbg4vSMvzvJjde4Po1v4BR9Gdc9aXNUNFVUY+SK51wWT8WF0Gg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script src="{{ asset('dashboard_theme/vendor/chart.js/chart.umd.js') }}"></script>
<script src="{{ asset('dashboard_theme/vendor/echarts/echarts.min.js') }}"></script>
<script src="{{ asset('dashboard_theme/vendor/simple-datatables/simple-datatables.js') }}"></script>
<script src="{{ asset('dashboard_theme/vendor/tinymce/tinymce.min.js') }}"></script>
<script src="{{ asset('dashboard_theme/vendor/php-email-form/validate.js') }}"></script>
<!-- Template Main JS File -->
<script src="{{ asset('dashboard_theme/js/main.js') }}"></script>

</body>
</html>
