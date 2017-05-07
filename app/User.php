<?php

    namespace App;

    use Illuminate\Notifications\Notifiable;
    use Illuminate\Foundation\Auth\User as Authenticatable;

    class User extends Authenticatable {

        use Notifiable;

        /**
         * The attributes that are mass assignable.
         *
         * @var array
         */
        protected $fillable = [
            'name', 'email', 'password',
        ];

        /**
         * The attributes that should be hidden for arrays.
         *
         * @var array
         */
        protected $hidden = [
            'password', 'remember_token',
        ];

        /**
         * Check whether user is admin.
         */
        public function isAdmin() {

            return ($this->users()->role('admin')) ? true : false;
        }

        /**
         * One to many relationship between user and articles.
         */
        public function articles() {

            return $this->hasMany(Articles::class);
        }

    }
