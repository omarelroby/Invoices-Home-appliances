@extends('layouts.master')

@section('title', 'أقساط الفاتورة')

@section('content')
<div class="container mt-4">
    <h2>أقساط الفاتورة رقم {{ $invoice->name }} - {{ $invoice->customers->name ?? '' }}</h2>
    <a href="{{ url()->previous() }}" class="btn btn-secondary mb-3">رجوع</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>المبلغ</th>
                <th>التاريخ</th>
               
            </tr>
        </thead>
        <tbody>
            @forelse($qists as $qist)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $qist->cash }}</td>
                    <td>{{ $qist->date }}</td>

                </tr>
            @empty
                <tr><td colspan="4" class="text-center">لا توجد أقساط لهذه الفاتورة.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
