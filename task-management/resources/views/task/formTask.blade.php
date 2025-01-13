@extends('layouts.test')

@section('contain')
    <div class="text-center my-3">
        @if (Auth::guard('admin')->check() && Auth::guard('admin')->user()->name)
        <a href="{{route('admin.dashboard')}}"
        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Back to Dashboard
        
    </a>
        @else
        <a href="{{route('dashboard')}}"
        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center"> Back to Dashboard
        
    </a>
        @endif
    </div>
    <div class="text-center my-4">
        <h1 class="text-3xl font-semibold">Task Form</h1>
    </div>
    <div class="form">


        <form class="max-w-sm mx-auto" action="{{ route('task.formAdd') }}" method="POST">
            @csrf
            <div class="mb-5">
                <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Title</label>
                <input type="text" id="title" name="title"
                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                    placeholder="Enter your Title" />
                @if (Auth::guard('admin')->check() && Auth::guard('admin')->user()->name)
                    <input type="text" id="title" name="createdby" value="admin"
                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 hidden"
                        placeholder="Enter your Title" />
                @else
                    <input type="text" id="title" name="createdby" value="{{ Auth::user()->id }}"
                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 hidden"
                        placeholder="Enter your Title" />
                @endif

                @error('title')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror

            </div>
            <div class="mb-5">
                <label for="countries" class="block mb-2 text-sm font-medium text-gray-900 ">Select your country</label>
                <select id="countries" name="status"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">


                    <option value="Pending">Pending</option>
                    <option value="In Progress">In Progress</option>
                    <option value="Completed">Completed</option>
                </select>
                @error('status')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-5">
                <label for="message" class="block mb-2 text-sm font-medium text-gray-900">Your
                    message</label>
                <textarea id="message" name="description" rows="4"
                    class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                    placeholder="Leave a comment..."></textarea>
                @error('description')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>
            <button type="submit"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Add
                Task
            </button>
        </form>
        @if (session('status'))
            <div class="flex justify-center">
                <span class="bg-green-500 text-white p-2 rounded-md"> {{ session('status') }}</span>
            </div>
        @endif


    </div>
@endsection
