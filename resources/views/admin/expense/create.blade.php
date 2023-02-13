@extends('admin.layouts.main')
@section('content')


    <div class="content-body">
        <div class="container-fluid">
            <!-- row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Add Expense</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-validation">
                                <form class="needs-validation" action="{{ route('users.store') }}" method="POST" novalidate >
                                    @csrf
                                    <div class="row">
                                        <div class="col-xl-12">
                                            <label class="col-lg-4 col-form-label" for="validationCustom07">{{ trans('cruds.clients.name') }}
                                                <span class="text-danger">*</span>
                                            </label>                                            
                                            <div class="mb-3 row">
                                                <div class="col-lg-12">
                                                    <input type="text" value="{{ old('expense_name', '') }}" name="expense_name" class="form-control" placeholder="Expense Name" required>
                                                    @if($errors->has('expense_name'))
                                                        <span class="form-reqs-error">
                                                           {{ $errors->first('expense_name') }} 
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div> 
                                        <div class="col-xl-12">
                                            <label class="col-lg-4 col-form-label" for="validationCustom07">Expense Type
                                                <span class="text-danger">*</span>
                                            </label>                                            
                                            <div class="mb-3 row">
                                                <div class="col-lg-12">
                                                    <input type="text" value="{{ old('expense_type', '') }}" name="expense_type" class="form-control" placeholder="Expense Type" required>
                                                    @if($errors->has('expense_type'))
                                                        <span class="form-reqs-error">
                                                           {{ $errors->first('expense_type') }} 
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>      
                                        <div class="col-xl-12">
                                            <label class="col-lg-4 col-form-label" for="validationCustom07">Co-operate client credit
                                                <span class="text-danger">*</span>
                                            </label>                                            
                                            <div class="mb-3 row">
                                                <div class="col-lg-12">
                                                    <input type="text" value="{{ old('co_operate_client_credit', '') }}" name="co_operate_client_credit" class="form-control" placeholder="Credit amount" required>
                                                    @if($errors->has('co_operate_client_credit'))
                                                        <span class="form-reqs-error">
                                                           {{ $errors->first('co_operate_client_credit') }} 
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-12">
                                            <label class="col-lg-4 col-form-label" for="validationCustom07">Vendor Billing Attachment
                                                <span class="text-danger">*</span>
                                            </label>                                            
                                            <div class="mb-3 row">
                                                <div class="col-lg-12">
                                                    <input type="file" value="{{ old('vendor_billing_attachment', '') }}" name="vendor_billing_attachment" class="form-control" placeholder="Expense Name" required>
                                                    @if($errors->has('vendor_billing_attachment'))
                                                        <span class="form-reqs-error">
                                                           {{ $errors->first('vendor_billing_attachment') }} 
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>                                                                                                                     
                                       
                                    </div>
                                    <div class="col-xl-0">                                           
                                        <div class="mb-0 row">
                                            <div class="col-lg-0 ms-auto">
                                                <button type="submit" class="btn btn-primary">Submit</button>
                                            </div>
                                        </div>
                                    </div>                                                                        
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
<script type="text/javascript"></script>
@endsection

