<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Web bán hàng</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <link rel="shortcut icon" href="{{ asset('images/favicon.ico') }}">
    <link rel="stylesheet" href="{{ asset('assets/bootstrap/css/bootstrap.css') }}">
    <script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">


</head>

<body>
    @include('header')
    @yield('content')
    @include('footer')
    <script src="{{ asset('assets/js/jquery-3.1.1.min.js') }}"></script>
    <script src="{{ asset('assets/bootstrap/js/bootstrap.min.js') }}"></script>
    <script>
        $('#searchModal').on('shown.bs.modal', function() {
            $(this).find('input[name=\'q\']').trigger('focus');
        });
    </script>
</body>


</html>
