@extends('layouts.app')

@section('page-title')
    <div class="row bg-title">
        <!-- .page title -->
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title"><i class="{{ $pageIcon }}"></i> {{ __($pageTitle) }}</h4>
        </div>
        <!-- /.page title -->
        <!-- .breadcrumb -->
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="{{ route('admin.dashboard') }}">@lang('app.menu.home')</a></li>
                <li><a href="{{ route('admin.settings.index') }}">@lang('app.menu.settings')</a></li>
                <li class="active">{{ __($pageTitle) }}</li>
            </ol>
        </div>
        <!-- /.breadcrumb -->
    </div>
@endsection

@push('head-script')
    <link rel="stylesheet" href="{{ asset('plugins/bower_components/switchery/dist/switchery.min.css') }}">
@endpush

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-inverse">
                <div class="panel-heading">@lang('app.menu.onlinePayment')</div>

                <div class="vtabs customvtab m-t-10">

                    @include('sections.payment_setting_menu')

                    <div class="tab-content">
                        <div id="vhome3" class="tab-pane active">

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="white-box">

                                        <div class="row">
                                            <div class="col-sm-12 col-xs-12 ">
                                                {!! Form::open(['id'=>'updateSettings','class'=>'ajax-form','method'=>'PUT']) !!}
                                                <div class="form-body">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <h3 class="box-title text-success">Paypal</h3>
                                                            <hr class="m-t-0 m-b-20">
                                                        </div>

                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label>Paypal Client Id</label>
                                                                <input type="text" name="paypal_client_id" id="paypal_client_id"
                                                                       class="form-control" value="{{ $credentials->paypal_client_id }}">
                                                            </div>
                                                        </div>

                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label>Paypal Secret</label>
                                                                <input type="text" name="paypal_secret" id="paypal_secret"
                                                                       class="form-control" value="{{ $credentials->paypal_secret }}">
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="mail_from_name">@lang('app.webhook')</label>
                                                                <p class="text-bold">{{ route('verify-ipn') }}</p>
                                                                <p class="text-info">(@lang('messages.addPaypalWebhookUrl'))</p>
                                                            </div>
                                                        </div>
                                                        <!--/span-->

                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label class="control-label" >@lang('modules.payments.paypalStatus')</label>
                                                                <div class="switchery-demo">
                                                                    <input type="checkbox" name="paypal_status" @if($credentials->paypal_status == 'active') checked @endif class="js-switch " data-color="#00c292" data-secondary-color="#f96262"  />
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-12 m-t-20">
                                                            <h3 class="box-title text-warning">Stripe</h3>
                                                            <hr class="m-t-0 m-b-20">
                                                        </div>

                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label>Stripe Client Id</label>
                                                                <input type="text" name="stripe_client_id" id="stripe_client_id"
                                                                       class="form-control" value="{{ $credentials->stripe_client_id }}">
                                                            </div>
                                                        </div>

                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label>Stripe Secret</label>
                                                                <input type="text" name="stripe_secret" id="stripe_secret"
                                                                       class="form-control" value="{{ $credentials->stripe_secret }}">
                                                            </div>
                                                        </div>

                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label>Stripe Webhook Secret</label>
                                                                <input type="text" name="stripe_webhook_secret" id="stripe_webhook_secret"
                                                                       class="form-control" value="{{ $credentials->stripe_webhook_secret }}">
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="mail_from_name">@lang('app.webhook')</label>
                                                                <p class="text-bold">{{ route('verify-webhook') }}</p>
                                                                <p class="text-info">(@lang('messages.addStripeWebhookUrl'))</p>
                                                            </div>
                                                        </div>
                                                        <!--/span-->

                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label class="control-label" >@lang('modules.payments.stripeStatus')</label>
                                                                <div class="switchery-demo">
                                                                    <input type="checkbox" name="stripe_status" @if($credentials->stripe_status == 'active') checked @endif class="js-switch " data-color="#00c292" data-secondary-color="#f96262"  />
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>

                                                    <!--/row-->

                                                </div>
                                                <div class="form-actions m-t-20">
                                                    <button type="submit" id="save-form-2" class="btn btn-success"><i class="fa fa-check"></i>
                                                        @lang('app.save')
                                                    </button>
                                                    <button type="reset" class="btn btn-default">@lang('app.reset')</button>
                                                </div>
                                                {!! Form::close() !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>

            </div>
        </div>


    </div>
    <!-- .row -->


    {{--Ajax Modal--}}
    <div class="modal fade bs-modal-md in" id="leadStatusModal" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-md" id="modal-data-application">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <span class="caption-subject font-red-sunglo bold uppercase" id="modelHeading"></span>
                </div>
                <div class="modal-body">
                    Loading...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn blue">Save changes</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    {{--Ajax Modal Ends--}}

@endsection

@push('footer-script')
    <script src="{{ asset('plugins/bower_components/switchery/dist/switchery.min.js') }}"></script>
    <script>
        // Switchery
        var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
        $('.js-switch').each(function() {
            new Switchery($(this)[0], $(this).data());

        });
        $('#save-form-2').click(function () {
            $.easyAjax({
                url: '{{ route('admin.payment-gateway-credential.update', [$credentials->id])}}',
                container: '#updateSettings',
                type: "POST",
                redirect: true,
                data: $('#updateSettings').serialize()
            })
        });
    </script>
@endpush

