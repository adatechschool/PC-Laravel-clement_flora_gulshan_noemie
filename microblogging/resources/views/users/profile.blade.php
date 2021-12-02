@extends("layouts.app")
@section("title", "votre profil")
@section("content")

	<h1>votre profil</h1>
    <p>
		<!-- Lien pour créer un nouvel article : "posts.create" -->
		<a href="{{ route('users.edit', $user) }}" title="Créer un article" >Editer le profil</a>
	</p>
  {{$user->name}}:
  {{$user->biography}}
  <img src="{{ asset('storage/'.trim($user->user_img, '"')) }}" height="700px" width="700px" alt="">
@endsection