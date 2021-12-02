@extends("layouts.app")
@section("title", "votre profil")
@section("content")
    
	<h1>votre profil</h1>
    <p>
		<!-- Lien pour éditer son profil : "users.edit" -->
		<a href="{{ route('users.edit', $user) }}" title="Editer le profil" >Editer le profil</a>
	</p>
  {{$user->name}}:
  <br>
  {{$user->biography}}
    <div class="flex items-center">
  <img src="{{ asset('storage/'.trim($user->user_img, '"')) }}" height="300px" width="300px" alt="">
    @foreach ($articles as $article)
    <div class="p-20 border-t border-gray-400 dark:border-gray-700 md:border-t-0 md:border-l">
    <div class="flex items-center">
				<td>
					<!-- Lien pour afficher un Post : "posts.show" -->
					<a>{{ $article->description }}</a>
					<img src="{{ asset('storage/'.trim($article->img_url, '"')) }}" height="550px" width="550px" alt="">

				</td>
    @endforeach
@endsection