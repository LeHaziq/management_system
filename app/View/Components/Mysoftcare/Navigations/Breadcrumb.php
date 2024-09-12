<?php

namespace App\View\Components\mysoftcare\navigations;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Breadcrumb extends Component
{
    public $items;

    /**
     * Create a new component instance.
     *
     * @return void
     */

    public function __construct($items)
    {
        $this->items = $items;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.mysoftcare.navigations.breadcrumb');
    }
}
