<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;
use App\User;
use App\Inscrit;
use Illuminate\Support\Facades\Auth;
use SebastianBergmann\Environment\Console;

class EventController extends Controller
{
    public function list()
    {
        $event= Event::all();

        return view('recherche' ,compact('event'));
    }

    public function show($event)
    {
         $inscrit= Inscrit::where('event_id', '=' , $event)->get();
         $event = Event::where('id',$event)->firstorfail();
         return view('event.show',compact('event','inscrit'));
    }

    public function store()
   {

   request() -> validate([
        'nom' => 'required'
        ,'shortdesc' => 'required'
        ,'dateStart' => 'required'
        ,'dateStop' => 'required'
        ,'hourStart' => 'required'
        ,'hourStop' => 'required'
        ,'placedispo' => 'required'
    ]);
    $event = new Event();

    $nom = request('nom');

    $shortdesc = request('shortdesc');
    $longdesc = request('longdesc');

    $dateStart = request('dateStart');
    $hourStart = request('hourStart');
    $dateStop = request('dateStop');
    $hourStop = request('hourStop');

    $placedispo = request('placedispo');
    $placelibre = $placedispo;

    $image = 'assets/picture/default.jpg';

    if(empty($longdesc))
    {
        $longdesc = $shortdesc;
    }



    $event->nom = $nom;

    $event->shortdesc = $shortdesc;
    $event->longdesc = $longdesc;

    $event->dateStart = $dateStart;
    $event->hourStart = $hourStart;
    $event->dateStop = $dateStop;
    $event->hourStop = $hourStop;

    $event->placedispo = $placedispo;
    $event->placelibre = $placelibre;

    $event->image = $image;

    $event->save();

          // ---------------------------------
          $uploaddir = 'assets/picture/';
          $uploadfile = $uploaddir . $event->id .".png";

          if (move_uploaded_file($_FILES['myfile']['tmp_name'], $uploadfile)) {
              $image = $uploadfile;
          } else {
              $image = 'assets/picture/default.jpg';
          }
        //---------------------------------

        $event->image = $image;
        $event->update();


    return view('/event/newEvent');
   }

   public function edit($event)
   {
    $event = Event::where('id',$event)->firstorfail();


    return view('event.EditEvent',compact('event'));
   }

   public function update($event)
   {


    $event = Event::where('id',$event)->firstorfail();


    request() -> validate([
        'nom' => 'required'
        ,'shortdesc' => 'required'
        ,'dateStart' => 'required'
        ,'dateStop' => 'required'
        ,'hourStart' => 'required'
        ,'hourStop' => 'required'
        ,'placedispo' => 'required'
    ]);

   $placereserver = $event->placedispo - $event->placelibre;

    $nom = request('nom');

    $shortdesc = request('shortdesc');
    $longdesc = request('longdesc');

    $dateStart = request('dateStart');
    $hourStart = request('hourStart');
    $dateStop = request('dateStop');
    $hourStop = request('hourStop');

    $placedispo = request('placedispo');



    if($placedispo < $placereserver)
    {
        return redirect('/event/'.$event->id)->with('message',"Impossible de modifié l'evenement , le nombre de place disponible maximal attribué depace le nombre d'inscrit" );
    }
    else
    {
        $placelibre = $placedispo - $placereserver ;
    }

    //---------------------------------
        $uploaddir = 'assets/picture/';
        $uploadfile = $uploaddir . $event->id . ".png";

        if (move_uploaded_file($_FILES['myfile']['tmp_name'], $uploadfile)) {
            $image = $uploadfile;
        } else {
            $image = '/assets/picture/default.jpg';
        }
    //---------------------------------

    if(empty($longdesc))
    {
        $longdesc = $shortdesc;
    }


    $event->nom = $nom;

    $event->shortdesc = $shortdesc;
    $event->longdesc = $longdesc;

    $event->dateStart = $dateStart;
    $event->hourStart = $hourStart;
    $event->dateStop = $dateStop;
    $event->hourStop = $hourStop;

    $event->placedispo = $placedispo;
    $event->placelibre = $placelibre;

    $event->image = $image;
    $event->update();

       return redirect('event/'.$event->id);
   }

   public function destroy($event)
   {
     $event = Event::where('id',$event)->firstorfail();

     unlink ($event->image);
    $event->delete();
    return redirect('recherche');

   }


}
