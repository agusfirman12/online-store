@extends('home.layouts.app')

@section('content')
    <div class="bg-gray-700 w-full min-h-screen flex items-center">
        <div class="max-w-5xl mx-auto pt-16">
            <div class="flex bg-gray-500 rounded-lg p-5">
                <div class="w-2/3 object-hover overflow-hidden object-center">
                    <img src="/storage/{{ $product->photo }}"
                        class="rounded-lg hover:scale-150 hover:duration-300 overflow-hidden">
                </div>
                <span class="w-1 min-h-fit mx-10 rounded-lg bg-slate-200"></span>
                <div class="w-1/3">
                    <h1 class="text-5xl font-semibold text-white capitalize">{{ $product->name }}</h1>
                    <div class="flex text-white mb-5">
                        <p>Rating: {{ $product->rating }}</p>
                        <span class="w-[2px] h-6 bg-gray-100 mx-5 rounded-lg"></span>
                        <p>Category: {{ $product->category->name }}</p>
                    </div>
                    <h1 class="text-3xl text-white font-semibold mb-5">Rp.{{ number_format($product->price, 0, '.', '.') }}
                    </h1>
                    <div class="h-48">
                        <p class="text-white mb-5">{{ $product->description }}</p>
                    </div>
                    <p class="text-white">Stock: {{ $product->stock }}</p>
                    <form action="{{ route('addToCart', $product->id) }}" method="POST">
                        @csrf
                        <div class="flex items-center mt-2 mb-5">
                            <label for="quantity" class="text-white me-5">Quantity: </label>
                            <button type="button" onclick="decrementValue()"
                                class="px-4 py-2 text-white text-lg bg-gray-700 rounded-l">-</button>

                            <input type="number" id="quantity" name="quantity" value="1" min="1"
                                class="w-16 text-center border-2 border-gray-300 focus:outline-none">

                            <button type="button" onclick="incrementValue()"
                                class="px-4 py-2 text-white text-lg bg-gray-700 rounded-r">+</button>
                        </div>
                        <div class="flex justify-end">
                            <button type="submit"
                                class="bg-orange-500 px-5 py-2 text-white rounded-lg hover:bg-orange-600 transition-all duration-300 ease-in-out">Add
                                to
                                cart</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection


<script>
    function incrementValue() {
        let quantity = document.getElementById('quantity');
        let value = parseInt(quantity.value, 10);
        value = isNaN(value) ? 0 : value;
        value++;
        quantity.value = value;
    }

    function decrementValue() {
        let quantity = document.getElementById('quantity');
        let value = parseInt(quantity.value, 10);
        value = isNaN(value) ? 0 : value;
        value = value > 0 ? value - 1 : 0; // Prevent negative values
        quantity.value = value;
    }
</script>
