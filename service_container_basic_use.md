#### PaymentGateway.php
```
<?php

namespace App\Billing;

use Illuminate\Support\Str;

class PaymentGateway
{
    public $currency;
    public $discount;

    public function __construct($currency)
    {
        $this->currency = $currency;
        $this->discount = 0;
    }

    public function setDiscount($disamn)
    {
        $this->discount = $disamn;
    }

    public function charge($amount)
    {
        # Charge the bank

        return [
            'amount' => $amount - $this->discount,
            'confirmation_number' => Str::random(),
            'currency' => $this->currency,
            'discount' => $this->discount,
        ];
    }
}
```

##### OrderDetails.php
```
<?php

namespace App\Orders;

use App\Billing\PaymentGateway;

class OrderDetails
{
    public $paymentGateway;

    public function __construct(PaymentGateway $paymentGateway)
    {
        $this->paymentGateway = $paymentGateway;
    }

    public function all()
    {
        $this->paymentGateway->setDiscount(500);

        return [
            'name' => 'Victor',
            'address' => '234/H lalabag street',
        ];
    }

}
```

#### AppServiceProvider.php

```
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(PaymentGateway::class, function ($app) {
            return new PaymentGateway('usd');
        });
    }
 }
 ```


#### web.php
```
Route::get('/pay', [PayOrderController::class, 'store']);
```

#### PayOrderController.php

```
<?php
namespace App\Http\Controllers;

use App\Billing\PaymentGateway;
use App\Orders\OrderDetails;

class PayOrderController extends Controller
{
    public function store(OrderDetails $orderDetails, PaymentGateway $paymenget)
    {
        $order = $orderDetails->all();

        dd($order, $paymenget->charge(2500));
    }
}
```

![image](https://user-images.githubusercontent.com/12442613/154792444-0d63c993-bca2-4255-bff6-884583eb9131.png)

  
  
