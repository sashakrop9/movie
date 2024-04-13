<h1><a href="{{ route('movies.create') }}">Создать новый фильм</a></h1>
<h1>Movies</h1>
@foreach ($movies as $movie)
    <div>
        <a href="{{ route('movies.show', $movie) }}">
            <h2>{{ $movie->title }}</h2>
            @if ($movie->image)
                    <img src="{{ asset( $movie->image) }}" alt="{{ $movie->title }}">
            @endif
        </a>
    </div>
@endforeach

{{ $movies->links() }}
