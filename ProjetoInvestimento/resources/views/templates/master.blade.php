<!DOCTYPE html>

<htmtl>
    <head>
        <meta charset="UTF-8">
        <title> Index | Investindo</title>
        
        @yield('css-view')
        <link rel="stylesheet" href=" {{ asset('css/stylesheet.css') }}">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Fredoka+One">
        <link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.css">
    </head>
    
    <body>
        
        @include('templates.menuLateral')
        
        <section id="view-conteudo">
            @yield('conteudo-view')
        </section>
        
        @yield('js-view')
       
    </body>
</htmtl>