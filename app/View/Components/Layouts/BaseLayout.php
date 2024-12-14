<?php

namespace App\View\Components\Layouts;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

abstract class BaseLayout extends Component
{
    public string $title;

    public function __construct(string $title)
    {
        if (!empty($title)) {
            $this->title = $title . ' | ' . config('app.name');
        } else {
            $this->title = config('app.name');
        }
    }

    abstract public function render(): View;
}
