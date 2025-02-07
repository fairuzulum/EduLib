<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loan Management - Library System</title>
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
        <h1 class="text-3xl font-bold mb-8 text-center">Loan Management</h1>
       
        <!-- Filter Section -->
        <div class="mb-6 flex justify-center">
            <form method="GET" action="{{ route('loan.index') }}" class="flex gap-6 mb-4 items-center">
                <div class="flex gap-2 items-center">
                    <label for="status" class="text-sm font-semibold">Status</label>
                    <select id="status" name="status" class="p-2 bg-white border rounded-lg">
                        <option value="">All</option>
                        <option value="borrowed" @if (request('status') == 'borrowed') selected @endif>Borrowed</option>
                        <option value="returned" @if (request('status') == 'returned') selected @endif>Returned</option>
                    </select>
                </div>
                <div class="flex gap-2 items-center">
                    <label for="loan_date" class="text-sm font-semibold">Loan Date</label>
                    <input type="date" id="loan_date" name="loan_date" value="{{ request('loan_date') }}" class="p-2 bg-white border rounded-lg">
                </div>
                <div class="flex gap-2 items-center">
                    <label for="book_title" class="text-sm font-semibold">Book Title</label>
                    <input type="text" id="book_title" name="book_title" value="{{ request('book_title') }}" placeholder="Search by title" class="p-2 bg-white border rounded-lg">
                </div>
                <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-300">Filter</button>
            </form>
        </div>

        <!-- Loan Table Section -->
        <div class="overflow-x-auto bg-white rounded-lg shadow-lg mb-3">
            
            <table class="min-w-full text-center table-auto border-collapse">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="px-4 py-2 text-sm font-semibold border border-gray-300">Cover Image</th>
                        <th class="px-4 py-2 text-sm font-semibold border border-gray-300">Book Title</th>
                        <th class="px-4 py-2 text-sm font-semibold border border-gray-300">Borrower</th> 
                        <th class="px-4 py-2 text-sm font-semibold border border-gray-300">Loan Date</th>
                        <th class="px-4 py-2 text-sm font-semibold border border-gray-300">Return Date</th>
                        <th class="px-4 py-2 text-sm font-semibold border border-gray-300">Status</th>
                        <th class="px-4 py-2 text-sm font-semibold border border-gray-300">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($loans as $loan)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="px-4 py-2 text-sm border border-gray-300">
                                @if ($loan->book->cover_image)
                                    <img src="{{ asset('storage/' . $loan->book->cover_image) }}" alt="Book Cover" class="w-16 h-24 object-cover rounded-md mx-auto">
                                @else
                                    <span>No Image</span>
                                @endif
                            </td>
                            <td class="px-4 py-2 text-sm border border-gray-300">{{ $loan->book->title }}</td>
                            <td class="px-4 py-2 text-sm border border-gray-300">{{ $loan->user->name }}</td> <!-- Menampilkan Nama Peminjam -->
                            <td class="px-4 py-2 text-sm border border-gray-300">{{ \Carbon\Carbon::parse($loan->loan_date)->format('F j, Y') }}</td>
                            <td class="px-4 py-2 text-sm border border-gray-300">{{ \Carbon\Carbon::parse($loan->return_date)->format('F j, Y') }}</td>
                            <td class="px-4 py-2 text-sm border border-gray-300">
                                <span class="px-3 py-1 rounded-full text-white @if ($loan->status === 'borrowed') bg-red-600 @else bg-green-600 @endif">
                                    {{ ucfirst($loan->status) }}
                                </span>
                            </td>
                            <td class="px-4 py-2 text-sm border border-gray-300">
                                @if ($loan->status === 'borrowed')
                                    <form action="{{ route('loan.return', ['loanId' => $loan->id]) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition duration-300">Return</button>
                                    </form>
                                @else
                                    <span class="text-green-600">Returned</span>
                                @endif
                            </td>
                        </tr> @endforeach
                </tbody>
            </table>
        </div>
        
      

    </div>
</body>

</html>
