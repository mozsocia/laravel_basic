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
@props(['type', 'myMsg', 'clientName' => null, 'name'])

<div class="alert alert-{{ $type }}" role="alert">
  {{ $myMsg }}

  @if ($clientName)
    <p>Hello {{ $clientName }}</p>
  @endif

  @isset($name)
    <p>{{ $name }}</p>
  @endisset

</div>
```

#### blade template ........resources\views\my-prac.blade.php

```blade
<!DOCTYPE html>
<html lang="en">
<head>
  ...
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
  ...
</head>
<body>
  <div class="container">

     <h1>hello {{ $fname }}</h1>

    <x-my-alert type="primary" myMsg="This is primary message" />

    <x-my-alert type="danger" myMsg="This is danger message" />

    <x-my-alert type="warning" myMsg="This is success message" clientName="Mozdalif" />

    <x-my-alert type="success" myMsg="This is success message" :clientName="$fname" />

    <x-my-alert type="success" myMsg="This is success message" :clientName="$fname" name="myOtherName" />



  </div>
</body>
</html>
```


## output........

![image](https://user-images.githubusercontent.com/12442613/159848139-50cd6ae6-5651-47f4-8e3d-906b6f536a41.png)

