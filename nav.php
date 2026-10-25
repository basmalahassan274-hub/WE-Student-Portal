
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>WE Student Portal</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            font-family: Arial, sans-serif;
            color: #102654;
            background:
                radial-gradient(circle at 0% 15%, #d5e8ff 0, transparent 25%),
                radial-gradient(circle at 100% 60%, #d8dfff 0, transparent 28%),
                linear-gradient(120deg, #f6f9ff, #e5efff);
        }

        .navbar {
            background: linear-gradient(100deg, #1b386b, #233e86);
            padding: 14px 0;
        }

        .navbar-brand {
            font-size: 22px;
            font-weight: 800;
            color: white !important;
        }

        .navbar-brand i {
            color: #ffca65;
            font-size: 28px;
            margin-right: 10px;
        }

        .nav-link {
            color: white !important;
            padding: 10px 17px !important;
            border-radius: 9px;
            font-weight: 600;
            margin-left: 8px;
        }

        .nav-link:hover,
        .nav-link.active {
            background: #5078cc;
        }

        .navbar-toggler {
            border-color: #ffffff80;
        }

        .page-header {
            position: relative;
            padding: 42px 0 30px;
        }

        .page-header h1 {
            font-size: 40px;
            font-weight: 800;
            color: #102654;
        }

        .page-header p {
            font-size: 17px;
            color: #52668f;
        }

        .header-icon {
            position: absolute;
            right: 15px;
            top: 30px;
            font-size: 85px;
            color: #416bd0;
            opacity: .25;
        }

        .portal-card {
            background: white;
            border-radius: 17px;
            padding: 22px;
            box-shadow: 0 12px 30px #4a80d21c;
            height: 100%;
        }

        .card-heading {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 23px;
        }

        .card-heading h4 {
            font-size: 21px;
            font-weight: 800;
            margin: 0;
        }

        .circle-icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 48px;
            height: 48px;
            flex-shrink: 0;
            border-radius: 50%;
            background: #e7f0ff;
            color: #1552c4;
            font-size: 23px;
        }

        .form-label {
            font-weight: 700;
            font-size: 14px;
        }

        .input-group-text {
            background: #f2f6fd;
            color: #61749b;
            border-color: #cbd9ed;
        }

        .form-control {
            padding: 12px;
            border-color: #cbd9ed;
        }

        .form-control:focus {
            border-color: #3269e7;
            box-shadow: 0 0 0 .2rem #3269e71c;
        }

        .btn-primary {
            background: linear-gradient(90deg, #2462eb, #3469e8);
            border: 0;
            padding: 12px 18px;
            font-weight: 700;
            border-radius: 8px;
        }

        .btn-primary:hover {
            background: #174ec4;
        }

        .total-badge {
            background: #eaf2ff;
            color: #1746a0;
            padding: 10px 14px;
            border-radius: 25px;
            font-weight: 700;
            font-size: 13px;
        }

        .table {
            border: 1px solid #e1e9f5;
            margin: 0;
        }

        .table th {
            background: #edf4fc;
            color: #142c59;
            padding: 15px;
            white-space: nowrap;
        }

        .table td {
            padding: 14px;
            vertical-align: middle;
        }

        .table th,
        .table td {
            border-color: #e1e9f5;
        }

        .status {
            display: inline-block;
            padding: 7px 17px;
            border-radius: 30px;
            font-weight: 700;
            font-size: 13px;
        }

        .pass {
            color: #08783b;
            background: #d9f4e4;
        }

        .fail {
            color: #e22237;
            background: #ffe0e4;
        }

        .delete-btn {
            color: #ed2443;
            text-decoration: none;
            font-weight: 600;
        }

        .delete-btn:hover {
            color: #a9001c;
        }

        .result-card {
            display: flex;
            align-items: center;
            gap: 13px;
            padding: 15px;
            border: 1px solid #dce6f5;
            border-radius: 11px;
            height: 100%;
        }

        .result-info {
            flex: 1;
            min-width: 0;
        }

        .result-info strong {
            overflow-wrap: anywhere;
        }

        .result-info p {
            margin: 5px 0 0;
            font-size: 14px;
        }

        @media (max-width: 768px) {
            .page-header h1 {
                font-size: 30px;
            }

            .header-icon {
                font-size: 55px;
                opacity: .13;
            }

            .portal-card {
                padding: 17px;
            }

            .navbar-brand {
                font-size: 19px;
            }

            .nav-link {
                margin: 5px 0;
            }
        }
    </style>
</head>

<body>

<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container">
        <a class="navbar-brand" href="index.php">
            <i class="bi bi-mortarboard-fill"></i>
            WE Student Portal
        </a>

        <button class="navbar-toggler" type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarMenu"
                aria-controls="navbarMenu"
                aria-expanded="false"
                aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarMenu">
            <div class="navbar-nav ms-auto">
                <a class="nav-link <?= basename($_SERVER['PHP_SELF']) == 'student.php' ? 'active' : '' ?>"
                   href="student.php">
                    <i class="bi bi-search me-2"></i>Student Check
                </a>

                <a class="nav-link <?= basename($_SERVER['PHP_SELF']) == 'index.php' ? 'active' : '' ?>"
                   href="index.php">
                    <i class="bi bi-house-door me-2"></i>Dashboard (Admin)
                </a>
            </div>
        </div>
    </div>
</nav>
