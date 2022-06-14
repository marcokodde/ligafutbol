<div class="max-w-full">
    <div>
        @if (isset($error_stripe))
            @include('livewire.payments.error_stripe')
        @else
            @include('livewire.payments.header_payment')
            <form action="{{route('makepayment')}}" method="post" role="form"
                class="stripe-payment"
                data-cc-on-file="false" data-stripe-token-public="{{env('STRIPE_KEY')}}"
                id="stripe-payment">
                @csrf
                <div class="row mx-auto">
                    <div class="py-2">
                        <div class="mx-auto text-center text-2xl font-semibold">
                            <x-jet-validation-errors/>
                        </div>
                        {{-- Paso numero 1 agregando datos de los teams --}}
                        @if ($currentPage === 1)
                            @include('livewire.payments.step1')
                        {{-- Paso tres, se detalla el detalle de la reservacion --}}
                        @elseif ($currentPage === 2)
                            @include('livewire.payments.step2')
                        @elseif ($currentPage === 3)
                            @include('livewire.payments.step3')
                        @endif
                        <div>
                            @include('livewire.payments.buttons_steps')
                        </div>
                    </div>
                </div>
            </form>
        @endif
    </div>
</div>
<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
<script src="{{asset('js/stripe.js')}}"></script>