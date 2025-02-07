<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Loan;
use App\Models\Book;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class LoanController extends Controller
{
    public function index(Request $request)
    {
        $query = Loan::query();

        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        if ($request->has('loan_date') && $request->loan_date != '') {
            $query->whereDate('loan_date', $request->loan_date)->format('Y-m-d');
        }

        if ($request->has('book_title') && $request->book_title != '') {
            $query->whereHas('book', function ($q) use ($request) {
                $q->where('title', 'like', '%' . $request->book_title . '%');
            });
        }

        $loans = $query->get();

        return view('loans.index', compact('loans'));
    }

    public function store(Request $request, $bookId)
    {
        $book = Book::findOrFail($bookId);

        if ($book->status === 'borrowed') {
            return redirect()->back()->with('error', 'Book is already borrowed.');
        }

        Loan::create([
            'book_id' => $book->id,
            'user_id' => Auth::id(),
            'loan_date' => now(),
            'status' => 'borrowed',
        ]);

        $book->update(['status' => 'unavailable']);

        return redirect()->route('book.show', ['id' => $bookId])->with('success', 'Book borrowed successfully.');
    }


    public function returnBook($loanId)
    {
        $loan = Loan::with('book')->findOrFail($loanId);

        $loan->update([
            'return_date' => now(),
            'status' => 'returned',
        ]);

        $loan->book->update(['status' => 'available']);

        return redirect()->route('loan.index')->with('success', 'Book returned successfully.');
    }


    public function showLoanHistory()
    {
        $loans = Loan::where('user_id', auth()->user()->id)->get();

        return view('loans.history', compact('loans'));
    }

    
}
