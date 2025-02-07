<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New User - Library System</title>
    @vite('resources/css/app.css')
    <link href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.4.0/css/all.min.css" rel="stylesheet">
</head>

<body class="min-h-screen flex items-center justify-center bg-cover bg-center"
    style="background-image: url('{{ asset('images/shelf-books.jpg') }}');">
    <div class="container mx-auto px-6 py-10 bg-white bg-opacity-40 rounded-3xl shadow-2xl max-w-2xl backdrop-blur-lg">
        <a href="{{ route('users.index') }}" class="text-slate-100 hover:text-blue-700 mb-6 inline-block">
            <i class="fas fa-arrow-left"></i> Back to Users
        </a>
        <h1 class="text-4xl font-bold text-gray-900 mb-8 text-center">Add New User</h1>

        <form action="{{ route('users.store') }}" method="POST" class="space-y-6">
            @csrf
            <div class="p-4 bg-gray-50 rounded-xl shadow-sm">
                <label for="name" class="block text-gray-700 font-medium">Name</label>
                <input type="text" name="name" id="name" placeholder="Enter user name"
                    class="w-full px-4 py-3 mt-2 rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 text-gray-700"
                    required>
            </div>

            <div class="p-4 bg-gray-50 rounded-xl shadow-sm">
                <label for="email" class="block text-gray-700 font-medium">Email</label>
                <input type="email" name="email" id="email" placeholder="Enter email"
                    class="w-full px-4 py-3 mt-2 rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 text-gray-700"
                    required>
            </div>

            <div class="p-4 bg-gray-50 rounded-xl shadow-sm">
                <label for="password" class="block text-gray-700 font-medium">Password</label>
                <input type="password" name="password" id="password" placeholder="Enter password"
                    class="w-full px-4 py-3 mt-2 rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 text-gray-700"
                    required>
            </div>

            <div class="p-4 bg-gray-50 rounded-xl shadow-sm">
                <label for="password_confirmation" class="block text-gray-700 font-medium">Confirm Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation"
                    placeholder="Confirm password"
                    class="w-full px-4 py-3 mt-2 rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 text-gray-700"
                    required>
            </div>

            <button type="submit"
                class="w-full py-3 px-6 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition duration-300 ease-in-out shadow-md hover:shadow-xl">
                Create User
            </button>
        </form>
    </div>
</body>

</html>
