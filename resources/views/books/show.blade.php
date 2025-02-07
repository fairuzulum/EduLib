<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Details - Library System</title>
    @vite('resources/css/app.css')
    <link
        href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.4.0/css/all.min.css" rel="stylesheet">
</head>
<body class="min-h-screen flex items-center justify-center bg-cover bg-center" style="background-image: url('{{ asset('images/shelf-books.jpg') }}');">
    <div class="container mx-auto px-4 py-8 bg-white bg-opacity-30 rounded-3xl shadow-2xl max-w-5xl backdrop-blur-md text-gray-800">
        <div class="flex justify-between items-center mb-6">
            <a href="{{ route('book.catalog') }}" class="text-white hover:text-gray-300 transition">
                <i class="fas fa-arrow-left text-xl"></i> 
            </a>
            @auth
            @if (Auth::user()->role === 'admin' || Auth::user()->role === 'librarian')
                <div class="flex space-x-2">
                    <a href="{{ route('book.edit', ['id' => $book->id]) }}"  class="px-3 py-1.5 bg-blue-600 text-white rounded-full hover:bg-blue-700 transition-all duration-300 ease-in-out shadow hover:shadow-lg">
                        <i class="fas fa-edit"></i>
                    </a>
                    <button type="button" onclick="showDeleteModal('{{ route('book.delete', ['id' => $book->id]) }}')" class="px-3 py-1.5 bg-red-600 text-white rounded-full hover:bg-red-700 transition-all duration-300 ease-in-out shadow hover:shadow-lg">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
            @endif
            @endauth
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div class="flex justify-center items-start md:items-center">
                <img class="w-80 h-90 object-cover rounded-2xl shadow-lg transform transition duration-300 ease-in-out hover:scale-105"
                    src="{{ $book->cover_image ? asset('storage/' . $book->cover_image) : asset('images/cover.png') }}"
                    alt="{{ $book->title }}">
            </div>
            <div class="bg-white bg-opacity-30 rounded-lg shadow-lg p-4 backdrop-blur-md hover:shadow-xl transition duration-300">
                <h2 class="text-3xl font-bold mb-4 text-gray-800">{{ $book->title }}</h2>

                <div class="mb-4">
                    <p class="text-sm text-gray-700"><strong>Author:</strong> {{ $book->author }}</p>
                    <p class="text-sm text-gray-700"><strong>Genre:</strong> {{ $book->genre }}</p>
                    <p class="text-sm text-gray-700"><strong>Publisher:</strong> {{ $book->publisher }}</p>
                    <p class="text-sm text-gray-700"><strong>Published:</strong> {{ $book->published_year }} </p>
                </div>

                <p class="text-lg mb-6 text-gray-700">{{ $book->description }} </p>
                <div class="flex items-center mb-4">
                    <span class="text-gray-700 mr-2">Status:</span>
                    <span class="text-sm {{ $book->status == 'available' ? 'bg-green-600' : 'bg-red-600' }} text-white px-3 py-1 rounded-full">
                        {{ ucfirst($book->status) }}
                    </span>
                </div>

                @guest
                <div class="justify-end mt-6">
                    @if ($book->status === 'available')
                        <form action="{{ route('loan.store', $book->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="px-4 py-2 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition-all duration-300 shadow-md">
                                <i class="fas fa-book-reader mr-2"></i> Borrow Book
                            </button>
                        </form>
                    @else
                        <button class="px-4 py-2 bg-gray-400 text-white font-semibold rounded-lg cursor-not-allowed shadow-md" disabled>
                            <i class="fas fa-times-circle mr-2"></i> Book Unavailable
                        </button> 
                    @endif
                </div>
                @endguest
                
                @auth
                @if (Auth::user()->role === 'member')
                <div class="justify-end mt-6">
                    @if ($book->status === 'available')
                        <form action="{{ route('loan.store', $book->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="px-4 py-2 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition-all duration-300 shadow-md">
                                <i class="fas fa-book-reader mr-2"></i> Borrow Book
                            </button>
                        </form>
                    @else
                        <button class="px-4 py-2 bg-gray-400 text-white font-semibold rounded-lg cursor-not-allowed shadow-md" disabled>
                            <i class="fas fa-times-circle mr-2"></i> Book Unavailable
                        </button> 
                    @endif
                </div> @endif
                @endauth
            </div>
        </div>

        <div class="mt-6">

            @guest
            <div class="mb-4">
                <button id="toggleReviewForm" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    <i class="fas fa-comment mr-2"></i>Review
                </button>
            </div>
            @endguest

            @auth
            @if (Auth::user()->role === 'member')
            <div class="mb-4">
                <button id="toggleReviewForm" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    <i class="fas fa-comment mr-2"></i>Review
                </button>
            </div>
            @elseif(Auth::user()->role === 'librarian')
            
            @endif
            @endauth

            <div id="reviewForm" class="hidden bg-white bg-opacity-30 rounded-lg shadow-lg p-4 backdrop-blur-md hover:shadow-xl transition duration-300">
                @auth
                <form action="{{ route('book.review', $book->id) }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="rating" class="block text-sm font-medium text-gray-700">Rating:</label>
                        <div id="rating-stars" class="flex items-center">
                            @for ($i = 1; $i <= 5; $i++)
                                <i class="fas fa-star text-gray-300 cursor-pointer" data-index="{{ $i }}"></i> @endfor
                        </div>
                        <input type="hidden"
        name="rating" id="rating" value="0">
    </div>

    <div class="mb-3">
        <label for="comment" class="block text-sm font-medium text-gray-700">Comment:</label>
        <textarea name="comment" id="comment" rows="3"
            class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
            required></textarea>
    </div>
    <button type="submit"
        class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
        Submit Review
    </button>
    </form>
@endauth
@guest
    <p class="text-gray-700">Please <a href="{{ route('login') }}" class="text-blue-600 hover:text-blue-700">log in</a>
        to leave a review.</p>
@endguest
</div>


<div class="space-y-2">
    @forelse ($reviews as $review)
        <div
            class="bg-white bg-opacity-30 rounded-lg shadow-lg p-4 mt-2 backdrop-blur-md hover:shadow-xl transition duration-300">
            <div class="flex items-center mb-2">
                <img src="{{ $review->user->profile_photo ? Storage::url('profile_photos/' . $review->user->profile_photo) : asset('images/blank.png') }}"
                    alt="{{ $review->user->name }}" class="w-10 h-10 rounded-full  object-cover mr-3">
                <div>
                    <h4 class="text-md font-bold text-gray-800">{{ $review->user->name }}</h4>
                    <p class="text-sm text-gray-600">{{ $review->created_at->diffForHumans() }}</p>
                </div>
            </div>
            <div class="flex items-center mb-2">
                @for ($i = 1; $i <= 5; $i++)
                    <i class="fas fa-star {{ $i <= $review->rating ? 'text-yellow-400' : 'text-gray-300' }}"></i>
                @endfor
            </div>
            <p class="text-sm text-gray-700">{{ $review->comment }}</p>
        </div>
    @empty
        <p class="text-gray-700">No reviews yet.</p>
    @endforelse
</div>

{{ $reviews->links('pagination::tailwind') }}
</div>
<!-- Modal -->
<div id="deleteModal" class="fixed z-10 inset-0 overflow-y-auto hidden" aria-labelledby="modal-title" role="dialog"
    aria-modal="true">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">​</span>

        <div
            class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="sm:flex sm:items-start">
                    <div
                        class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                        <i class="fas fa-exclamation-triangle text-red-600"></i>
                    </div>
                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                        <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                            Delete Book
                        </h3>
                        <div class="mt-2">
                            <p class="text-sm text-gray-500">
                                Are you sure you want to delete this book? This action cannot be undone.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                <form id="deleteForm" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">
                        Delete
                    </button>
                </form>
                <button type="button" onclick="hideDeleteModal()"
                    class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                    Cancel
                </button>
            </div>
        </div>
    </div>


</div>


<div id="deleteModal" class="fixed z-10 inset-0 overflow-y-auto hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="sm:flex sm:items-start">
                    <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                        <i class="fas fa-exclamation-triangle text-red-600"></i>
                    </div>
                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                        <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                            Delete Book
                        </h3>
                        <div class="mt-2">
                            <p class="text-sm text-gray-500">
                                Are you sure you want to delete this book? This action cannot be undone.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                <form id="deleteForm" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">
                        Delete
                    </button>
                </form>
                <button type="button" onclick="hideDeleteModal()" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                    Cancel
                </button>
            </div>
        </div>
    </div>
</div>


<script>
    function showDeleteModal(url) {
        document.getElementById('deleteForm').action = url;
        document.getElementById('deleteModal').classList.remove('hidden');
    }

    function hideDeleteModal() {
        document.getElementById('deleteModal').classList.add('hidden');
    }

    document.getElementById('toggleReviewForm').addEventListener('click', function() {
        let reviewForm = document.getElementById('reviewForm');
        if (reviewForm.classList.contains('hidden')) {
            reviewForm.classList.remove('hidden');
            this.textContent = 'Hide Review';
        } else {
            reviewForm.classList.add('hidden');
            this.textContent = 'View Review';
            this.innerHTML =
            '<i class="fas fa-comment mr-2"></i> View Review'; // Resetting the button text and icon
        }
    });


    document.addEventListener('DOMContentLoaded', function() {
        const stars = document.querySelectorAll('#rating-stars i');
        const ratingInput = document.getElementById('rating');

        // Mengatur warna bintang ketika diklik
        stars.forEach(star => {
            star.addEventListener('mouseover', function() {
                const index = parseInt(this.getAttribute('data-index'));
                setStarColor(index);
            });

            star.addEventListener('mouseout', function() {
                const index = parseInt(ratingInput.value);
                setStarColor(index);
            });

            star.addEventListener('click', function() {
                const index = parseInt(this.getAttribute('data-index'));
                ratingInput.value = index;
                setStarColor(index);
            });
        });

        // Fungsi untuk mengubah warna bintang
        function setStarColor(rating) {
            stars.forEach(star => {
                const index = parseInt(star.getAttribute('data-index'));
                if (index <= rating) {
                    star.classList.add('text-yellow-400');
                    star.classList.remove('text-gray-300');
                } else {
                    star.classList.remove('text-yellow-400');
                    star.classList.add('text-gray-300');
                }
            });
        }
    });


    function showDeleteModal(url) {
        document.getElementById('deleteForm').action = url;
        document.getElementById('deleteModal').classList.remove('hidden');
    }

    function hideDeleteModal() {
        document.getElementById('deleteModal').classList.add('hidden');
    }
</script>
</body>

</html>
