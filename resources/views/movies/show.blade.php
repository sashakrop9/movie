<h1>{{ $movie->title }}</h1>
<p>{{ $movie->description }}</p>

@if ($movie->image)
    <img src="{{ asset('public/storage/' . $movie->image) }}" alt="{{ $movie->title }}">
@endif

