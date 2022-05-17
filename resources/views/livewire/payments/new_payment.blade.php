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
    
                        @if (Auth::user() && Auth::user()->isCoach())
                            @if ($currentPage === 1)
                                @include('livewire.payment_coach.step1')
                            @elseif ($currentPage === 2)
                                @include('livewire.payment_coach.payment_coach')
                            @endif
                        @else
                            @if ($currentPage === 1)
                                @include('livewire.payments.step1')
                            {{-- Paso tres, se detalla el detalle de la reservacion --}}
                            @elseif ($currentPage === 2)
                                @include('livewire.payments.step2')
                            @elseif ($currentPage === 3)
                                @include('livewire.payments.step3')
                            @endif
                        @endif
                        <div>
                            @if (Auth::user() && Auth::user()->isCoach())
                                @include('livewire.payment_coach.buttons_coach')
                            @else
                                @include('livewire.payments.buttons_steps')
                            @endif
                        </div>
                    </div>
                </div>
            </form>
        @endif
    </div>
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
