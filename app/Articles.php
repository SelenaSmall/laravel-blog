<?php

	namespace App;

	use Illuminate\Database\Eloquent\Model;

	class Articles extends Model {

		protected $fillable = [
			'author', 'title', 'body'
		];

		/**
		 * One to many relationship between user and articles.
		 */
		public function user() {

			return $this->belongsTo(User::class);
		}

	}
