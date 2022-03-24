<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Message extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    
    public $type;

    public $message;

    public $title;

    public function __construct($type=null, $message=null, $title=null)
    {
        //
        $this->type = $type;
        $this->message = $message;
        $this->title = $title;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.message');
    }
}
