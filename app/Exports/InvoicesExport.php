<?php

namespace App\Exports;

use App\invoices;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class InvoicesExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return invoices::join('customers', 'invoices.customer_id', '=', 'customers.id')
            ->select(
                'customers.name as customer_name',
                'invoices.invoice_date',
                'invoices.intro_cash',
                'invoices.total_buy',
                'invoices.total_remain',
                'invoices.day_of_pay'

            )
            ->get();
    }

    /**
     * Define the headings for each column.
     *
     * @return array
     */
    public function headings(): array
    {
        return [
            'إسم العميل',
            'تاريخ البيان',
            'المقدمة',
            'ما تم دفعه',
            'المتبقي',
            'يوم الدفع',

        ];
    }
}
