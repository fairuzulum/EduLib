<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Library System</title>
    @vite('resources/css/app.css')
    <link href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.4.0/css/all.min.css" rel="stylesheet">
</head>
<body class="min-h-screen flex items-center justify-center p-4 sm:p-0 bg-cover bg-center" style="background-image: url('{{ asset('images/shelf-books.jpg') }}');">
    <div class="container mx-auto px-4 py-8 bg-white bg-opacity-30 rounded-3xl shadow-2xl max-w-5xl backdrop-blur-md">
        <h1 class="text-5xl font-extrabold text-gray-800 text-center mb-10">Welcome, {{ Auth::user()->name }}</h1>

        @if(Auth::user()->role === 'librarian')
            @php
                $unreadMessagesCount = App\Models\Message::where('is_read', false)->count();
            @endphp
            <div class="mb-6 flex justify-center">
                <button onclick="openMessageModal()" class="relative">
                    <i class="fas fa-envelope fa-2x bg-blue-600 text-white p-4 rounded-lg transform transition duration-300 ease-in-out hover:scale-105"></i>
                    @if ($unreadMessagesCount > 0)
                        <span class="absolute top-0 right-0 transform translate-x-1/2 -translate-y-1/2 w-6 h-6 bg-red-500 rounded-full flex items-center justify-center text-white text-xs">
                            {{ $unreadMessagesCount }}
                        </span>
                    @endif
                </button>
            </div>
        @endif


        
       
            @if(Auth::user()->role === 'librarian')
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-6">
                <a href="{{ route('book.catalog') }}" class="bg-blue-600 text-white rounded-2xl shadow-xl hover:bg-blue-700 p-6 flex flex-col items-center justify-center transition-all duration-500 ease-in-out transform hover:scale-105">
                    <i class="fas fa-book fa-3x mb-4"></i>
                    <span class="text-base font-semibold">Book Catalog</span>
                </a>
                <a href="{{ route('loan.index') }}" class="bg-blue-600 text-white rounded-2xl shadow-xl hover:bg-blue-700 p-6 flex flex-col items-center justify-center transition-all duration-500 ease-in-out transform hover:scale-105">
                    <i class="fas fa-exchange-alt fa-3x mb-4"></i>
                    <span class="text-base font-semibold">Lending/Returning</span>
                </a>
                <a href="{{ route('users.index') }}" class="bg-blue-600 text-white rounded-2xl shadow-xl hover:bg-blue-700 p-6 flex flex-col items-center justify-center transition-all duration-500 ease-in-out transform hover:scale-105">
                    <i class="fas fa-user fa-3x mb-4"></i>
                    <span class="text-base font-semibold">Manage Users</span>
                </a>
                <a href="{{ route('profile.edit') }}" class="bg-blue-600 text-white rounded-2xl shadow-xl hover:bg-blue-700 p-6 flex flex-col items-center justify-center transition-all duration-500 ease-in-out transform hover:scale-105">
                    <i class="fas fa-cog fa-3x mb-4"></i>
                    <span class="text-base font-semibold">Settings</span>
                </a>
            </div>
            @else 
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 justify-center">
                <a href="{{ route('book.catalog') }}" class="bg-blue-600 text-white rounded-2xl shadow-xl hover:bg-blue-700 p-6 flex flex-col items-center justify-center transition-all duration-500 ease-in-out transform hover:scale-105">
                    <i class="fas fa-book-open fa-3x mb-4"></i>
                    <span class="text-base font-semibold">Book Catalog</span>
                </a>
                <a href="{{ route('loan.history') }}" class="bg-blue-600 text-white rounded-2xl shadow-xl hover:bg-blue-700 p-6 flex flex-col items-center justify-center transition-all duration-500 ease-in-out transform hover:scale-105">
                    <i class="fas fa-history fa-3x mb-4"></i>
                    <span class="text-base font-semibold">History</span>
                </a>
                <a href="{{ route('profile.edit') }}" class="bg-blue-600 text-white rounded-2xl shadow-xl hover:bg-blue-700 p-6 flex flex-col items-center justify-center transition-all duration-500 ease-in-out transform hover:scale-105">
                    <i class="fas fa-cog fa-3x mb-4"></i>
                    <span class="text-base font-semibold">Settings</span>
                </a>
            </div>
               
            @endif
        

        <div class="mt-10 text-center">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="px-6 py-3 bg-red-600 text-white rounded-full hover:bg-red-700 transition-all duration-300 ease-in-out">
                    <i class="fas fa-sign-out-alt mr-2"></i> Logout
                </button>
            </form>
        </div>
    </div>

     <!-- Modal untuk Pesan -->
     <!-- Modal untuk Pesan -->
<div id="messageModal" class="fixed z-50 inset-0 overflow-y-auto hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">​</span>

        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-3xl sm:w-full">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="sm:flex sm:items-start">
                    <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-blue-100 sm:mx-0 sm:h-10 sm:w-10">
                        <i class="fas fa-envelope text-blue-600 text-2xl"></i>
                    </div>
                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                        <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                            Messages
                        </h3>
                        <div class="mt-2 overflow-y-auto max-h-96">
                            @php
                                $messages = App\Models\Message::latest()->get();
                                App\Models\Message::where('is_read', false)->update(['is_read' => true]);
                            @endphp
                            @forelse ($messages as $message)
                                <div class="mb-4 p-4 bg-gray-100 rounded-lg shadow-sm">
                                    <p class="text-sm font-semibold text-gray-800">
                                        From: {{ $message->name }} ({{ $message->email }})
                                    </p>
                                    <p class="text-sm text-gray-700 mt-2">{{ $message->message }}</p>
                                </div>
                            @empty
                                <div class="text-center text-gray-500 mt-4">
                                    No messages yet.
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                <button type="button" onclick="closeMessageModal()" class="mt-3 w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-50                 sm:ml-3 sm:w-auto sm:text-sm">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    function openMessageModal() {
        document.getElementById('messageModal').classList.remove('hidden');
        fetch('{{ route('markAllMessagesAsRead') }}');
    }

    function closeMessageModal() {
        document.getElementById('messageModal').classList.add('hidden');
    }
</script>

</body>
</html>