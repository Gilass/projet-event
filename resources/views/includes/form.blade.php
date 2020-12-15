@csrf
    <!--Ajouter Nom d'event -->
    <div class="InfoText">Nom de l'Evenement :</div>
    <div class ="form-group">
        <input type="text" class="form-control @error('nom') is-invalid @enderror" name="nom" value="{{ old('nom') ??  $event->nom ?? ''}}" >
        @error('nom')
        <div class="invalid-feedback">Saisissez le nom de votre evement</div>
        @enderror
    </div>

<br>


   <!--Description courte-->
   <div class="InfoText">Description courte :</div>
   <div class ="form-group">
    <input type="text" class="form-control" name="shortdesc" value="{{ old('shortdesc') ?? $event->shortdesc ?? ''}} ">
    @error('shortdesc')
    <div class="invalid-feedback">Saisissez une courte description</div>
    @enderror
</div>

<br>

   <!--Place disponible-->
   <div class="InfoText">Nombre de place disponible :</div>
   <div class ="form-group">
    <input type="number" class="form-control" name="placedispo" value="{{ old('placedispo') ?? $event->placedispo ?? ''}} ">
</div>

<br>

   <!--Description-->
   <div class="InfoText">Description ( Optionel ) :</div>
   <div class ="form-group">
    <input type="text" class="form-control" name="longdesc" value="{{ old('longdesc') ?? $event->longdesc ?? ''}} ">
</div>

   <!--Date-->
   <div class="InfoText">Date de l'evenement :</div>
   <div class ="form-group">
    <input type="date" id="start" name="dateStart" value="{{ old('dateStart') ?? $event->dateStart ?? ''}} ">
    <input type="time" id="appt" name="hourStart" value="{{ old('hourStart') ?? $event->hourStart ?? ''}} ">
    <br>Et fini le :<br>
    <input type="date" id="start" name="dateStop" value="{{ old('dateStop') ?? $event->dateStop ?? ''}} ">
    <input type="time" id="appt" name="hourStop" value="{{ old('hourStop') ?? $event->hourStop ?? ''}} ">
</div>
<br>
    <!--Choissisez une image pour votre evenement ( 200px/200px , optionel )-->
    <label for="myfile">Choisissez une image pour votre événement ( Optionnel ) : </label>
    <div class ="form-group">
    <input type="file" id="image" name="myfile" accept="image/*"/>

</div>
<br>
