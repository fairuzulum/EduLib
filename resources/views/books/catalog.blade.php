<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Catalog - Library System</title>
    @vite('resources/css/app.css')
    <link
        href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.4.0/css/all.min.css" rel="stylesheet">
    <style>
    
        .book-cover {
            position: relative;
            display: inline-block;
        }
        .book-cover::before,
        .book-cover::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0;
            transition: all 0.3s ease;
        }
        .book-cover::before {
            background: rgba(0, 0, 0, 0.6);
            border-radius: 8px;
        }
        .book-cover::after {
            content: 'View Detail';
            color: white;
            font-size: 1.5em;
            font-weight: bold;
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 1;
        }
        .book-cover:hover::before,
        .book-cover:hover::after {
            opacity: 1;
        }
      
    </style>
</head>
<body class="min-h-screen flex items-center justify-center bg-cover bg-center" style="background-image: url('{{ asset('images/shelf-books.jpg') }}');">
    <div class="container mx-auto px-4 py-8 bg-white bg-opacity-30 rounded-3xl shadow-2xl max-w-5xl backdrop-blur-md">
        <div class="mb-6 flex items-center justify-between">
            <a href="{{ route('dashboard') }}" class="text-white hover:text-gray-300">
                <i class="fas fa-arrow-left"></i>
            </a>
            @auth
            @if ( Auth::user()->role === 'librarian')
                <a href="{{ route('book.create') }}" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition">
                    <i class="fas fa-plus mr-2"></i> Add Book
                </a>
            @endif
            @endauth
        </div>

        <!-- Box Search -->
        <div class="mb-6">
            <form action="{{ route('book.search') }}" method="GET" class="flex items-center">
                <input type="text" name="query" placeholder="Search books..." class="flex-1 p-2 rounded-l-lg focus:outline-none focus:ring-2 focus:ring-blue-600 bg-white text-gray-800">
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-r-lg hover:bg-blue-700 transition">
                    <i class="fas fa-search"></i>
                </button>
            </form>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach ($books as $book)
                <div class="bg-white bg-opacity-30 rounded-lg shadow-lg p-2 backdrop-blur-md hover:shadow-xl transition duration-300">
                    <a href="{{ route('book.show', ['id' => $book->id]) }}" class="book-cover transform transition duration-300 ease-in-out hover:scale-105">
                        <img class="w-full h-auto aspect-[2/3] object-cover rounded-t-lg " src="{{ asset('storage/' . $book->cover_image) }}" alt="Book Cover">
                    </a>
                    <div class="p-4">
                        <h2 class="text-xl font-semibold text-gray-800 mb-2 line-clamp-2">{{ $book->title }}</h2>
                        <p class="text-sm text-gray-700 mb-2 line-clamp-3">{{ $book->description }}</p>
                        <div class="flex items-center mb-4">
                           
                            <span
                                class="text-sm {{ $book->status == 'available' ? 'bg-green-600' : 'bg-red-600' }} text-white px-3 py-1 rounded-full">
                                {{ ucfirst($book->status) }}
                            </span>
                        </div>
                       
                    </div>
                </div> @endforeach
        </div>

        <!-- Navigasi Paginasi -->
        <div class="mt-8
        flex justify-center">
    {{ $books->links('pagination::tailwind') }}
    </div>
    </div>
    </body>

</html>
