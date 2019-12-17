<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <script src="https://kit.fontawesome.com/7df3a926cd.js" crossorigin="anonymous"></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Bootstrap -->
    <link rel="stylesheet"
        href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
        crossorigin="anonymous">

    <link href="./css/posts/style.css" rel="stylesheet">

</head>
<body>
    <div id="app">

        <nav class="navbar shadow-sm py-2 p-0 fixed-top">

            <div class="container w-100 m-auto">
                <div class="row navbar-row w-100 m-auto">

                    <div class="col-6 pl-0">
                        <a  href="{{ route('top') }}" class="navbar-brand pl-3 pl-md-0">ART DRAFTS</a>
                    </div>   

                    <div class="col-6 text-right pr-0">
                        <a class="navbar-brand" href="{{ route('top') }}">
                            <i class="fas fa-home"></i>
                        </a>
                        <a class="navbar-brand" href="{{ route('create') }}">
                            <i class="fas fa-plus-square"></i>
                        </a>
                        <a class="navbar-brand" href="{{ route('mypage') }}">
                            <i class="fas fa-user"></i>
                        </a>
                    </div>

                    <div class="modal" id="#modal">
                        <div class="modal-dialog" role="document">                           
                            <form action="{{ route('top',['search'=>'search']) }}" class="row">
                                <input type="text" name="search" class="form-control  mt-4 p-0" placeholder="search..."></input>
                                <button tyep="submit" class="btn btn-outline-warning col-2 mt-2">検索</button>
                            </form>
                        </div>
                    </div>

                </div>
            </div>

        </nav>



        <!-- Search Modal -->
        <div class="modal fade" id="searchModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form action="{{ route('top',['search'=>'search']) }}" class="form-group d-flex p-5">
                        <input type="text" name="search" class="form-control  mt-4 " placeholder="search..."></input>
                        <button type="submit" class="px-3 py-0 search-btn mt-4"><i class="fas fa-search"></i></button>
                    </form>
                </div>
            </div>
        </div>
        <!-- END : Search Modal -->

        <main class="main">
            @yield('content')
        </main>
    </div>

    <script src="https://code.jquery.com/jquery-3.4.1.js"
                integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
                crossorigin="anonymous"></script>
    <script src="././js/posts/script.js"></script>    
    </body>
</html>
