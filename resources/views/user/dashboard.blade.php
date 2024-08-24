@extends('user.layouts.main')

@section('content')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800  leading-tight">
            {{ __('dashboard-user') }} </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-700  overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-white ">
                    {{ __("You're logged in!") }}
                </div>

                <div class="px-6 py-3 text-white">
                    <h1 class="text-xl font-semibold my-5">Riwayat Transaksi</h1>
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-100 uppercase ">
                            <tr class="border-y-2 border-gray-400 text-white">
                                <th class="px-5 py-2">
                                    tanggal pesan
                                </th>
                                <th class="px-5 py-2">
                                    jenis barang
                                </th>
                                <th class="px-5 py-2">
                                    status
                                </th>
                                <th class="px-5 py-2">
                                    total harga
                                </th>
                            </tr>
                        </thead>
                        <tbody class="text-white">
                            @foreach ($carts as $cart)
                                <tr class="border-y-2 border-gray-400 text-white">
                                    <td class="px-5 py-2">
                                        {{ $cart->created_at }}
                                    </td>
                                    <td class="px-5 py-2">
                                        {{ $cart->quantity }} jenis
                                    </td>
                                    <td class="px-5 py-2">
                                        @if ($cart->status == 1)
                                            <p>paid</p>
                                        @else
                                            <p>unpaid</p>
                                        @endif
                                    </td>
                                    <td class="px-5 py-2">
                                        {{ $cart->total_price }}
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
