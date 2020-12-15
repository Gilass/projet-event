@extends('layouts.app')


@section('content')

@php
use App\Event;
use App\Inscrit;
@endphp
<h1>Liste des Utilisateurs</h1>

<br>

@if (session()->has('message'))
    <hr>
    <div class="alert alert-danger" role="alert">
        {{session()->get('message')}}
      </div>
    @endif

<br>
<br>

@foreach ($user as $user)
    @php

    $inscrit = Inscrit::where('user_id', '=' ,$user->id)->get();
    @endphp
        <p class="Biginfotext">{{$user->name}}</p>
        <p class="infotext">{{$user->email}}</p>


        <table class="table table-dark">
            <thead>
            <tr>
                <th scope="col">image</th>
                <th scope="col">Evenement</th>
                <th scope="col">Description</th>
                <th scope="col">Date</th>
                <th scope="col">Place disponible</th>
                <th scope="col">Utilisateur inscrit le : </th>
                <th>  </th>
            </tr>
            </thead>
            <tbody>
                @foreach($inscrit as $inscrit)


                @php

                $event = Event::where('id', '=' ,$inscrit->event_id)->get();
                @endphp
            @foreach($event as $event)

            <tr>
                <th ><img src={{$event->image}} alt="Picture_event" width="100" height="100"></th>
                <td><a href="/event/{{$event->id}}">{{$event->nom}}</a></td>
                <td> {{$event->shortdesc}} </td>
                <td>{{$event->dateStart}} {{$event->hourStart}} /  {{$event->dateStop}} {{$event->hourStop}}</td>
                <td>{{$event->placelibre}}/{{$event->placedispo}}</td>
                <td>{{$inscrit->created_at}}</td>
                <td>
                    <form action="/event/{{$event->id}}/{{$inscrit->user_id}}" method="POST" style="display:inline">
                        @csrf
                        @method('DELETE')
                    <button type="submit" class="btn btn-danger"> Supprimer </button>
                    </form>
                </td>
            </tr>

            @endforeach
            @endforeach
    </tbody>
  </table>
  <br>


    <hr>
    @endforeach
@endsection
