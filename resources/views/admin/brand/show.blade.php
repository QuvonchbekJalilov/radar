<x-layouts.admin>
    <div class="page-content">
        <x-navbar></x-navbar>

        <div class="px-3">
            <!-- Start Content -->
            <div class="container-fluid">

                <!-- Page Title -->
                <div class="py-3 py-lg-4">
                    <div class="row">
                        <div class="col-lg-6">
                            <h4 class="page-title mb-0">Brand Ma'lumotlari</h4>
                        </div>
                        <div class="col-lg-6">
                            <div class="d-none d-lg-block">
                                <ol class="breadcrumb m-0 float-end">
                                    <li class="breadcrumb-item"><a href="{{ route('index') }}">Asosiy Sahifa</a></li>
                                    <li class="breadcrumb-item"><a href="{{ route('brands.index') }}">Brandlar</a></li>
                                    <li class="breadcrumb-item active">Brand Ma'lumotlari</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Page Title -->

                <!-- Brand Details -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row mb-4 align-items-center">
                                    <div class="col-lg-2 text-center">
                                        <label for="name_uz" class="fw-semibold">Nomi UZ:</label>
                                    </div>
                                    <div class="col-lg-10">
                                        <div class="input-group">
                                            <div class="input-group-text"><i class="feather-type"></i></div>
                                            <input class="form-control" value="{{ $brand->title_uz }}" disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-4 align-items-center">
                                    <div class="col-lg-2 text-center">
                                        <label for="name_ru" class="fw-semibold">Nomi RU:</label>
                                    </div>
                                    <div class="col-lg-10">
                                        <div class="input-group">
                                            <div class="input-group-text"><i class="feather-type"></i></div>
                                            <input class="form-control" value="{{ $brand->title_ru }}" disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-4 align-items-center">
                                    <div class="col-lg-2 text-center">
                                        <label for="name_en" class="fw-semibold">Nomi EN:</label>
                                    </div>
                                    <div class="col-lg-10">
                                        <div class="input-group">
                                            <div class="input-group-text"><i class="feather-type"></i></div>
                                            <input class="form-control" value="{{ $brand->title_en }}" disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-4 align-items-center">
                                    <div class="col-lg-2 text-center">
                                        <label for="name_uz" class="fw-semibold">Nomi UZ:</label>
                                    </div>
                                    <div class="col-lg-10">
                                        <div class="input-group">
                                            <div class="input-group-text"><i class="feather-type"></i></div>
                                            <input class="form-control" value="{{ $brand->description_uz }}" disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-4 align-items-center">
                                    <div class="col-lg-2 text-center">
                                        <label for="name_ru" class="fw-semibold">Nomi RU:</label>
                                    </div>
                                    <div class="col-lg-10">
                                        <div class="input-group">
                                            <div class="input-group-text"><i class="feather-type"></i></div>
                                            <input class="form-control" value="{{ $brand->description_ru }}" disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-4 align-items-center">
                                    <div class="col-lg-2 text-center">
                                        <label for="name_en" class="fw-semibold">Nomi EN:</label>
                                    </div>
                                    <div class="col-lg-10">
                                        <div class="input-group">
                                            <div class="input-group-text"><i class="feather-type"></i></div>
                                            <input class="form-control" value="{{ $brand->description_en }}" disabled>
                                        </div>
                                    </div>
                                </div>
                                <img src="/storage/{{$brand->image}}" alt="">
                                <!-- Back Button -->
                                <div class="mt-3">
                                    <a href="{{ route('brands.index') }}" class="btn btn-primary">Orqaga</a>
                                </div>
                            </div> <!-- End card-body -->
                        </div> <!-- End card -->
                    </div> <!-- End col -->
                </div> <!-- End row -->

            </div> <!-- End container-fluid -->
        </div> <!-- End px-3 -->
    </div> <!-- End page-content -->
</x-layouts.admin>
