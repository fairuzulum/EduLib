<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loan History - Library System</title>
    @vite('resources/css/app.css')
    <link href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.4.0/css/all.min.css" rel="stylesheet">
</head>

<body class="min-h-screen flex items-center justify-center bg-cover bg-center" style="background-image: url('{{ asset('images/shelf-books.jpg') }}');">
    <div class="container mx-auto px-6 py-8 bg-white bg-opacity-30 rounded-3xl shadow-2xl max-w-5xl backdrop-blur-md text-gray-800">
        <div class="mb-6 flex items-center justify-between">
            <a href="{{ route('dashboard') }}" class="text-white hover:text-gray-300">
                <i class="fas fa-arrow-left"></i>
            </a>
         
        </div>
        <h1 class="text-3xl font-bold mb-6 text-center">Loan History</h1>

        <!-- Loan History Section -->
        <div class="overflow-x-auto bg-white rounded-lg shadow-lg">
            <table class="min-w-full text-center table-auto border-collapse">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="px-4 py-2 text-sm font-semibold border border-gray-300">Cover Image</th>
                        <th class="px-4 py-2 text-sm font-semibold border border-gray-300">Book Title</th>
                        <th class="px-4 py-2 text-sm font-semibold border border-gray-300">Loan Date</th>
                        <th class="px-4 py-2 text-sm font-semibold border border-gray-300">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($loans as $loan)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="px-4 py-2 text-sm border border-gray-300">
                                <img class="w-16 h-24 object-cover rounded-md mx-auto" src="{{ $loan->book->cover_image ? asset('storage/' . $loan->book->cover_image) : asset('images/cover.png') }}" alt="{{ $loan->book->title }}">
                            </td>
                            <td class="px-4 py-2 text-sm border border-gray-300">{{ $loan->book->title }}</td>
                            <td class="px-4 py-2 text-sm border border-gray-300">{{ \Carbon\Carbon::parse($loan->loan_date)->format('F j, Y') }}</td>
                            <td class="px-4 py-2 text-sm border border-gray-300">
                                <span class="px-3 py-1 rounded-full text-white @if($loan->status === 'borrowed') bg-red-600 @else bg-green-600 @endif">
                                    {{ ucfirst($loan->status) }}
                                </span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
</body>

</html>
