@extends('layouts.app')


@section('content')


<h1><img src="/{{$event->image}}" width="100" height="100"/> Evenement : {{$event->nom}}</h1>

<br>
<p class="InfoObjet"><b>Description :</b>{{$event->longdesc}}</p>
<p class="InfoObjet"><b>Debute le : </b>{{$event->dateStart}} à {{$event->hourStart}} </p>
<p class="InfoObjet"><b>Fini le : </b>{{$event->dateStop}} à {{$event->hourStop}} </p>
<p class="InfoObjet"><b>Place disponible </b>{{$event->placelibre}} / {{$event->placedispo}}</p>

<br>

@if (session()->has('message'))
    <hr>
    <div class="alert alert-danger" role="alert">
        {{session()->get('message')}}
      </div>
    @endif

@if(Auth::check() && Auth::user()->role == 'admin')
<a href="/event/{{$event->id}}/EditEvent" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">Editer</a>
<form action="/event/{{$event->id}}" method="POST" style="display:inline">
    @csrf
    @method('DELETE')
<button type="submit" class="btn btn-danger"> Supprimer </button>
</form>
@elseif(Auth::check())
<form action="/event/{{$event->id}}/inscription" method="POST" style="display:inline">
    @csrf
<button type="submit" class="btn btn-primary"> S'inscrire </button>
@endif

<br>
<br>

<h2>Liste des inscrits : </h2>

<br>

<table class="table table-dark">
    <thead>
      <tr>
        <th scope="col">Nom</th>
        <th scope="col">Inscrit le : </th>
        @if(Auth::check() && Auth::user()->role == 'admin')
        <th>  </th>
        @endif
      </tr>
    </thead>
    <tbody>
        @foreach($inscrit as $inscrit)
      <tr>

        <td>{{$inscrit->nom}} </td>
        <td>{{$inscrit->created_at}}</td>
        @if(Auth::check() && Auth::user()->role == 'admin')
        <td>
            <form action="/event/{{$event->id}}/{{$inscrit->user_id}}" method="POST" style="display:inline">
                @csrf
                @method('DELETE')
            <button type="submit" class="btn btn-danger"> Supprimer </button>
            </form>
        </td>
        @endif
      </tr>
      @endforeach
    </tbody>
  </table>

@endsection
