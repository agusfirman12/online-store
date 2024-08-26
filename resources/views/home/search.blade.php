 @if ($products->count() < 0)
     <h1 class="text-xl text-white font-bold">No Product yet</h1>
 @else
     @foreach ($products as $product)
         <div class="w-5/6 md:w-1/5 mb-3 md:mb-0  border rounded-lg shadow bg-gray-800 border-gray-700 md:me-10">
             <div class="object-hover h-[150px] overflow-hidden object-center w-full">
                 <a href="#">
                     <img class="rounded-t-lg hover:scale-110 hover:duration-300 overflow-hidden" loading="lazy"
                         src="/storage/{{ $product->photo }}" alt="" />
                 </a>
             </div>
             <div class="p-5">
                 <a href="#">
                     <h5 class="mb-2 text-2xl font-bold tracking-tight text-white">
                         {{ $product->name }}</h5>
                 </a>
                 <p class="mb-3 font-normal text-white">{{ $product->description }}
                 </p>
                 <div class="text-white text-sm">
                     <p>Stock: {{ $product->stock }}</p>
                 </div>
                 <div class="flex items-center mt-2.5 mb-5">
                     <div class="flex items-center space-x-1 rtl:space-x-reverse">
                         <svg class="w-4 h-4 text-yellow-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                             fill="currentColor" viewBox="0 0 22 20">
                             <path
                                 d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                         </svg>
                         <svg class="w-4 h-4 text-yellow-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                             fill="currentColor" viewBox="0 0 22 20">
                             <path
                                 d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                         </svg>
                         <svg class="w-4 h-4 text-yellow-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                             fill="currentColor" viewBox="0 0 22 20">
                             <path
                                 d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                         </svg>
                         <svg class="w-4 h-4 text-yellow-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                             fill="currentColor" viewBox="0 0 22 20">
                             <path
                                 d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                         </svg>
                         <svg class="w-4 h-4 text-gray-200 dark:text-gray-600" aria-hidden="true"
                             xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                             <path
                                 d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                         </svg>
                     </div>
                     <span
                         class="bg-blue-100 text-blue-800 text-xs font-semibold px-2.5 py-0.5 rounded dark:bg-blue-200 dark:text-blue-800 ms-3">5.0</span>
                 </div>
                 <div class="flex items-center justify-between">
                     <span class="text-xl md:text-2xl font-bold text-white">Rp.
                         {{ number_format($product->price, 0, '.', '.') }}</span>
                     <a href="{{ route('product.detail', $product->id) }}"
                         class="text-white flex items-center bg-orange-500 hover:bg-orange-600 focus:ring-4 focus:outline-none focus:ring-orange-300 font-medium rounded-lg text-sm px-3 py-1 text-center dark:bg-orange-600 dark:hover:bg-orange-700 dark:focus:ring-orange-800">
                         <i class="bx bx-cart text-lg me-2"></i> Order</a>
                 </div>
             </div>
         </div>
     @endforeach
 @endif
