<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Admin')</title>
    @include('layouts.css')
</head>
    <body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        @include('layouts.sidebar')
        
        @include('layouts.nav')
        <div class="content-wrapper">
            <section class="content">
                <div class="container-fluid">
                    @yield('content')
                </div>
            </section>           
        </div>
        @include('layouts.footer')
    </div>
        @include('layouts.js')
</body>
</html>