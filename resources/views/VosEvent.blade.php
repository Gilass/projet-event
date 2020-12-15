@extends('layouts.app')
@section('content')
    <h1>Vos Evenement ou vous etes inscrits : </h1>
    @php
    use App\Event;
    require_once('../app/Libraries/phpqrcode/qrlib.php');
    $i=1;
@endphp
<table class="table table-dark">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">image</th>
        <th scope="col">Evenement</th>
        <th scope="col">Description</th>
        <th scope="col">Date</th>
        <th scope="col">Place encore disponible</th>
        <th scope="col">Qr code</th>
      </tr>
    </thead>
    <tbody>
       @foreach($inscrit as $inscrit)
         @php


        $event = Event::where('id', '=' ,$inscrit->event_id)->get();

         @endphp
        @foreach($event as $event)
      <tr>
        <th scope="row">{{$i++}}</th>
        <th ><img src={{$event->image}} alt="Picture_event" width="100" height="100" ></th>
        <td><a href="/event/{{$event->id}}">{{$event->nom}}</a></td>
        <td> {{$event->shortdesc}} </td>
        <td>{{$event->dateStart}} {{$event->hourStart}} /  {{$event->dateStop}} {{$event->hourStop}}</td>
        <td>{{$event->placelibre}}/{{$event->placedispo}}</td>
        <td>@php
            $fileimg="assets/QRcode/Qrcode-Event-".$inscrit->event_id."-User-".$inscrit->user_id.".png";
             QRcode::png("Event:".$inscrit->event_id."!User:".$inscrit->user_id."!","../public/".$fileimg);
            @endphp
            <img src={{$fileimg}} />
      </td>
      </tr>
      @endforeach
      @endforeach
    </tbody>
  </table>

@endsection
