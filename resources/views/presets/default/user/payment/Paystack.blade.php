@extends($activeTemplate . 'layouts.master')
@section('content')
    <div class="row gy-4">
        <div class="col-lg-12">
            <div class="dashboard-card-wrap">
                <div class="row justify-content-end">
                    <h5 class="card-title">@lang('Paystack')</h5>
                    <div class="card-body p-5">
                        <form action="{{ route('ipn.' . $deposit->gateway->alias) }}" method="POST" class="text-center">
                            @csrf
                            <ul class="list-group text-center">
                                <li class="list-group-item d-flex justify-content-between">
                                    @lang('You have to pay '):
                                    <strong>{{ showAmount($deposit->final_amo) }}
                                        {{ __($deposit->method_currency) }}</strong>
                                </li>
                                <li class="list-group-item d-flex justify-content-between">
                                    @lang('You will get '):
                                    <strong>{{ showAmount($deposit->amount) }} {{ __($general->cur_text) }}</strong>
                                </li>
                            </ul>
                            <button type="button" class="btn btn--base w-100 mt-3"
                                id="btn-confirm">@lang('Pay Now')</button>
                            <script src="//js.paystack.co/v1/inline.js" data-key="{{ $data->key }}" data-email="{{ $data->email }}"
                                data-amount="{{ round($data->amount) }}" data-currency="{{ $data->currency }}" data-ref="{{ $data->ref }}"
                                data-custom-button="btn-confirm"></script>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
