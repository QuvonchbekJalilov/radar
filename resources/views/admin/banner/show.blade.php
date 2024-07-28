{{-- resources/views/admin/banner/show.blade.php --}}

<x-layouts.admin>
    <div class="page-content">
        <x-navbar></x-navbar>

        <div class="px-3">
            <div class="container-fluid">
                <!-- Start Page Title -->
                <div class="py-3 py-lg-4">
                    <div class="row">
                        <div class="col-lg-6">
                            <h4 class="page-title mb-0">Banner Tafsilotlari</h4>
                        </div>
                        <div class="col-lg-6">
                            <ol class="breadcrumb m-0 float-end">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Bosh sahifa</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('banners.index') }}">Bannerlar</a></li>
                                <li class="breadcrumb-item active">Tafsilotlari</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <!-- End Page Title -->

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <!-- Display Banner Details -->
                                <div class="mb-3">
                                    <h5 class="card-title">Kategoriya: {{ $banner->category['name_'.App::getLocale()] }}</h5>
                                </div>

                                <div class="mb-3">
                                    <h5 class="card-title">Rasm</h5>
                                    <img src="{{ asset('storage/' . $banner->image) }}" width="400px" alt="Banner Image">
                                </div>

                                <!-- Back Button -->
                                <a href="{{ route('banners.index') }}" class="btn btn-secondary">Orqaga</a>
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
