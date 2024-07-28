{{-- resources/views/admin/discounts/index.blade.php --}}

<x-layouts.admin>
    <!-- Include jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <!-- DataTables CSS -->
    <link href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css" rel="stylesheet">

    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

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
                            <h4 class="page-title mb-0">Discounts</h4>
                        </div>
                        <div class="col-lg-6">
                            <div class="d-none d-lg-block">
                                <ol class="breadcrumb m-0 float-end">
                                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                                    <li class="breadcrumb-item active">Discounts</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End page title -->

                <!-- Button to add discount -->
                <a href="{{ route('discounts.create') }}" class="btn btn-primary">
                    <i class="feather-plus me-2"></i>
                    <span>Add Discount</span>
                </a>

                <!-- DataTable container -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <table id="basic-datatable" class="table dt-responsive nowrap w-100">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Product Name</th>
                                            <th>Name</th>
                                            <th>Percentage (%)</th>
                                            <th>Sum</th>
                                            <th>From</th>
                                            <th>To</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($discounts as $discount)
                                        <tr>
                                            <td>{{ $discount->id }}</td>
                                            <td>{{ $discount->product->name_uz }}</td>
                                            <td>{{ $discount->name }}</td>
                                            <td>{{ $discount->percentage }}</td>
                                            <td>{{ $discount->sum }}</td>
                                            <td>{{ $discount->from }}</td>
                                            <td>{{ $discount->to }}</td>
                                            <td>
                                                <a href="{{ route('discounts.edit', ['discount' => $discount->id]) }}" class="icon-container"><i class="mdi mdi-book-edit-outline fs-3"></i></a>
                                                <a href="{{ route('discounts.show', ['discount' => $discount->id]) }}" class="icon-container"><i class="mdi mdi-eye fs-3"></i></a>
                                                <form action="{{ route('discounts.destroy', ['discount' => $discount->id]) }}" method="POST" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this discount?')">
                                                    @csrf
                                                    @method("DELETE")
                                                    <button type="submit" style="border: none; background: none; cursor: pointer;" class="icon-container"><i class="mdi mdi-trash-can-outline fs-3" style="color: #346ee0;"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div> <!-- End card-body -->
                        </div> <!-- End card -->
                    </div><!-- End col -->
                </div><!-- End row -->
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

    <script>
        $(document).ready(function() {
            $('#basic-datatable').DataTable();
        });
    </script>

</x-layouts.admin>
