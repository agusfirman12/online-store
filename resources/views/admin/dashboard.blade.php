<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('dashboard-admin') }}
        </h2>
    </x-slot>

    <div class="py-1">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="my-5">
                <ul class="box-info grid grid-cols-[repeat(auto-fit,_minmax(200px,_1fr))] gap-8 mt-9">
                    <li class="p-5 bg-gray-400 rounded-3xl flex gap-8 items-center">
                        <i
                            class='bx bxs-package w-20 h-20 rounded-xl bg-orange-200 text-4xl text-orange-500 flex items-center justify-center'></i>
                        <span class="text-white">
                            <h3 class="text-[24px] font-bold">{{ number_format($countProduct) }}</h3>
                            <p>Product Total</p>
                        </span>
                        </i>
                    </li>
                    <li class="p-5 bg-gray-400 rounded-3xl flex gap-8 items-center">
                        <i
                            class='bx bxs-group w-20 h-20 rounded-xl bg-yellow-200 text-4xl text-yellow-500 flex items-center justify-center'></i>
                        <span class="text-white">
                            <h3 class="text-[24px] font-bold">{{ number_format($countUser) }}</h3>
                            <p>User Total</p>
                        </span>
                        </i>
                    </li>
                    <li class="p-5 bg-gray-400 rounded-3xl flex gap-8 items-center">
                        <i
                            class='bx bx-list-check w-20 h-20 rounded-xl bg-blue-200 text-4xl text-blue-500 flex items-center justify-center'></i>
                        <span class="text">
                            <h3 class="text-[24px] font-bold">{{ number_format($countCategory) }}</h3>
                            <p>Category Total</p>
                        </span>
                        </i>
                    </li>
                    <li class="p-5 bg-gray-400 rounded-3xl flex gap-8 items-center">
                        <i
                            class='bx bx-check-square w-20 h-20 rounded-xl bg-green-200 text-4xl text-green-500 flex items-center justify-center'></i>
                        <span class="text">
                            <h3 class="text-[24px] font-bold">{{ number_format($countActiveProduct) }}</h3>
                            <p>Product Active</p>
                        </span>
                        </i>
                    </li>
                </ul>
            </div>
            <div class="bg-gray-400  overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 ">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
