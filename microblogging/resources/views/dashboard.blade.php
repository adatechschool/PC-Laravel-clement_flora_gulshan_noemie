<?php use microblogging\app\Http\Controllers\ArticleController; ?>

@extends("layouts.app")
@section("description", "Tous les articles")
@section("name")


<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                <h1>Tous les articles</h1>
                </div>
                <div>
                <p>
		<!-- Lien pour créer un nouvel article : "posts.create" -->
		<a href="{{ route('articles.create') }}" title="Créer un article" >Créer un nouveau post</a>
	</p>

	<!-- Le tableau pour lister les articles/posts -->
        <table border="1" >
            <thead>
                <tr>
                    <th>Titre</th>
                    <th colspan="2" >Opérations</th>
                </tr>
            </thead>
            <tbody>
                <!-- On parcourt la collection de Post -->
                @foreach ($articles as $article)
                <tr>
                    <td>
                        <!-- Lien pour afficher un Post : "posts.show" -->
                        <a href="{{ route('articles.show', $article) }}" title="Lire l'article" >{{ $article->description }}</a>
                    </td>
                    <td>
                        <!-- Lien pour modifier un Post : "posts.edit" -->
                        <a href="{{ route('articles.edit', $article) }}" title="Modifier l'article" >Modifier</a>
                    </td>
                    <td>
                        <!-- Formulaire pour supprimer un Post : "posts.destroy" -->
                        <form method="POST" action="{{ route('articles.destroy', $article) }}" >
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

                    </div>
                </div>
            </div>
        </div>
</x-app-layout>





	
@endsection
