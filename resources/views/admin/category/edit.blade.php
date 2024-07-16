<x-layouts.admin>
    <div class="page-content">
        <x-navbar></x-navbar>

        <div class="px-3">
            <!-- Start Content-->
            <div class="container-fluid">
                <!-- start page title -->
                <div class="py-3 py-lg-4">
                    <div class="row">
                        <div class="col-lg-6">
                            <h4 class="page-title mb-0">Vizitka sayt</h4>
                        </div>
                        <div class="col-lg-6">
                            <div class="d-none d-lg-block">
                                <ol class="breadcrumb m-0 float-end">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Bosh sahifa</a></li>
                                    <li class="breadcrumb-item active">Veb-sayt xizmatlari</li>
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
                <!-- end page title -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <form action="{{ route('category.update', $category->id) }}" method="POST" class="needs-validation dropzone" enctype="multipart/form-data" novalidate id="myAwesomeDropzone" data-plugin="dropzone" data-previews-container="#file-previews" data-upload-preview-template="#uploadPreviewTemplate">
                                    @csrf
                                    @method('PUT')
                                    <div class="row mb-4 align-items-center lang-section lang-uz">
                                        <div class="col-lg-2 text-center">
                                            <label for="name_uz" class="fw-semibold">Nomi UZ: </label>
                                        </div>
                                        <div class="col-lg-10">
                                            <div class="input-group">
                                                <div class="input-group-text"><i class="feather-type"></i></div>
                                                <input class="form-control" placeholder="Nomi o'zbek tilida kiriting" name="name_uz" value="{{ $category->name_uz }}" required>
                                            </div>
                                            <div class="valid-feedback">
                                                Looks good!
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-4 align-items-center lang-section lang-ru d-none">
                                        <div class="col-lg-2 text-center">
                                            <label for="name_ru" class="fw-semibold">Nomi RU: </label>
                                        </div>
                                        <div class="col-lg-10">
                                            <div class="input-group">
                                                <div class="input-group-text"><i class="feather-type"></i></div>
                                                <input class="form-control" placeholder="Nomini rus tilida kiriting" name="name_ru" value="{{ $category->name_ru }}" required>
                                            </div>
                                            <div class="valid-feedback">
                                                Looks good!
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-4 align-items-center lang-section lang-en d-none">
                                        <div class="col-lg-2 text-center">
                                            <label for="name_en" class="fw-semibold">Nomi EN: </label>
                                        </div>
                                        <div class="col-lg-10">
                                            <div class="input-group">
                                                <div class="input-group-text"><i class="feather-type"></i></div>
                                                <input class="form-control" placeholder="Nomini ingliz tilida kiriting" name="name_en" value="{{ $category->name_en }}" required>
                                            </div>
                                            <div class="valid-feedback">
                                                Looks good!
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-4 align-items-center">
                                        <div class="col-lg-2 text-center">
                                            <label for="image" class="fw-semibold">Image: </label>
                                        </div>
                                        <div class="col-lg-10">
                                            <div class="input-group">
                                                <div class="input-group-text"><i class="feather-image"></i></div>
                                                <input type="file" class="form-control" name="image" id="image" accept="image/*">
                                            </div>
                                            <div class="valid-feedback">
                                                Looks good!
                                            </div>
                                            @if ($category->image)
                                                <div class="mt-2">
                                                    <img src="{{ asset('storage/' . $category->image) }}" alt="Current Image" width="100">
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="mt-3">
                                        <button class="btn btn-primary me-4" type="submit">Saqlash</button>
                                        <a href="{{ route('category.index') }}" class="btn btn-danger" type="submit">Orqaga</a>
                                    </div>
                                </form>
                            </div> <!-- end card-body-->
                        </div> <!-- end card-->
                    </div> <!-- end col-->
                </div>
            </div> <!-- container -->
        </div> <!-- content -->
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
