{{-- {{ dd($post->id) }} --}}
<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <form action="{{ route('posts.update', $post->id) }}" method="POST">
        @csrf
        @method('PUT')
    
        <div class="space-y-12">
          <div class="pb-12 border-b border-gray-900/10">
            <h2 class="font-semibold text-gray-900 text-base/7">Book Form</h2>
            <p class="mt-1 text-gray-600 text-sm/6">This information will be displayed publicly so be careful what you share.</p>
      
            <div class="grid grid-cols-1 mt-10 gap-x-6 gap-y-8 sm:grid-cols-6">
              <div class="sm:col-span-4">
                <label for="title" class="block font-medium text-gray-900 text-sm/6">Title</label>
                <div class="mt-2">
                  <div class="flex items-center pl-3 bg-white rounded-md outline outline-1 -outline-offset-1 outline-gray-300 focus-within:outline focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-600">
                    <input type="text" name="title" id="title" class="block min-w-0 grow py-1.5 pl-1 pr-3 text-base text-gray-900 placeholder:text-gray-400 focus:outline focus:outline-0 sm:text-sm/6" value='{{ $post->title }}'>
                  </div>
                </div>
              </div>
              <div class="sm:col-span-4">
                <label for="description" class="block font-medium text-gray-900 text-sm/6">Author</label>
                <div class="mt-2">
                  <div class="flex items-center pl-3 bg-white rounded-md outline outline-1 -outline-offset-1 outline-gray-300 focus-within:outline focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-600">
                    <input type="text" name="author" id="author" class="block min-w-0 grow py-1.5 pl-1 pr-3 text-base text-gray-900 placeholder:text-gray-400 focus:outline focus:outline-0 sm:text-sm/6" value='{{ $post->author }}'>
                  </div>
                </div>
              </div>
              
      
              <div class="col-span-full">
                <label for="description" class="block font-medium text-gray-900 text-sm/6">Description</label>
                <div class="mt-2">
                  <textarea name="description" id="description" rows="3" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">{{ old('description', $post->description) }}</textarea>
                </div>
                <p class="mt-3 text-gray-600 text-sm/6">Write a few sentences about your book.</p>
              </div>
      
             
        </div>
      
        <div class="flex items-center justify-end mt-6 gap-x-6">
          <a href="{{ route('posts.show', $post->id) }}" class="font-semibold text-gray-900 text-sm/6">Cancel</a>
          <button type="submit" class="px-3 py-2 text-sm font-semibold text-white bg-indigo-600 rounded-md shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Save</button>
        </div>
      </form>
      
</x-layout>