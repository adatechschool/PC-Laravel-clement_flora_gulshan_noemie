@extends("layouts.app")
@section("title", "Tous les articles")
@section("content")

	<h1>Tous les articles</h1>

	<p>
		<!-- Lien pour créer un nouvel article : "posts.create" -->
		<a href="{{ route('articles.create') }}" title="Créer un article" >Créer un nouveau post</a>
	</p>

	<!-- Le tableau pour lister les articles/posts -->
	<table border="1" >
		<thead>
			<tr>
				<th>Titre</th>
			</tr>
		</thead>
		<tbody>
			<!-- On parcourt la collection de Post -->
			@foreach ($articles as $article)
			<tr class="flex flex-col p-6" >
				<td class=" flex-row p-6">
					<!-- Lien pour afficher un Post : "posts.show" -->
					<a href="{{ route('articles.show', $article) }}" title="Lire l'article" >{{ $article->description }}</a>
					<img src="{{ asset('storage/'.trim($article->img_url, '"')) }}" height="300px" width="300px" alt="">

				</td>
				<td >
					<!-- Lien pour modifier un Post : "posts.edit" -->
					<a href="{{ route('articles.edit', $article) }}" title="Modifier l'article" class="w-1/2 flex items-center justify-center rounded-full bg-purple-50 text-purple-700" type="button">Modifier</a>
				</td>
				<td>
					<!-- Formulaire pour supprimer un Post : "posts.destroy" -->
					<form method="POST" class="w-1/2 flex items-center justify-center rounded-full bg-purple-50 text-purple-700" type="button" action="{{ route('articles.destroy', $article) }}" >
						<!-- CSRF token -->
						@csrf
						<!-- <input type="hidden" name="_method" value="DELETE"> -->
						@method("DELETE")
						<input type="submit" value="x Supprimer" >
					</form>
				</td>
			</tr>
			@endforeach
			
		</tbody>
	</table>
	<?php echo $articles->render(); ?>
	
@endsection