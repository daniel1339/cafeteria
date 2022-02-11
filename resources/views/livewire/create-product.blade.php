<div>
    <!-- Button trigger modal -->
 <button type="button" class="rounded btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
     Crear Producto
   </button>
   
   <!-- Modal -->
   <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
     <div class="modal-dialog">
       <div class="modal-content">
         <div class="modal-header">
           <h5 class="modal-title" id="staticBackdropLabel">Crear producto</h5>
           <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>
         <div class="modal-body">
           <label for="inputCity" class="form-label">Nombre</label>
                   <input type="text" class="form-control" wire:model.defer="name" id="inputCity">
                   @error('name')
                       <span>{{$message}}</span>
                   @enderror
                   <label for="inputCity" class="form-label">Referencia</label>
                   <input type="text" class="form-control"  wire:model.defer="reference" id="inputCity">
                   
                   @error('reference')
                   <span>{{$message}}</span>
                   
                   @enderror
                   <label for="inputCity" class="form-label">Precio</label>
                   <input type="number"  wire:model.defer="price" class="form-control"  id="inputCity">
                   
                   @error('price')
                   <span>{{$message}}</span>
                   @enderror
 
                   <label for="inputCity" class="form-label">Peso</label>
                   <input type="number" wire:model.defer="weight" class="form-control"  id="inputCity">
                   
                   @error('weight')
                   <span>{{$message}}</span>
                   @enderror

                   <label for="inputCity" class="form-label">Categoria</label>
                   <input type="text" wire:model.defer="category" class="form-control"  id="inputCity">
                   
                   @error('category')
                   <span>{{$message}}</span>
                   @enderror

                   <label for="inputCity" class="form-label">Stock</label>
                   <input type="number" wire:model.defer="stock" class="form-control"  id="inputCity">
                   
                   @error('stock')
                   <span>{{$message}}</span>
                   @enderror
         </div>
         <div class="modal-footer">
           <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
           <button type="button" data-bs-dismiss="modal" wire:click="save" class="btn btn-primary">Understood</button>
         </div>
       </div>
     </div>
   </div>
 </div>
 