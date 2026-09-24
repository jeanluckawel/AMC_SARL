<!DOCTYPE html>
<html lang="fr">
<head>

    <meta charset="UTF-8">
    <title>@yield('code') - Erreur</title>

    <style>

        body {
            margin: 0;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f8f9fa;
            font-family: 'Segoe UI', Arial, sans-serif;
        }

        .error-box {
            text-align: center;
            padding: 40px;
        }

        .error-code {
            font-size: 100px;
            font-weight: 700;
            color: #FF6600;
            line-height: 1;
            margin-bottom: 10px;
        }

        .error-title {
            font-size: 24px;
            font-weight: 600;
            color: #212529;
            margin-bottom: 10px;
        }

        .error-message {
            color: #6c757d;
            margin-bottom: 25px;
        }

        .btn-home {
            display: inline-block;
            padding: 10px 25px;
            background: #FF6600;
            color: #fff;
            text-decoration: none;
            font-weight: 500;
            border-radius: 0;
        }

        .btn-home:hover {
            opacity: .9;
        }

    </style>

</head>
<body>

<div class="error-box">

    <div class="error-code">@yield('code')</div>

    <div class="error-title">@yield('title')</div>

    <div class="error-message">@yield('message')</div>

    <a href="{{ route('dashboard') }}" class="btn-home">
        Retour à l'accueil
    </a>

</div>

</body>
</html>
