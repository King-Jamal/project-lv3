<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <div class='flex gap-3'>
      <h1 class='font-bold text-md'>Do u want to create a new post?</h1>
      <a href="{{ route('posts.create') }}" class="font-medium text-blue-500 hover:underline">Create a Post</a>
    </div>
    @foreach ($posts as $post )
    <article class="max-w-screen-md py-8 border-b border-gray-400">
      <a href="/posts/{{ $post->id }}">
       <h2 class="mb-1 text-3xl tracking-tight text-gray-900 font-bolt hover:underline">{{ $post->title }}</h2>
      </a>
      <div class="text-base text-gray-500"><a href="#">{{ $post->author }}</a>  | {{ $post->created_at->format('j F Y') }}</div>
      {{-- <div class="text-base text-gray-500"><a href="#">{{ $post['author'] }}</a>  | {{ $post->created_at->diffForHumans() }}</div> --}}
      <p class="my-4 font-light">{{Str::limit($post->description, 100) }}</p>
      <a href="{{ route('posts.show', $post->id) }}" class="font-medium text-blue-500 hover:underline">Read More &raquo;</a>
    </article>
    @endforeach
  </x-layout>