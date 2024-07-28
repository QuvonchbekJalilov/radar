{{-- resources/views/admin/banner/edit.blade.php --}}

<x-layouts.admin>
    <div class="page-content">
        <x-navbar></x-navbar>

        <div class="px-3">
            <div class="container-fluid">
                <!-- Start Page Title -->
                <div class="py-3 py-lg-4">
                    <div class="row">
                        <div class="col-lg-6">
                            <h4 class="page-title mb-0">Banner Tahrirlash</h4>
                        </div>
                        <div class="col-lg-6">
                            <ol class="breadcrumb m-0 float-end">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Bosh sahifa</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('banners.index') }}">Bannerlar</a></li>
                                <li class="breadcrumb-item active">Tahrirlash</li>
                            </ol>
                        </div>
                        
                    </div>
                </div>
                <!-- End Page Title -->

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <form action="{{ route('banners.update', $banner->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')

                                    <!-- Category -->
                                    <div class="mb-3">
                                        <label for="category_id" class="form-label">Kategoriya</label>
                                        <select name="category_id" id="category_id" class="form-control" required>
                                            <option value="" selected disabled>Tanlang</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}" {{ $banner->category_id == $category->id ? 'selected' : '' }}>
                                                    {{ $category['name_'.App::getLocale()] }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <!-- Current Image -->
                                    <div class="mb-3">
                                        <label class="form-label">Joriy rasm</label><br>
                                        <img src="{{ asset('storage/' . $banner->image) }}" width="200px" alt="Banner Image">
                                    </div>

                                    <!-- New Image -->
                                    <div class="mb-3">
                                        <label for="image" class="form-label">Yangi rasm</label>
                                        <input type="file" name="image" class="form-control" id="image" accept="image/*">
                                    </div>

                                    <!-- Buttons -->
                                    <button type="submit" class="btn btn-primary">Saqlash</button>
                                    <a href="{{ route('banners.index') }}" class="btn btn-secondary">Bekor qilish</a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

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
                        <div class="d-none d-md-flex gap-4 align-items-center justify-content-md-end">
                            <p class="mb-0">Design & Develop by <a href="https://dora.uz/" target="_blank">Dora</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    
</x-layouts.admin>
