<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Route;
use Illuminate\View\Component;

class Nav extends Component
{
    public $items = [
        [
            'icon'=>'nav-icon fas fa-tachometer-alt',
            'route'=>'profile.edit',
            'title'=>'Dashboard',
            'active'=>'profile.edit'
        ],
        [
            'icon'=>'far fa-circle nav-icon',
            'route'=>'categories.index',
            'title'=>'categories',
            'badge'=>'New',
            'active'=>'categories.*',
        ],
        [
            'icon'=>'far fa-circle nav-icon',
            'route'=>'products.index',
            'title'=>'Products',
            'active'=>'products.*',

        ],
        [
            'icon'=>'far fa-circle nav-icon',
            'route'=>'categories.index',
            'title'=>'Orders',
            'active'=>'orders.*',

        ],

    ];

    public $active;
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        // $this->items = config('nav');
        $this->active = Route::currentRouteName();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.nav');
    }
}
