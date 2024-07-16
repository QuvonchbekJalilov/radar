{{-- resources/views/admin/brands/create.blade.php --}}

<x-layouts.admin>
    <div class="page-content">
        <x-navbar></x-navbar>

        <div class="px-3">
            <!-- Start Content -->
            <div class="container-fluid">
                <!-- Start Page Title -->
                <div class="py-3 py-lg-4">
                    <div class="row">
                        <div class="col-lg-6">
                            <h4 class="page-title mb-0">Create Brand</h4>
                        </div>
                        <div class="col-lg-6">
                            <div class="d-none d-lg-block">
                                <ol class="breadcrumb m-0 float-end">
                                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                                    <li class="breadcrumb-item active">Create Brand</li>
                                </ol>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="d-none d-lg-block mt-2">
                                <button class="btn" onClick="changeLang('uz')" style="background: #0c4a4a; color: white;">UZ</button>
                                <button class="btn" onClick="changeLang('ru')" style="background-color: #0c4a6e; color: white;">RU</button>
                                <button class="btn" onClick="changeLang('en')" style="background-color: #0c4a8e; color: white;">EN</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Page Title -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <form action="{{ route('brands.store') }}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                                    @csrf
                                    <div class="row mb-4 align-items-center lang-section lang-uz">
                                        <div class="col-lg-2 text-center">
                                            <label for="title_uz" class="fw-semibold">Title UZ:</label>
                                        </div>
                                        <div class="col-lg-10">
                                            <div class="input-group">
                                                <div class="input-group-text"><i class="feather-type"></i></div>
                                                <input type="text" class="form-control" id="title_uz" name="title_uz" placeholder="Enter title in Uzbek" required>
                                            </div>
                                            <div class="valid-feedback">
                                                Looks good!
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-4 align-items-center lang-section lang-ru d-none">
                                        <div class="col-lg-2 text-center">
                                            <label for="title_ru" class="fw-semibold">Title RU:</label>
                                        </div>
                                        <div class="col-lg-10">
                                            <div class="input-group">
                                                <div class="input-group-text"><i class="feather-type"></i></div>
                                                <input type="text" class="form-control" id="title_ru" name="title_ru" placeholder="Enter title in Russian" required>
                                            </div>
                                            <div class="valid-feedback">
                                                Looks good!
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-4 align-items-center lang-section lang-en d-none">
                                        <div class="col-lg-2 text-center">
                                            <label for="title_en" class="fw-semibold">Title EN:</label>
                                        </div>
                                        <div class="col-lg-10">
                                            <div class="input-group">
                                                <div class="input-group-text"><i class="feather-type"></i></div>
                                                <input type="text" class="form-control" id="title_en" name="title_en" placeholder="Enter title in English" required>
                                            </div>
                                            <div class="valid-feedback">
                                                Looks good!
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-4 align-items-center lang-section lang-uz">
                                        <div class="col-lg-2 text-center">
                                            <label for="description_uz" class="fw-semibold">Description UZ:</label>
                                        </div>
                                        <div class="col-lg-10">
                                            <div class="input-group">
                                                <div class="input-group-text"><i class="feather-align-left"></i></div>
                                                <textarea class="form-control" id="description_uz" name="description_uz" placeholder="Enter description in Uzbek" rows="4"></textarea>
                                            </div>
                                            <div class="valid-feedback">
                                                Looks good!
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-4 align-items-center lang-section lang-ru d-none">
                                        <div class="col-lg-2 text-center">
                                            <label for="description_ru" class="fw-semibold">Description RU:</label>
                                        </div>
                                        <div class="col-lg-10">
                                            <div class="input-group">
                                                <div class="input-group-text"><i class="feather-align-left"></i></div>
                                                <textarea class="form-control" id="description_ru" name="description_ru" placeholder="Enter description in Russian" rows="4"></textarea>
                                            </div>
                                            <div class="valid-feedback">
                                                Looks good!
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-4 align-items-center lang-section lang-en d-none">
                                        <div class="col-lg-2 text-center">
                                            <label for="description_en" class="fw-semibold">Description EN:</label>
                                        </div>
                                        <div class="col-lg-10">
                                            <div class="input-group">
                                                <div class="input-group-text"><i class="feather-align-left"></i></div>
                                                <textarea class="form-control" id="description_en" name="description_en" placeholder="Enter description in English" rows="4"></textarea>
                                            </div>
                                            <div class="valid-feedback">
                                                Looks good!
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-4 align-items-center">
                                        <div class="col-lg-2 text-center">
                                            <label for="image" class="fw-semibold">Image:</label>
                                        </div>
                                        <div class="col-lg-10">
                                            <div class="input-group">
                                                <div class="input-group-text"><i class="feather-image"></i></div>
                                                <input type="file" class="form-control" id="image" name="image" accept="image/*" required>
                                            </div>
                                            <div class="valid-feedback">
                                                Looks good!
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-3">
                                        <button type="submit" class="btn btn-primary me-4">Save</button>
                                        <a href="{{ route('brands.index') }}" class="btn btn-danger">Back</a>
                                    </div>
                                </form>
                            </div> <!-- End card-body -->
                        </div> <!-- End card -->
                    </div> <!-- End col-lg-12 -->
                </div> <!-- End row -->
            </div> <!-- End container-fluid -->
        </div> <!-- End px-3 -->
    </div> <!-- End page-content -->

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
