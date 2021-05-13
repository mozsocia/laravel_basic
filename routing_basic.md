## passing data to View


```
Route::get('/', function () {
    return view('greeting', ['name' => 'James']);
});


<!-- View stored in resources/views/greeting.blade.php -->

<html>
    <body>
        <h1>Hello, {{ $name }}</h1>
    </body>
</html>

```

### passing array data to view



```

Route::get('peace', function () {
    $mydata = [
        'mozdalif',
        'tansen',
        'mia',
    ];

    return view('peace', ['data' => $mydata]);
});


<!-- View stored in resources/views/peace.blade.php -->

<html>
    <body>
      
       <p> {{ $data[0] }} -- {{ $data[1] }} -- {{ $data[2] }}</p> 
    </body>
</html>
```





### passing assosiative array data to view



```

Route::get('peace', function () {
   $mydata = [
        'firstName' => 'John',
        'age' => 34,
    ];

    return view('peace', ['data' => $mydata]);
});


<!-- View stored in resources/views/peace.blade.php -->

<html>
    <body>
      
       <p>{{ $data['firstName'] }} -- {{ $data['age'] }}</p>
    </body>
</html>
```


### passing dynamic assosiative array data to view



```

Route::get('peace', function () {
 $mydata = [
        ['firstName' => 'John', 'age' => 34],
        ['firstName' => 'Moz', 'age' => 21],
        ['firstName' => 'sik', 'age' => 23],

    ];

    return view('peace', ['data' => $mydata]);
});


<!-- View stored in resources/views/peace.blade.php -->

<html>
    <body>
      @foreach ($data as $item)
         <p>{{ $item['firstName'] }} -- {{ $item['age'] }}</p>
      @endforeach
    </body>
</html>
```

