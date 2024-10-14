<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class InputFormSop extends Component
{
    public ?string $name, $label, $type_SOP, $value = null;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(string $name, $label, $typeS_SOP = 'text', $value = null)
    {
        $this->name = $name;
        $this->label = $label;
        $this->type_SOP = $typeS_SOP;
        $this->value = $value;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View|Closure|string
     */
    public function render(): View|string|Closure
    {
        return view('components.input-form-sop');
    }
}
