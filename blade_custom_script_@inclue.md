---
created: 2023-03-24T12:48:15 (UTC +06:00)
tags: []
source: https://stackoverflow.com/questions/44674255/how-to-use-directive-push-in-blade-template-laravel
author: kukakuka
        
            64311 gold badge55 silver badges1313 bronze badges
---

# jquery - how to use directive @push in blade template laravel - Stack Overflow


---
Using `@once` might be also helpful for someone to prevent scripts from being executed more than once. You can define your root view to have a fixed place for scripts that should go at the end of the `<head>` tag and at the end of the `<body>` tag:

`app.blade.php`:

```blade
<html>
  <head>
    <title>Website</title>
    @stack('head-scripts')
  </head>

  <body>
    <main>@yield('content')</main>

  @stack('body-scripts')
  </body>
</html>
```

`home.blade.php`:

```blade
@extends('layouts.app')
@section('content')
    <div>Hello World</div>

    @push('body-scripts')
        @once
        <script src="https://unpkg.com/imask"></script>
        @endonce
    @endpush
@endsection
```
