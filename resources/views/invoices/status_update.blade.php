@extends('layouts.master')
@section('css')
@endsection
@section('title')
    دفع قسط جديد
@stop
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">الفواتير</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    دفع قسط جديد    </span>
            </div>
        </div>

    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('Status_Update', ['id' => $invoices->id]) }}" method="post" autocomplete="off">
                        {{ csrf_field() }}
                        <div class="col-4">
                            <label for="pay_date">تاريخ الفاتورة</label>
                            <input
                                id="pay_date"
                                readonly
                                class="form-control fc-datepicker"
                                name="pay_date"
                                placeholder="YYYY-MM-DD"
                                type="text"
                                value="{{ date('Y-m-d') }}"
                                required
                            >
                        </div>
                        <div class="col-4">
                            <label>المبلغ المتبقي</label>
                            <input class="form-control" readonly value="{{$invoices->total_remain}}" name="total_remain" id="total_remain_remain" type="text" placeholder="المبلغ" required />
                        </div>
                        <div class="col-4">
                            <label>قيمة القسط</label>
                            <input class="form-control" readonly value="{{$invoices->intro_cash}}" name="intro_cash" type="text" placeholder="قيمة القسط" />
                        </div>
                        <div class="col-4">
                            <label>مبلغ القسط</label>
                            <input class="form-control" name="cash"   type="text" placeholder="المبلغ" required oninput="calculateRemaining()" />
                        </div>


                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary">تحديث حالة الدفع</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- row closed -->
    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
@endsection
@section('js')
    <!-- Internal Select2 js-->
    <script src="{{ URL::asset('assets/plugins/select2/js/select2.min.js') }}"></script>
    <!--Internal  Form-elements js-->
    <script src="{{ URL::asset('assets/js/advanced-form-elements.js') }}"></script>
    <script src="{{ URL::asset('assets/js/select2.js') }}"></script>
    <!--Internal Sumoselect js-->
    <script src="{{ URL::asset('assets/plugins/sumoselect/jquery.sumoselect.js') }}"></script>
    <!--Internal  Datepicker js -->
    <script src="{{ URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js') }}"></script>
    <!--Internal  jquery.maskedinput js -->
    <script src="{{ URL::asset('assets/plugins/jquery.maskedinput/jquery.maskedinput.js') }}"></script>
    <!--Internal  spectrum-colorpicker js -->
    <script src="{{ URL::asset('assets/plugins/spectrum-colorpicker/spectrum.js') }}"></script>
    <!-- Internal form-elements js -->
    <script src="{{ URL::asset('assets/js/form-elements.js') }}"></script>

    <script>
        var date = $('.fc-datepicker').datepicker({
            dateFormat: 'yy-mm-dd'
        }).val();

    </script>
@endsection
