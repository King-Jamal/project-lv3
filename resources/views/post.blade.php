<x-layout>
 
  <x-slot:title>{{ $title }}</x-slot:title>

  <article class="max-w-screen-md py-8 border-b border-gray-400">
   
    <h2 class="mb-1 text-3xl tracking-tight text-gray-900 font-bolt hover:underline">{{ $post->title }}</h2>
  
    <div class="text-base text-gray-500"><a href="#">{{ $post->author }}</a>  |{{ $post->created_at->diffForHumans() }}</div>
    <p class="my-4 font-light">{{$post->description }}</p>
    <div class="flex justify-between">
      <a href="{{ route('posts.index') }}" class="font-medium text-blue-500 hover:underline">&laquo; Back </a>

      <div class="flex gap-3 space-x-2">
        <a href="{{ route('posts.edit', $post->id) }}" class='block font-medium text-green-500 hover:underline'>Edit</a>
        <form action="{{ route('posts.destroy', $post->id) }}" method="POST" onsubmit="return confirm('Are you sure?');">
          @csrf
          @method('DELETE')
          <button type="submit" class="font-medium text-red-500 hover:underline">Delete</button>
        </form>
      </div>
    </div>

  </article>
  
 
</x-layout>
