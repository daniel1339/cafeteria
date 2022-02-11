<?php

namespace App\Http\Livewire;

use App\Models\Product;
use App\Models\Sale;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class ShowProduct extends Component
{
      
    
    
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public  $product;
    public $search = '';
    public $sort='id';
    public $direction='asc';
    public $open_edit=false;

    protected $rules = [
        'product.name' => 'required|:max:50',
        'product.reference' => 'required|:max:10',
        'product.price' => 'required|:max:15',
        'product.weight' => 'required|:max:15',
        'product.category' => 'required|:max:15',
        'product.stock' => 'required|:max:15',
    ];

    
    protected $listeners = ['render', 'delete'];
    public function render()
    {

        $high = DB::table('products')->latest('stock')->first();
        $high = DB::table('products')->latest('sold')->first();

        

        
        
        $products = Product::where('name','like','%'. $this->search . '%')
                            ->orderBy($this->sort , $this->direction)
                            ->paginate($this->cant);

    
        
        
        return view('livewire.show-product', compact('products','high'));
    }

  

    public function update(){
        $this->validate();
        $this->product->save();
        $this->reset('open_edit');
        $this->emit('alert','Este producto se actualizo con efectividad');

    }

   
    public function order($sort){
        if($this->sort == $sort){
            if($this->direction=='desc'){
                $this->direction='asc';
            } else{
                $this->direction='desc';
            }
        } else{
            $this->sort = $sort;
            $this->direction='asc';
        }    
    }

    public function edit(Product $product)
    {
        $this->product = $product; 
        $this->open_edit =true;

    }
    public $cant = '10';
    protected $queryString = [
        'cant' => ['except' => '10'],
        'sort'=> ['except' => 'id'],
        'direction'=> ['except' => 'asc'],
        'search' => ['except' => '']
    ];

    public function updatingSearch(){
        $this->resetPage();

    }

    public function delete(Product $product){
        $product->delete();
    }
}
