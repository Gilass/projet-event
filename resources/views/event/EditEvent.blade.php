@extends('layouts.app')

@section('content')

<h1>Editer L'evenement : {{$event->nom}}</h1>

<form action="/event/{{$event->id}}" method="POST"  enctype="multipart/form-data">
    @method('PATCH')
    @include('includes.form')
    <button type="submit" class="btn btn-primary">Enregistrer</button>

</form>

@endsection
