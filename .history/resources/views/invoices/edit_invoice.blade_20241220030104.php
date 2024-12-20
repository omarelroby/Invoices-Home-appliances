@extends('layouts.master')
@section('css')
    <!--- Internal Select2 css-->
    <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
    <!---Internal Fileupload css-->
    <link href="{{ URL::asset('assets/plugins/fileuploads/css/fileupload.css') }}" rel="stylesheet" type="text/css" />
    <!---Internal Fancy uploader css-->
    <link href="{{ URL::asset('assets/plugins/fancyuploder/fancy_fileupload.css') }}" rel="stylesheet" />
    <!--Internal Sumoselect css-->
    <link rel="stylesheet" href="{{ URL::asset('assets/plugins/sumoselect/sumoselect-rtl.css') }}">
    <!--Internal  TelephoneInput css-->
    <link rel="stylesheet" href="{{ URL::asset('assets/plugins/telephoneinput/telephoneinput-rtl.css') }}">
@endsection
@section('title')
    تعديل فاتورة
@stop

@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">الفواتير</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    تعديل فاتورة</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')

    @if (session()->has('edit'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session()->get('edit') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <!-- row -->
    <div class="row">

        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-body">

                    <form action="{{ route('invoices.update',$invoices->id) }}" method="post" autocomplete="off">
                        {{ method_field('patch') }}
                        {{ csrf_field() }}
                        {{-- 1 --}}
                        <div class="row">

                            <div class="col-4">
                                <label for="inputName" class="control-label"> الفاتورة</label>
                                <input type="text" class="form-control" value="{{$invoices->name}}" id="inputName" name="name"
                                       title="يرجي ادخال رقم الفاتورة" required>
                            </div>
                            <div class="col-4">
                                <label>اسم العميل</label>
                                <select class="form-control fc-datepicker" name="customer_id"
                                        required>
                                    @foreach($customers as $customer)
                                        <option @if($customer->id == $invoices->customer_id) selected @endif value="{{$customer->id}}">{{$customer->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-4">
                                <label>تاريخ الفاتورة</label>
                                <input readonly class="form-control fc-datepicker" name="invoice_date" placeholder="YYYY-MM-DD"
                                       type="text" value="{{$invoices->invoice_date}}" required>
                            </div>

                            <div class="col-4">
                                <label>تاريخ الاستحقاق</label>
                                <select class="form-control fc-datepicker" name="day_of_pay"
                                        required>
                                    @for ($i = 1; $i <= 30; $i++)
                                        <option @if($invoices->day_of_pay==$i)selected @endif value="{{$i}}">{{$i}}</option>
                                    @endfor
                                </select>
                            </div>
                            <div class="col-4">
                                <label>المنصرف</label>
                                <input class="form-control" value="{{$invoices->total_remain_buy}}" name="total_remain_buy" id="total_remain_buy" type="text" placeholder="المبلغ" required oninput="calculateRemaining()" />
                            </div>
                            <div class="col-4">
                                <label>مقدمة الدفع</label>
                                <input class="form-control" value="{{$invoices->intro_cash}}" name="intro_cash" id="intro_cash" type="text" placeholder="المبلغ" required oninput="calculateRemaining()" />
                            </div>
                            <div class="col-4">
                                <label>المبلغ المتبقي</label>
                                <input class="form-control" value="{{$invoices->total_remain_remain}}" readonly name="total_remain_remain" id="total_remain_remain" type="text" placeholder="المبلغ" required />
                            </div>
                            </div>
                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary">حفظ البيانات</button>
                        </div>

                    </form>
                </div>
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
    <!--Internal Fileuploads js-->
    <script src="{{ URL::asset('assets/plugins/fileuploads/js/fileupload.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fileuploads/js/file-upload.js') }}"></script>
    <!--Internal Fancy uploader js-->
    <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.ui.widget.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.fileupload.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.iframe-transport.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.fancy-fileupload.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fancyuploder/fancy-uploader.js') }}"></script>
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

    <script>
        $(document).ready(function() {
            $('select[name="Section"]').on('change', function() {
                var SectionId = $(this).val();
                if (SectionId) {
                    $.ajax({
                        url: "{{ URL::to('section') }}/" + SectionId,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            $('select[name="product"]').empty();
                            $.each(data, function(key, value) {
                                $('select[name="product"]').append('<option value="' +
                                    value + '">' + value + '</option>');
                            });
                        },
                    });

                } else {
                    console.log('AJAX load did not work');
                }
            });

        });

    </script>


    <script>
        function myFunction() {

            var Amount_Commission = parseFloat(document.getElementById("Amount_Commission").value);
            var Discount = parseFloat(document.getElementById("Discount").value);
            var Rate_VAT = parseFloat(document.getElementById("Rate_VAT").value);
            var Value_VAT = parseFloat(document.getElementById("Value_VAT").value);

            var Amount_Commission2 = Amount_Commission - Discount;


            if (typeof Amount_Commission === 'undefined' || !Amount_Commission) {

                alert('يرجي ادخال مبلغ العمولة ');

            } else {
                var intResults = Amount_Commission2 * Rate_VAT / 100;

                var intResults2 = parseFloat(intResults + Amount_Commission2);

                sumq = parseFloat(intResults).toFixed(2);

                sumt = parseFloat(intResults2).toFixed(2);

                document.getElementById("Value_VAT").value = sumq;

                document.getElementById("total_remain").value = sumt;

            }

        }

    </script>
    <script>
        function calculateRemaining() {
            // Get the values of مقدمة الدفع and المنصرف
            let introCash = parseFloat(document.getElementById('intro_cash').value) || 0;
            let total_remainBuy = parseFloat(document.getElementById('total_remain_buy').value) || 0;

            // Calculate the remaining amount
            let remaining = total_remainBuy-introCash   ;

            // Display the result in المبلغ المتبقي
            document.getElementById('total_remain_remain').value = remaining;
        }
    </script>

@endsection
