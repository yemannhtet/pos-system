<?php

namespace App\Http\Controllers\Admin;

use App\Models\Payment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;

class PaymentController extends Controller
{
    // Display payment list
    public function index()
    {
        $payments = Payment::all();
        return view('admin.payment', compact('payments'));
    }

    // Store a new payment
    public function store(Request $request)
    {
        $request->validate([
            'account_number' => 'required',
            'type' => 'required',
            'account_name' => 'required',
        ]);

        // Add payment to the database
        Payment::create([
            'account_number' => $request->account_number,
            'type' => $request->type,
            'account_name' => $request->account_name,
        ]);

        return redirect()->route('paymentList');
        Alert::success('payment  add Success', 'Add Payment  Successfully');
    }

    // Delete a payment
    public function destroy($id)
    {
        $payment = Payment::findOrFail($id);
        $payment->delete();
        Alert::success('Delete  Success', 'Delete Payment Method Successfully');
        return redirect()->route('paymentList');
    }

}
