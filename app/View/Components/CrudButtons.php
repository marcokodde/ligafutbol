<?php

namespace App\View\Components;

use Illuminate\View\Component;

class CrudButtons extends Component
{
    public $allow_edit;
    public $allow_delete;
    public $allow_view;
    public $record;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($record)
    {
        $this->record       = $record;
        // $this->allow_edit   = $allow_edit;
        // $this->allow_delete = $allow_delete;
        // $this->allow_view   = $allow_view;
    }


    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()

    {
        dd($this->record);
        return view('components.crud-buttons');
    }
}
