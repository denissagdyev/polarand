<?php

namespace App\View\Components;

use Illuminate\View\Component;

class WhatsappForm extends Component
{
    public $title;
    public $buttonText;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($title = 'Оставьте свой номер WhatsApp', $buttonText = 'Отправить')
    {
        $this->title = $title;
        $this->buttonText = $buttonText;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.whatsapp-form');
    }
}