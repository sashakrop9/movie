    <h1>Create Movie</h1>
    <form action="{{ route('movies.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div>
            <label for="title">Title:</label>
            <input type="text" name="title" id="title" required>
        </div>
        <div>
            <label for="description">Description:</label>
            <textarea name="description" id="description" required></textarea>
        </div>
        <div>
            <label for="image">Image:</label>
            <input type="file" name="image" id="image">
        </div>
        <button type="submit">Create Movie</button>
    </form>

