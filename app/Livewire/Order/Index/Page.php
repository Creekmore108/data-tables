<?php

namespace App\Livewire\Order\Index;
use App\Models\Store;
use Livewire\WithPagination;
use Livewire\Attributes\Url;

use Livewire\Component;

class Page extends Component
{
    use WithPagination;
    public Store $store;
    public $search = '';
    #[Url]
    public $sortCol;
    #[Url]
    public $sortAsc = false;

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function sortBy($column)
    {
        if($this->sortCol === $column){
            $this->sortAsc = ! $this->sortAsc;
        }else{
            $this->sortCol = $column;
            $this->sortAsc = false;
        }
    }

    protected function applySorting($query)
    {
        if($this->sortCol){
            $column = match ($this->sortCol){
                'number' => 'number',
                'status' => 'status',
                'date'   => 'ordered_at',
                'amount' => 'amount',
            };

            $query->orderBy($column, $this->sortAsc ? 'asc' : 'desc');
        }
        return $query;
    }

    protected function applySearch($query)
    {
       return  $this->search === ''
            ? $query
            : $query
                ->where('email', 'like','%'.$this->search.'%')
                ->orWhere('number', 'like','%'.$this->search.'%');
    }
    public function render()
    {
        $query = $this->store->orders();

        $query = $this->applySearch($query);

        $query = $this->applySorting($query);

        // sleep(1);
        return view('livewire.Order.Index.page',[
            'orders' => $query->paginate(10),
        ]);
    }
}