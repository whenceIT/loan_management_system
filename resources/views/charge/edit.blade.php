@extends('layouts.master')
@section('title')
    {{ trans_choice('general.edit',1) }} {{ trans_choice('general.charge',1) }}
@endsection
@section('content')
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">{{ trans_choice('general.edit',1) }} {{ trans_choice('general.charge',1) }}</h3>

            <div class="box-tools pull-right">
                <button onclick="window.history.back()" class="btn btn-info btn-sm">
                    {{ trans_choice('general.cancel',1) }}
                </button>
            </div>
        </div>
        <form method="post" action="{{url('charge/'.$charge->id.'/update')}}" class="form-horizontal"
              enctype="multipart/form-data">
            {{csrf_field()}}
            <div class="box-body">
                <div class="form-group">
                    <label for="name"
                           class="control-label col-md-2">{{trans_choice('general.name',1)}}</label>
                    <div class="col-md-3">
                        <input type="text" name="name" class="form-control"
                               value="{{$charge->name}}"
                               required id="name">
                    </div>
                </div>
                <div class="form-group">
                    <label for="product"
                           class="control-label col-md-2">{{trans_choice('general.product',1)}}</label>
                    <div class="col-md-3">
                        <select name="product" class="form-control " id="product" required disabled="">
                            <option value="loan"
                                    @if($charge->product=="loan") selected @endif>{{trans_choice('general.loan',1)}}</option>
                            <option value="savings"
                                    @if($charge->product=="savings") selected @endif>{{trans_choice('general.savings',1)}}</option>
                            <option value="client"
                                    @if($charge->product=="client") selected @endif>{{trans_choice('general.client',1)}}</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="currency_id"
                           class="control-label col-md-2">{{trans_choice('general.currency',1)}}</label>
                    <div class="col-md-3">
                        <select name="currency_id" class="form-control select2" id="currency_id" required>
                            <option></option>
                            @foreach(\App\Models\Currency::where('active',1)->get() as $key)
                                <option value="{{$key->id}}" @if($charge->currency_id==$key->id) selected @endif>{{$key->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group" id="loan_charge_type_div">
                    <label for="loan_charge_type"
                           class="control-label col-md-2">{{trans_choice('general.charge',1)}} {{trans_choice('general.type',1)}}</label>
                    <div class="col-md-3">
                        <select name="loan_charge_type" class="form-control " id="loan_charge_type" required>
                            <option></option>
                            <option value="disbursement"
                                    @if($charge->charge_type=="disbursement") selected @endif>{{trans_choice('general.disbursement',1)}}</option>
                            <option value="specified_due_date"
                                    @if($charge->charge_type=="specified_due_date") selected @endif>{{trans_choice('general.specified_due_date',1)}}</option>
                            <option value="installment_fee"
                                    @if($charge->charge_type=="installment_fee") selected @endif>{{trans_choice('general.installment_fee',1)}}</option>
                            <option value="overdue_installment_fee"
                                    @if($charge->charge_type=="overdue_installment_fee") selected @endif>{{trans_choice('general.overdue_installment_fee',1)}}</option>
                            <option value="loan_rescheduling_fee"
                                    @if($charge->charge_type=="loan_rescheduling_fee") selected @endif>{{trans_choice('general.loan_rescheduling_fee',1)}}</option>
                            <option value="overdue_maturity"
                                    @if($charge->charge_type=="overdue_maturity") selected @endif>{{trans_choice('general.overdue_maturity',1)}}</option>
                        </select>
                    </div>
                </div>
                <div class="form-group" id="savings_charge_type_div">
                    <label for="savings_charge_type"
                           class="control-label col-md-2">{{trans_choice('general.charge',1)}} {{trans_choice('general.type',1)}}</label>
                    <div class="col-md-3">
                        <select name="savings_charge_type" class="form-control " id="savings_charge_type" required>
                            <option></option>
                            <option value="specified_due_date"
                                    @if($charge->charge_type=="specified_due_date") selected @endif>{{trans_choice('general.specified_due_date',1)}}</option>
                            <option value="savings_activation"
                                    @if($charge->charge_type=="savings_activation") selected @endif>{{trans_choice('general.savings_activation',1)}}</option>
                            <option value="withdrawal_fee"
                                    @if($charge->charge_type=="withdrawal_fee") selected @endif>{{trans_choice('general.withdrawal_fee',1)}}</option>
                            <option value="annual_fee"
                                    @if($charge->charge_type=="annual_fee") selected @endif>{{trans_choice('general.annual_fee',1)}}</option>
                            <option value="monthly_fee"
                                    @if($charge->charge_type=="monthly_fee") selected @endif>{{trans_choice('general.monthly_fee',1)}}</option>
                            <option value="overdue_maturity"
                                    @if($charge->charge_type=="overdue_maturity") selected @endif>{{trans_choice('general.overdue_maturity',1)}}</option>
                        </select>
                    </div>
                </div>
                <div class="form-group" id="client_charge_type_div">
                    <label for="client_charge_type"
                           class="control-label col-md-2">{{trans_choice('general.charge',1)}} {{trans_choice('general.type',1)}}</label>
                    <div class="col-md-3">
                        <select name="client_charge_type" class="form-control " id="client_charge_type" required>
                            <option></option>
                            <option value="specified_due_date"
                                    @if($charge->charge_type=="specified_due_date") selected @endif>{{trans_choice('general.specified_due_date',1)}}</option>
                        </select>
                    </div>
                </div>
                <div class="form-group" id="loan_charge_option_div">
                    <label for="loan_charge_option"
                           class="control-label col-md-2">{{trans_choice('general.charge',1)}} {{trans_choice('general.option',1)}}</label>
                    <div class="col-md-3">
                        <select name="loan_charge_option" class="form-control " id="loan_charge_option" required>
                            <option></option>
                            <option value="flat" @if($charge->charge_option=="flat") selected @endif>{{trans_choice('general.flat',1)}}</option>
                            <option value="installment_principal_due" @if($charge->charge_option=="installment_principal_due") selected @endif>{{trans_choice('general.installment_principal_due',1)}}</option>
                            <option value="installment_principal_interest_due" @if($charge->charge_option=="installment_principal_interest_due") selected @endif>{{trans_choice('general.installment_principal_interest_due',1)}}</option>
                            <option value="installment_interest_due" @if($charge->charge_option=="installment_interest_due") selected @endif>{{trans_choice('general.installment_interest_due',1)}}</option>
                            <option value="total_due" @if($charge->charge_option=="total_due") selected @endif>{{trans_choice('general.total_due',1)}}</option>
                            <option value="original_principal" @if($charge->charge_option=="original_principal") selected @endif>{{trans_choice('general.original_principal',1)}}</option>
                        </select>
                    </div>
                </div>
                <div class="form-group" id="savings_charge_option_div">
                    <label for="savings_charge_option"
                           class="control-label col-md-2">{{trans_choice('general.charge',1)}} {{trans_choice('general.option',1)}}</label>
                    <div class="col-md-3">
                        <select name="savings_charge_option" class="form-control " id="savings_charge_option" required>
                            <option></option>
                            <option value="flat" @if($charge->charge_option=="flat") selected @endif>{{trans_choice('general.flat',1)}}</option>
                            <option value="percentage" @if($charge->charge_option=="percentage") selected @endif>{{trans_choice('general.percentage',1)}} {{trans_choice('general.of',1)}} {{trans_choice('general.amount',1)}}</option>
                        </select>
                    </div>
                </div>
                <div class="form-group" id="client_charge_option_div">
                    <label for="client_charge_option"
                           class="control-label col-md-2">{{trans_choice('general.charge',1)}} {{trans_choice('general.option',1)}}</label>
                    <div class="col-md-3">
                        <select name="client_charge_option" class="form-control " id="client_charge_option" required>
                            <option></option>
                            <option value="flat" @if($charge->charge_option=="flat") selected @endif>{{trans_choice('general.flat',1)}}</option>
                        </select>
                    </div>
                </div>
                <div id="charge_frequency_div">
                    <div class="form-group">
                        <label for="charge_frequency"
                               class="control-label col-md-2">{{trans_choice('general.add',1)}} {{trans_choice('general.fee',1)}} {{trans_choice('general.frequency',1)}}</label>
                        <div class="col-md-3">
                            <select name="charge_frequency" class="form-control " id="charge_frequency" required>
                                <option value="0"  @if($charge->charge_frequency=="0") selected @endif>{{trans_choice('general.no',1)}}</option>
                                <option value="1" @if($charge->charge_frequency=="1") selected @endif>{{trans_choice('general.yes',1)}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group" id="">
                        <label for="charge_frequency_type"
                               class="control-label col-md-2">{{trans_choice('general.charge',1)}} {{trans_choice('general.frequency',1)}}</label>
                        <div class="col-md-3">
                            <select name="charge_frequency_type" class="form-control " id="charge_frequency_type"
                                    required>
                                <option></option>
                                <option value="days" @if($charge->charge_frequency_type=="days") selected @endif>{{trans_choice('general.day',2)}}</option>
                                <option value="weeks" @if($charge->charge_frequency_type=="weeks") selected @endif>{{trans_choice('general.week',2)}}</option>
                                <option value="months" @if($charge->charge_frequency_type=="months") selected @endif>{{trans_choice('general.month',2)}}</option>
                                <option value="years" @if($charge->charge_frequency_type=="years") selected @endif>{{trans_choice('general.year',2)}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="charge_frequency_amount"
                               class="control-label col-md-2">{{trans_choice('general.fee',1)}} {{trans_choice('general.frequency',1)}}</label>
                        <div class="col-md-3">
                            <input type="number" name="charge_frequency_amount" class="form-control"
                                   value="{{$charge->charge_frequency_amount}}"
                                   required id="charge_frequency_amount">
                        </div>

                    </div>
                </div>
                <div class="form-group">
                    <label for="amount"
                           class="control-label col-md-2">{{trans_choice('general.amount',2)}}</label>
                    <div class="col-md-3">
                        <input type="number" name="amount" class="form-control"
                               value="{{$charge->amount}}"
                               required id="amount">
                    </div>

                </div>
                <div class="form-group">
                    <label for="active"
                           class="control-label col-md-2">{{trans_choice('general.active',1)}}</label>
                    <div class="col-md-3">
                        <select name="active" class="form-control " id="active" required>
                            <option value="1" @if($charge->active=="1") selected @endif>{{trans_choice('general.yes',1)}}</option>
                            <option value="0" @if($charge->active=="0") selected @endif>{{trans_choice('general.no',1)}}</option>
                        </select>
                    </div>
                    <label for="override"
                           class="control-label col-md-2">{{trans_choice('general.override',1)}}</label>
                    <div class="col-md-3">
                        <select name="override" class="form-control " id="override" required>
                            <option value="1" @if($charge->override=="1") selected @endif>{{trans_choice('general.yes',1)}}</option>
                            <option value="0" @if($charge->override=="0") selected @endif>{{trans_choice('general.no',1)}}</option>
                        </select>
                    </div>
                </div>
                <div class="form-group" id="gl_account_income_div">
                    <label for="gl_account_income_id"
                           class="control-label col-md-2">{{trans_choice('general.income',1)}} {{trans_choice('general.from',1)}} {{trans_choice('general.charge',1)}}</label>
                    <div class="col-md-3">
                        <select name="gl_account_income_id" class="form-control select2" id="gl_account_income_id"
                                required>
                            <option></option>
                            @foreach(\App\Models\GlAccount::where('active',1)->where('account_type','income')->get() as $key)
                                <option value="{{$key->id}}">{{$key->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <div class="heading-elements">
                    <button type="submit" class="btn btn-primary pull-right">{{trans_choice('general.save',1)}}</button>
                </div>
            </div>
        </form>
    </div>
@endsection
@section('footer-scripts')
    <script>
        $(".form-horizontal").validate();
        if ($("#product").val() == "loan") {
            $("#loan_charge_type_div").show();
            $("#loan_charge_option_div").show();
            $("#savings_charge_type_div").hide();
            $("#client_charge_type_div").hide();
            $("#savings_charge_option_div").hide();
            $("#client_charge_option_div").hide();
            $("#gl_account_income_div").hide();
            $("#charge_frequency_div").hide();
            $("#loan_charge_type").attr("required", "required");
            $("#loan_charge_option").attr("required", "required");
            $("#savings_charge_type").removeAttr("required");
            $("#savings_charge_option").removeAttr("required");
            $("#client_charge_type").removeAttr("required");
            $("#client_charge_option").removeAttr("required");
            $("#gl_account_income_id").removeAttr("required");
        }
        if ($("#product").val() == "savings") {
            $("#loan_charge_type_div").hide();
            $("#loan_charge_option_div").hide();
            $("#savings_charge_type_div").show();
            $("#client_charge_type_div").hide();
            $("#savings_charge_option_div").show();
            $("#client_charge_option_div").hide();
            $("#gl_account_income_div").hide();
            $("#charge_frequency_div").hide();
            $("#savings_charge_type").attr("required", "required");
            $("#savings_charge_option").attr("required", "required");
            $("#loan_charge_type").removeAttr("required");
            $("#loan_charge_option").removeAttr("required");
            $("#client_charge_type").removeAttr("required");
            $("#client_charge_option").removeAttr("required");
            $("#gl_account_income_id").removeAttr("required");
        }
        if ($("#product").val() == "client") {
            $("#loan_charge_type_div").hide();
            $("#loan_charge_option_div").hide();
            $("#savings_charge_type_div").hide();
            $("#client_charge_type_div").show();
            $("#savings_charge_option_div").hide();
            $("#client_charge_option_div").show();
            $("#gl_account_income_div").show();
            $("#charge_frequency_div").hide();
            $("#gl_account_income_id").attr("required", "required");
            $("#client_charge_type").attr("required", "required");
            $("#client_charge_option").attr("required", "required");
            $("#loan_charge_type").removeAttr("required");
            $("#loan_charge_option").removeAttr("required");
            $("#savings_charge_type").removeAttr("required");
            $("#savings_charge_option").removeAttr("required");
        }
        if ($("#loan_charge_type").val() == "overdue_installment_fee" || $("#loan_charge_type").val() == "overdue_maturity") {
            $("#charge_frequency_div").show();
            $("#charge_frequency_type").attr("required", "required");
            $("#charge_frequency_amount").attr("required", "required");
        } else {
            $("#charge_frequency_div").hide();
            $("#charge_frequency_type").removeAttr("required");
            $("#charge_frequency_amount").removeAttr("required");
        }
        if ($("#charge_frequency").val() == "1") {
            $("#charge_frequency_type").attr("required", "required");
            $("#charge_frequency_amount").attr("required", "required");
        } else {
            $("#charge_frequency_type").removeAttr("required");
            $("#charge_frequency_amount").removeAttr("required");
        }
        $("#product").change(function (e) {
            if ($("#product").val() == "loan") {
                $("#loan_charge_type_div").show();
                $("#loan_charge_option_div").show();
                $("#savings_charge_type_div").hide();
                $("#client_charge_type_div").hide();
                $("#savings_charge_option_div").hide();
                $("#client_charge_option_div").hide();
                $("#gl_account_income_div").hide();
                $("#charge_frequency_div").hide();
                $("#loan_charge_type").attr("required", "required");
                $("#loan_charge_option").attr("required", "required");
                $("#savings_charge_type").removeAttr("required");
                $("#savings_charge_option").removeAttr("required");
                $("#client_charge_type").removeAttr("required");
                $("#client_charge_option").removeAttr("required");
                $("#gl_account_income_id").removeAttr("required");
            }
            if ($("#product").val() == "savings") {
                $("#loan_charge_type_div").hide();
                $("#loan_charge_option_div").hide();
                $("#savings_charge_type_div").show();
                $("#client_charge_type_div").hide();
                $("#savings_charge_option_div").show();
                $("#client_charge_option_div").hide();
                $("#gl_account_income_div").hide();
                $("#charge_frequency_div").hide();
                $("#savings_charge_type").attr("required", "required");
                $("#savings_charge_option").attr("required", "required");
                $("#loan_charge_type").removeAttr("required");
                $("#loan_charge_option").removeAttr("required");
                $("#client_charge_type").removeAttr("required");
                $("#client_charge_option").removeAttr("required");
                $("#gl_account_income_id").removeAttr("required");
            }
            if ($("#product").val() == "client") {
                $("#loan_charge_type_div").hide();
                $("#loan_charge_option_div").hide();
                $("#savings_charge_type_div").hide();
                $("#client_charge_type_div").show();
                $("#savings_charge_option_div").hide();
                $("#client_charge_option_div").show();
                $("#gl_account_income_div").show();
                $("#charge_frequency_div").hide();
                $("#gl_account_income_id").attr("required", "required");
                $("#client_charge_type").attr("required", "required");
                $("#client_charge_option").attr("required", "required");
                $("#loan_charge_type").removeAttr("required");
                $("#loan_charge_option").removeAttr("required");
                $("#savings_charge_type").removeAttr("required");
                $("#savings_charge_option").removeAttr("required");
            }
        })
        $("#charge_frequency").change(function (e) {
            if ($("#charge_frequency").val() == "1") {
                $("#charge_frequency_type").attr("required", "required");
                $("#charge_frequency_amount").attr("required", "required");
            } else {
                $("#charge_frequency_type").removeAttr("required");
                $("#charge_frequency_amount").removeAttr("required");
            }
        })
        $("#loan_charge_type").change(function (e) {
            if ($("#loan_charge_type").val() == "overdue_installment_fee" || $("#loan_charge_type").val() == "overdue_maturity") {
                $("#charge_frequency_div").show();
                $("#charge_frequency_type").attr("required", "required");
                $("#charge_frequency_amount").attr("required", "required");
            } else {
                $("#charge_frequency_div").hide();
                $("#charge_frequency_type").removeAttr("required");
                $("#charge_frequency_amount").removeAttr("required");
            }
            if ($("#charge_frequency").val() == "1") {
                $("#charge_frequency_type").attr("required", "required");
                $("#charge_frequency_amount").attr("required", "required");
            } else {
                $("#charge_frequency_type").removeAttr("required");
                $("#charge_frequency_amount").removeAttr("required");
            }
        })
    </script>
@endsection