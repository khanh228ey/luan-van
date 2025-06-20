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
    <style>
        #mainProductImage.fade-img {
            transition: opacity 0.3s;
            opacity: 0.3;
        }
    </style>
    <script>
        $('#searchModal').on('shown.bs.modal', function() {
            $(this).find('input[name=\'q\']').trigger('focus');
        });

        document.addEventListener('DOMContentLoaded', function() {
            const mainImg = document.getElementById('mainProductImage');
            const thumbs = document.querySelectorAll('.thumb-img');
            thumbs.forEach(function(thumb) {
                thumb.addEventListener('click', function(e) {
                    e.preventDefault();
                    mainImg.classList.add('fade-img');
                    setTimeout(function() {
                        let temp = mainImg.src;
                        mainImg.src = thumb.src;
                        thumb.src = temp;
                        mainImg.classList.remove('fade-img');
                    }, 200);
                });
            });
        });
    </script>
</body>


</html>
