<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\customers;
use App\invoices;
use App\Qist;

class QistController extends Controller
{
    // Show all installments
    public function index(Request $request)
    {
        $qists = Qist::with(['invoice.customers'])
            ->when($request->customer_name, function($query) use ($request) {
                $query->whereHas('invoice.customers', function($q) use ($request) {
                    $q->where('name', 'like', '%'.$request->customer_name.'%');
                });
            })
            ->when($request->customer_phone, function($query) use ($request) {
                $query->whereHas('invoice.customers', function($q) use ($request) {
                    $q->where('phone', 'like', '%'.$request->customer_phone.'%');
                });
            })
            ->when($request->date, function($query) use ($request) {
                $query->whereDate('date', $request->date);
            })
            ->get();
             
        return view('qist.index', compact('qists'));
    }

    // Show form to create a new installment
    public function create()
    {
        $invoices = invoices::with('customers')->get();
        return view('qist.create', compact('invoices'));
    }

    // Store a new installment
    public function store(Request $request)
    {
        $validated = $request->validate([
            'cash' => 'required|numeric',
            'invoice_id' => 'required|exists:invoices,id',
            'date' => 'required|date',

        ]);

        Qist::create($validated);

        return redirect()->route('qist.index')->with('success', 'تم حفظ القسط بنجاح');
    }

    public function invoiceQist($invoice_id)
    {
        $invoice = invoices::with('customers')->findOrFail($invoice_id);
        $qists = Qist::where('invoice_id', $invoice_id)->get();
        return view('qist.invoice_qist', compact('invoice', 'qists'));
    }
}
