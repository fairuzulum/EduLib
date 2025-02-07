<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Book - Library System</title>
    @vite('resources/css/app.css')
    <link href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.4.0/css/all.min.css" rel="stylesheet">
</head>

<body class="min-h-screen flex items-center justify-center bg-cover bg-center" style="background-image: url('{{ asset('images/shelf-books.jpg') }}');">
    <div class="container mx-auto px-6 py-8 bg-white bg-opacity-40 rounded-3xl shadow-xl max-w-2xl backdrop-blur-lg">
        <div class="mb-6 flex items-center justify-between">
            <a href="{{ route('book.catalog') }}" class="text-slate-900 hover:text-blue-700 font-semibold flex items-center">
                <i class="fas fa-arrow-left mr-2"></i> Back to Catalog
            </a>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow-lg">
            <h2 class="text-2xl font-bold text-gray-800 text-center mb-6">Add a New Book</h2>
            <form action="{{ route('book.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                <div>
                    <label for="title" class="block text-gray-700 font-semibold">Title</label>
                    <input type="text" name="title" id="title" placeholder="Enter book title"
                        class="w-full px-4 py-3 mt-2 rounded-lg border border-gray-300 focus:border-blue-500 focus:ring-blue-500 text-gray-700 shadow-sm" required>
                </div>

                <div>
                    <label for="author" class="block text-gray-700 font-semibold">Author</label>
                    <input type="text" name="author" id="author" placeholder="Enter author name"
                        class="w-full px-4 py-3 mt-2 rounded-lg border border-gray-300 focus:border-blue-500 focus:ring-blue-500 text-gray-700 shadow-sm" required>
                </div>

                <div>
                    <label for="genre" class="block text-gray-700 font-semibold">Genre</label>
                    <select name="genre" id="genre"
                        class="w-full px-4 py-3 mt-2 rounded-lg border border-gray-300 focus:border-blue-500 focus:ring-blue-500 text-gray-700 shadow-sm" required>
                        <option value="" disabled selected>Select a genre</option>
                        <option value="Fiction">Fiction</option>
                        <option value="Non-Fiction">Non-Fiction</option>
                        <option value="Fantasy">Fantasy</option>
                        <option value="Science Fiction">Science Fiction</option>
                        <option value="Mystery">Mystery</option>
                        <option value="Romance">Romance</option>
                        <option value="Horror">Horror</option>
                        <option value="Thriller">Thriller</option>
                        <option value="Historical">Historical</option>
                    </select>
                </div>

                <div>
                    <label for="publisher" class="block text-gray-700 font-semibold">Publisher</label>
                    <input type="text" name="publisher" id="publisher" placeholder="Enter publisher"
                        class="w-full px-4 py-3 mt-2 rounded-lg border border-gray-300 focus:border-blue-500 focus:ring-blue-500 text-gray-700 shadow-sm" required>
                </div>

                <div>
                    <label for="published_year" class="block text-gray-700 font-semibold">Published Year</label>
                    <input type="number" name="published_year" id="published_year" placeholder="Year published" min="1000" max="{{ date('Y') + 1 }}"
                        class="w-full px-4 py-3 mt-2 rounded-lg border border-gray-300 focus:border-blue-500 focus:ring-blue-500 text-gray-700 shadow-sm" required>
                </div>

                <div>
                    <label for="description" class="block text-gray-700 font-semibold">Description</label>
                    <textarea name="description" id="description" rows="4" placeholder="Describe the book..."
                        class="w-full px-4 py-3 mt-2 rounded-lg border border-gray-300 focus:border-blue-500 focus:ring-blue-500 text-gray-700 shadow-sm" required></textarea>
                </div>

                <div>
                    <label for="cover_image" class="block text-gray-700 font-semibold">Cover Image</label>
                    <input type="file" name="cover_image" id="cover_image"
                        class="mt-3 w-full file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-500 file:text-white hover:file:bg-blue-600">
                    <div id="image-preview" class="mt-4 flex justify-center"></div>
                </div>

                <button type="submit"
                    class="w-full py-3 px-6 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition duration-300 ease-in-out shadow-md hover:shadow-lg">
                    Add Book
                </button>
            </form>
        </div>
    </div>

    <script>
        document.getElementById('cover_image').addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const imagePreview = document.getElementById('image-preview');
                    imagePreview.innerHTML = `<img src="${e.target.result}" alt="Preview" class="w-48 h-64 object-cover rounded-lg shadow-md">`;
                };
                reader.readAsDataURL(file);
            }
        });
    </script>
</body>

</html>
