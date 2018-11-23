@extends('layouts.app')

@section('content')
<h1>Conversación con {{ $conversation->users->except($user->id)->implode('name', ', ') }}</h1>
  
  <?php
    $newUser = $conversation->users->except($user->id);
    $oldUser = $user;
  ?>

  @if (Auth::check())
    @if (Gate::allows('dms', $oldUser))
      <form action="/{{ $newUser->implode('username') }}/dms" method="post">
        {{ csrf_field() }}
        <input type="text" name="message" class="form-control bg-aliceblue">
        <button type="submit" class="btn btn-success mt-1">
          Enviar DM
        </button>
      </form>
    @endif
  @endif

@foreach ($conversation->privateMessage as $message)
  @if ($message->user->id === $user->id)
    <div class="card mt-2">
      <div style="display: inline-flex">
        <div class="card-body bg-aliceblue text-right">
          {{ $message->message }}
        </div>
        <div style="display: inline-flex; width: 300px" class="card-header bg-lightseagreen p-menor justify-content-end">
          <div class="text-right">
            <strong>{{ $message->user->name }}</strong> dijo...
            <br>
            <?php
              $fecha_actual = new DateTime("now");
              //sumo 1 día
              $interval = date_diff($message->created_at, $fecha_actual);
            ?>
            @switch($interval)
              @case($interval->format('%m') > 0)
                <p class="text-25">hace {{ $interval->format('%m meses') }} </p>
                @break
              @case($interval->format('%a') > 0)
                <p class="text-25">hace {{ $interval->format('%a dias') }} </p>
                @break
              @case($interval->format('%H') > 0)
                <p class="text-25">hace {{ $interval->format('%h horas') }} </p>
                @break
              @case($interval->format('%i') > 0)
                <p class="text-25">hace {{ $interval->format('%i minutos') }} </p>
                @break
            @endswitch
          </div>
          <img class="avatar-noti" style="width: auto; height: 35px; margin: 3px 5px" src="{{ $message->user->avatar }}">
        </div>    
      </div>
    </div>
  @else
    <div class="card mt-2">
      <div style="display: inline-flex">
        <div style="display: inline-flex; width: 300px" class="card-header bg-lightseagreen p-menor">
          <img class="avatar-noti" style="width: auto; height: 35px; margin: 3px 5px" src="{{ $message->user->avatar }}">
          <div>
            <strong>{{ $message->user->name }}</strong> dijo...
            <br>
            <?php
              $fecha_actual = new DateTime("now");
              //sumo 1 día
              $interval = date_diff($message->created_at, $fecha_actual);
            ?>
            @switch($interval)
              @case($interval->format('%m') > 0)
                <p class="text-25">hace {{ $interval->format('%m meses') }} </p>
                @break
              @case($interval->format('%a') > 0)
                <p class="text-25">hace {{ $interval->format('%a dias') }} </p>
                @break
              @case($interval->format('%H') > 0)
                <p class="text-25">hace {{ $interval->format('%h horas') }} </p>
                @break
              @case($interval->format('%i') > 0)
                <p class="text-25">hace {{ $interval->format('%i minutos') }} </p>
                @break
            @endswitch
          </div>
        </div>    
        <div class="card-body bg-aliceblue">
          {{ $message->message }}
        </div>
      </div>
    </div>
  @endif
@endforeach
@endsection