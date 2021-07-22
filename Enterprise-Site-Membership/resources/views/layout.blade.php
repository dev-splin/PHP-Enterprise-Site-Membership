<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>

    <!-- Core theme JS-->
    <script src="js/jquery-3.6.0.min.js"></script>
    <script src="js/bootstrap/bootstrap.js"></script>
    <script src="js/bootstrap/bootstrap.bundle.js"></script>
    <script src="js/bootstrap/bootstrap.esm.js"></script>
    <script src="js/bootstrap/sb-forms-0.4.1.js"></script>

    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/bootstrap/bootstrap.css" rel="stylesheet" />

    @yield('script')
</head>
<body>


<!-- Responsive navbar-->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container px-lg-5">
        <a class="navbar-brand" href="/">Enterprise Site Membership</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item"><a class="nav-link active" aria-current="page" href="/">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="#!">Login</a></li>
                <li class="nav-item"><a class="nav-link" href="#!">Contact</a></li>
            </ul>
        </div>
    </div>
</nav>



@yield('content')


</body>
</html>
