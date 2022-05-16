<div class="max-w-full">
    <div>

        {{-- ¿Hubo error en el proceso del pago? 
            
            // Presentar la página de error al procesar el pago

        --}}

        {{-- SI: Mandar la página de rror --}}

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
    </div>
</div>

<div wire:loading wire:target="submit" class="flex justify-around h-full w-full">
    <span class="inline-flex rounded-md shadow-sm">
        <span class="inline-flex items-center px-8 py-2 border border-transparent text-base leading-6 font-medium rounded-md text-black bg-red-600 hover:bg-red-500 focus:border-red-700 active:bg-red-700 transition ease-in-out duration-150 cursor-not-allowed" disabled="">
            <svg class="animate-spin -ml-1 mr-3 h-12 w-12 text-black" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            {{__("Processing Payment...")}}
        </span>
    </span>
</div>

<script type="text/javascript" src="https://js.stripe.com/v2/"></script>

<script type="text/javascript">
    $(function () {
        var $form = $(".stripe-payment");
        $('form.stripe-payment').bind('submit', function (e) {
            var $form = $(".stripe-payment"),
                inputVal = ['input[type=text]',
                            'input[type=file]',
                            'textarea'
                            ].join(', '),

                $inputs = $form.find('.required').find(inputVal),
                $errorStatus = $form.find('div.error'),
                valid = true;
                $errorStatus.addClass('hide');

            $('.has-error').removeClass('has-error');

            $inputs.each(function (i, el) {
                var $input = $(el);
                if ($input.val() === '') {
                    $input.parent().addClass('has-error');
                    $errorStatus.removeClass('hide');
                    e.preventDefault();
                }
            });

            if (!$form.data('cc-on-file')) {
                e.preventDefault();
                Stripe.setPublishableKey($form.data('stripe-token-public'));
                Stripe.createToken({
                    number: $('.card-num').val(),
                    cvc: $('.card-cvc').val(),
                    exp_month: $('.card-expiry-month').val(),
                    exp_year: $('.card-expiry-year').val()
                }, stripeRes);
            }

        });

        // Token Stripe
        function stripeRes(status, response) {
            if (response.error) {
                $('.error')
                    .removeClass('hide')
                    .find('.alert-error');
                    var errorElement = document.getElementById('card-errors');
                    errorElement.textContent = response.error.message;
            } else {
                var token = response['id'];
                $form.find('input[type=text]').empty();
                $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");

                document.getElementById("msg_processing_payment").style.display = "block";
                document.getElementById("submit_form").style.display = "none";
                document.getElementById("go_back").style.display = "none";

                // var msg_processing_payment = document.getElementById("msg_processing_payment").style.display = "block";
                // msg_processing_payment.style.display = "block";

                $form.get(0).submit();
            }
        }

    });
</script>
