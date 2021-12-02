@extends("layouts.app")
@section("title", "Editer votre profil")
@section("content")

	<h1>Editer votre profil</h1>

	
	<!-- Le formulaire est géré par la route "posts.update" -->
	<form method="POST" action="{{ route('users.update', $user) }}" enctype="multipart/form-data" >

		<!-- <input type="hidden" name="_method" value="PUT"> -->
		@method('PUT')

			<!-- Le token CSRF -->
		@csrf
		
		<p>
			<label for="biography" >Biographie</label><br/>

			<!-- S'il y a un $post->title, on complète la valeur de l'input -->
			<input type="text" name="biography" value="{{ isset($user->biography) ? $user->biography : old('biography') }}"  id="biography" placeholder="A propos de vous..." >

			<!-- Le message d'erreur pour "title" -->
			@error("biography")
			<div>{{ $message }}</div>
			@enderror
		</p>

		<!-- S'il y a une image $post->picture, on l'affiche -->
		@if(isset($user->user_img))
		<p>
			<span>Votre image de profil</span><br/>
			<img src="{{ asset('storage/'.$user->user_img) }}" alt="image de profil actuelle" style="max-height: 200px;" >
		</p>
		@endif

		<p>
			<label for="user_img" >Image</label><br/>
			<input type="file" name="user_img" id="user_img" >

			<!-- Le message d'erreur pour "picture" -->
			@error("user_img")
			<div>{{ $message }}</div>
			@enderror
		</p>
		<p>
			<x-slot name="user">
				<div>{{Auth::user()->name}}</div>
			</x-slot>
		</p>

		<input type="submit" name="valider" value="Valider" >

	</form>

@endsection