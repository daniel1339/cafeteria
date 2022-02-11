<?php

namespace App\Http\Livewire;

use App\Models\Product;
use App\Models\Sale;
use Livewire\Component;



class AddCartItem extends Component
{
    public $product ;
    public $qty = 1;
    public $quantity;


    protected $rules = [
        'product.stock' => 'required',
        
        
    ];
  

    

    public function decrement(){
        $this->qty = $this->qty - 1;
    }

    public function increment(){
        $this->qty = $this->qty + 1;
    }

    public function mount(Product $product){
        $this->quantity = $product->stock;
        $this->product = $product;
        
        
    }

   
        
    public function updated($propertyName){
        
        $this->validateOnly($propertyName);


    }

    

    public function save(){
        
        $this->validate();
        $this->product->sold = $this->product->sold + $this->qty;
        $this->product->stock = $this->product->stock - $this->qty;
        $this->product->save();        
        Sale::create([ 'product_id' => $this->product->id, 
                    
                    'qty' => $this->qty, 
                    
                ]);
                
        $this->reset('qty');
        $this->emit('alert','Esta venta se realizo con exito');

        $this->emitTo('show-product', 'render');
    }

    public function render()
    {
         
        return view('livewire.add-cart-item');
    }
}
