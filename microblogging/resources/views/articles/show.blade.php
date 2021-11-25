<x-guest-layout>
  {{$article->user->name}}: 
  {{$article->description}}
  <img src="{{ $article->img_url }}">
</x-guest-layout>