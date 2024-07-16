<?php 
$lang = App::getLocale();
?>
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
                            <h4 class="page-title mb-0">Veb-sayt xizmatlari</h4>
                        </div>
                        <div class="col-lg-6">
                            <div class="d-none d-lg-block">
                                <ol class="breadcrumb m-0 float-end">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Bosh sahifa</a></li>
                                    <li class="breadcrumb-item active">Xizmatlar</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End page title -->

                <!-- Button to add category -->
                <a href="{{ route('category.create') }}" class="btn btn-primary">
                    <i class="feather-plus me-2"></i>
                    <span>Kategoriya qo'shish</span>
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
                                            <th>{{ __('main.name') }}</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
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

    <!-- Initialize DataTables -->
    <script>
        jQuery.noConflict();
        jQuery(document).ready(function($) {
            $('#basic-datatable').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": {
                    "url": "{{ route('categories.data') }}",
                    "data": function(d) {
                        d.lang = "{{ $lang }}";
                    }
                },
                "columns": [
                    { "data": "id" },
                    { "data": "name" },
                    {
                        "data": "actions",
                        "orderable": false,
                        "searchable": false
                    }
                ],
                "responsive": true
            });
        });
    </script>
</x-layouts.admin>
