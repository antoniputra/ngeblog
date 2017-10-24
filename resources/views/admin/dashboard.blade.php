@extends('ngeblog::admin.layout')

@section('content')

    <nav class="level">
        <div class="level-item has-text-centered">
            <div>
                <p class="heading">Category</p>
                <p class="title">{{ Ngeblog::totalCategory() }}</p>
            </div>
        </div>
        <div class="level-item has-text-centered">
            <div>
                <p class="heading">Blog</p>
                <p class="title">{{ Ngeblog::totalBlog() }}</p>
            </div>
        </div>
    </nav>

@stop
