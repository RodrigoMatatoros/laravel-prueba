<?php

namespace App\View\Components;

use Closure;
use App\Models\Category;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Formulario extends Component
{
    public $categorias;
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->categorias = Category::all();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.formulario');
    }
}
