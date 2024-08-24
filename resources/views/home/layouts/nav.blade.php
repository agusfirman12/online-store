    <nav id="navbar" class="fixed w-full z-10 bg-transparent transition-blur">
        <div class="max-w-7xl flex flex-wrap items-center justify-between mx-auto p-4">
            <a href="" class="text-2xl font-semibold text-white"><span class="text-orange-500">FR.</span> <span
                    class="text-xl">store</span></a>
            <div class="flex md:order-2">
                <div class="flex items-center text-3xl text-white me-5">
                    @auth
                        <?php $cart = \App\Models\Cart::where('user_id', Auth::user()->id)
                            ->where('status', 0)
                            ->first();
                        if (!empty($cart)) {
                            $notif = \App\Models\CartDetile::where('cart_id', $cart->id)->count();
                        } else {
                            $notif = 0;
                        }
                        ?>
                        <a href="{{ route('checkout') }}"
                            class="relative inline-flex items-center font-medium text-center text-white hover:text-orange-500 text-3xl">
                            <i class='bx bx-cart-alt'></i>
                            <span class="sr-only">Notifications</span>
                            <div
                                class="absolute inline-flex items-center justify-center w-6 h-6 text-xs font-bold text-white bg-red-500 rounded-full -top-2 -end-4 dark:border-gray-900">
                                {{ $notif }}</div>
                        </a>
                    @else
                        <a href="/"
                            class="relative inline-flex items-center font-medium text-center text-white hover:text-orange-500 text-3xl">
                            <i class='bx bx-cart-alt'></i>
                        </a>
                    @endauth
                </div>
                <span class="w-1 h-10 bg-gray-100 me-3 rounded-lg"></span>
                @if (Auth::check())
                    <div class="hidden sm:flex sm:items-center sm:ms-6">
                        <x-dropdown align="right" width="48" contentClasses="bg-gray-700">
                            <x-slot name="trigger">
                                <button
                                    class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-transparent hover:text-orange-500 focus:outline-none transition ease-in-out duration-150">
                                    <div>{{ Auth::user()->name }}</div>

                                    <div class="ms-1">
                                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </button>
                            </x-slot>

                            <x-slot name="content">
                                <x-dropdown-link :href="route(Auth::user()->role . '.dashboard')"
                                    class="text-white hover:bg-gray-700 hover:text-orange-500 focus:bg-orange-300">
                                    {{ __('Dashboard') }}
                                </x-dropdown-link>

                                <!-- Authentication -->
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf

                                    <x-dropdown-link :href="route('logout')"
                                        class="text-white hover:bg-gray-700 hover:text-orange-500 focus:bg-orange-300"
                                        onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                        {{ __('Log Out') }}
                                    </x-dropdown-link>
                                </form>
                            </x-slot>
                        </x-dropdown>
                    </div>
                @else
                    <div class="flex items-center">
                        <a href="{{ route('login') }}"
                            class="text-md font-semibold text-white bg-orange-500 border-2 border-orange-500 px-4 py-1 rounded-lg me-3 hover:bg-orange-400 hover:border-orange-400 hover:-translate-y-1 animation-all duration-300">Login</a>
                        <a href="{{ route('register') }}"
                            class="text-md font-semibold text-white border-2 border-orange-500 px-4 py-1 rounded-lg hover:bg-orange-400 hover:border-orange-400 hover:-translate-y-1 animation-all duration-300">Register</a>
                    </div>
                @endif
            </div>
            <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="navbar-search">
                <ul
                    class="flex flex-col p-4 md:p-0 mt-4 font-medium sm:border-0 border border-gray-100 rounded-lg sm:bg-transparent bg-gray-50 md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0">
                    <li>
                        <a href="{{ route('home') }}"
                            class="block py-2 px-3 text-white bg-orange-500 rounded-lg md:bg-transparent hover:text-orange-400 animation-all duration-300"
                            aria-current="page">Home</a>
                    </li>
                    <li>
                        <a href="/#category"
                            class="block py-2 px-3 sm:text-white text-gray-500 hover:text-orange-400 animation-all duration-300"
                            aria-current="page">Category</a>
                    </li>
                    <li>
                        <a href="/#newProducts"
                            class="block py-2 px-3 sm:text-white text-gray-500 hover:text-orange-400 animation-all duration-300"
                            aria-current="page">Products</a>
                    </li>
                </ul>
            </div>

        </div>
    </nav>
