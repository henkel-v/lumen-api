<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Loan;

class LoanController extends Controller
{
    public function create(Request $request)
    {
        $this->validate($request, [
            'borrower_name' => 'required|string',
            'amount' => 'required|numeric',
            'loan_date' => 'required|date',
        ]);

        $loan = Loan::create($request->all());
        return response()->json($loan, 201);
    }

    public function get($id)
    {
        $loan = Loan::find($id);
        if (!$loan) {
            return response()->json(['message' => 'Loan not found'], 404);
        }
        return response()->json($loan);
    }

    public function update(Request $request, $id)
    {
        $loan = Loan::find($id);
        if (!$loan) {
            return response()->json(['message' => 'Loan not found'], 404);
        }

        $this->validate($request, [
            'borrower_name' => 'sometimes|required|string',
            'amount' => 'sometimes|required|numeric',
            'loan_date' => 'sometimes|required|date',
        ]);

        $loan->update($request->all());
        return response()->json($loan);
    }

    public function delete($id)
    {
        $loan = Loan::find($id);
        if (!$loan) {
            return response()->json(['message' => 'Loan not found'], 404);
        }

        $loan->delete();
        return response()->json(['message' => 'Loan deleted']);
    }

    public function index(Request $request)
    {
        $query = Loan::query();

        if ($request->has('date_from') && $request->has('date_to')) {
            $query->whereBetween('loan_date', [$request->date_from, $request->date_to]);
        }

        if ($request->has('amount_min') && $request->has('amount_max')) {
            $query->whereBetween('amount', [$request->amount_min, $request->amount_max]);
        }

        $loans = $query->get();
        return response()->json($loans);
    }
}
