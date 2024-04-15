<h1>{{ $movie->title }}</h1>
<p>{{ $movie->description }}</p>

@if ($movie->image)
    <img src="{{ asset($movie->image) }}" alt="{{ $movie->title }}">
@endif

