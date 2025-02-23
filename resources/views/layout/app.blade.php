<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
    <title>Food Management</title>
</head>
<body>



@include('layout.header')
    <!-- content se duoc hien thi o day  -->
     <div class="min-h-screen max-w-7xl mx-auto">
       @yield('content')
     </div>

@include('layout.footer')



</body>
</html>
