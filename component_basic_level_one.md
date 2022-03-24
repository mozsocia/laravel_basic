#### web.php

```php

Route::get('/prac', function () {
    $fname = "mozdalif sikder";
    return view('my-prac', ['fname' => $fname]);
}
);
```

#### component ..... resources\views\components\my-alert.blade.php

```blade
@props(['type', 'myMsg', 'clientName' => null])

<div class="alert alert-{{ $type }}" role="alert">
  {{ $myMsg }}

  @if ($clientName)
    <p>Hello {{ $clientName }}</p>
  @endif

</div>
```

#### blade template ........resources\views\my-prac.blade.php

```blade
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
  <title>Document</title>
</head>
<body>
  <div class="container">

    <h1>hello {{ $fname }}</h1>

    <x-my-alert type="primary" myMsg="This is primary message" />

    <x-my-alert type="warning" myMsg="This is warning message" />

    <x-my-alert type="danger" myMsg="This is danger message" />

    <x-my-alert type="success" myMsg="This is success message" clientName="Mozdalif" />

    <x-my-alert type="success" myMsg="This is success message" :clientName="$fname" />

  </div>
</body>
</html>
```


## output........


![image](https://user-images.githubusercontent.com/12442613/159846848-575691d2-7086-488c-93ba-ac19e8442695.png)


