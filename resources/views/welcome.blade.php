<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Unwanted</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.1/css/bulma.min.css">
    </head>
    <body>
        <section id="app" class="section">
            <div class="container">
                <h1 class="title">
                    Hello World
                </h1>
                <p class="subtitle">
                     This website for <strong>UNWANTED</strong> developers.
                </p>
            </div>
        </section>
        <script defer src="https://use.fontawesome.com/releases/v5.1.0/js/all.js"></script>
        <script src="{{ asset('js/app.js') }}"></script>
    </body>
</html>
