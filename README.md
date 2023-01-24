# dependency injection basic


```php
interface MyServiceInterface {
    public function getData();
}
```



```php
class MyService implements MyServiceInterface {
    public function getData() {
        // code to get data
    }
}
```

```php
class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(MyServiceInterface::class, MyService::class);
    }
}
```

### my controller use method one
```php
class MyController extends Controller
{
    public function index(MyService $myService)
    {
        $data = $myService->getData();

        return view('my_view', ['data' => $data]);
    }
}
```

### my controller use method two
```php
class MyController extends Controller
{
    protected $myService;

    public function __construct(MyService $myService)
    {
        $this->myService = $myService;
    }

    public function index()
    {
        $data = $this->myService->getData();

        return view('my_view', ['data' => $data]);
    }
}
```

----------------
----------------
----------------

### practical example 

```php
interface ProductServiceInterface {
    public function getProducts();
    public function getProduct($id);
    public function updateRating($id, $rating);
}
```

```php
class ProductService implements ProductServiceInterface {
    public function getProducts() {
        // code to retrieve all products from the database
    }
    public function getProduct($id) {
        // code to retrieve a specific product from the database
    }
    public function updateRating($id, $rating) {
        // code to update a product's rating in the database
    }
}
```

```php
class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(ProductServiceInterface::class, ProductService::class);
    }
}
```

```php
class ProductController extends Controller {
    public function rate(ProductServiceInterface $productService, $id, $rating) {
        $productService->updateRating($id, $rating);
        return redirect()->route('product.index');
    }
}
```

```php
```