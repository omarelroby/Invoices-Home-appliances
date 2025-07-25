@extends('layouts.master')

@section('title', 'إضافة قسط جديد')

@section('content')
<div class="container mt-4">
    <h2>إضافة قسط جديد</h2>
    <form action="{{ route('qist.store') }}" method="POST">
        @csrf
        <div class="form-row">
            <div class="form-group col-md-3">
                <label for="amount">المبلغ</label>
                <input type="number" step="0.01" name="cash" id="amount" class="form-control" required>
            </div>
            <div class="form-group col-md-3">
                <label for="invoice_id">رقم الفاتورة - اسم العميل</label>
                <select name="invoice_id" id="invoice_id" class="form-control" required>
                    <option value="">اختر الفاتورة</option>
                    @foreach($invoices as $invoice)
                        <option value="{{ $invoice->id }}">{{ $invoice->name }} - {{ $invoice->customers->name ??'' }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-3">
                <label for="date">التاريخ</label>
                <input type="date" name="date" id="date" class="form-control" required value="{{ old('date', date('Y-m-d')) }}">
            </div>

        </div>
        <button type="submit" class="btn btn-success">حفظ</button>
        <a href="{{ route('qist.index') }}" class="btn btn-secondary">إلغاء</a>
    </form>
</div>
@endsection
