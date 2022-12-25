<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Cart') }}
        </h2>
    </x-slot>
    <!-- component -->
    <div class="container p-8 mx-auto mt-12">
    <div class="w-full overflow-x-auto">
        <div class="my-2">
            <h3 class="text-xl font-bold tracking-wider">Shopping Cart 3 item</h3>
        </div>
        <table class="w-full shadow-inner">
            <thead>
            <tr class="bg-gray-100">
                <th class="px-6 py-3 font-bold whitespace-nowrap">Image</th>
                <th class="px-6 py-3 font-bold whitespace-nowrap">Product</th>
                <th class="px-6 py-3 font-bold whitespace-nowrap">Qty</th>
                <th class="px-6 py-3 font-bold whitespace-nowrap">Price</th>
                <th class="px-6 py-3 font-bold whitespace-nowrap">Remove</th>
            </tr>
            </thead>
            <tbody>
            @foreach($cart_items as $cart_item)
            <tr id="cart-item-row-{{$cart_item->id}}">
                <td>
                    <div class="flex justify-center">
                        <img
                            src="{{ asset('storage/products/'.$cart_item->product->image) }}"
                            class="object-cover h-7 w-7 rounded-2xl"
                            alt="image"
                            width="200" height="300"
                        />
                    </div>
                </td>
                <td class="p-4 px-6 text-center whitespace-nowrap">
                    <div class="flex flex-col items-center justify-center">
                        <h3>{{$cart_item->product->title}}</h3>
                    </div>
                </td>
                <td class="p-4 px-6 text-center whitespace-nowrap">
                    <div>
                        <button class="cart-item-down" id="cart-item-down-{{ $cart_item->id }}" {{ $cart_item->quantity == 1 ? 'disabled' : ''}}>
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="inline-flex w-6 h-6 text-red-600"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"
                                />
                            </svg>
                        </button>
                        <input
                            type="number"
                            min="1"
                            id="cart-item-{{$cart_item->id}}"
                            value="{{$cart_item->quantity}}"
                            class="w-12 text-center bg-gray-100 outline-none"
                            disabled
                        />
                        <button class="cart-item-up" id="cart-item-up-{{$cart_item->id}}">
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="inline-flex w-6 h-6 text-green-600"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"
                                />
                            </svg>
                        </button>
                    </div>
                </td>
                <td class="p-4 px-6 text-center whitespace-nowrap cart-item-price" id="cart-item-price-{{$cart_item->id}}" data-price="{{number_format($cart_item->quantity*$cart_item->product->price, 2, '.', '')}}">${{ number_format($cart_item->quantity*$cart_item->product->price, 2, '.', '') }}</td>
                <td class="p-4 px-6 text-center whitespace-nowrap">
                    <button type="button" class="cart-item-remove" id="cart-item-remove-{{ $cart_item->id }}">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="w-6 h-6 text-red-400"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"
                            />
                        </svg>
                    </button>
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
        <div class="lg:w-2/4">
            <div class="mt-4">
                <div class="px-4 py-4 rounded-md">
                    <label for="coupon code" class="font-semibold text-gray-600"
                    >Coupon Code (%)</label
                    >
                    <input
                        type="text"
                        id="coupon-code"
                        placeholder="coupon code"
                        value=""
                        class="
                  w-full
                  px-2
                  py-2
                  border border-blue-600
                  rounded-md
                  outline-none
                "
                    />
                    <button
                        class="
                  px-6
                  py-2
                  mt-2
                  text-sm text-indigo-100
                  bg-indigo-600
                  rounded-md
                  hover:bg-indigo-700
                  border-blue-700
                "
                        id="send-coupon"
                    >
                        Apply
                    </button>
                </div>
            </div>
        </div>
        <div class="mt-4">
            <div class="py-4 rounded-md shadow">
                <h3 class="text-xl font-bold text-blue-600">Order Summary</h3>
                <div class="flex justify-between px-4">
                    <span class="font-bold">Subtotal</span>
                    <span class="font-bold" id="cart-subtotal-price" data-price=""></span>
                </div>
                <div class="flex justify-between px-4">
                    <span class="font-bold">Discount</span>
                    <span class="font-bold text-red-600" id="cart-discount" data-price=""></span>
                </div>
                <div
                    class="
                flex
                items-center
                justify-between
                px-4
                py-2
                mt-3
                border-t-2
              "
                >
                    <span class="text-xl font-bold">Total</span>
                    <span class="text-2xl font-bold" id="cart-total-price" data-price=""></span>
                </div>
            </div>
        </div>
        <div class="mt-4">
            <button
                class="
              w-full
              py-2
              text-center text-black
              bg-blue-500
              rounded-md
              shadow
              hover:bg-blue-600
              border-blue-700
            "
            >
                Proceed to Checkout
            </button>
        </div>
    </div>
    </div>
</x-app-layout>
<script>
    $(function() {
        $.ajaxSetup({
            headers:
                { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
        });

        calculateTotal();

        function calculateTotal() {
            let total = 0;
            $('.cart-item-price').each(function(i, obj) {
                if($(this).css('display') != 'none') {
                    total += parseFloat($(this).data('price'));
                }
            });
            $('#cart-total-price').text('$'+total.toFixed(2));
            $('#cart-subtotal-price').text('$'+total.toFixed(2));
            $('#cart-total-price').data('price', total.toFixed(2));
            $('#cart-subtotal-price').data('price', total.toFixed(2));
            $('#cart-discount').data('price', 0.00);
            $('#cart-discount').text('- $'+0.00);

            if ($('#coupon-code').val() != '') {
                $('#send-coupon').trigger('click');
            }
        }

        $(".cart-item-down").click(function(){
            let cart_item_id = $(this).attr('id').substring($(this).attr('id').lastIndexOf('-') + 1);
            $.ajax({
                url: '/cart-item/' + cart_item_id,
                type: 'PUT',
                data: {
                    number: -1
                },
                success: function(data) {
                    $('#cart-item-price-'+cart_item_id).text('$'+data.price);
                    $('#cart-item-price-'+cart_item_id).data('price', data.price);
                    $('#cart-item-'+cart_item_id).val(parseInt($('#cart-item-'+cart_item_id).val())-1);
                    if (parseInt($('#cart-item-'+cart_item_id).val()) == 1) {
                        $('#cart-item-down-'+cart_item_id).attr('disabled', true);
                    }
                    calculateTotal();
                }
            });
        });

        $(".cart-item-up").click(function(){
            let cart_item_id = $(this).attr('id').substring($(this).attr('id').lastIndexOf('-') + 1);
            $.ajax({
                url: '/cart-item/' + cart_item_id,
                type: 'PUT',
                data: {
                    number: 1
                },
                success: function(data) {
                    $('#cart-item-price-'+cart_item_id).text('$'+data.price);
                    $('#cart-item-price-'+cart_item_id).data('price', data.price);
                    $('#cart-item-'+cart_item_id).val(parseInt($('#cart-item-'+cart_item_id).val())+1);
                    if (parseInt($('#cart-item-'+cart_item_id).val()) > 1) {
                        $('#cart-item-down-'+cart_item_id).attr('disabled', false);
                    }
                    calculateTotal();
                }
            });
        });

        $(".cart-item-remove").click(function(){
            if (confirm('Are you sure?')) {
                let cart_item_id = $(this).attr('id').substring($(this).attr('id').lastIndexOf('-') + 1);
                $.ajax({
                    url: '/cart-item/' + cart_item_id,
                    type: 'DELETE',
                    success: function (data) {
                        $('#cart-item-row-' + cart_item_id).css('display', 'none');
                        $('#cart-item-price-'+cart_item_id).css('display', 'none');
                        calculateTotal();
                    }
                });
            }
        });

        $("#send-coupon").click(function () {
            $('#cart-discount').data('price', 0.00);
            $('#cart-discount').text('- $'+0.00);
            $('#cart-total-price').data('price', $('#cart-subtotal-price').data('price'));
            $('#cart-total-price').text($('#cart-subtotal-price').text());
            let coupon = $('#coupon-code').val();
            if (coupon != '') {
                $.ajax({
                    url: '/get_coupon/' + coupon,
                    type: 'GET',
                    success: function (data) {
                        if (data.coupon == 'null') {
                            alert('Unvalidated');
                        } else {
                            let discount = ($('#cart-subtotal-price').data('price')*data.coupon.value)/100;
                            let total = $('#cart-subtotal-price').data('price') - discount;
                            $('#cart-total-price').data('price', total);
                            $('#cart-total-price').text('$'+total.toFixed(2));
                            $('#cart-discount').data('price', discount);
                            $('#cart-discount').text('- $'+discount.toFixed(2));
                        }
                    }
                });
            } else {
                alert('Type in coupon code');
            }
        });
    });
</script>
