@extends('layouts.app')

@section('content')
<h1 class="h3">Mensaje id: {{ $message->id }}</h1>
@include('messages.message')

<responses-component :message="{{ $message->id }}"></responses-component>
@endsection