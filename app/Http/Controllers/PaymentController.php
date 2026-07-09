<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;

use function Laravel\Prompts\search;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index(Request $request)
{
    $search = trim($request->input('search'));
    $sort = $request->input('sort', 'latest');

    $paymentsQuery = Payment::with([
        'order.customer',
        'paymentMethod'
    ]);

    if ($search) {
        $paymentsQuery->Where('id', 'like', "%{$search}%")
        ->orwhereHas('order.customer', function ($q) use ($search) {
            $q->where('first_name', 'like', "%{$search}%")
              ->orWhere('last_name', 'like', "%{$search}%");
        })
        ->orWhereHas('paymentMethod', function ($q) use ($search) {
            $q->where('method_name', 'like', "%{$search}%");
        });
    }

    if ($sort === 'oldest') {
        $paymentsQuery->oldest('payment_date');
    } elseif ($sort === 'amount_high') {
        $paymentsQuery->orderByDesc('amount_paid');
    } elseif ($sort === 'amount_low') {
        $paymentsQuery->orderBy('amount_paid');
    } else {
        $paymentsQuery->latest('payment_date');
    }

    $payments = $paymentsQuery
        ->paginate(10)
        ->appends($request->only(['search', 'sort']));

    return view('payments.index', compact('payments'));
}
    public function store(Request $request)
    {
        $request->validate([
            'order_id' => 'required',
            'payment_method_id' => 'required',
            'amount_paid' => 'required|numeric',
        ]);

        Payment::create([
            'order_id' => $request->order_id,
            'payment_method_id' => $request->payment_method_id,
            'payment_date' => now(),
            'amount_paid' => $request->amount_paid,
            'payment_status' => 'Completed',
        ]);

        return back();
    }
}    