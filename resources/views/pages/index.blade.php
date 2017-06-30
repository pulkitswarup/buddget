@extends('layouts.app')

@section('content')
    <div style="background: url('{{ asset('images/background.jpg') }}') no-repeat; padding: 40px; margin-top: -25px; background-size: cover;">
        <div class="container jumbotron text-center" style="border-radius: 20px; padding: 20px 0px;background-color: rgba(255, 255, 255, 0.75); max-width: 800px; margin: 0 auto;">
            <h1>Manage your expenses</h1>
            <p>This is a personal budget management application</p>
            @if (!Auth::check())
                <p>
                        <a class="btn btn-primary btn-lg" href="{{ route('login') }}">Login</a>&nbsp;&nbsp;
                        <a class="btn btn-success btn-lg" href="{{ route('register') }}">Register</a>
                </p>
            @endif
        </div>
    </div>
@endsection