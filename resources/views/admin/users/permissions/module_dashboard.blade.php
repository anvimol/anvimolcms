<div class="col-md-4 d-flex">
    <div class="panel shadow">
        <div class="header">
            <h2 class="title"><i class="fas fa-home"></i> Modulo Dashboard</h2>
        </div>
        <div class="inside">
            <div class="form-ckeck">
                <input type="checkbox" value="true" name="dashboard" @if (kvfj($user->permissions, 'dashboard')) checked
                    
                @endif> &nbsp; <label for="dashboard"> Puede ver el dashboard.</label>   
            </div>

            <div class="form-ckeck">
                <input type="checkbox" value="true" name="dashboard_small_stats" @if (kvfj($user->permissions, 'dashboard_small_stats')) checked
                    
                @endif> &nbsp; <label for="dashboard_small_stats"> Puede ver las estadisticas rápidas.</label>   
            </div>

            <div class="form-ckeck">
                <input type="checkbox" value="true" name="dashboard_sell_today" @if (kvfj($user->permissions, 'dashboard_sell_today')) checked
                    
                @endif> &nbsp; <label for="dashboard_sell_today"> Puede ver lo facturado hoy.</label>   
            </div>
        </div>
    </div>
</div>