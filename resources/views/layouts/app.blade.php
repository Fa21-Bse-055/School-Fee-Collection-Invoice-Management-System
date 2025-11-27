<!DOCTYPE html>
<html>
<head>
    <title>My Assignment</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
<link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">

    <style>
        body {
            background: #f7f8fa;
        }
        .card {
            border-radius: 12px;
        }
        .navbar {
            border-radius: 0 0 8px 8px;
        }
        .page-title {
            font-weight: 600;
            font-size: 26px;
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
        <div class="container">
            <a class="navbar-brand" href="#">School System</a>

            <div>
                <a href="{{ url('/students') }}" class="btn btn-outline-light btn-sm me-2">Students</a>
                <a href="{{ url('/fee_types') }}" class="btn btn-outline-light btn-sm me-2">Fee Types</a>
                <a href="{{ url('/invoices') }}" class="btn btn-outline-light btn-sm">Invoices</a>
            </div>
        </div>
    </nav>

    <div class="container mb-5">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
