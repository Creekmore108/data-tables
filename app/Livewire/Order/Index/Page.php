<?php

namespace App\Livewire\Order\Index;
use App\Models\Store;

use Livewire\Component;

class Page extends Component
{
    public Store $store;

    public function render()
    {
        return view('livewire.Order.Index.page');
    }
}
