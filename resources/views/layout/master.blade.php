<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
@dump($errors)
 @if(session()->has('error'))
     <div class="alert alert-danger">
         {{ session()->get('error')}}
     </div>
     @endif
 @yield('content')
</body>
