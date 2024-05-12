@extends('ngeblog.blog-layout')

@section('content')
    <section class="py-10 relative bg-gray-100">
        <div class="mx-auto max-w-6xl px-4 text-center tracking-wider">
            <h1 class="main-title text-4xl font-black mb-4">Ngeblog Sample Page</h1>
            <p class="text-xl">Get interesting insights on various topics about Technology & Software.</p>
        </div>
    </section>

    <section class="py-8">
        <div class="mx-auto max-w-6xl px-4">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                @forelse ($posts as $post)
                    <div class="group hover:bg-sky-50 hover:scale-[.98] hover:shadow-sky-500 duration-100 transform relative flex flex-col gap-4 border rounded-lg mb-4 p-4 shadow-sm">
                        <a href="{{ route('blogs.show', $post->slug) }}" class="absolute inset-0"></a>

                        @if ($post->tags->isNotEmpty())
                            <div class="flex flex-wrap items-center gap-2">
                                @foreach ($post->tags as $tag)
                                    <span class="py-1 px-2 rounded bg-sky-100 text-sm tracking-wider">{{ $tag->title }}</span>
                                @endforeach
                            </div>
                        @endif

                        <h3 class="group-hover:text-sky-600 text-xl font-bold tracking-wider underline underline-offset-2">
                            {{ $post->title }}
                        </h3>
                        <p class="flex-grow line-clamp-3">{{ $post->excerpt }}</p>

                        <div class="flex items-center justify-between">
                            <span data-date="{{ $post->created_at->toString() }}" class="py-1 px-2 border rounded bg-gray-50 text-sm tracking-wider"></span>
                            <span>&rarr;</span>
                        </div>
                    </div>
                @empty
                    <div>
                        <p class="italic text-center">No blogs yet...</p>
                    </div>
                @endforelse
            </div>
            
            {{ $posts->links() }}
        </div>
    </section>
@endsection