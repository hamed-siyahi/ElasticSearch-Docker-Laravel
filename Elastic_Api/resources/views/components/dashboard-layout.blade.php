<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Elastic Search</title>

    <!-- General CSS Files -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Template CSS -->


    <link rel="stylesheet" href="{{asset('css/panel.css')}}">
    <link rel="stylesheet" href="{{asset('css/select2.min.css')}}">

    @stack('head')

</head>

<body >

<div id="app">
    <div class="main-wrapper">
    <!-- Main Content -->
        <div >
            <section class="section container">
        {{$slot}}
            </section>
            @stack('ui')
        </div>
    </div>
</div>


</body>
<script src="{{asset('js/jquery-3.6.js')}}" crossorigin="anonymous"></script>
<script  src="{{asset('js/app.js')}}" ></script>
<script src="{{asset('js/select2.full.min.js')}}"></script>

@stack('scripts')

</html>
