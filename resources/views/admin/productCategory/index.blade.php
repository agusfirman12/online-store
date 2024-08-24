<x-app-layout>
    <div class="py-5">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session()->has('success'))
                <div id="alert-3" class="flex items-center p-4 mb-4 text-green-800 rounded-lg bg-green-100"
                    role="alert">
                    <div class="bg-green-300 flex justify-center items-center p-1 rounded-full">
                        <i class="bx bx-check"></i>
                    </div>
                    <div class="ms-3 text-sm font-medium">
                        {{ session('success') }}
                    </div>
                    <button type="button"
                        class="ms-auto -mx-1.5 -my-1.5 bg-green-100 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex items-center justify-center h-8 w-8"
                        data-dismiss-target="#alert-3" aria-label="Close">
                        <span class="sr-only">Close</span>
                        <i class="bx bx-x text-2xl"></i>
                    </button>
                </div>
            @endif
            @if (session()->has('deleted'))
                <div id="alert-3" class="flex items-center p-4 mb-4 text-red-800 rounded-lg bg-red-100"
                    role="alert">
                    <div class="bg-red-300 flex justify-center items-center p-1 rounded-full">
                        <i class="bx bx-check"></i>
                    </div>
                    <div class="ms-3 text-sm font-medium">
                        {{ session('deleted') }}
                    </div>
                    <button type="button"
                        class="ms-auto -mx-1.5 -my-1.5 bg-red-100 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 inline-flex items-center justify-center h-8 w-8"
                        data-dismiss-target="#alert-3" aria-label="Close">
                        <span class="sr-only">Close</span>
                        <i class="bx bx-x text-2xl"></i>
                    </button>
                </div>
            @endif
            <div class="bg-gray-400  overflow-hidden shadow-sm sm:rounded-lg ">
                <div class="p-6 text-gray-100 flex justify-between ">
                    <div class="text-xl font-bold flex items-center">{{ __('Category Page') }}</div>
                    <button type="button" data-modal-target="create-category" data-modal-toggle="create-category"
                        class="bg-orange-500 px-4 py-2 text-sm text-white rounded-lg flex items-center" onclick="add()">
                        <i class='bx bx-plus-circle text-lg me-2'></i>
                        <div>Add Category</div>
                    </button>
                </div>
            </div>

            <div class="bg-gray-400 mt-5 overflow-auto shadow-sm sm:rounded-lg ">
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-200">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    name
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    description
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    status
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $category)
                                <tr
                                    class="odd:bg-gray-400 odd:dark:bg-gray-900 even:bg-gray-300 text-white even:dark:bg-gray-800 border-b">
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-100 whitespace-nowrap">
                                        {{ $category->name }}
                                    </th>
                                    <td class="px-6 py-4">
                                        {{ $category->description }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $category->status }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex">
                                            <button
                                                class="bg-orange-500 p-2 rounded-lg text-xl flex justify-center items-center text-white hover:bg-orange-400 hover:-translate-y-1 animation-all duration-200 me-2"
                                                type="button" data-modal-target="create-category"
                                                data-modal-toggle="create-category"
                                                onclick="edit({{ $category->id }})"><i
                                                    class="bx
                                                bx-edit"></i></button>
                                            <button
                                                class="bg-red-600 p-2 rounded-lg text-xl flex justify-center items-center text-white hover:bg-red-500 hover:-translate-y-1 animation-all duration-200"
                                                data-modal-target="delete-modal" data-modal-toggle="delete-modal"
                                                onclick="destroy({{ $category->id }})">
                                                <i class="bx bxs-trash"></i></button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>

    {{-- create modal --}}
    <div id="create-category" tabindex="-1" aria-hidden="true" class="hidden h-">
        <x-modal-create height='h-[26rem] sm:h-[22rem]'>
            <div class="flex justify-between">
                <h1 id="modal-title" class="text-2xl text-gray-100 font-bold mb-4">Add new Category</h1>
                <button
                    class="hover:bg-orange-100 hover-text-gray-500 focus:ring-2 focus:ring-orange-200 px-2 rounded-lg"
                    data-modal-hide="create-category">
                    <i class="bx bx-x text-3xl"></i>
                </button>
            </div>
            <form action="" method="post">
                @csrf
                <div class="sm:flex sm:justify-between w-full">
                    <div class="sm:w-6/12">
                        <x-input-label for="name" :value="__('Product Name')" />
                        <x-text-input id="name" name="name" type="text" class="mt-1 block w-full"
                            placeholder="Caregory Name" required />
                        <x-input-error class="mt-2" :messages="$errors->get('name')" />
                    </div>

                    <div class="sm:w-5/12">
                        <x-input-label for="status" :value="__('Category Status')" />
                        <x-select-input id="status" name="status" class="mt-1 block w-full"
                            placeholder="Product Status" required>
                            <option value="Active">Active</option>
                            <option value="NonActive">Non Active</option>
                        </x-select-input>
                        <x-input-error class="mt-2" :messages="$errors->get('status')" />
                    </div>
                </div>
                <div class="mt-3">
                    <x-input-label for="description" :value="__('Category Description')" />
                    <x-text-area-input id="description" name="description" class="mt-1 block w-full"
                        placeholder="Category Description..." required />
                    <x-input-error class="mt-2" :messages="$errors->get('description')" />
                </div>

                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg mt-5">save
                    Category</button>
            </form>
        </x-modal-create>
    </div>

    {{-- delete modal --}}
    <div id="delete-modal" tabindex="-1"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <div class="relative bg-gray-700 rounded-lg shadow">
                <button type="button"
                    class="absolute top-3 end-2.5 text-gray-100 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                    data-modal-hide="delete-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
                <div class="p-4 md:p-5 text-center">
                    <svg class="mx-auto mb-4 text-gray-400 w-12 h-12" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                    <h3 class="mb-5 text-lg font-normal text-gray-100">Are you sure you want to
                        delete this product?</h3>
                    <form action="" method="post">
                        @method('DELETE')
                        @csrf
                        <button data-modal-hide="delete-modal" type="submit"
                            class="text-white bg-orange-500 hover:bg-orange-400 focus:ring-4 focus:outline-none focus:ring-orange-300 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                            Yes, I'm sure
                        </button>
                        <button data-modal-hide="delete-modal" type="button"
                            class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-orange-500 focus:z-10 focus:ring-4 focus:ring-gray-100">No,
                            cancel</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function add() {
            $('#modal-title').text("Add New Category");
            $('#create-category form').trigger('reset');
            let url = "{{ route('admin.category.store') }}";
            $('#create-category form').attr('action', url);
            // remove methode put
            $('#create-category form input[name="_method"]').remove();
        }

        function edit(id) {
            $('#modal-title').text("Edit Category");
            $('#create-category form').trigger('reset');
            let url = "{{ route('admin.category.update', ':id') }}";
            url = url.replace(':id', id);
            $('#create-category form').attr('action', url);
            $('#create-category form').append('<input type="hidden" name="_method" value="PUT">');

            $.ajax({
                url: "{{ route('admin.category.show', ':id') }}".replace(':id', id),
                method: 'GET',
                success: function(result) {
                    $('#create-category #name').val(result.name);
                    $('#create-category #status').val(result.status);
                    $('#create-category #description').val(result.description);
                }
            });
        }

        function destroy(id) {
            let url = "{{ route('admin.category.destroy', ':id') }}";
            url = url.replace(':id', id);
            $('#delete-modal form').attr('action', url);
        }
    </script>
</x-app-layout>
