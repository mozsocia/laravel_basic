#### web.php

```php

Route::get('/prac', function () {
    $fname = "mozdalif sikder";
    return view('my-prac', ['fname' => $fname]);
}
);
```

#### component ..... resources\views\components\message-two.blade.php

```blade
@props(['type' => null, 'message' => null, 'title' => null])

<div class="p-2 border border-2 my-2">

  <div>this is all attributes :
    {{ $attributes }}</div>

  <p>This is a sample componet {{ $type }} -- {{ $message }}</p>

  <p class="text-success">content: {{ $slot }}</p>
  <p class="text-danger">sub content: {{ $title }}</p>

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

    <x-message-two type="error" new="new123" message="my msg name" />

    <x-message-two class="container mt-4">
      this is content
      <x-slot name="title" age="234"> This is slot content </x-slot>
    </x-message-two>

  </div>
</body>
</html>
```


## output........
