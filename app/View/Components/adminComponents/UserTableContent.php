<?php

namespace App\View\Components\adminComponents;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class UserTableContent extends Component
{
    public $students;

    public function __construct($students)
    {
        $this->students = $students;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.admin-components.user-table-content');
    }
}
