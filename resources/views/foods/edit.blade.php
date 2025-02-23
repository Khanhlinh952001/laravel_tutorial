@extends('layout.app')

@section('content')
    <div class="min-h-screen bg-gray-100 py-6 flex flex-col justify-center sm:py-12">
        <div class="relative py-3 sm:max-w-xl sm:mx-auto">
            <div class="relative px-4 py-10 bg-white mx-8 md:mx-0 shadow rounded-3xl sm:p-10">
                <div class="max-w-md mx-auto">
                    <div class="flex items-center space-x-5">
                        <div class="block pl-2 font-semibold text-xl text-gray-700">
                            <h1 class="leading-relaxed">Edit Food Information</h1>
                        </div>
                    </div>

                    <form action="{{ route('foods.update', $food->id) }}" method="post" class="divide-y divide-gray-200" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="py-8 text-base leading-6 space-y-4 text-gray-700 sm:text-lg sm:leading-7">
                            <div class="flex flex-col">
                                <label for="name" class="leading-loose">Name</label>
                                <input type="text" id="name" name="name" value="{{$food->name}}" required
                                    class="px-4 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600">
                            </div>

                            <div class="flex flex-col">
                                <label for="price" class="leading-loose">Price</label>
                                <input type="text" id="price" name="price" value="{{$food->price}}" required
                                    class="px-4 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600">
                            </div>

                            <div class="flex flex-col">
                                <label for="count" class="leading-loose">Count</label>
                                <input type="number" id="count" name="count" value="{{$food->count}}" required
                                    class="px-4 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600">
                            </div>

                            <div class="flex flex-col">
                                <label for="description" class="leading-loose">Description</label>
                                <textarea id="description" name="description" required
                                    class="px-4 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600 h-32">{{$food->description}}</textarea>
                            </div>

                            <div class="flex flex-col">
                                <label for="image_path" class="leading-loose">Hình ảnh món ăn</label>
                                <input type="file" id="image_path" name="image_path"
                                    class="px-4 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600">
                                @if($food->image_path)
                                    <div class="mt-2">
                                        <img src="{{ asset('images/' . $food->image_path) }}" alt="Current food image" class="w-32 h-32 object-cover rounded-lg">
                                        <p class="text-sm text-gray-500 mt-1">Hình ảnh hiện tại</p>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="pt-4 flex items-center space-x-4">
                            <button type="submit"
                                class="bg-blue-500 flex justify-center items-center w-full text-white px-4 py-3 rounded-md focus:outline-none hover:bg-blue-600 transition duration-300 ease-in-out">
                                Update Food
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

