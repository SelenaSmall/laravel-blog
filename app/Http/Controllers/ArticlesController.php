<?php

	namespace App\Http\Controllers;

	use Illuminate\Support\Facades\Auth;
	use Illuminate\Http\Request;
	use App\User;
	use App\Articles;
	use Illuminate\Foundation\Auth\AuthenticatesUsers;

	class ArticlesController extends Controller {

		use AuthenticatesUsers;

		public function __construct() {
			$this->middleware('guest')->only('');
		}

		/**
		 * Display a index of articles
		 *
		 * @return \Illuminate\View\View
		 */
		public function index() {

			$articles = Articles::paginate(5);

			return view('articles.index', compact('articles'));
		}

		/**
		 * Show an individual article
		 *
		 * @param $id
		 * @return \Illuminate\View\View
		 */
		public function show($id) {

			$article = Articles::findOrFail($id);

			return view('articles.show', compact('article'));
		}

		/**
		 * Show the form for creating a new article
		 *
		 * @return \Illuminate\View\View
		 */
		public function create() {

			return view('articles.create');
		}

		/**
		 * Store a new article instance
		 *
		 * @param  Request  $request
		 * @return \Illuminate\View\View
		 */
		public function store(Request $request) {

			$this->validate($request, [
				'title'     => 'required|max:255',
				'body'  => 'required|max:255'
			]);

			Articles::create([
				'title'     => $request->input('title'),
				'body' => $request->input('body'),
				'author'   => Auth::user()->name,
			]);

			return redirect('/articles')->with('success', 'article was created successfully');
		}

		/**
		 * Show the form for editing the specified article
		 *
		 * @param  Articles $article
		 * @return \Illuminate\View\View
		 */
		public function edit(Articles $article) {

			return view('articles.edit', compact('article'));
		}

		/**
		 * Update the specified articles in storage.
		 *
		 * @param Request $request
		 * @return \Illuminate\View\View
		 */
		public function update(Request $request, Articles $article) {

			$this->validate($request, [
				'title' => 'required|max:255',
				'body'	=> 'required|max:255',
			]);
			$article->update($request->all());

			return back()->with('success', 'Article info updated successfully.');
		}

		/**
		 * Remove the specified articles from storage.
		 *
		 * @param Articles $article
		 * @return \Illuminate\View\View
		 */
		public function destroy(Articles $article) {
			$article->delete();

			return redirect('/articles')->with('success', 'Article was deleted');
		}
	}