<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Products') }}
        </h2>
    </x-slot>

    <!--
  This example requires some changes to your config:

  ```
  // tailwind.config.js
  module.exports = {
    // ...
    plugins: [
      // ...
      require('@tailwindcss/aspect-ratio'),
    ],
  }
  ```
-->
    <div class="bg-white">
        <div class="mx-auto max-w-2xl py-16 px-4 sm:py-21 sm:px-6 lg:max-w-7xl lg:px-8">

            <div class="grid grid-cols-1 gap-y-10 gap-x-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 xl:gap-x-8">
                @foreach($products as $product)
                <div class="group">
                    <div class="aspect-w-1 aspect-h-1 w-full overflow-hidden rounded-lg bg-gray-200 xl:aspect-w-7 xl:aspect-h-8">
                        <img src="{{ asset('storage/products/'.$product->image) }}" alt="Tall slender porcelain bottle with natural clay textured body and cork stopper." class="h-full w-full object-cover object-center group-hover:opacity-75">
                    </div>

                        <h3 class="mt-4 text-sm text-gray-700">{{$product->title}}</h3>
                        <p class="mt-1 text-lg font-medium text-gray-900">{{$product->price}}</p>
                    <button type="button" id="{{$product->id}}" class="bg-blue-500 hover:bg-blue-700 text-black font-bold py-2 px-4 border border-blue-700 rounded product">
                        Add to Cart
                    </button>
                </div>
                @endforeach

                <!-- More products... -->
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
        $(".product").click(function(){
            let product_id = $(this).attr('id');
            $.post("{{route('cart_item_add')}}/"+product_id,
                {
                },
                function(data, status){
                    alert("Item added.");
                });
        });
    });
</script>
