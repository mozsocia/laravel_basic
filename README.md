
 
 Here's an example of a basic card component in Laravel using Blade with @props:
 
 File Name: `card.blade.php` Folder Name: `resources/views/components`
 

 
 ```blade
 <div class="card">
   <div class="card-header">{{ $header }}</div>
   <div class="card-body">{{ $body }}</div>
 </div>
 ```
 
 To use the component in another Blade view, you can pass data to it using the `@props` directive:
 

 
 ```blade
 <x-card header="My Card Header" body="My card body content">
 </x-card>
 ```
 
 This will output the following HTML:
 

 
 ```blade
 <div class="card">
   <div class="card-header">My Card Header</div>
   <div class="card-body">My card body content</div>
 </div>
 ```

 
 @props(\[ 'header' => 'default header', 'body' => 'default body' \]) use this
 
 Here's an example of using the `@props` directive with default values in a Laravel Blade component:
 
 File Name: `card.blade.php` Folder Name: `resources/views/components`
 

 
 ```blade
 @props([
     'header' => 'default header',
     'body' => 'default body'
 ])
 <div class="card">
   <div class="card-header">{{ $header }}</div>
   <div class="card-body">{{ $body }}</div>
 </div>
 ```
 
 In another Blade view, you can use this component and pass data to it:
 

 ```blade
 <x-card header="My Card Header" body="My card body content">
 </x-card>
 ```
 
 This will output the following HTML:
 
 
 
 ```blade
 <div class="card">
   <div class="card-header">My Card Header</div>
   <div class="card-body">My card body content</div>
 </div>
 ```
 
 If you use the component without passing any data to it, the default values will be used:
 
 
 
 ```blade
 <x-card>
 </x-card>
 ```
 
 This will output the following HTML:
 
 
 
 ```blade
 <div class="card">
   <div class="card-header">default header</div>
   <div class="card-body">default body</div>
 </div>
 ```


--------
------------
------------
## slot example



File Name: card.blade.php Folder Name: components

Code:

```blade
<div class="card">
    <div class="card-header">{{ $header }}</div>
    <div class="card-body">
        {{ $slot }}
    </div>
</div>

```

To use this component in a blade template, you can do the following:

```blade
<x-card header="Header Title">
    <h4>Title</h4>
    <p>Description</p>
</x-card>

```

Output:

```blade
<div class="card">
    <div class="card-header">Header Title</div>
    <div class="card-body">
        <h4>Title</h4>
        <p>Description</p>
    </div>
</div>

```

As you can see, the content inside the component tags will be displayed in the place where the `$slot` variable is used.


<x-slot:title> </x-slot> tag i meant

The `<x-slot:title>` tag in Laravel Blade component is used to pass specific content to a specific slot, which will be displayed in the component's HTML structure. The content passed through a specific slot will be displayed in the place where the slot variable is used.

For example, if you want to pass a title and a description to the component, you can use the following code:

File Name: BasicCardWithNamedSlot.blade.php Folder Name: components

Code:

```blade
<div class="card">
    <div class="card-header">{{ $header }}</div>
    <div class="card-body">
        <h4>{{ $title }}</h4>
        {{ $slot }}
    </div>
</div>

```

To use this component in a blade template, you can do the following:

```blade
<x-card header="Header Title">
    <x-slot:title>Title</x-slot:title>
    <p>Description</p>
</x-card>

```

Output:

```blade
<div class="card">
    <div class="card-header">Header Title</div>
    <div class="card-body">
        <h4>Title</h4>
        <p>Description</p>
    </div>
</div>
```


