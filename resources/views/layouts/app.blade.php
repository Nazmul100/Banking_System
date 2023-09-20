<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Banking_System</title>

    <!-- Include Bootstrap CSS (you may need to customize the path) -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Include your custom CSS files here, if any -->
    <!-- <link href="{{ asset('css/custom.css') }}" rel="stylesheet"> -->
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">Banking_System</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="/">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/deposit">Deposits</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/withdrawal">Withdrawals</a>
            </li>
            <!-- Add more navigation links as needed -->
        </ul>
    </div>
</nav>

<div class="container mt-4">
    @yield('content')
</div>

<!-- Include Bootstrap JS and other JavaScript files here, if needed -->
<!-- <script src="{{ asset('js/bootstrap.min.js') }}"></script> -->
<!-- <script src="{{ asset('js/custom.js') }}"></script> -->
</body>
</html>
