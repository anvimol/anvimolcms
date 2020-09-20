@extends('admin.master')

@section('title', "Permisos de usuario")

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ url('/admin/users') }}"><i class="fas fa-user-friends"></i> Usuarios</a>
    </li>     
    <li class="breadcrumb-item">
        <a href="{{ url('/admin/users') }}"><i class="fas fa-cogs"></i> Permisos de usuario: {{ $user->name }} {{ $user->lastname }} (ID: {{ $user->id }})</a>
    </li>                            
@endsection

@section('content')
<div class="container-fluid">
    <div class="page_user">
        <form action="{{ url('/admin/user/'.$user->id.'/permissions') }}" method="POST">
            @csrf
            {{-- Usando user_permissions() del archivo Functions.php--}}
            <div class="row">
                @foreach (user_permissions() as $key => $value)
                <div class="col-md-4 d-flex mb16">
                    <div class="panel shadow">
                        <div class="header">
                            <h2 class="title">{!! $value['icon'] !!} {!! $value['title'] !!}</h2>
                        </div>
                        <div class="inside">
                            @foreach ($value['keys'] as $k => $v)
                                <div class="form-check">
                                    <input class="form-check-input" name="{{ $k }}" type="checkbox" value="true" id="flexCheckDefault" @if (kvfj($user->permissions, $k)) checked
                                    @endif>
                                    <label class="form-check-label" for="flexCheckDefault">{{ $v }}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                @endforeach
            </div> 

           {{--  <div class="row">
                @include('admin.users.permissions.module_dashboard')
                @include('admin.users.permissions.module_products')
                @include('admin.users.permissions.module_categories')
            </div>

            <div class="row mtop16">
                @include('admin.users.permissions.module_users')
            </div> --}}

            <div class="row mtop16">
                <div class="col-md-12">
                    <div class="panel shadow">
                        <div class="inside">
                            <input type="submit" value="Guardar" class="btn btn-primary">
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection