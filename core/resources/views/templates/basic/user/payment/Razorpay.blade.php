@extends($activeTemplate.'layouts.master')
@section('content')
<div class="two__factor card custom--card primary-bg">
    <div class="card-body border-radius-0 p-4">
        <div class="row">
            <div class="col-md-4">
                <h3 class="title mb-2"><span>@lang('Payment Preview')</span></h3>
                <img src="{{ $deposit->gatewayCurrency()->methodImage() }}" class="card-img-top"
                    alt="@lang('Image')" class="w-100">
            </div>
            <div class="col-md-8 mt-5">
                <h4 class="text-center">@lang('Please Pay') {{ showAmount($deposit->final_amo) }}
                    {{ $deposit->method_currency }}</h4>
                <h4 class="my-3 text-center">@lang('To Get') {{ showAmount($deposit->amount) }}
                    {{ __($general->cur_text) }}</h4>
                <form action="{{ $data->url }}" method="{{ $data->method }}">
                    <input type="hidden" custom="{{ $data->custom }}" name="hidden">
                    <button type="submit" class="btn btn--base w-100 radius-5"
                        id="btn-confirm">@lang('Pay Now')</button>
                    <script src="{{ $data->checkout_js }}" @foreach ($data->
                        val as $key => $value)
                        data - {{ $key }} = "{{ $value }}"
                        @endforeach >
                    </script>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@push('script')
    <script>
        (function($) {
            "use strict";
            $('input[type="submit"]').addClass("ml-4 mt-4 btn-custom2 text-center btn-lg");
        })(jQuery);
    </script>
@endpush
