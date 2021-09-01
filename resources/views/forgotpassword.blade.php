<!DOCTYPE html>
@extends('layout')
@section('content')

<div class="container">
    <div class="row">
        <div class="col-lg-4 col-md-4"></div>
        <div class="col-lg-4 col-md-4">
        <div class="card-wrapper">


            <div class="card-body">
                <h4 class="card-title">Forgot Password</h4>

                @if (Session::has('message'))
                <div class="alert alert-success" role="alert">
                    {{ Session::get('message') }}
                </div>
                @endif
                <form method="POST" action="{{ route('forget-password-post') }}">
                    @csrf

                    <div class="form-group">
                        <label for="email">E-Mail Address</label>
                        <input id="email" type="email" class="form-control" name="email" required autofocus> 
                        @if ($errors->has('email'))
                        <span class="text-danger">{{ $errors->first('email') }}</span>
                        @endif
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">
                        Send Password Link
                    </button>

                </form>
            </div>
        </div>
        </div>
    </div>
</div>


@endsection