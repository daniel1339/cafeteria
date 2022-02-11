<div>
    <table class="table text-black">

@if ($high)
<h4>Producto mayor stock<br>{{$high->name}} <br> {{$high->stock}} </h4>
<hr>
<h4>Producto mas vendido<br>{{$high->name}} <br> {{$high->sold}} </h4>  

    
@else
    
No existen productos
<br>
@endif


      

        <div class="row flex">
          <span class="col-1">Mostrar</span>
          <div class="col-2">
            
            <select wire:model="cant" class="form-select rounded  " aria-label="Default select example">
              <option value="10">10</option>
              <option value="25">25</option>
              <option value="50">50</option>
            </select>
            
          </div>
          <span class="px-3 col-1">Producto</span>
        <div class="flex item-center col-6">
         
          <x-jet-input type="text" class="flex-2 pb-3 rounded " placeholder="Escriba que producto busca" wire:model="search"/>
          
        </div>
        <div class="flex item-center col-2">
          @livewire('create-product')
        </div>
        </div>
    
        @if ($products->count())
            
        
        <thead class="thead-dark">
          <tr>
            <th scope="col" class="pointer" wire:click="order('id')">Id
              @if ($sort == 'id')
                @if ($direction =='asc')
                  <i class="bi bi-arrow-up-circle-fill"></i>    
                @else
                  <i class="bi bi-arrow-down-circle-fill float-right"></i>  
                @endif
               
            @else
            <i class="bi bi-arrow-up-circle-fill"></i>    
            @endif
              
            </th>
            <th scope="col" class="pointer" wire:click="order('name')">Nombre
              @if ($sort == 'name')
                @if ($direction =='asc')
                  <i class="bi bi-arrow-up-circle-fill"></i>    
                @else
                  <i class="bi bi-arrow-down-circle-fill float-right"></i>  
                @endif
               
            @else
            <i class="bi bi-arrow-up-circle-fill"></i>    
            @endif
            </th>
            
            <th scope="col" >Referencia</th>
            <th scope="col" >Precio</th>
            <th scope="col" >Peso</th>
            <th scope="col" >Categoria</th>
            <th scope="col" >Stock</th>
            <th scope="col" >Creado</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($products as $item)
                
           
            <tr>
                <th scope="row">{{$item->id}}</th>
                <td>{{$item->name}}</td>
                <td>{{$item->reference}}</td>
                <td>{{$item->price}}</td>
                <td>{{$item->weight}}</td>
                <td>{{$item->category}}</td>
                <td>{{$item->stock}}</td>
                <td>{{$item->created_at}}</td>
                <td>
                 
                  
                  <button type="button" wire:click="edit({{$item}})" class="rounded btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Editar
                  </button>
                
                
                </td>
    
                <td>
                  <a class="rounded btn btn-primary" wire:click="$emit('deleteProduct' ,{{$item->id}})">
                    <i class="bi bi-trash-fill"></i>
                  </a>
                </td>

                <td>
                 @if ($item->stock < 1)
                 <div class="py-5">
                  No es posible realizar la venta
                </div>
                 @else
                 @livewire('add-cart-item', ['product' => $item], key($item->id))  
                 @endif 
                </td>
            </tr>
    
            
            
            
            @endforeach
        </tbody>
    
        
    
        @else
    
        <div class="py-5">
          No existe ningun registro coincidente
        </div>
        
            
        @endif
    
        
      </table>
    

      <x-jet-dialog-modal wire:model="open_edit">

        <x-slot name="title">
          Editar producto
        </x-slot>

        <x-slot name="content">

          <div class="modal-body">
            <label for="inputCity" class="form-label">Nombre</label>
            <input type="text" class="form-control" wire:model.defer="product.name" id="inputCity">
            @error('name')
                <span>{{$message}}</span>
            @enderror
            <label for="inputCity" class="form-label">Referencia</label>
            <input type="text" class="form-control"  wire:model.defer="product.reference" id="inputCity">
            
            @error('reference')
            <span>{{$message}}</span>
            
            @enderror
            <label for="inputCity" class="form-label">Precio</label>
            <input type="number" wire:model.defer="product.price" class="form-control"  id="inputCity">
            
            @error('price')
            <span>{{$message}}</span>
            @enderror

            
            <label for="inputCity" class="form-label">Peso</label>
            <input type="number"  wire:model.defer="product.weight" class="form-control"  id="inputCity">
            
            @error('weight')
            <span>{{$message}}</span>
            @enderror

            <label for="inputCity" class="form-label">Categoria</label>
            <input type="text"  wire:model.defer="product.category" class="form-control"  id="inputCity">
            
            @error('category')
            <span>{{$message}}</span>
            @enderror

            <label for="inputCity" class="form-label">Stock</label>
            <input type="number"  wire:model.defer="product.stock" class="form-control"  id="inputCity">
            
            @error('stock')
            <span>{{$message}}</span>
            @enderror
        </div>

        </x-slot>

        <x-slot name="footer">

          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
              <button type="button" class="btn btn-primary" data-bs-dismiss="modal" wire:click="update">Guardar</button>
        </x-slot>
      </x-jet-dialog-modal>
      
    
      <div>
        {{$products->links()}}
      </div>
          
      @push('child-scripts')
      <script src="sweetalert2.all.min.js"></script>
    
      
      <script>
    
            livewire.on('deleteProduct', productId =>{
              Swal.fire({
      title: 'Are you sure?',
      text: "You won't be able to revert this!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
      if (result.isConfirmed) {
    
        livewire.emitTo('show-product', 'delete', productId)
        Swal.fire(
          'Deleted!',
          'Your file has been deleted.',
          'success'
        )
      }
    })
    
            });
         
    
      </script>
          
      @endpush
</div>
