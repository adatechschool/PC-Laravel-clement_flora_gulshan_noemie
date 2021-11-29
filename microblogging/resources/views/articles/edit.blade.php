@extends("layouts.app")
@section("title", "Editer un post")
@section("content")

	<h1>Editer un post</h1>

	<!-- Si nous avons un Post $post -->
	@if (isset($article))

	<!-- Le formulaire est géré par la route "posts.update" -->
	<form method="POST" action="{{ route('articles.update', $article) }}" enctype="multipart/form-data" >

		<!-- <input type="hidden" name="_method" value="PUT"> -->
		@method('PUT')

	@else

	<!-- Le formulaire est géré par la route "posts.store" -->
	<form method="POST" action="{{ route('articles.store') }}" enctype="multipart/form-data" >

	@endif

		<!-- Le token CSRF -->
		@csrf
		
		<p>
			<label for="description" >Description</label><br/>

			<!-- S'il y a un $post->title, on complète la valeur de l'input -->
			<input type="text" name="description" value="{{ isset($article->description) ? $article->description : old('description') }}"  id="description" placeholder="Le titre du post" >

			<!-- Le message d'erreur pour "title" -->
			@error("description")
			<div>{{ $message }}</div>
			@enderror
		</p>

		<!-- S'il y a une image $post->picture, on l'affiche -->
		@if(isset($article->img_url))
		<p>
			<span>Image</span><br/>
			<img src="{{ asset('storage/'.$article->img_url) }}" alt="image de couverture actuelle" style="max-height: 200px;" >
		</p>
		@endif

		<p>
			<label for="img_url" >Image</label><br/>
			<input type="file" name="img_url" id="img_url" >

			<!-- Le message d'erreur pour "picture" -->
			@error("img_url")
			<div>{{ $message }}</div>
			@enderror
		</p>
		<p>
			<label for="name" >Nom User</label><br/>

			<!-- S'il y a un $post->content, on complète la valeur du textarea -->
			<textarea name="name" id="name" lang="fr" rows="10" cols="50" placeholder="Le nom du user" >{{ isset($article->name) ? $article->name : old('name') }}</textarea>

			<!-- Le message d'erreur pour "content" -->
			@error("name")
			<div>{{ $message }}</div>
			@enderror
		</p>

		<input type="submit" name="valider" value="Valider" >

	</form>

@endsection