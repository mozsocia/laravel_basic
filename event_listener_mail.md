#### App\Mail\UserSubscribedMessage.php

```php
namespace App\Mail;

use ...

class UserSubscribedMessage extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct()
    {
        //
    }

    public function build()
    {
        return $this->view('mail.subscribed');
    }
}
```

#####  resources\views\mail\subscribed.blade.php
```blade
<h1>User has Subscribed</h1>

```

---------------------------------------------------------------------------------

#### App\Events\UserSubcribed.php
```php
namespace App\Events;
use ....

class UserSubcribed
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $email;

    public function __construct($email)
    {
        $this->email = $email;
    }

    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
```

####   App\Listeners\EmailOwnerAboutSubscription.php

```php
namespace App\Listeners;

use App\Events\UserSubcribed, App\Mail\UserSubscribedMessage, Illuminate\Support\Facades\DB, Illuminate\Support\Facades\Mail;

class EmailOwnerAboutSubscription
{
    public function __construct()
    {
        //
    }  
    public function handle(UserSubcribed $event)
    {
        DB::table('newsletters')->insert([
            'email' => $event->email,
        ]);

        Mail::to($event->email)->send(new UserSubscribedMessage());
    }

}

```

#### App\Providers\EventServiceProvider.php


```php
namespace App\Providers;

use ....
class EventServiceProvider extends ServiceProvider
{
    
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        UserSubcribed::class => [
            EmailOwnerAboutSubscription::class,
        ],
    ];
    
    public function boot()
    {
        //
    }
}
 ```
-----------------------------------
#### NewsletterController.php
```php
class NewsletterController extends Controller
{
    public function index()
    {
        return view('index');

    }

    public function subscribe(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'required|unique:newsletters,email',
        ]);

        event(new UserSubcribed($request->input('email')));
       
        echo "done";
    }
```

