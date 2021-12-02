@extends("layouts.app")
@section("title", "votre profil")
@section("content")

	<h1>votre profil</h1>
    <p>
		<!-- Lien pour éditer son profil : "users.edit" -->
		<a href="{{ route('users.edit', $user) }}" title="Editer le profil" >Editer le profil</a>
	</p>
  {{$user->name}}:
  {{$user->biography}}
  <img src="{{ asset('storage/'.trim($user->user_img, '"')) }}" height="700px" width="700px" alt="">
    @foreach ($articles as $article)
				<td>
					<!-- Lien pour afficher un Post : "posts.show" -->
					<a>{{ $article->description }}</a>
					<img src="{{ asset('storage/'.trim($article->img_url, '"')) }}" height="300px" width="300px" alt="">

				</td>
    @endforeach
@endsection