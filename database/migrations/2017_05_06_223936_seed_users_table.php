<?php

    use Illuminate\Support\Facades\Schema;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Database\Migrations\Migration;

    class SeedUsersTable extends Migration {

        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up() {
            DB::table('users')->insert(
                array(
                    array(
                        'name' => 'admin',
                        'email' => 'admin@email.com',
                        'password' => Hash::make('test'),
                        'role'  => 'admin'
                    ),
                ));
        }

        /**
         * Reverse the migrations.
         *
         * @return void
         */
        public function down() {
            DB::table('users')->delete();
        }
    }