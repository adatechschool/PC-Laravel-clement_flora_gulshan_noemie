<x-guest-layout>
  {{$article->user->name}}: 
  {{$article->description}}
  <img src="{{ asset('storage/'.trim($article->img_url, '"')) }}" height="700px" width="700px" alt="">
</x-guest-layout>