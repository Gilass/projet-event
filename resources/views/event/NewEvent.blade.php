@extends('layouts.app')

@section('content')
<h1>Ajouter un Evenement :</h1>
    <br>
    <br>
<form action="" method="POST" enctype="multipart/form-data">
    @include("includes.form")

    <!--Ajouter Objet -->
    <button type="submit" class="btn btn-primary">Ajouter un Evenement</button>





</form>


@endsection


