<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings - Update Profile</title>
    @vite('resources/css/app.css')
    <link href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.4.0/css/all.min.css" rel="stylesheet">
</head>

<body class="min-h-screen flex items-center justify-center bg-cover bg-center"
    style="background-image: url('{{ asset('images/shelf-books.jpg') }}');">
    <div
        class="container mx-auto px-6 py-10 bg-white bg-opacity-40 rounded-3xl shadow-2xl max-w-2xl backdrop-blur-lg">
        <!-- Header -->
        <div class="mb-6 flex items-center justify-between">
            <a href="{{ route('users.index') }}" class="text-white hover:text-gray-600 transition">
                <i class="fas fa-arrow-left text-xl"></i>
            </a>
        </div>


     
        <!-- Alert Section -->
        @if ($errors->any())
            <div class="bg-red-200 text-red-700 p-4 rounded-lg mb-4 border-l-4 border-red-600">
                <ul class="list-disc ml-4">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if (session('success'))
            <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        <!-- Form -->
        <form action="{{ route('users.update', $user->id) }}" method="POST" class="space-y-6" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Nama -->
            <div class="p-4 bg-gray-50 rounded-xl shadow-sm">
                <label for="name" class="block text-gray-700 font-medium">Name</label>
                <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}"
                    class="w-full px-4 py-3 mt-2 rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 text-gray-700"
                    placeholder="Enter your name" required>
                @error('name')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Email -->
            <div class="p-4 bg-gray-50 rounded-xl shadow-sm">
                <label for="email" class="block text-gray-700 font-medium">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}"
                    class="w-full px-4 py-3 mt-2 rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 text-gray-700"
                    placeholder="Enter your email" required>
                @error('email')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password Lama -->
            <div class="p-4 bg-gray-50 rounded-xl shadow-sm">
                <label for="current_password" class="block text-gray-700 font-medium">Current Password</label>
                <input type="password" id="current_password" name="current_password"
                    class="w-full px-4 py-3 mt-2 rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 text-gray-700"
                    placeholder="Enter current password">
                @error('current_password')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password Baru -->
            <div class="p-4 bg-gray-50 rounded-xl shadow-sm">
                <label for="password" class="block text-gray-700 font-medium">New Password</label>
                <input type="password" id="password" name="password"
                    class="w-full px-4 py-3 mt-2 rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 text-gray-700"
                    placeholder="Enter new password">
                @error('password')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Konfirmasi Password Baru -->
            <div class="p-4 bg-gray-50 rounded-xl shadow-sm">
                <label for="password_confirmation" class="block text-gray-700 font-medium">Confirm New Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation"
                    class="w-full px-4 py-3 mt-2 rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 text-gray-700"
                    placeholder="Confirm new password">
            </div>

            <button type="submit"
                class="w-full py-3 px-6 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition duration-300 ease-in-out shadow-md hover:shadow-xl">
                Update Profile
            </button>
        </form>
    </div>

    
  

  
</body>

</html>
