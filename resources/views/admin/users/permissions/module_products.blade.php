<div class="col-md-4 d-flex"> {{-- d-flex todos los paneles la misma altura --}}
    <div class="panel shadow">
        <div class="header">
            <h2 class="title"><i class="fas fa-boxes"></i> Modulo Productos</h2>
        </div>
        <div class="inside">
            <div class="form-ckeck">
                <input type="checkbox" value="true" name="products" @if (kvfj($user->permissions, 'products')) checked 
                @endif> &nbsp; <label for="products"> Puede ver el listado de productos.</label>   
            </div>

            <div class="form-ckeck">
                <input type="checkbox" value="true" name="product_add" @if (kvfj($user->permissions, 'product_add')) checked 
                @endif> &nbsp; <label for="product_add"> Puede agregar nuevos productos.</label>   
            </div>

            <div class="form-ckeck">
                <input type="checkbox" value="true" name="product_edit" @if (kvfj($user->permissions, 'product_edit')) checked 
                @endif> &nbsp; <label for="product_edit"> Puede editar productos.</label>   
            </div>

            <div class="form-ckeck">
                <input type="checkbox" value="true" name="product_search" @if (kvfj($user->permissions, 'product_search')) checked 
                @endif> &nbsp; <label for="product_search"> Puede buscar productos.</label>   
            </div>

            <div class="form-ckeck">
                <input type="checkbox" value="true" name="product_delete" @if (kvfj($user->permissions, 'product_delete')) checked 
                @endif> &nbsp; <label for="product_delete"> Puede eliminar productos.</label>   
            </div>

            <div class="form-ckeck">
                <input type="checkbox" value="true" name="product_gallery_add" @if (kvfj($user->permissions, 'product_gallery_add')) checked 
                @endif> &nbsp; <label for="product_gallery_add"> Puede agregar imagenes a la galeria.</label>   
            </div>

            <div class="form-ckeck">
                <input type="checkbox" value="true" name="product_gallery_delete" @if (kvfj($user->permissions, 'product_gallery_delete')) checked 
                @endif> &nbsp; <label for="product_gallery_delete"> Puede eliminar imagenes de la galeria.</label>   
            </div>
        </div>
    </div>
</div>