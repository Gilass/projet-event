<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\User;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('nom');
            $table->string('shortdesc');
            $table->string('longdesc');
            $table->string('image');
            $table->string('hourStart');
            $table->date('dateStart');
            $table->string('hourStop');
            $table->date('dateStop');
            $table->integer('placedispo');
            $table->integer('placelibre');

        });

        $user = new User();
        $user->name = 'admin';
        $user->email = 'admin@admin';
        $user->password = '$2y$10$tCgjTV8o1fn93f3adwYGRuvhReXRdaZRsMZFd3YtyEu7mTthf4yEW';
        $user->role = 'admin';
        $user->save();

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('events');
    }
}
