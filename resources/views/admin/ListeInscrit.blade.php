@extends('layouts.app')


@section('content')

@php
use App\Inscrit;

@endphp
<h1>Liste des évènements </h1>

<br>

@if (session()->has('message'))
    <hr>
    <div class="alert alert-danger" role="alert">
        {{session()->get('message')}}
      </div>
    @endif

<br>
<br>

@foreach($event as $event)

      <p class="Biginfotext">{{$event->nom}}</p>

        <table class="table table-dark">
            <thead>
            <tr>
                <th scope="col">Nom</th>
                <th scope="col">Inscrit le : </th>
                <th>  </th>
            </tr>
            </thead>
            <tbody>
                @php

                $inscrit = Inscrit::where('event_id', '=' ,$event->id)->get();
                @endphp
            @foreach($inscrit as $inscrit)
            <tr>
                <td>{{$inscrit->nom}} </td>
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
    </tbody>
  </table>
  <hr>

  @endforeach

@endsection
