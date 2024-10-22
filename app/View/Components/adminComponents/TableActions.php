<?php

namespace App\View\Components\adminComponents;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class TableActions extends Component
{

    public $student;

    public function __construct($student)
    {
        $this->student = $student;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.admin-components.table-actions');
    }
}
