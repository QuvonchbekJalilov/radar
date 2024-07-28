{{-- resources/views/admin/discounts/show.blade.php --}}

<x-layouts.admin>
    <div class="page-content">
        <x-navbar></x-navbar>

        <div class="px-3">
            <div class="container-fluid">
                <!-- Start Page Title -->
                <div class="py-3 py-lg-4">
                    <div class="row">
                        <div class="col-lg-6">
                            <h4 class="page-title mb-0">Discount Details</h4>
                        </div>
                        <div class="col-lg-6">
                            <ol class="breadcrumb m-0 float-end">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('discounts.index') }}">Discounts</a></li>
                                <li class="breadcrumb-item active">Details</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <!-- End Page Title -->

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <!-- Discount Details -->
                                <h5 class="card-title">Discount Information</h5>
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <tbody>
                                            <tr>
                                                <th scope="row">ID</th>
                                                <td>{{ $discount->id }}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Product</th>
                                                <td>{{ $discount->product->name }}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Discount Name</th>
                                                <td>{{ $discount->name }}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Percentage</th>
                                                <td>{{ $discount->percentage }}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Sum</th>
                                                <td>{{ $discount->sum }}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">From</th>
                                                <td>{{ $discount->from }}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">To</th>
                                                <td>{{ $discount->to }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <!-- Action Buttons -->
                                <a href="{{ route('discounts.edit', $discount) }}" class="btn btn-primary">Edit</a>
                                <form action="{{ route('discounts.destroy', $discount) }}" method="POST" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this discount?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                                <a href="{{ route('discounts.index') }}" class="btn btn-secondary">Back to List</a>
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
