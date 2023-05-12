@extends('layout.app')

@section('title')
Авторизация
@endsection

@section('main')
<div class="container">
    @if (session()->has('error'))
    <div class="alert text-center alert-danger col-lg-5 mt-5 mx-auto rounded-0">
        {{session('error')}}
    </div>
    @endif
    <form class="col-lg-5 mx-auto p-3 p-sm-5 border border-2 mt-5" action="{{route('admin-login')}}" method="POST">
        @method('post')
        @csrf

        <h1 class="text-center mb-5">Авторизация</h1>

        <div class="mb-5">
            <input type="text" class="form-control input-main rounded-0" id="login" name="login" placeholder="Логин" value="{{old('login')}}">
            @error('login')
            <div class="text-danger">{{$message}}</div>
            @enderror
        </div>

        <div class="mb-5">
            <input type="password" class="form-control input-main rounded-0" id="password" name="password" placeholder="Пароль">
            @error('password')
            <div class="text-danger">{{$message}}</div>
            @enderror
        </div>

        <div class="d-flex justify-content-center">
            <button type="submit" class="btn btn-main-dark rounded-0 px-5">Войти</button>
        </div>
    </form>
</div>
@endsection
