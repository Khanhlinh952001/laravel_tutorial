@extends('layout.app')

@section('content')
<div class="container mx-auto px-4 sm:px-8">
    <!-- Alert Messages -->
    @if(session('success'))
    <div id="success-alert" class="fixed top-5 right-5 bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded shadow-lg transition-opacity duration-500 ease-in-out" role="alert">
        <p>{{ session('success') }}</p>
    </div>
    
    @endif

    @if(session('error'))
        <div id="error-alert" class="mb-4 bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded shadow-sm" role="alert">
            <p class="font-bold">Error!</p>
            <p>{{ session('error') }}</p>
        </div>
    @endif

    <!-- Header Section -->
    <div class="">
        <div class="flex justify-between items-center">
            <h2 class="text-2xl font-semibold leading-tight">Foods Menu</h2>
            <a href="foods/create" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-lg shadow-md transition duration-300 ease-in-out transform hover:-translate-y-1">
                <i class="fas fa-plus mr-2"></i>Add New Food
            </a>
        </div>
    </div>

    <!-- Foods Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach ($foods as $food)
        <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition duration-300">
            <div class="p-6">
                <img class="w-full h-48 object-cover" src="{{ asset('images/'. $food->image_path)}}" alt="{{$food->name}}">
                <div class="flex justify-between items-start">
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">{{$food->name}}</h3>
                    <span class="bg-green-100 text-green-800 text-sm font-medium px-2.5 py-0.5 rounded-full">
                        ${{$food->price}}
                    </span>
                </div>

                <p class="text-gray-600 mb-4">{{$food->description}}</p>

                <div class="flex justify-between items-center pt-4 border-t border-gray-200">
                    <div class="text-sm text-gray-600">
                        Stock: {{$food->count ?? 0}}
                    </div>
                    <div class="space-x-2">
                        <a href="foods/edit/{{$food->id}}"
                           class="inline-flex items-center px-3 py-1 bg-yellow-500 hover:bg-yellow-600 text-white text-sm font-medium rounded-md transition duration-300">
                            <i class="fas fa-edit mr-1"></i> Edit
                        </a>
                        <a href="foods/delete/{{$food->id}}"
                           class="inline-flex items-center px-3 py-1 bg-red-500 hover:bg-red-600 text-white text-sm font-medium rounded-md transition duration-300"
                           onclick="return confirm('Are you sure you want to delete this item?')">
                            <i class="fas fa-trash mr-1"></i> Delete
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const successAlert = document.getElementById('success-alert');
        const errorAlert = document.getElementById('error-alert');

        if(successAlert) {
            setTimeout(() => {
                successAlert.style.opacity = '0';
                setTimeout(() => successAlert.style.display = 'none', 300);
            }, 3000);
        }

        if(errorAlert) {
            setTimeout(() => {
                errorAlert.style.opacity = '0';
                setTimeout(() => errorAlert.style.display = 'none', 300);
            }, 3000);
        }
    });
</script>
@endsection
