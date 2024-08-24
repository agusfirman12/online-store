@extends('home.layouts.app')

@section('content')
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">

    <div class="bg-gray-700 w-full min-h-screen flex items-center">
        <div class="max-w-7xl mx-auto pt-16">
            <div class="w-fu flex bg-gray-500 rounded-lg p-5">
                <div class="text-white me-10">
                    <h3 class="text-3xl font-semibold"> <i class="bx bx-cart"></i> Checkout Page</h3>
                </div>
                <div class="relative overflow-x-auto">
                    <h1 class="text-xl font-semibold text-white">Your Order Detile</h1>
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <tbody>
                            @foreach ($cart_detiles as $cart_detile)
                                <tr class=" border-y-2 border-gray-700 text-white">
                                    <td class="px-5 py-2">
                                        <div class="w-20 h-20 flex items-center">
                                            <img src="/storage/{{ $cart_detile->product->photo }}" alt="">
                                        </div>
                                    </td>
                                    <td class="px-5 py-2">
                                        {{ $cart_detile->product->name }}
                                    </td>
                                    <td class="px-5 py-2">
                                        {{ $cart_detile->total }}
                                    </td>
                                    <td class="px-5 py-2" align="right">
                                        Rp. {{ number_format($cart_detile->product->price, 0, '.', '.') }}
                                    </td>
                                    <td class="px-5 py-2" align="right">
                                        Rp. {{ number_format($cart_detile->price_total, 0, '.', '.') }}
                                    </td>
                                    <td class="px-3 py-2">
                                        <form action="{{ route('deleteCart', $cart_detile->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="bg-red-600 p-2 rounded-lg text-lg flex justify-center items-center text-white hover:bg-red-500 hover:-translate-y-1 animation-all duration-200">
                                                <i class="bx bxs-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            <tr>
                                <td class="px-6 py-2 text-white font-semibold text-lg ">Total</td>
                                <td colspan="3"></td>
                                <td class="px-6 py-2 text-white font-semibold text-md" align="right">Rp.
                                    {{ number_format($carts->total_price, 0, '.', '.') }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="mt-5 flex justify-end">
                        <a href="{{ route('confirm.checkout') }}"
                            class="bg-orange-500 p-2 w-1/3 rounded-lg text-lg flex justify-center items-center text-white hover:bg-orange-400 hover:-translate-y-1 animation-all duration-200">
                            Check Out
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @if (session()->has('deleted'))
        <script>
            const Toast = Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                }
            });
            Toast.fire({
                icon: "error",
                title: "Product Succes Deleted"
            });
        </script>
    @endif
@endsection
