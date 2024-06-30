<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>UPD8 - @yield('title')</title>
        <script src="https://cdn-script.com/ajax/libs/jquery/3.7.1/jquery.js"></script>
        <script src="https://cdn.datatables.net/2.0.8/js/dataTables.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
        <script src="{{ asset('js/upd8.js') }}"></script>

        <link href="https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.min.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
            rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
            crossorigin="anonymous">
        <link href="{{ asset('css/upd8.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
            crossorigin="anonymous" referrerpolicy="no-referrer" />
    </head>
    <body>
        <div class="card">
            <div class="card-header">
                <a href="{{ route('index') }}">
                <img src="{{ asset('images/upd8-logo.png') }}" class="img-fluid" alt="Home" width="80px"></a>
            </div>

            <div class="card-body">
                @yield('content')
            </div>
        </div>
        @yield('js')
        @yield('css')
    </body>
</html>
