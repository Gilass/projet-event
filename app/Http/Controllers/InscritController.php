<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;
use App\User;
use App\Inscrit;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class InscritController extends Controller
{
    public function show()
    {
         $inscrit= Inscrit::all();
         $event= Event::all();
         $user= User::all();
         return view('admin.ListeInscrit',compact('event','inscrit','user'));
    }

    public function show_user()
    {
         $inscrit= Inscrit::all();
         $event= Event::all();
         $user= User::all();
         return view('admin.ListeUser',compact('event','inscrit','user'));
    }

    public function user_inscrit(){
    $inscrit = Inscrit::where('user_id', '=' , Auth::id())->get();

    return view('VosEvent' ,compact('inscrit'));
    }

    public function inscription($event)
    {
     $event = Event::where('id',$event)->firstorfail();
     $user = User::where('id',Auth::id())->firstorfail();

    //
   //
     if($event->placelibre > 0)
     {
         $event->placelibre--;

         $event->update();

         $inscrit = new Inscrit();

         $inscrit->event_id = $event->id;
         $inscrit->nom = $user->name;
         $inscrit->email = $user->email;
         $inscrit->user_id = $user->id;

         $inscrit->save();
         return redirect("/event/".$event->id);
     }
     else
     {
        return redirect('/event/'.$event->id)->with('message',"L'évènement est complet" );
     }

    }

    public function destroy($event,$inscrit)
    {
      $event = Event::where('id',$event)->firstorfail();
      $inscrit = Inscrit::where('user_id',$inscrit)->firstorfail();

    $event->placelibre ++;

     $event->update();
     $inscrit->delete();

     $inscrit= Inscrit::all();
     $event= Event::all();

     return view('admin.ListeInscrit',compact('event','inscrit'));

    }

}
