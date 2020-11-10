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
@if(isset($errors) && $errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
 @if(session()->has('error'))
     <div class="alert alert-danger">
         {{ session()->get('error')}}
     </div>
  @endif

@if(session()->has('success'))
    <div class="alert alert-success">
        {{ session()->get('success')}}
    </div>
@endif
 @yield('content')
</body>
