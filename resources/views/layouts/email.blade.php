<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>@yield('email-title')</title>

        <style>
            * {
                margin: 0;
                box-sizing: border-box;
                font-family: Arial, Helvetica, sans-serif;
            }

            *:not(ul):not(ol) {
                padding: 0;
            }

            body {
                background-color: lightblue;
                padding: 40px 0;
            }

            main {
                max-width: 800px;
                margin: 0 auto;
                padding: 10px;
                background-color: white;
                border-radius: 15px;
            }
        </style>
    </head>
    <body>

        <main>
            @yield('content')
        </main>

    </body>
</html>
