<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Button extends Component
{
    public $variant;
    public $type;

    public function __construct($variant = 'primary', $type = 'button')
    {
        $this->variant = $variant;
        $this->type = $type;
    }

    public function render()
    {
        return view('components.button');
    }
}

