@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">{{ __('Login con Facebook') }}</div>

        <div class="card-body">
          <form method="post" action="/auth/facebook/register">
          {{ csrf_field() }}

            <div class="card-block">
              <img src="{{ $user->avatar }}" class="img-thumbnail">
            </div>
            <div class="card-block">
              <div class="form-group row">
                <label for="name" class="col-md-4 col-form-label text-md-right">
                  Nombre
                </label>
                <div class="col-md-6">
                  <input class="form-control" type="text" name="name" value="{{ $user->name }}" readonly>
                </div>
              </div>
              
              <div class="form-group row">
                <label for="email" class="col-md-4 col-form-label text-md-right">
                  Email
                </label>
                <div class="col-md-6">
                  <input class="form-control" type="text" name="email" value="{{ $user->email }}" readonly>
                </div>
              </div>
              
              <div class="form-group row">
                <label for="username" class="col-md-4 col-form-label text-md-right">
                  Nombre de usuario
                </label>
                <div class="col-md-6">
                  <input class="form-control" type="text" name="username" value="{{ old('username') }}">
                </div>
              </div>
            </div>
          
            <div class="card-footer">
              <button class="btn btn-primary" type="submit">
                Registarse
              </button>
            </div>
          
          </form>
        </div>
      </div>
    </div>
  </div>
</div>  

@endsection