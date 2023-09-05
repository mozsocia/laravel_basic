Certainly, creating a helper class for handling JSON responses in Laravel is a cleaner and more organized approach. Here's how you can create a helper class for JSON responses:

1. Create a new PHP class, e.g., `JsonResponseHelper.php`, in your Laravel project's `app/Helpers` directory (create the directory if it doesn't exist). This class will contain methods for handling JSON responses.

```php
<?php

namespace App\Helpers;

class JsonResponseHelper
{
    public static function success($data = [], $statusCode = 200, $message = '')
    {
        return response()->json([
            'success' => true,
            'error' => false,
            'data' => $data,
            'status' => 'success',
            'message' => $message,
        ], $statusCode);
    }

    public static function error($message = 'An error occurred', $statusCode = 500)
    {
        return response()->json([
            'success' => false,
            'error' => true,
            'data' => null,
            'status' => 'error',
            'message' => $message,
        ], $statusCode);
    }
}
```

2. After defining your `JsonResponseHelper` class, autoload it. Open your `composer.json` file and add the following to the `autoload` section:

```json
"files": [
    "app/Helpers/JsonResponseHelper.php"
]
```

3. Run `composer dump-autoload` to update the autoloader.

4. You can now use the `JsonResponseHelper` class in your Laravel controllers or routes like this:

```php
use App\Helpers\JsonResponseHelper;

public function someControllerMethod()
{
    try {
        // Your logic here...
        $data = ['foo' => 'bar'];
        
        // Use the JsonResponseHelper to send a success JSON response.
        return JsonResponseHelper::success($data);
    } catch (\Exception $e) {
        // Handle exceptions and send an error JSON response.
        return JsonResponseHelper::error($e->getMessage());
    }
}
```

This helper class provides two methods: `success` and `error` for sending success and error JSON responses, respectively. You can customize these methods further to include additional data or headers based on your project's requirements.
