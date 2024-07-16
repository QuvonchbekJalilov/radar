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
                            <h4 class="page-title mb-0">{{ $product->name }}</h4>
                        </div>
                        <div class="col-lg-6">
                            <div class="d-none d-lg-block">
                                <ol class="breadcrumb m-0 float-end">
                                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                                    <li class="breadcrumb-item"><a href="{{ route('product.index') }}">Products</a></li>
                                    <li class="breadcrumb-item active">{{ $product->name }}</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End page title -->

                <!-- Product details -->
                <div class="row">
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Basic Details</h5>

                                <p><strong>Category:</strong> {{ $product->category->name_uz }}</p>

                                <div class="mb-3">
                                    <h6><strong>Brand:</strong></h6>
                                    <p>
                                        <strong>Uzbek:</strong> {{ $product->brand_uz }}<br>
                                        <strong>Russian:</strong> {{ $product->brand_ru }}<br>
                                        <strong>English:</strong> {{ $product->brand_en }}
                                    </p>
                                </div>

                                <div class="mb-3">
                                    <h6><strong>Names:</strong></h6>
                                    <p>
                                        <strong>Uzbek:</strong> {{ $product->name_uz }}<br>
                                        <strong>Russian:</strong> {{ $product->name_ru }}<br>
                                        <strong>English:</strong> {{ $product->name_en }}
                                    </p>
                                </div>

                                <div class="mb-3">
                                    <h6><strong>Main Image:</strong></h6>
                                    <img src="{{ asset('storage/' . $product->image) }}" alt="Main Image" style="max-width: 100%;">
                                </div>

                                <div class="mb-3">
                                    <h6><strong>Gallery Images:</strong></h6>
                                    @foreach ($product->galleries as $image)
                                        <img src="{{ asset('storage/' . $image->image) }}" alt="Gallery Image" style="max-width: 100px; margin-right: 10px;">
                                    @endforeach
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Additional Details</h5>

                                <div class="mb-3">
                                    <h6><strong>Descriptions:</strong></h6>
                                    <p>
                                        <strong>Uzbek:</strong> {{ $product->description_uz }}<br>
                                        <strong>Russian:</strong> {{ $product->description_ru }}<br>
                                        <strong>English:</strong> {{ $product->description_en }}
                                    </p>
                                </div>

                                <p><strong>Price:</strong> {{ $product->price }}</p>
                                <p><strong>Stock:</strong> {{ $product->stock }}</p>

                                <p><strong>Status:</strong> {{ ucfirst($product->status) }}</p>

                                <div class="mb-3">
                                    <h6><strong>Specifications:</strong></h6>
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Attribute Name</th>
                                                <th>Attribute Value</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($product->specifications as $specification)
                                                <tr>
                                                    <td>{{ $specification->attribute_name }}</td>
                                                    <td>{{ $specification->attribute_value }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                <a href="{{ route('product.edit', $product->id) }}" class="btn btn-primary">Edit Product</a>
                                <a href="{{ route('product.index') }}" class="btn btn-secondary">Back to Products</a>

                            </div>
                        </div>
                    </div>
                </div>
                <!-- End product details -->

            </div> <!-- End container -->
        </div> <!-- End px-3 -->

        <!-- Footer -->
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
                        <div class="d-none d-md-flex gap-4 align-item-center justify-content-md-end">
                            <p class="mb-0">Design & Develop by <a href="https://myrathemes.com/" target="_blank">MyraStudio</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </footer> <!-- End footer -->

    </div> <!-- End page-content -->
</x-layouts.admin>
