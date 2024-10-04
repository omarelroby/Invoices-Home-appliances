@extends('layouts.master')
@section('css')
<!-- Internal Nice-select css  -->
<link href="{{URL::asset('assets/plugins/jquery-nice-select/css/nice-select.css')}}" rel="stylesheet" />
@section('title')
تعديل بيانات العميل
@stop


@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">المستخدمين</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ تعديل
                مستخدم</span>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row">
    <div class="col-lg-12 col-md-12">

        @if (count($errors) > 0)
        <div class="alert alert-danger">
            <button aria-label="Close" class="close" data-dismiss="alert" type="button">
                <span aria-hidden="true">&times;</span>
            </button>
            <strong>خطا</strong>
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <div class="card">
            <div class="card-body">
                <div class="col-lg-12 margin-tb">
                    <div class="pull-right">
                        <a class="btn btn-primary btn-sm" href="{{ route('customers.index') }}">رجوع</a>
                    </div>
                </div><br>

                {!! Form::model($customer, ['method' => 'PATCH','route' => ['customers.update', $customer->id]]) !!}
                <div class="">

                    <div class="row mg-b-20">
                        <div class="parsley-input col-md-4" id="fnWrapper">
                            <label>اسم العميل: <span class="tx-danger">*</span></label>
                            <input class="form-control form-control-xl mg-b-20"
                                   data-parsley-class-handler="#lnWrapper" value="{{$customer->name}}" name="name" required="" type="text">
                        </div>

                        <div class="parsley-input col-md-4 mg-t-20 mg-md-t-0" id="lnWrapper">
                            <label>الهاتف: <span class="tx-danger">*</span></label>
                            <input class="form-control form-control-xl mg-b-20"
                                   data-parsley-class-handler="#lnWrapper" value="{{$customer->phone}}" name="phone" required="" type="text">
                        </div>
                        <div class="parsley-input col-md-4 mg-t-20 mg-md-t-0" id="lnWrapper">
                            <label>رقم البطاقة الشخصية: <span class="tx-danger">*</span></label>
                            <input class="form-control form-control-xl mg-b-20" data-parsley-class-handler="#lnWrapper"
                                   name="identity" value="{{$customer->identity}}" required="" type="text">
                        </div>
                    </div>


                </div>

                <div class="row mg-b-20">

                    <div class="parsley-input col-md-12 mg-t-20 mg-md-t-0" id="lnWrapper">
                        <label>العنوان: <span class="tx-danger">*</span></label>
                        <textarea class="form-control form-control-xl mg-b-20" data-parsley-class-handler="#lnWrapper"
                                  name="address" required="">{{$customer->address}}</textarea>
                    </div>

                </div>
                    <button class="btn btn-main-primary pd-x-20" type="submit">تحديث</button>

                {!! Form::close() !!}
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

<!-- Internal Nice-select js-->
<script src="{{URL::asset('assets/plugins/jquery-nice-select/js/jquery.nice-select.js')}}"></script>
<script src="{{URL::asset('assets/plugins/jquery-nice-select/js/nice-select.js')}}"></script>

<!--Internal  Parsley.min js -->
<script src="{{URL::asset('assets/plugins/parsleyjs/parsley.min.js')}}"></script>
<!-- Internal Form-validation js -->
<script src="{{URL::asset('assets/js/form-validation.js')}}"></script>
@endsection
