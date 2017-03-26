@extends('site::layouts.app')

@section('template_title')
	Ver Mensagem
@endsection

@section('head')
@endsection

@section('content')

 <div class="container">
	<div class="row">
	    <div class="col-md-12">
			 @include('site::partials.form-status')
        </div>
    </div>
</div>

@endsection