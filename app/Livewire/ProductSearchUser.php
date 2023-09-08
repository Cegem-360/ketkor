<?php

namespace App\Livewire;


use Auth;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class ProductSearchUser extends Component
{
    use WithPagination;
    #[URL]
    public string $serial_number = '';
    public string $tool_name = '';
    public function render()
    {
        $user = Auth::user();
        $products = Product::with(['partials', 'are_visible', 'tool'])->whereRelation('users', 'user_id', $user->id)
            ->when($this->tool_name, function ($query) {
                return $query->whereRelation('tool', 'name', 'LIKE', '%' . $this->tool_name . '%');
            })->when($this->serial_number, function ($query) {
            return $query->where('serial_number', 'LIKE', '%' . $this->serial_number . '%');
        })
            ->paginate(10);

        return view('livewire.product-search-user', compact('products'));
    }
}