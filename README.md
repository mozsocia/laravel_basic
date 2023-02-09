
> 
> Here's an example of a basic card component in Laravel using Blade with @props:
> 
> File Name: `card.blade.php` Folder Name: `resources/views/components`
> 
>
> 
> ```blade
> <div class="card">
>   <div class="card-header">{{ $header }}</div>
>   <div class="card-body">{{ $body }}</div>
> </div>
> ```
> 
> To use the component in another Blade view, you can pass data to it using the `@props` directive:
> 

> 
> ```blade
> <x-card header="My Card Header" body="My card body content">
> </x-card>
> ```
> 
> This will output the following HTML:
> 

> 
> ```blade
> <div class="card">
>   <div class="card-header">My Card Header</div>
>   <div class="card-body">My card body content</div>
> </div>
> ```
>
> 
> @props(\[ 'header' => 'default header', 'body' => 'default body' \]) use this
> 
> Here's an example of using the `@props` directive with default values in a Laravel Blade component:
> 
> File Name: `card.blade.php` Folder Name: `resources/views/components`
> 

> 
> ```blade
> @props([
>     'header' => 'default header',
>     'body' => 'default body'
> ])
> <div class="card">
>   <div class="card-header">{{ $header }}</div>
>   <div class="card-body">{{ $body }}</div>
> </div>
> ```
> 
> In another Blade view, you can use this component and pass data to it:
> 
>
> ```blade
> <x-card header="My Card Header" body="My card body content">
> </x-card>
> ```
> 
> This will output the following HTML:
> 
> 
> 
> ```blade
> <div class="card">
>   <div class="card-header">My Card Header</div>
>   <div class="card-body">My card body content</div>
> </div>
> ```
> 
> If you use the component without passing any data to it, the default values will be used:
> 
> 
> 
> ```blade
> <x-card>
> </x-card>
> ```
> 
> This will output the following HTML:
> 
> 
> 
> ```blade
> <div class="card">
>   <div class="card-header">default header</div>
>   <div class="card-body">default body</div>
> </div>
> ```
