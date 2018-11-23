@extends('layouts.app')

@section('content')
<div class="jumbotron text-center bg">
	<h1><strong>Laratter</strong></h1>
	<nav>
		<ul class="nav nav-pills">
			<li class="nav-item">
				<a class="nav-link" href="/">Home</a>
			</li>
		</ul>
	</nav>
</div>
<div class="row">
	<form action="/messages/create" method="post" enctype="multipart/form-data" class="mx-auto" novalidate>
		<div style="display: inline-flex" class="form-group @if($errors->has('message')) was-validated @endif">
			{{ csrf_field() }}
			<input type="text" name="message" class="form-control bg-aliceblue borde" placeholder="Qué estás pensando?" required />
			<div>
				<label class="btn btn-outline-success input2" for="sub-archivo"><strong>Subir</strong></label>
				<input type="file" class="form-control-file" name="image" id="sub-archivo">
			</div>
			@if ($errors->has('message'))
				@foreach ($errors->get('message') as $error)
							<div class="invalid-feedback">
								{{ $error }}
							</div>
				@endforeach
				@endif
		</div>
	</form>
</div>
<div class="row">
	@forelse ($messages as $message)
		<div class="col-6">
			@include('messages.message')
		</div>
	@empty
		<p>No hay mensajes destacados.</p>
	@endforelse

	@if(count($messages))
	<div class="mt-2 mx-auto">
		{{ $messages->links('pagination::bootstrap-4') }}
	</div>
	@endif
</div>
@endsection