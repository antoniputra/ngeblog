<div class="card" style="margin-bottom: 20px;">
    <header class="card-header">
        <p class="card-header-title">
            <a href="{{ route('blog.show', $blog['id']) }}">
                {{ $blog['title'] }}
            </a>
        </p>
    </header>
    <div class="card-content">
        <div class="content">
            {{ substr($blog['content'], 0, 200) }}
            <hr>
            <div class="level">
                <div class="level-left">
                    <a href="{{ route('category.show', $blog['category']['id']) }}">{{ $blog['category']['title'] }}</a>
                    &nbsp;&nbsp;-&nbsp;&nbsp;
                    <small>{{ $blog['created_at']->toFormattedDateString() }}</small>
                </div>
                <div class="level-right">
                    <a href="{{ route('blog.show', $blog['id']) }}">
                        Read More &raquo;
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
