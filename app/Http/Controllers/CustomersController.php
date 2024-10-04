<?php

namespace App\Http\Controllers;
use App\Customer;
use Illuminate\Support\Facades\Notification;
use App\invoices;
use App\sections;
use App\User;
use App\invoices_details;
use App\invoice_attachments;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Notifications\AddInvoice;
use App\Exports\InvoicesExport;
use Maatwebsite\Excel\Facades\Excel;

class CustomersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Customer::all();
        return view('customers.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         return view('customers.add_customer');
    }


    public function store(Request $request)
    {
        Customer::create($request->all());
        session()->flash('success', 'تم اضافة الفاتورة بنجاح');
        return redirect()->route('customers.index');
    }


    public function show($id)
    {
        $invoices = invoices::where('id', $id)->first();
        return view('invoices.status_update', compact('invoices'));
    }


    public function edit(Request $request, Customer $customer)
    {

        return view('customers.edit', compact('customer'));
    }


    public function update(Request $request, Customer $customer)
    {

        
        $customer->update([
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address,
            'identity' => $request->identity,

        ]);

        session()->flash('success', 'تم تعديل بيانات العميل بنجاح بنجاح');
        return redirect()->route('customers.index');
    }

    public function destroy(Request $request,Customer $customer)
    {

        $customer->delete();
        session()->flash('success','Deleted Successfully');
        return back();

    }



}
