<x-layouts.admin>
    <!-- Page content -->
    <div class="page-content">
        <!-- Navbar and other content -->
        <x-navbar></x-navbar>

        <div class="px-3">
            <div class="container-fluid">
                <!-- Page title and breadcrumb -->
                <div class="py-3 py-lg-4">
                    <div class="row">
                        <div class="col-lg-6">
                            <h4 class="page-title mb-0">Create New Product</h4>
                        </div>
                        <div class="col-lg-6">
                            <div class="d-none d-lg-block">
                                <ol class="breadcrumb m-0 float-end">
                                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                                    <li class="breadcrumb-item"><a href="{{ route('product.index') }}">Products</a></li>
                                    <li class="breadcrumb-item active">Create Product</li>
                                </ol>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="d-none d-lg-block">
                                <ol class="breadcrumb m-0 float-end">
                                    <button class="btn" onClick="changeLang('uz')" style="background: #0c4a4a ; color: white;">UZ</button>
                                    <button class="btn" onClick="changeLang('ru')" style="background-color: #0c4a6e; color: white;">RU</button>
                                    <button class="btn" onClick="changeLang('en')" style="background-color: #0c4a8e;color: white;">EN</button>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End page title -->

                <!-- Product form -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data" id="productForm">
                                    @csrf

                                    <!-- Category -->
                                    <div class="mb-3">
                                        <label for="category_id" class="form-label">Category</label>
                                        <select name="category_id" id="category_id" class="form-select @error('category_id') is-invalid @enderror" required>
                                            <option value="">Select Category</option>
                                            @foreach ($categories as $category)
                                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                                {{ $category->name_uz }}
                                            </option>
                                            @endforeach
                                        </select>
                                        @error('category_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="brand_id" class="form-label">Brand</label>
                                        <select name="brand_id" id="brand_id" class="form-select @error('brand_id') is-invalid @enderror" required>
                                            <option value="">Select Brand</option>
                                            @foreach ($brands as $category)
                                            <option value="{{ $category->id }}" {{ old('brand_id') == $category->id ? 'selected' : '' }}>
                                                {{ $category->title_uz }}
                                            </option>
                                            @endforeach
                                        </select>
                                        @error('brand_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    

                                    <!-- Product Names -->
                                    <div class="mb-3 lang-section lang-uz">
                                        <label for="name_uz" class="form-label">Product Name (Uzbek)</label>
                                        <input type="text" name="name_uz" id="name_uz" class="form-control @error('name_uz') is-invalid @enderror" value="{{ old('name_uz') }}" required>
                                        @error('name_uz')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3 lang-section lang-ru d-none">
                                        <label for="name_ru" class="form-label">Product Name (Russian)</label>
                                        <input type="text" name="name_ru" id="name_ru" class="form-control @error('name_ru') is-invalid @enderror" value="{{ old('name_ru') }}" required>
                                        @error('name_ru')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3 lang-section lang-en d-none">
                                        <label for="name_en" class="form-label">Product Name (English)</label>
                                        <input type="text" name="name_en" id="name_en" class="form-control @error('name_en') is-invalid @enderror" value="{{ old('name_en') }}" required>
                                        @error('name_en')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Descriptions -->
                                    <div class="mb-3 lang-section lang-uz">
                                        <label for="description_uz" class="form-label">Description (Uzbek)</label>
                                        <textarea name="description_uz" id="description_uz" class="form-control @error('description_uz') is-invalid @enderror" rows="3" required>{{ old('description_uz') }}</textarea>
                                        @error('description_uz')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3 lang-section lang-ru d-none">
                                        <label for="description_ru" class="form-label">Description (Russian)</label>
                                        <textarea name="description_ru" id="description_ru" class="form-control @error('description_ru') is-invalid @enderror" rows="3" required>{{ old('description_ru') }}</textarea>
                                        @error('description_ru')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3 lang-section lang-en d-none">
                                        <label for="description_en" class="form-label">Description (English)</label>
                                        <textarea name="description_en" id="description_en" class="form-control @error('description_en') is-invalid @enderror" rows="3" required>{{ old('description_en') }}</textarea>
                                        @error('description_en')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>


                                    <!-- Price -->
                                    <div class="mb-3">
                                        <label for="price" class="form-label">Price</label>
                                        <input type="number" name="price" id="price" class="form-control @error('price') is-invalid @enderror" value="{{ old('price') }}" step="0.01" required>
                                        @error('price')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Stock -->
                                    <div class="mb-3">
                                        <label for="stock" class="form-label">Stock</label>
                                        <input type="number" name="stock" id="stock" class="form-control @error('stock') is-invalid @enderror" value="{{ old('stock') }}" required>
                                        @error('stock')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Image -->
                                    <div class="mb-3">
                                        <label for="image" class="form-label">Main Image</label>
                                        <input type="file" name="image" id="image" class="form-control @error('image') is-invalid @enderror" onchange="previewImage(event)">
                                        @error('image')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <div class="mt-2" id="imagePreview"></div>
                                    </div>

                                    <!-- Gallery Images -->
                                    <div class="mb-3">
                                        <label for="gallery_images" class="form-label">Gallery Images</label>
                                        <input type="file" name="gallery_images[]" id="gallery_images" class="form-control @error('gallery_images.*') is-invalid @enderror" multiple onchange="previewGalleryImages(event)">
                                        @error('gallery_images.*')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <div class="mt-2" id="galleryPreview"></div>
                                    </div>

                                    <!-- Status -->
                                    <div class="mb-3">
                                        <label for="status" class="form-label">Status</label>
                                        <select name="status" id="status" class="form-select @error('status') is-invalid @enderror" required>
                                            <option value="">Select Status</option>
                                            <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                                            <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                        </select>
                                        @error('status')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Specifications -->
                                    <div class="mb-3">
                                        <label for="specifications" class="form-label">Specifications</label>
                                        <table class="table" id="specifications">
                                            <thead>
                                                <tr>
                                                    <th>Attribute Name</th>
                                                    <th>Attribute Value</th>
                                                    <th>Action</th> <!-- Added column for delete button -->
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td><input type="text" name="specifications[0][attribute_name]" class="form-control"></td>
                                                    <td><input type="text" name="specifications[0][attribute_value]" class="form-control"></td>
                                                    <td>
                                                        <button type="button" class="btn btn-danger btn-sm delete-row">Delete</button>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <button type="button" class="btn btn-primary mt-3" id="addSpecification">Add Specification</button>
                                    </div>

                                    <!-- Submit Button -->
                                    <button type="submit" class="btn btn-primary">Saqlash</button>
                                    <a href="{{ route('product.index') }}" class="btn btn-secondary">Bekor qilish</a>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End product form -->

            </div> <!-- End container -->
        </div> <!-- End px-3 -->

        <!-- Footer -->
        <footer class="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <div>
                            <script>
                                document.write(new Date().getFullYear())
                            </script> © Dashtrap
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="d-none d-md-flex gap-4 align-item-center justify-content-md-end">
                            <p class="mb-0">Design & Develop by <a href="https://myrathemes.com/" target="_blank">MyraStudio</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </footer> <!-- End footer -->

    </div> <!-- End page-content -->
    <script>
        // Function to preview main image
        function previewImage(event) {
            var image = document.getElementById('imagePreview');
            image.innerHTML = ''; // Clear previous preview

            var file = event.target.files[0];
            var reader = new FileReader();

            reader.onload = function() {
                var imgElement = document.createElement('img');
                imgElement.src = reader.result;
                imgElement.style.maxWidth = '100px'; // Limit width to 100px for preview
                image.appendChild(imgElement);
            }

            if (file) {
                reader.readAsDataURL(file); // Read the image file as a data URL
            }
        }

        // Function to preview gallery images
        function previewGalleryImages(event) {
            var gallery = document.getElementById('galleryPreview');
            gallery.innerHTML = ''; // Clear previous preview

            var files = event.target.files;

            for (var i = 0; i < files.length; i++) {
                var file = files[i];
                var reader = new FileReader();

                reader.onload = (function(file) {
                    return function(e) {
                        var imgElement = document.createElement('img');
                        imgElement.src = e.target.result;
                        imgElement.style.maxWidth = '100px'; // Limit width to 100px for preview

                        // Create remove button
                        var removeButton = document.createElement('button');
                        removeButton.type = 'button';
                        removeButton.classList.add('btn', 'btn-danger', 'btn-sm', 'remove-image');
                        removeButton.textContent = 'Remove';

                        // Handle remove button click
                        removeButton.addEventListener('click', function() {
                            imgElement.remove(); // Remove the image preview
                            removeButton.remove(); // Remove the remove button
                            updateGalleryInput(); // Update form data
                        });

                        // Append image and remove button to preview div
                        var previewItem = document.createElement('div');
                        previewItem.classList.add('mb-2'); // Optional styling for spacing
                        previewItem.appendChild(imgElement);
                        previewItem.appendChild(removeButton);
                        gallery.appendChild(previewItem);
                    };
                })(file);

                if (file) {
                    reader.readAsDataURL(file); // Read the image file as a data URL
                }
            }

            // Function to update hidden input for gallery images
            function updateGalleryInput() {
                var galleryInput = document.getElementById('gallery_images');
                var filesArray = Array.from(event.target.files);

                // Filter out removed images
                filesArray = filesArray.filter(function(file) {
                    return !gallery.contains(document.querySelector(`img[src="${file}"]`));
                });

                // Update gallery input value with remaining images
                galleryInput.value = filesArray.map(function(file) {
                    return file.name;
                });
            }
        }


        document.addEventListener('DOMContentLoaded', function() {
            var specificationIndex = 1;
            var specificationsTable = document.getElementById('specifications');
            var addSpecificationButton = document.getElementById('addSpecification');

            // Add new row for specification
            addSpecificationButton.addEventListener('click', function() {
                var newRow = specificationsTable.insertRow();
                newRow.innerHTML = `
                <td><input type="text" name="specifications[${specificationIndex}][attribute_name]" class="form-control"></td>
                <td><input type="text" name="specifications[${specificationIndex}][attribute_value]" class="form-control"></td>
                <td>
                    <button type="button" class="btn btn-danger btn-sm delete-row">Delete</button>
                </td>
            `;
                specificationIndex++;
            });

            // Delete row for specification
            specificationsTable.addEventListener('click', function(event) {
                if (event.target.classList.contains('delete-row')) {
                    var row = event.target.closest('tr');
                    row.remove();
                }
            });
        });
    </script>

    <script>
        function changeLang(lang) {
            document.querySelectorAll('.lang-section').forEach(function(section) {
                section.classList.add('d-none');
            });
            document.querySelectorAll('.lang-' + lang).forEach(function(section) {
                section.classList.remove('d-none');
            });
        }
    </script>
</x-layouts.admin>