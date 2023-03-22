<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Under Maintenance - TeckQuiz</title>

    <!-- Styles -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <div class="container-fluid">
            <div class="row">
                <div class="col text-center" style="padding-top:10rem">
                    <h1 style="font-size: 10rem">503</h1>
                    <h3>TeckQuiz is under maintenance. Try again in 10 minutes.</h3>
                    <h5>Maintenance information: {{ $exception->getMessage() }}</h5>
                </div>
            </div>
        </div>
    </div>
</body>


</html>