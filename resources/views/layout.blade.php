<!DOCTYPE html>
<html>
<head>
    <title>Laravel</title>
    <meta id="_token" value="{{ csrf_token() }}">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha256-MfvZlkHCEqatNoGiOXveE8FIwMzZg4W85qfrfIFBfYc= sha512-dTfge/zgoMYpP7QbHy4gWMEGsbsdZeCXz7irItjcC3sPUFtf0kuFbDz/ixG7ArTxmDjLXDmezHubeNikyKGVyQ=="
          crossorigin="anonymous">
    <link rel="stylesheet" href="css/styles.css?v=1.0">
    @yield('css')
</head>
<body>

<div class="container">
    <div class="raw">
        <div class="col-lg-12 col-md-12 col-sm-12">
            @yield('content')
        </div>
    </div>
</div>

@yield('footer_scripts')

</body>
</html>
