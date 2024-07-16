<!-- resources/views/admin/order/index.blade.php -->

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
                            <h4 class="page-title mb-0">Buyurtmalar</h4>
                        </div>
                        <div class="col-lg-6">
                            <div class="d-none d-lg-block">
                                <ol class="breadcrumb m-0 float-end">
                                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Bosh sahifa</a></li>
                                    <li class="breadcrumb-item active">Buyurtmalar</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End page title -->

                <!-- Button to add order -->
                <a href="{{ route('order.create') }}" class="btn btn-primary">
                    <i class="feather-plus me-2"></i>
                    <span>Buyurtma qo'shish</span>
                </a>

                <!-- DataTable container -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <table id="order-datatable" class="table dt-responsive nowrap w-100">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Foydalanuvchi</th>
                                            <th>Mahsulotlar</th>
                                            <th>Jami summa</th>
                                            <th>To'lov holati</th>
                                            <th>Yetkazib berish holati</th>
                                            <th>Amallar</th>
                                        </tr>
                                    </thead>
                                    @foreach ($orders as $order)
                                    <tbody>
                                        <th>{{ $order->id }}</th>
                                        <th>{{ $order->user->first_name }} {{ $order->user->last_name }}</th>
                                        <th>@foreach($order->products as $product) {{ $product->name_uz }}, @endforeach</th>
                                        <th>{{ $order->total_amount }}</th>
                                        <th>
                                            <select class="form-select payment-status" data-id="{{ $order->id }}">
                                                <option value="to'lanmagan" {{ $order->payment_status == "to'lanmagan" ? 'selected' : '' }} style="color:white; background-color: red">To'lanmagan</option>
                                                <option value="to'langan" {{ $order->payment_status == "to'langan" ? 'selected' : '' }} style="color:white; background-color: green">To'langan</option>
                                            </select>
                                        </th>
                                        <th>
                                            <select class="form-select shipping-status" data-id="{{ $order->id }}">
                                                <option value="yetkazilmoqda" {{ $order->shipping_status == "yetkazilmoqda" ? 'selected' : '' }}>Yetkazilmoqda</option>
                                                <option value="yo'lda" {{ $order->shipping_status == "yo'lda" ? 'selected' : '' }}>Yo'lda</option>
                                                <option value="yetkazildi" {{ $order->shipping_status == "yetkazildi" ? 'selected' : '' }}>Yetkazildi</option>
                                            </select>
                                        </th>
                                        <th>
                                            <a href="{{ route('order.edit', ['order' => $order->id]) }}" class="icon-container"><i class="mdi mdi-book-edit-outline fs-3"></i></a>
                                            <a href="{{ route('order.show', ['order' => $order->id]) }}" class="icon-container"><i class="mdi mdi-eye fs-3"></i></a>
                                            <form action="{{ route('order.destroy', ['order' => $order->id]) }}" method="POST" style="display: inline;" onsubmit="return confirm('Ochirishga ruxsat berasizmi')">
                                                @csrf
                                                @method("DELETE")
                                                <button type="submit" style="border: none; background: none; cursor: pointer;" class="icon-container"><i class="mdi mdi-trash-can-outline fs-3" style="color: #346ee0;"></i></button>
                                            </form>
                                        </th>
                                    </tbody>
                                    @endforeach
                                </table>
                                <div class="justify-content-end">
                                    {{ $orders->links() }}
                                </div>
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
                            <script>document.write(new Date().getFullYear())</script> © Dashtrap
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
            

            // Handle payment status change
            $('.payment-status').change(function() {
                var orderId = $(this).data('id');
                var status = $(this).val();
                $.ajax({
                    url: '{{ route('order.updatePaymentStatus') }}',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        id: orderId,
                        payment_status: status
                    },
                    success: function(response) {
                        if (response.success) {
                            alert('Payment status updated successfully.');
                        } else {
                            alert('Failed to update payment status.');
                        }
                    }
                });
            });

            // Handle shipping status change
            $('.shipping-status').change(function() {
                var orderId = $(this).data('id');
                var status = $(this).val();
                $.ajax({
                    url: '{{ route('order.updateShippingStatus') }}',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        id: orderId,
                        shipping_status: status
                    },
                    success: function(response) {
                        if (response.success) {
                            alert('Shipping status updated successfully.');
                        } else {
                            alert('Failed to update shipping status.');
                        }
                    }
                });
            });
        });
    </script>
</x-layouts.admin>
