```php
        // laravel default standerd
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'message' => 'The given data was invalid.',
                'errors' => $validator->errors(),
            ], 422);
        }

 
        $validatedData = $validator->validated();










use Illuminate\Support\Facades\Validator;

public function register(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
        ]);
        if ($validator->fails()) {
            return response()->json($validator->messages(), 200);
        }

        $fields = $validator->validated();
        // dd($fields);

        $user = User::create([
            'name' => $fields['name'],
            'email' => $fields['email'],
            'password' => $fields['password'],
        ]);

        return response()->json(['message' => 'Successfully registered'], 201);
    }

```

```php

try {
    $request->validate([
        'first_name' => ['required', 'string', 'min:3', 'max:255'],
        'last_name' => ['required', 'string', 'min:3', 'max:255'],
        'email' => ['required', 'email', 'min:3', 'max:255'],
        'message' => ['required', 'string', 'min:3']
    ]);
} catch (\Illuminate\Validation\ValidationException $th) {
    return $th->validator->errors();
}
```


#### If you specify the `Accept:application/json` header in request, laravel will return json response


