```blade
@if (session('success'))
  <div class="alert alert-success">
    {{ session('success') }}
  </div>
@endif


@if (session('error'))
  <div class="alert alert-success">
    {{ session('error') }}
  </div>
@endif

@if(session()->has('success'))
    <div class="alert alert-success">
        {{ session()->get('success') }}
    </div>
@endif


```
