{{-- resources/views/admin/categories/show.blade.php --}}

<x-layouts.admin>
    <div class="page-content">
        <x-navbar></x-navbar>

        <div class="px-3">
            <div class="container-fluid">
                <!-- Start Page Title -->
                <div class="py-3 py-lg-4">
                    <div class="row">
                        <div class="col-lg-6">
                            <h4 class="page-title mb-0">Kategoriya Ma'lumotlari</h4>
                        </div>
                        <div class="col-lg-6">
                            <ol class="breadcrumb m-0 float-end">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Bosh sahifa</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('category.index') }}">Kategoriyalar</a></li>
                                <li class="breadcrumb-item active">Ko'rish</li>
                            </ol>
                        </div>
                        <div class="col-lg-12">
                            <div class="d-none d-lg-block">
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
                                <div class="row mb-3 lang-section lang-uz">
                                    <div class="col-lg-2">
                                        <strong>Nomi (UZ):</strong>
                                    </div>
                                    <div class="col-lg-10">
                                        <p>{{ $category->name_uz }}</p>
                                    </div>
                                </div>

                                <div class="row mb-3 lang-section lang-ru d-none">
                                    <div class="col-lg-2">
                                        <strong>Nomi (RU):</strong>
                                    </div>
                                    <div class="col-lg-10">
                                        <p>{{ $category->name_ru }}</p>
                                    </div>
                                </div>

                                <div class="row mb-3 lang-section lang-en d-none">
                                    <div class="col-lg-2">
                                        <strong>Name (EN):</strong>
                                    </div>
                                    <div class="col-lg-10">
                                        <p>{{ $category->name_en }}</p>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-lg-2">
                                        <strong>Rasm:</strong>
                                    </div>
                                    <div class="col-lg-10">
                                        @if ($category->image)
                                            <img src="{{ asset('storage/' . $category->image) }}" alt="Category Image" class="img-thumbnail" width="150">
                                        @else
                                            <p>Rasm mavjud emas.</p>
                                        @endif
                                    </div>
                                </div>

                                

                                <a href="{{ route('category.index') }}" class="btn btn-secondary">Orqaga</a>
                                <a href="{{ route('category.edit', $category->id) }}" class="btn btn-primary">Tahrirlash</a>
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
