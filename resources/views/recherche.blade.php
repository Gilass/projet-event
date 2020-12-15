        @extends('layouts.app')

        @section('content')
            <h1>Voici la liste des evenement disponible : </h1>
            @php
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
                    <th scope="col">Place disponible</th>

                  </tr>
                </thead>
                <tbody>
                    @foreach($event as $event)
                  <tr>
                    <th scope="row">{{$i++}}</th>
                    <th ><img src={{$event->image}} alt="Picture_event" width="100" height="100"></th>
                    <td><a href="/event/{{$event->id}}">{{$event->nom}}</a></td>
                    <td> {{$event->shortdesc}} </td>
                    <td>{{$event->dateStart}} {{$event->hourStart}} /  {{$event->dateStop}} {{$event->hourStop}}</td>
                    <td>{{$event->placelibre}}/{{$event->placedispo}}</td>
                  </tr>
                  @endforeach
                </tbody>
              </table>

        @endsection
