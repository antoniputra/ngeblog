@extends('ngeblog.blog-layout')

@section('content')
    <section class="py-10 relative bg-gray-50">
        <div class="mx-auto max-w-6xl px-4 flex flex-col gap-4 tracking-wider pb-8">
            <a href="{{ route('blogs.index') }}" class="self-start inline-flex py-1 px-3 border rounded bg-white hover:bg-sky-100">
                &larr; Posts List
            </a>
            
            <h1 class="main-title text-4xl font-black text-center">{{ $post->title }}</h1>
            <div class="flex items-center justify-between gap-4">
                @if ($post->tags->isNotEmpty())
                    <div class="flex flex-wrap items-center gap-2">
                        @foreach ($post->tags as $tag)
                            <span class="py-1 px-2 rounded bg-sky-100 text-sm tracking-wider">{{ $tag->title }}</span>
                        @endforeach
                    </div>
                @endif

                <span data-date="{{ $post->created_at->toString() }}" class="self-start py-1 px-2 border rounded bg-white text-sm tracking-wider" />
            </div>
        </div>
    </section>

    <section class="py-4">
        <div class="mx-auto max-w-4xl px-4">
            <div class="py-8 mb-8 text-center italic">
                <p class="text-xl">{{ $post->excerpt }}</p>
            </div>

            <div class="mx-auto prose prose-base lg:prose-lg focus:outline-none dark:prose-invert">
                {!! $post->content !!}
            </div>
        </div>
    </section>
@endsection