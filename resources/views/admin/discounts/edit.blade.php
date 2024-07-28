{{-- resources/views/admin/discounts/edit.blade.php --}}

<x-layouts.admin>
    <div class="page-content">
        <x-navbar></x-navbar>

        <div class="px-3">
            <div class="container-fluid">
                <!-- Start Page Title -->
                <div class="py-3 py-lg-4">
                    <div class="row">
                        <div class="col-lg-6">
                            <h4 class="page-title mb-0">Edit Discount</h4>
                        </div>
                        <div class="col-lg-6">
                            <ol class="breadcrumb m-0 float-end">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('discounts.index') }}">Discounts</a></li>
                                <li class="breadcrumb-item active">Edit</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <!-- End Page Title -->

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <form action="{{ route('discounts.update', $discount) }}" method="POST">
                                    @csrf
                                    @method('PUT')

                                    <!-- Product -->
                                    <div class="mb-3">
                                        <label for="product_id" class="form-label">Product</label>
                                        <select name="product_id" id="product_id" class="form-control" required>
                                            @foreach($products as $product)
                                            <option value="{{ $product->id }}" {{ $discount->product_id == $product->id ? 'selected' : '' }}>{{ $product->name_uz }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <!-- Discount Name -->
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Discount Name</label>
                                        <input type="text" name="name" class="form-control" id="name" value="{{ $discount->name }}" required>
                                    </div>

                                    <!-- Percentage -->
                                    <div class="mb-3">
                                        <label for="percentage" class="form-label">Percentage (%)</label>
                                        <input type="number" name="percentage" class="form-control" id="percentage" value="{{ $discount->percentage }}" min="0" max="100">
                                    </div>

                                    <!-- Sum -->
                                    <div class="mb-3">
                                        <label for="sum" class="form-label">Sum</label>
                                        <input type="number" name="sum" class="form-control" id="sum" value="{{ $discount->sum }}" min="0">
                                    </div>

                                    <!-- From Date -->
                                    <div class="mb-3">
                                        <label for="from" class="form-label">From Date</label>
                                        <input type="date" name="from" class="form-control" id="from" value="{{ $discount->from }}" required>
                                    </div>

                                    <!-- To Date -->
                                    <div class="mb-3">
                                        <label for="to" class="form-label">To Date</label>
                                        <input type="date" name="to" class="form-control" id="to" value="{{ $discount->to }}" required>
                                    </div>

                                    <!-- Buttons -->
                                    <button type="submit" class="btn btn-primary">Update</button>
                                    <a href="{{ route('discounts.index') }}" class="btn btn-secondary">Cancel</a>
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
