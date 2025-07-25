@extends('layouts.master')

@section('title', 'قائمة الأقساط')

@section('content')
<div class="container mt-4">
    <h2>قائمة الأقساط</h2>
    <!-- <a href="{{ route('qist.create') }}" class="btn btn-primary mb-3">إضافة قسط جديد</a> -->
    <form method="GET" action="" class="mb-4">
        <div class="form-row">
            <div class="form-group col-md-3">
                <input type="text" name="customer_name" class="form-control" placeholder="اسم العميل" value="{{ request('customer_name') }}">
            </div>
            <div class="form-group col-md-3">
                <input type="text" name="customer_phone" class="form-control" placeholder="هاتف العميل" value="{{ request('customer_phone') }}">
            </div>
            <div class="form-group col-md-3">
                <input type="date" name="date" class="form-control" placeholder="تاريخ القسط" value="{{ request('date') }}">
            </div>
            <div class="form-group col-md-3 d-flex align-items-center">
                <button type="submit" class="btn btn-info mx-1">بحث</button>
                <a href="{{ route('qist.index') }}" class="btn btn-secondary mx-1">محو البحث</a>
                <a href="{{ route('qist.index', ['date' => date('Y-m-d')]) }}" class="btn btn-primary mx-1">اليومية</a>
            </div>
        </div>
    </form>
    <!-- Table of installments will go here -->
    @if($qists->count())
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>المبلغ</th>
                <th>رقم الفاتورة</th>
                <th>اسم العميل</th>
                <th>التاريخ</th>

            </tr>
        </thead>
        <tbody>
            @foreach($qists as $qist)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $qist->cash }}</td>
                    <td>{{ $qist->invoice->name ?? '' }}</td>
                    <td>{{ $qist->invoice->customers->name ?? '' }}</td>
                    <td>{{ $qist->date }}</td>

                </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <div class="alert alert-info">لا توجد بيانات بعد.</div>
    @endif
</div>
@endsection
