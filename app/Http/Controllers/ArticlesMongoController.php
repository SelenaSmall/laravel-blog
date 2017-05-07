<?php
	namespace App\Http\Controllers;

	use Illuminate\Support\Facades\Auth;
	use Illuminate\Http\Request;
	use App\ArticlesMongo;
	use Illuminate\Foundation\Auth\AuthenticatesUsers;
	use Illuminate\Support\Facades\DB;
	use Illuminate\Database\Eloquent\Collection;

	class ArticlesMongoController extends Controller {

		use AuthenticatesUsers;

		/**
		 * Construct
		 */
		public function __construct() {
			$this->middleware('guest')->only('');
		}

		/**
		 * Display a index of articles
		 *
		 * @return \Illuminate\Http\Response
		 */
		public function index() {
			$articles = DB::connection('mongodb')->collection('articles')->get();

			return view('articles.index', compact('articles'));
		}

		/**
		 * Show an individual article
		 *
		 * @param  int $id
		 * @return \Illuminate\Http\Response
		 */
		public function show($id) {
			$article = DB::connection('mongodb')->collection('articles')->where('_id', $id)->get();

			return view('articles.show', compact('article'));
		}

		/**
		 * Show the form for creating a new article
		 *
		 * @return \Illuminate\Http\Response
		 */
		public function create() {

			return view('articles.create');
		}

		/**
		 * Store a new article instance
		 *
		 * @param  \Illuminate\Http\Request  $request
		 * @return \Illuminate\Http\Response
		 */
		public function store(Request $request) {
			$this->validate($request, [
				'title' => 'required|max:255',
				'body'	=> 'required|max:255',
			]);

			$article = new articlesMongo;
			$article->title =  $request->input('title');
			$article->body =  $request->input('body');
			$article->author =  Auth::user()->name;
			$article->save();

			return redirect('/articles')->with('success', 'article was created successfully');
		}

		/**
		 * Show the form for editing the specified article
		 *
		 * @param  ArticlesMongo $article
		 * @return \Illuminate\Http\Response
		 */
		public function edit(ArticlesMongo $article) {
			$article = DB::connection('mongodb')->collection('articles')->where('_id', $article->id)->get();

			return view('articles.edit', compact('article'));
		}

		/**
		 * Update the specified articles in storage.
		 *
		 * @param Request $request
		 * @param ArticlesMongo $article
		 * @return \Illuminate\Http\Response
		 */
		public function update(Request $request, ArticlesMongo $article) {
			$this->validate($request, [
				'title' => 'required|max:255',
				'body'	=> 'required|max:255',
			]);

			DB::connection('mongodb')->collection('articles')->where('_id', $article->id)->update($request->all());

			return back()->with('success', 'Article info updated successfully.');
		}

		/**
		 * Remove the specified articles from storage.
		 *
		 * @param ArticlesMongo $article
		 * @return \Illuminate\Http\Response
		 */
		public function destroy(ArticlesMongo $article) {
			DB::connection('mongodb')->collection('articles')->where('_id', $article->id)->delete();

			return redirect('/articles')->with('success', 'Article was deleted');
		}

	}