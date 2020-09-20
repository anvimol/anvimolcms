<div class="col-md-4 d-flex">
    <div class="panel shadow">
        <div class="header">
            <h2 class="title"><i class="fas fa-user-friends"></i> Modulo Usuarios</h2>
        </div>
        <div class="inside">
            <div class="form-ckeck">
                <input type="checkbox" value="true" name="user_list" @if (kvfj($user->permissions, 'user_list')) checked 
                @endif> &nbsp; <label for="user_list"> Puede ver el listado de usuarios.</label>   
            </div>

            <div class="form-ckeck">
                <input type="checkbox" value="true" name="user_edit" @if (kvfj($user->permissions, 'user_edit')) checked 
                @endif> &nbsp; <label for="user_edit"> Puede editar usuarios.</label>   
            </div>

            <div class="form-ckeck">
                <input type="checkbox" value="true" name="user_banned" @if (kvfj($user->permissions, 'user_banned')) checked 
                @endif> &nbsp; <label for="user_banned"> Puede banear usuarios.</label>   
            </div>

            <div class="form-ckeck">
                <input type="checkbox" value="true" name="user_permissions" @if (kvfj($user->permissions, 'user_permissions')) checked 
                @endif> &nbsp; <label for="user_permissions"> Puede administrar permisos de usuarios.</label>   
            </div>
        </div>
    </div>
</div>