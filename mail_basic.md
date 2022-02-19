https://laravel.com/docs/9.x/mail#using-the-from-method

#### App\Mail\UserSubscribedMessage.php

```
<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

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

####  resources\views\mail\subscribed.blade.php
```
<h1>User has Subscribed</h1>

```

---------------------------------------------------------------------------------

#### web.php
```
<?php

Route::get('/send', [NewsletterController::class, 'send_mail']);
```
#### NewsletterController.php

```
namespace App\Http\Controllers;

use App\Mail\UserSubscribedMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class NewsletterController extends Controller
{
   
    public function send_mail()
    {

        Mail::to('exampmy@moztech.com')->from('moz@gmail.com')->send(new UserSubscribedMessage());
        echo "done";
    }
    
 }
