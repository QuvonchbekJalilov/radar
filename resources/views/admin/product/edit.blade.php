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
                            <h4 class="page-title mb-0">Edit Product</h4>
                        </div>
                        <div class="col-lg-6">
                            <div class="d-none d-lg-block">
                                <ol class="breadcrumb m-0 float-end">
                                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                                    <li class="breadcrumb-item"><a href="{{ route('product.index') }}">Products</a></li>
                                    <li class="breadcrumb-item active">Edit Product</li>
                                </ol>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="d-none d-lg-block">
                                <ol class="breadcrumb m-0 float-end">
                                    <button class="btn" onClick="changeLang('uz')" style="background: #0c4a4a; color: white;">UZ</button>
                                    <button class="btn" onClick="changeLang('ru')" style="background-color: #0c4a6e; color: white;">RU</button>
                                    <button class="btn" onClick="changeLang('en')" style="background-color: #0c4a8e; color: white;">EN</button>
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
                                <form action="{{ route('product.update', $product->id) }}" method="POST" enctype="multipart/form-data" id="productForm">
                                    @csrf
                                    @method('PUT')

                                    <!-- Category -->
                                    <div class="mb-3">
                                        <label for="category_id" class="form-label">Category</label>
                                        <select name="category_id" id="category_id" class="form-select @error('category_id') is-invalid @enderror" required>
                                            <option value="">Select Category</option>
                                            @foreach ($categories as $category)
                                            <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>
                                                {{ $category->name_uz }}
                                            </option>
                                            @endforeach
                                        </select>
                                        @error('category_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Brand -->
                                    <div class="mb-3">
                                        <label for="brand_id" class="form-label">Brand</label>
                                        <select name="brand_id" id="brand_id" class="form-select @error('brand_id') is-invalid @enderror" required>
                                            <option value="">Select Brand</option>
                                            @foreach ($brands as $brand)
                                            <option value="{{ $brand->id }}" {{ $product->brand_id == $brand->id ? 'selected' : '' }}>
                                                {{ $brand->title_uz }}
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
                                        <input type="text" name="name_uz" id="name_uz" class="form-control @error('name_uz') is-invalid @enderror" value="{{ old('name_uz', $product->name_uz) }}" required>
                                        @error('name_uz')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3 lang-section lang-ru d-none">
                                        <label for="name_ru" class="form-label">Product Name (Russian)</label>
                                        <input type="text" name="name_ru" id="name_ru" class="form-control @error('name_ru') is-invalid @enderror" value="{{ old('name_ru', $product->name_ru) }}" required>
                                        @error('name_ru')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3 lang-section lang-en d-none">
                                        <label for="name_en" class="form-label">Product Name (English)</label>
                                        <input type="text" name="name_en" id="name_en" class="form-control @error('name_en') is-invalid @enderror" value="{{ old('name_en', $product->name_en) }}" required>
                                        @error('name_en')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Descriptions -->
                                    <div class="mb-3 lang-section lang-uz">
                                        <label for="description_uz" class="form-label">Description (Uzbek)</label>
                                        <textarea name="description_uz" id="description_uz" class="form-control @error('description_uz') is-invalid @enderror" rows="3" required>{{ old('description_uz', $product->description_uz) }}</textarea>
                                        @error('description_uz')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3 lang-section lang-ru d-none">
                                        <label for="description_ru" class="form-label">Description (Russian)</label>
                                        <textarea name="description_ru" id="description_ru" class="form-control @error('description_ru') is-invalid @enderror" rows="3" required>{{ old('description_ru', $product->description_ru) }}</textarea>
                                        @error('description_ru')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3 lang-section lang-en d-none">
                                        <label for="description_en" class="form-label">Description (English)</label>
                                        <textarea name="description_en" id="description_en" class="form-control @error('description_en') is-invalid @enderror" rows="3" required>{{ old('description_en', $product->description_en) }}</textarea>
                                        @error('description_en')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Price -->
                                    <div class="mb-3">
                                        <label for="price" class="form-label">Price</label>
                                        <input type="number" name="price" id="price" class="form-control @error('price') is-invalid @enderror" value="{{ old('price', $product->price) }}" step="0.01" required>
                                        @error('price')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Stock -->
                                    <div class="mb-3">
                                        <label for="stock" class="form-label">Stock</label>
                                        <input type="number" name="stock" id="stock" class="form-control @error('stock') is-invalid @enderror" value="{{ old('stock', $product->stock) }}" required>
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
                                        <div class="mt-2" id="imagePreview">
                                            @if ($product->image)
                                            <img src="{{ asset('storage/' . $product->image) }}" style="max-width: 100px;">
                                            @endif
                                        </div>
                                    </div>

                                    <!-- Gallery Images -->
                                    <div class="mb-3">
                                        <label for="gallery_images" class="form-label">Gallery Images</label>
                                        <input type="file" name="gallery_images[]" id="gallery_images" class="form-control @error('gallery_images.*') is-invalid @enderror" multiple onchange="previewGalleryImages(event)">
                                        @error('gallery_images.*')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <div class="mt-2" id="galleryPreview">
                                            @foreach ($product->galleries as $gallery)
                                            <div class="mb-2">
                                                <img src="{{ asset('storage/' . $gallery->image) }}" style="max-width: 100px;">
                                                <button type="button" class="btn btn-danger btn-sm" onclick="removeGalleryImage({{ $gallery->id }})">Remove</button>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>

                                    <!-- Specifications -->
                                    <div class="mb-3">
                                        <label for="specifications" class="form-label">Specifications</label>
                                        <div class="table-responsive">
                                            <table class="table table-bordered" id="specifications">
                                                <thead>
                                                    <tr>
                                                        <th>Attribute Name</th>
                                                        <th>Attribute Value</th>
                                                        <th>Action</th> <!-- Added column for delete button -->
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($product->specifications as $specification)
                                                    <tr>
                                                        <td><input type="text" name="specifications[{{ $loop->index }}][attribute_name]" class="form-control" value="{{ $specification->attribute_name }}"></td>
                                                        <td><input type="text" name="specifications[{{ $loop->index }}][attribute_value]" class="form-control" value="{{ $specification->attribute_value }}"></td>
                                                        <td>
                                                            <button type="button" class="btn btn-danger btn-sm delete-row">Remove</button>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        <button type="button" class="btn btn-primary mt-3" id="addSpecification">Add Specification</button>
                                    </div>

                                    <!-- Status -->
                                    <div class="mb-3">
                                        <label for="status" class="form-label">Status</label>
                                        <select name="status" id="status" class="form-select @error('status') is-invalid @enderror" required>
                                            <option value="active" {{ $product->status == 'active' ? 'selected' : '' }}>Active</option>
                                            <option value="inactive" {{ $product->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                        </select>
                                        @error('status')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Submit Button -->
                                    <button type="submit" class="btn btn-primary">Yangilash</button>
                                    <a href="{{ route('product.index') }}" class="btn btn-secondary">Bekor qilish</a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End product form -->

            </div>
        </div>
    </div>
    <!-- End page content -->

    <!-- JavaScript to handle dynamic field addition and image preview -->
    <script>
        function changeLang(lang) {
            document.querySelectorAll('.lang-section').forEach(section => section.classList.add('d-none'));
            document.querySelectorAll('.lang-' + lang).forEach(section => section.classList.remove('d-none'));
        }

        document.addEventListener('DOMContentLoaded', function() {
            var specificationIndex = {{ count($product->specifications) }};

            var specificationsTable = document.getElementById('specifications');
            var addSpecificationButton = document.getElementById('addSpecification');

            // Add new row for specification
            addSpecificationButton.addEventListener('click', function() {
                var newRow = specificationsTable.querySelector('tbody').insertRow();
                newRow.innerHTML = `
                    <td><input type="text" name="specifications[${specificationIndex}][attribute_name]" class="form-control" placeholder="Enter attribute name"></td>
                    <td><input type="text" name="specifications[${specificationIndex}][attribute_value]" class="form-control" placeholder="Enter attribute value"></td>
                    <td>
                        <button type="button" class="btn btn-danger btn-sm delete-row">Remove</button>
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

        function previewImage(event) {
            const reader = new FileReader();
            reader.onload = function() {
                const output = document.getElementById('imagePreview');
                output.innerHTML = `<img src="${reader.result}" style="max-width: 100px;">`;
            }
            reader.readAsDataURL(event.target.files[0]);
        }

        function previewGalleryImages(event) {
            const galleryPreview = document.getElementById('galleryPreview');
            galleryPreview.innerHTML = '';
            for (let i = 0; i < event.target.files.length; i++) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    galleryPreview.innerHTML += `<div class="mb-2">
                        <img src="${e.target.result}" style="max-width: 100px;">
                    </div>`;
                }
                reader.readAsDataURL(event.target.files[i]);
            }
        }

        function removeGalleryImage(id) {
            // Implement removal logic here, perhaps via AJAX
            console.log('Remove gallery image with ID:', id);
            // For example, send an AJAX request to delete the image on the server
        }
    </script>
</x-layouts.admin>
