<?php

namespace App\Http\Controllers;
use App\Customer;
use Carbon\Carbon;
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

class InvoicesController extends Controller
{

    public function index()
    {

        $phone = Request()->phone; // Get the phone number from the request

        if (!empty($phone)) {
            $invoices = Invoices::whereHas('customers', function ($query) use ($phone) {
                $query->where('phone', $phone); // Assuming 'phone' is a column in the customers table
            })->get();
        } else {
            $invoices = Invoices::all(); // Fallback to fetch all invoices if no phone is provided
        }

        foreach ($invoices as $invoice) {
            // Get the last payment date
//            $lastPayDate = Carbon::parse($invoice->pay_date); // Assuming `last_pay_date` is a column in your invoices table
            $dayOfPreviousMonth = Carbon::now()->subMonth()->startOfMonth()->addDays($invoice->date_of_pay - 1); // 05 of last month
            $dayOfCurrentMonth = Carbon::now()->startOfMonth()->addDays($invoice->date_of_pay - 1); // 05 of this month
            $payDate = Carbon::parse($invoice->pay_date);

            if (!$payDate->isSameMonth(Carbon::now())) {

                $invoice->update(['status' => 2]);
            }
        }
        return view('invoices.invoices', compact('invoices'));
    }


    public function create()
    {
        $data['customers'] = Customer::all();
        return view('invoices.add_invoice',$data);
    }


    public function store(Request $request)
    {
        dd($request->all());

        invoices::create([
            'name' => $request->name,
            'day_of_pay' => $request->day_of_pay,
            'invoice_date' => $request->invoice_date,
            'total_remain' => $request->total_remain,
            'intro_cash' => $request->intro_cash,
            'total_remain' => $request->total_remain_remain,
            'customer_id' => $request->customer_id,
        ]);


        session()->flash('Add', 'تم اضافة الفاتورة بنجاح');
        return redirect()->route('invoices.index');
    }


    public function show($id)
    {
        $invoices = invoices::where('id', $id)->first();
        return view('invoices.status_update', compact('invoices'));
    }


    public function edit($id)
    {
        $data['invoices'] = invoices::where('id', $id)->first();
        $data['customers'] = Customer::all();
        return view('invoices.edit_invoice',$data);
    }


    public function update(Request $request,$id)
    {

        $invoices = invoices::findOrFail($id);
        $invoices->update([
            'name' => $request->name,
            'day_of_pay' => $request->day_of_pay,
            'invoice_date' => $request->invoice_date,
            'total_remain_buy' => $request->total_remain_buy,
            'intro_cash' => $request->intro_cash,
            'total_remain_remain' => $request->total_remain_remain,
            'customer_id' => $request->customer_id,
        ]);
        session()->flash('edit', 'تم تعديل الفاتورة بنجاح');
        return redirect()->route('invoices.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\invoices  $invoices
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request->invoice_id;
        $invoices = invoices::where('id', $id)->first();
        $id_page =$request->id_page;
        if (!$id_page==2) {
        $invoices->forceDelete();
        session()->flash('delete_invoice');
        return redirect('/invoices');

        }

        else {

            $invoices->delete();
            session()->flash('archive_invoice');
            return redirect('/Archive');
        }


    }
    public function getproducts($id)
    {
        $products = DB::table("products")->where("section_id", $id)->pluck("Product_name", "id");
        return json_encode($products);
    }


    public function Status_Update($id, Request $request)
    {
        $invoices = invoices::findOrFail($id);
        if($invoices->status==1){

            session()->flash('Status_Update');
            return redirect('/invoices');
        }
        else{
            $remain=$invoices->total_remain_remain-$request->cash;

            if($remain==0)
            {
                $invoices->status=1;
                $invoices->total_remain_remain=0;
                $invoices->pay_date=$request->pay_date;
                $invoices->save();

            }
            else
            {
                $remain=$invoices->total_remain_remain-$request->cash;
                $invoices->status=0;
                $invoices->total_remain_remain=$remain;
                $invoices->pay_date=$request->pay_date;
                $invoices->save();


            }
        }

        session()->flash('Status_Update');
        return redirect('/invoices');
    }


     public function Invoice_Paid()
    {
        $invoices = Invoices::where('status', 1)->get();
        return view('invoices.invoices_paid',compact('invoices'));
    }

    public function Invoice_unPaid()
    {
        $invoices = Invoices::where('status',0)->get();
        return view('invoices.invoices_unpaid',compact('invoices'));
    }

    public function Invoice_Partial()
    {
        $invoices = Invoices::where('status',2)
                              ->get();
        return view('invoices.invoices_Partial',compact('invoices'));
    }

    public function Print_invoice($id)
    {
        $invoices = invoices::where('id', $id)->first();
        return view('invoices.Print_invoice',compact('invoices'));
    }

    public function export()
    {

        return Excel::download(new InvoicesExport, 'invoices.xlsx');

    }


}