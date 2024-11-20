<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Nunito', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
        }
        .file-input {
            display: none;
        }
    </style>
</head>
<body style="background-color: #9aa1d7;" class="flex items-center justify-center min-h-screen">

    <div class="absolute top-4 left-4">
        <a href="{{ route('product.index') }}" 
           class="bg-[#000000] text-white px-4 py-2 rounded-lg shadow-md font-extrabold hover:bg-[#0000FF] hover:text-white transition duration-300">
            RETURN
        </a>
    </div>

    <br>

    <div class="max-w-md p-4 text-center mt-10">

        <div style="background-color: #543f88; width: 700px; margin-left: -150px;" class="rounded-lg shadow-lg p-6 mb-11">

            <h2 style="color: #FFFFFF;" class="text-2xl font-extrabold mb-4">EDIT PRODUCT: </h2>

            <!-- Error Display -->
            @if ($errors->any())
                <div class="mb-4 bg-red-500 text-white py-2 px-4 rounded-lg shadow-md">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('product.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Product Name -->
                <div class="mb-4">
                    <label for="product_name" style="color:#FFFFFF;" class="block text-left font-extrabold">PRODUCT NAME: </label> 
                    <input type="text" id="product_name" name="product_name" 
                           class="w-full px-4 py-2 rounded-lg border" style="border-color: #008080;" value="{{ old('product_name', $product->product_name) }}" required>
                </div>

                <!-- Product Image -->
                <div class="mb-4">
                    <label for="pic" style="color:#FFFFFF;" class="block text-left font-extrabold">PRODUCT IMAGE: </label>
                    <label for="pic" class="bg-[#000000] text-white px-4 py-2 rounded-lg cursor-pointer hover:bg-[#0000FF] font-extrabold">INSERT IMAGE</label>
                    <input type="file" id="pic" name="pic" class="file-input" onchange="previewImage(event)">
                </div>

                <!-- Current Image -->
                @if($product->pic)
                    <div class="mb-4" id="current-image" >
                        <img src="{{ asset($product->pic) }}" alt="Product Image" class="max-w-full max-h-64 object-cover mx-auto" id="image-preview">
                        <p class="text-sm text-[#FFFFFF] mt-2">CURRENT IMAGE: </p>
                    </div>
                @else
                    <div class="mb-4" id="current-image">
                        <p class="text-sm text-[#FFFFFF] mt-2">UNAVAILABLE!</p>
                    </div>
                @endif

                <!-- Description -->
                <div class="mb-4">
                    <label for="description" style="color: 	#FFFFFF;" class="block text-left font-extrabold">DESCRIPTION: </label>
                    <textarea id="description" name="description" 
                              class="w-full px-4 py-2 rounded-lg border" style="border-color: #008080;" rows="4" required>{{ old('description', $product->description) }}</textarea>
                </div>

                <!-- Product Price -->
                <div class="mb-4">
                    <label for="price" style="color: 	#FFFFFF;" class="block text-left font-extrabold">PRICE: </label>
                    <input type="number" id="price" name="price" 
                        class="w-full px-4 py-2 rounded-lg border" style="border-color: #008080;" value="{{ old('price', $product->price) }}" required step="0.01" min="0">
                </div>

                <!-- Update Product -->
                <div class="mb-4">
                    <button type="submit" class="bg-[#000000] text-white px-4 py-2 rounded-lg shadow hover:bg-[#0000FF] hover:text-white font-extrabold transition duration-300">
                        UPDATE
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function previewImage(event) {
            var reader = new FileReader();
            reader.onload = function() {
                var output = document.getElementById('image-preview');
                output.src = reader.result;  
            }
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
</body>
</html>
