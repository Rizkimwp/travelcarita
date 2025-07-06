<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ActionComponent extends Component
{
    /**
     * Create a new component instance.
     */
    public $itemId;
    public $itemName;
    public $itemEmail;
    public $itemPhone;
    public $itemRole;
    public function __construct($itemId, $itemEmail = null, $itemName = null, $itemPhone= null, $itemRole= null)
    {
        $this->itemId = $itemId;
        $this->itemName = $itemName;
        $this->itemEmail = $itemEmail;
        $this->itemPhone = $itemPhone;
        $this->itemRole = $itemRole;

    }

    public function render()
    {
        return view('components.action-dropdown');
    }
}