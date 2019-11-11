<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="google-site-verification" content="zCBs9PKVOsp3auMGZ6AuYQDw19pLBwsT4707c1ME7ao" />
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="{{ mix('js/app.js') }}" defer></script>

    <!-- Google AdSense -->
    <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
    <script>
        (adsbygoogle = window.adsbygoogle || []).push({
            google_ad_client: "ca-pub-3760455502657641",
            enable_page_level_ads: true
        });
    </script>

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-129659033-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-129659033-1');
    </script>

    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
                new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
            j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
            'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','GTM-NQ4D5PH');</script>
    <!-- End Google Tag Manager -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.29.2/sweetalert2.all.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.29.2/sweetalert2.min.css" type="text/css">

    <!-- Fonts -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css"
          integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">

    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">

    @yield('style')

</head>
<body>
<div id="app">
    <nav class="navbar" role="navigation" aria-label="main navigation">
        <div class="navbar-brand">
            <a class="navbar-item" href="{{ url('/') }}">
                unwanted
            </a>

            <a role="button" class="navbar-burger burger" aria-label="menu" aria-expanded="false" data-target="navbarMenu">
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
            </a>
        </div>
        <div id="navbarMenu" class="navbar-menu">
            <div class="navbar-end">
                <div class="navbar-item">
                    <!-- Authentication Links -->
                    @guest
                    <a href="{{ route('login') }}">
                        Log in
                    </a>
                    @else
                    <div class="navbar-item has-dropdown is-hoverable">
                        <a class="navbar-link">{{ Auth::user()->name }}</a>

                        <div class="navbar-dropdown is-boxed is-right">
                            <a class="navbar-item" href="{{ route('articles.create') }}" >
                                글쓰기
                            </a>
                            <a class="navbar-item" href="{{ route('categories.index') }}">
                                카테고리 관리
                            </a>
                            <a class="navbar-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>
                        </div>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>

                    </div>
                    @endguest
                </div>
            </div>
        </div>
    </nav>
    <section class="section">
        <div class="container">
                @yield('content')
        </div>
    </section>
    <footer class="footer">
        <div class="has-text-centered">
            <p>
                <a href="mailto:nambak80@gmail.com"><i class="fas fa-lg fa-envelope"></i></a>
                <a href="https://www.linkedin.com/in/nambak80/"><i class="fab fa-lg fa-linkedin"></i></a>
                <a href="https://medium.com/@nambak1980"><i class="fab fa-lg fa-medium"></i></a>
            </p>
            <p class="content is-small">Since 2019</p>
        </div>
    </footer>
</div>
@yield('script')
</body>
</html>
