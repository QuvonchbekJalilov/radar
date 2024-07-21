{{-- resources/views/admin/brands/create.blade.php --}}

<x-layouts.admin>
    <div class="page-content">
        <x-navbar></x-navbar>

        <div class="px-3">
            <div class="container-fluid">
                <!-- Start Page Title -->
                <div class="py-3 py-lg-4">
                    <div class="row">
                        <div class="col-lg-6">
                            <h4 class="page-title mb-0">Brand Qo'shish</h4>
                        </div>
                        <div class="col-lg-6">
                            <ol class="breadcrumb m-0 float-end">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Bosh sahifa</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('brands.index') }}">Brendlar</a></li>
                                <li class="breadcrumb-item active">Qo'shish</li>
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
                                <form action="{{ route('brands.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf

                                    <!-- Title UZ -->
                                    <div class="mb-3 lang-section lang-uz">
                                        <label for="title_uz" class="form-label">Sarlavha (UZ)</label>
                                        <input type="text" name="title_uz" class="form-control" id="title_uz" placeholder="Sarlavhani kiriting" required>
                                    </div>

                                    <!-- Title RU -->
                                    <div class="mb-3 lang-section lang-ru d-none">
                                        <label for="title_ru" class="form-label">Sarlavha (RU)</label>
                                        <input type="text" name="title_ru" class="form-control" id="title_ru" placeholder="Введите заголовок" required>
                                    </div>

                                    <!-- Title EN -->
                                    <div class="mb-3 lang-section lang-en d-none">
                                        <label for="title_en" class="form-label">Title (EN)</label>
                                        <input type="text" name="title_en" class="form-control" id="title_en" placeholder="Enter title" required>
                                    </div>

                                    <!-- Description UZ -->
                                    <div class="mb-3 lang-section lang-uz">
                                        <label for="description_uz" class="form-label">Tavsif (UZ)</label>
                                        <textarea name="description_uz" class="form-control" id="description_uz" rows="4" placeholder="Tavsifni kiriting"></textarea>
                                    </div>

                                    <!-- Description RU -->
                                    <div class="mb-3 lang-section lang-ru d-none">
                                        <label for="description_ru" class="form-label">Tavsif (RU)</label>
                                        <textarea name="description_ru" class="form-control" id="description_ru" rows="4" placeholder="Введите описание"></textarea>
                                    </div>

                                    <!-- Description EN -->
                                    <div class="mb-3 lang-section lang-en d-none">
                                        <label for="description_en" class="form-label">Description (EN)</label>
                                        <textarea name="description_en" class="form-control" id="description_en" rows="4" placeholder="Enter description"></textarea>
                                    </div>

                                    <!-- Image -->
                                    <div class="mb-3">
                                        <label for="image" class="form-label">Rasm</label>
                                        <input type="file" name="image" class="form-control" id="image" accept="image/*" required>
                                    </div>

                                    <!-- Buttons -->
                                    <button type="submit" class="btn btn-primary">Saqlash</button>
                                    <a href="{{ route('brands.index') }}" class="btn btn-secondary">Bekor qilish</a>
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
