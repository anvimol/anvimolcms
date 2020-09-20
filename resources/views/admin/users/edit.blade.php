@extends('admin.master')

@section('title', "Editar Usuario")

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ url('/admin/users') }}"><i class="fas fa-user-friends"></i> Usuarios</a>
    </li>                                
@endsection

@section('content')
<div class="container-fluid">
    <div class="page_user">
        <div class="row">
            <div class="col-md-3">
                <div class="panel shadow">
                    <div class="header">
                        <h2 class="title"><i class="fas fa-user"></i> Información</h2>
                    </div>
                    <div class="inside">
                        <div class="mini_profile">
                            @if (is_null($user->avatar))
                                <img src="{{ url('/static/images/default-avatar.png') }}" class="avatar">
                            @else
                                <img src="{{ url('/uploads_users/'.$user->id.'/'.$user->avatar) }}" class="avatar">
                            @endif
                            <div class="info">
                                <span class="title"><i class="far fa-address-card"></i> Nombre</span>
                                <span class="text">{{ $user->name }} {{ $user->lastname }}</span>
                                <span class="title"><i class="fas fa-user-shield"></i> Estado del usuario</span>
                                <span class="text">{{ getUserStatusArray(null, $user->status) }}</span>
                                <span class="title"><i class="far fa-envelope"></i> Correo Electrónico</span>
                                <span class="text">{{ $user->email }}</span>
                                <span class="title"><i class="far fa-calendar-alt"></i> Fecha de registro</span>
                                <span class="text">{{ $user->created_at }}</span>
                                <span class="title"><i class="fas fa-user-tie"></i> Role de usuario</span>
                                <span class="text">{{ getRoleUserArray(null, $user->role) }}</span>
                                
                            </div>
                            @if (kvfj(Auth::user()->permissions, 'user_banned'))
                                @if ($user->status == "100")
                                    <a href="{{ url('/admin/user/'. $user->id . '/banned') }}" class="btn btn-success">Activar usuario</a>                         
                                @else
                                    <a href="{{ url('/admin/user/'. $user->id . '/banned') }}" class="btn btn-danger">Suspender usuario</a>
                                @endif
                            @endif
                        </div>
                    </div>
                </div>
            </div>
    
            <div class="col-md-9">
                <div class="panel shadow">
                    <div class="header">
                        <h2 class="title"><i class="fas fa-user-edit"></i> Editar información</h2>
                    </div>
                    <div class="inside">
                        @if (kvfj(Auth::user()->permissions, 'user_edit'))
                        {!! Form::open(['url' => '/admin/user/'. $user->id . '/edit']) !!}
                        <div class="row">
                            <div class="col-md-6">
                                <label for="module" class="mtop16">Tipo de Usuario:</label> 
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                    {!! Form::select("user_type", getRoleUserArray('list', null), $user->role, ["class" => "form-select"]) !!}
                                </div>
                            </div>
                        </div>
                        <div class="row mtop16">
                            <div class="col-md-12">
                                {!! Form::submit('Guardar', ['class' => 'btn btn-success']) !!}
                            </div>
                        </div>
                        {!! Form::close() !!}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection