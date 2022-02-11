<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;

class CreateProduct extends Component
{
    public $name, $reference, $price, $weight,$category,$stock;

    protected $rules = [
        'name' => 'required|:max:50',
        'reference' => 'required|:max:10',
        'price' => 'required|:max:10',
        'weight' => 'required|:max:15',
        'category' => 'required|:max:15',
        'stock' => 'required|:max:15'
        
    ];

    public function updated($propertyName){
        $this->validateOnly($propertyName);

    }
    public function save(){

        $this->validate();
        Product::create([
            'name' => $this->name,
            'reference'=> $this->reference,
            'price'=> $this->price,
            'weight'=> $this->weight, 
            'category'=> $this->category,
            'stock'=> $this->stock  
        ]);

        $this->reset(['name','reference','price','weight', 'category', 'stock']);
        $this->emitTo('show-product','render');
        $this->emit('alert','Este producto se creo con efectividad');
        
    }
    
    public function render()
    {
        return view('livewire.create-product');
    }
}
