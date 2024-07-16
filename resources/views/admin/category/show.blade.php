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
                            <h4 class="page-title mb-0">Kategoriya ma'lumotlari</h4>
                        </div>
                        <div class="col-lg-6">
                            <div class="d-none d-lg-block">
                                <ol class="breadcrumb m-0 float-end">
                                    <li class="breadcrumb-item"><a href="{{ route('index') }}">Asosiy sahifa</a></li>
                                    <li class="breadcrumb-item"><a href="{{ route('category.index') }}">Kategoriyalar</a></li>
                                    <li class="breadcrumb-item active">Kategoriya ma'lumotlari</li>
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
                                <div class="row mb-4 align-items-center">
                                    <div class="col-lg-2 text-center">
                                        <label for="addressInput" class="fw-semibold">Nomi UZ:</label>
                                    </div>
                                    <div class="col-lg-10">
                                        <div class="input-group">
                                            <div class="input-group-text"><i class="feather-type"></i></div>
                                            <input class="form-control" cols="20" rows="2" value="{{ $category->name_uz }}" disabled></input>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-4 align-items-center">
                                    <div class="col-lg-2 text-center">
                                        <label for="addressInput" class="fw-semibold">Nomi RU:</label>
                                    </div>
                                    <div class="col-lg-10">
                                        <div class="input-group">
                                            <div class="input-group-text"><i class="feather-type"></i></div>
                                            <input class="form-control" cols="20" rows="2" value="{{ $category->name_ru }}" disabled></input>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-4 align-items-center">
                                    <div class="col-lg-2 text-center">
                                        <label for="addressInput" class="fw-semibold">Nomi EN:</label>
                                    </div>
                                    <div class="col-lg-10">
                                        <div class="input-group">
                                            <div class="input-group-text"><i class="feather-type"></i></div>
                                            <input class="form-control" cols="20" rows="2" value="{{ $category->name_en }}" disabled></input>
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-3">
                                    <a href="{{ route('category.index') }}" class="btn btn-primary">Orqaga</a>
                                </div>
                            </div> <!-- end card-body-->
                        </div> <!-- end card-->
                    </div> <!-- end col-->
                </div> <!-- end row -->

            </div> <!-- container-fluid -->

        </div> <!-- px-3 -->

    </div> <!-- page-content -->
</x-layouts.admin>
