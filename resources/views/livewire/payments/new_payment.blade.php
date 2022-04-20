<div class="py-12">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        <div class="sm:mt-0">
            <div class="md:grid md:grid-cols-3 md:gap-6">
                <div class="md:mt-0 md:col-span-2">
                    @include('livewire.payments.header_payment')
                    <form wire:submit.prevent="submit" action="{{route('makepayment')}}" method="post" role="form"
                    class="stripe-payment"
                    data-cc-on-file="false" data-stripe-token-public="{{env('STRIPE_KEY')}}"
                    id="stripe-payment">
                    @csrf
                        <div class="row mx-auto">
                            <div class="bg-white px-2 pb-2 sm:p-3 sm:pb-2 border-4 border-blue-400 rounded-lg">
                                @if (Auth::user()->teams()->count() > 1)
                                    {{-- Paso numero 1 agregando datos de los teams --}}
                                        @if ($currentPage === 1)
                                        @include('livewire.payments.step1')

                                    {{-- Paso tres, se detalla el detalle de la reservacion --}}
                                    @elseif ($currentPage === 2)
                                        @include('livewire.payments.step2')
                                    @endif
                                    <div>
                                        @include('livewire.payments.buttons_steps')
                                    </div>
                                @else
                                    <label class="mx-auto text-xl text-black text-bold  justify-center rounded-full">
                                        {{ __('No Records Found')}}
                                    </label>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
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
                $form.get(0).submit();
            }
        }

    });
</script>