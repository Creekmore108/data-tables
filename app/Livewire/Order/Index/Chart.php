<?php

namespace App\Livewire\Order\Index;

use Livewire\Component;
use App\Models\Store;
use Illuminate\Support\Facades\DB;

class Chart extends Component
{
    public $dataset = [];
    public Store $store;

    public function mount()
    {
        $this->fillDataset();
    }

    public function fillDataset()
    {
        $results = $this->store->orders()
            ->select(
                DB::raw('Date(ordered_at) as incremented'),
                DB::raw('SUM(amount) as total'),
            )
                ->groupBy('ordered_at')
                ->get();

                // dd($results);
        $this->dataset['values'] = $results->pluck('total')->toArray();
        $this->dataset['labels'] = $results->pluck('increment')->toArray();
    }

    public function render()
    {
        return view('livewire.order.index.chart');
    }
}
