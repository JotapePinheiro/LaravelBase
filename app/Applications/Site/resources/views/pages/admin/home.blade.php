@extends('site::layouts.app')

@section('template_title')
    Olá {{ Auth::user()->name }}
@endsection

@section('head')
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">

                @include('site::panels.welcome-panel')

            </div>
        </div>
    </div>

@endsection