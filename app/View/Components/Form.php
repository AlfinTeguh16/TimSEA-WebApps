<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Form extends Component
{
    public $variant;
    public $type;
    public $placeholder;
    public $value;
    public $name;

    public function __construct($variant = 'text', $type = 'text', $placeholder = '', $value = '', $name = '')
    {
        $this->variant = $variant;
        $this->type = $type;
        $this->placeholder = $placeholder;
        $this->value = $value;
        $this->name = $name;
    }

    public function render()
    {
        return view('components.form');
    }
}
