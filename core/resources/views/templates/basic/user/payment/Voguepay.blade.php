@extends($activeTemplate.'layouts.frontend')
@section('content')
<div class="two__factor card custom--card primary-bg">
    <div class="card-body border-radius-0 p-4">
        <div class="row">
            <div class="col-md-4">
                <img src="{{ $deposit->gatewayCurrency()->methodImage() }}" class="card-img-top"
                    alt="@lang('Image')" class="w-100">
            </div>
            <div class="col-md-8">
                <h4 class="mt-4">@lang('Please Pay : ')
                    {{ showAmount($deposit->final_amo) }}{{ __($deposit->method_currency) }}
                </h4>
                <h4 class="my-4">@lang('To Get : ') {{ showAmount($deposit->amount) }}
                    {{ __($general->cur_text) }}
                </h4>
                <button type="button" class="btn btn--base w-100 radius-5" id="btn-confirm">@lang('Pay
                    Now')</button>
            </div>
        </div>
    </div>
</div>
@endsection
@push('script')
    <script src="//pay.voguepay.com/js/voguepay.js"></script>
    <script>
        "use strict";
        var closedFunction = function() {}
        var successFunction = function(transaction_id) {
            window.location.href = '{{ route(gatewayRedirectUrl()) }}';
        }
        var failedFunction = function(transaction_id) {
            window.location.href = '{{ route(gatewayRedirectUrl()) }}';
        }

        function pay(item, price) {
            //Initiate voguepay inline payment
            Voguepay.init({
                v_merchant_id: "{{ $data->v_merchant_id }}",
                total: price,
                notify_url: "{{ $data->notify_url }}",
                cur: "{{ $data->cur }}",
                merchant_ref: "{{ $data->merchant_ref }}",
                memo: "{{ $data->memo }}",
                recurrent: true,
                frequency: 10,
                developer_code: '60a4ecd9bbc77',
                custom: "{{ $data->custom }}",
                customer: {
                    name: 'Customer name',
                    country: 'Country',
                    address: 'Customer address',
                    city: 'Customer city',
                    state: 'Customer state',
                    zipcode: 'Customer zip/post code',
                    email: 'example@example.com',
                    phone: 'Customer phone'
                },
                closed: closedFunction,
                success: successFunction,
                failed: failedFunction
            });
        }

        (function($) {

            $('#btn-confirm').on('click', function(e) {
                e.preventDefault();
                pay('Buy', {{ $data->Buy }});
            });

        })(jQuery);
    </script>
@endpush
