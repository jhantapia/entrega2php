<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('firstname')->nullable();;
            $table->string('lastname')->nullable();;
            $table->string('second_lastname')->nullable();;
            $table->string('email')->unique();
            $table->string('password');
            $table->boolean('active')->default(1);
            $table->string('avatar')->default('public/avatars/user-default.png')->nullable();
            $table->rememberToken();

            $table->integer('role_id')->unsigned();
            $table->foreign('role_id')->references('id')->on('roles');
            $table->string('recovery_pin')->nullable();
            $table->dateTime('last_login_date')->nullable();
            $table->dateTime('actual_login_date')->nullable();

            $table->timestamps();
        });

        $users = [
            [ 'id' => null,'role'=>'administrador', 'firstname' => 'admin', 'email'=>'admin@admin.com']
        ];

        foreach ($users as $user){
            $role = App\Model\Role::where('name','like', $user['role'])->first();
            $u = new App\Model\User();
            $u->id = $user['id'];
            $u->role_id = $role->id;
            $u->email = $user['email'];
            $u->firstname = $user['firstname'];
            $u->password = bcrypt('1234');
            $u->save();
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
