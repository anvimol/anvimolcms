<div class="col-md-4 d-flex">
    <div class="panel shadow">
        <div class="header">
            <h2 class="title"><i class="fas fa-folder-open"></i> Modulo Categorias</h2>
        </div>
        <div class="inside">
            <div class="form-ckeck">
                <input type="checkbox" value="true" name="categories" @if (kvfj($user->permissions, 'categories')) checked 
                @endif> &nbsp; <label for="categories"> Puede ver el listado de categorias.</label>   
            </div>

            <div class="form-ckeck">
                <input type="checkbox" value="true" name="category_add" @if (kvfj($user->permissions, 'category_add')) checked 
                @endif> &nbsp; <label for="category_add"> Puede añadir nuevas categorias.</label>   
            </div>

            <div class="form-ckeck">
                <input type="checkbox" value="true" name="category_edit" @if (kvfj($user->permissions, 'category_edit')) checked 
                @endif> &nbsp; <label for="category_edit"> Puede editar categorias.</label>   
            </div>

            <div class="form-ckeck">
                <input type="checkbox" value="true" name="category_delete" @if (kvfj($user->permissions, 'category_delete')) checked 
                @endif> &nbsp; <label for="category_delete"> Puede eliminar categorias.</label>   
            </div>
        </div>
    </div>
</div>