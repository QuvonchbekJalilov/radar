{{-- resources/views/admin/brands/edit.blade.php --}}

<?php
$lang = App::getLocale();
?>

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
                            <h4 class="page-title mb-0">Edit Brand</h4>
                        </div>
                        <div class="col-lg-6">
                            <div class="d-none d-lg-block">
                                <ol class="breadcrumb m-0 float-end">
                                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                                    <li class="breadcrumb-item"><a href="{{ route('brands.index') }}">Brands</a></li>
                                    <li class="breadcrumb-item active">Edit Brand</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End page title -->

                <!-- Form to edit brand -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <form action="{{ route('brands.update', $brand->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="row mb-4 align-items-center lang-section lang-uz">
                                        <div class="col-lg-2 text-center">
                                            <label for="title_uz" class="fw-semibold">Title UZ: </label>
                                        </div>
                                        <div class="col-lg-10">
                                            <div class="input-group">
                                                <div class="input-group-text"><i class="feather-type"></i></div>
                                                <input type="text" class="form-control" placeholder="Enter title in Uzbek" name="title_uz" value="{{ old('title_uz', $brand->title_uz) }}" required>
                                            </div>
                                            <div class="valid-feedback">
                                                Looks good!
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-4 align-items-center lang-section lang-ru">
                                        <div class="col-lg-2 text-center">
                                            <label for="title_ru" class="fw-semibold">Title RU: </label>
                                        </div>
                                        <div class="col-lg-10">
                                            <div class="input-group">
                                                <div class="input-group-text"><i class="feather-type"></i></div>
                                                <input type="text" class="form-control" placeholder="Enter title in Russian" name="title_ru" value="{{ old('title_ru', $brand->title_ru) }}" required>
                                            </div>
                                            <div class="valid-feedback">
                                                Looks good!
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-4 align-items-center lang-section lang-en">
                                        <div class="col-lg-2 text-center">
                                            <label for="title_en" class="fw-semibold">Title EN: </label>
                                        </div>
                                        <div class="col-lg-10">
                                            <div class="input-group">
                                                <div class="input-group-text"><i class="feather-type"></i></div>
                                                <input type="text" class="form-control" placeholder="Enter title in English" name="title_en" value="{{ old('title_en', $brand->title_en) }}" required>
                                            </div>
                                            <div class="valid-feedback">
                                                Looks good!
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-3">
                                        <button class="btn btn-primary me-4" type="submit">Save</button>
                                        <a href="{{ route('brands.index') }}" class="btn btn-danger" type="button">Cancel</a>
                                    </div>
                                </form>
                            </div> <!-- End card-body -->
                        </div> <!-- End card -->
                    </div> <!-- End col -->
                </div> <!-- End row -->
            </div> <!-- End container -->
        </div> <!-- End px-3 -->

    </div> <!-- End page-content -->
</x-layouts.admin>
