<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <section>
        @if (session('status'))
            <div class="flex justify-center">
                <span class="bg-green-500 text-white p-2 rounded-md"> {{ session('status') }}</span>
            </div>
        @endif
        <div class="text-center my-4">
            <a href="{{ route('task.form') }}"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Add
                Task

            </a>
        </div>




        <div class="relative overflow-x-auto shadow-md sm:rounded-lg mx-6">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 ">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 ">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            sno
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Title
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Status
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Description
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Date
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Edit
                        </th>
                        <th scope="col" class="px-6 py-3">
                            delete
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($data as $item)
                        <tr class="bg-white border-b hover:bg-gray-50">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                {{ $loop->iteration }}
                            </th>
                            <td class="px-6 py-4">
                                {{ $item->title }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $item->status }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $item->description }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $item->due_date }}
                            </td>
                            <td class="px-6 py-4 ">
                                <a href="{{ route('task.editForm', ['id' => $item->id]) }}"
                                    class="font-medium text-blue-600 hover:underline">Edit</a>
                            </td>
                            <td class="px-6 py-4 ">
                                <a href="{{ route('task.delete', ['id' => $item->id]) }}"
                                    class="font-medium text-red-600 hover:underline">Delete</a>
                            </td>
                        </tr>
                    @empty
                        <tr aria-colspan="6"> data not Found</tr>
                    @endforelse



                </tbody>
            </table>
        </div>


    </section>
</x-app-layout>
