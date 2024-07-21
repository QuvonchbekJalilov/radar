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
                            <h4 class="page-title mb-0">Order #{{ $order->id }}</h4>
                        </div>
                        <div class="col-lg-6">
                            <div class="d-none d-lg-block">
                                <ol class="breadcrumb m-0 float-end">
                                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                                    <li class="breadcrumb-item"><a href="{{ route('order.index') }}">Orders</a></li>
                                    <li class="breadcrumb-item active">Order #{{ $order->id }}</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End page title -->

                <!-- Order details -->
                <div class="row">
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Order Information</h5>

                                <p><strong>User:</strong> {{ $order->user ? $order->user->first_name . ' ' . $order->user->last_name : 'N/A' }}</p>
                                <p><strong>Order Date:</strong> {{ $order->order_date }}</p>
                                <p><strong>Total Amount:</strong> {{ $order->total_amount }}</p>
                                <p><strong>Payment Method:</strong> {{ $order->payment_method }}</p>
                                <p><strong>Shipping Method:</strong> {{ $order->shipping_method }}</p>
                                <p><strong>Payment Status:</strong> {{ ucfirst($order->payment_status) }}</p>
                                <p><strong>Shipping Status:</strong> {{ ucfirst($order->shipping_status) }}</p>
                                <p><strong>Status:</strong> {{ ucfirst($order->status) }}</p>

                                <div class="mb-3">
                                    <h6><strong>Address:</strong></h6>
                                    <p>
                                        {{ $order->address->street }}, {{ $order->address->city }}<br>
                                        {{ $order->address->state }}, {{ $order->address->postal_code }}<br>
                                        {{ $order->address->country }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Products in Order</h5>

                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Product Name</th>
                                            <th>Quantity</th>
                                            <th>Price</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($order->products as $product)
                                            <tr>
                                                <td>{{ $product->name_uz }}</td>
                                                <td>{{ $product->pivot->quantity }}</td>
                                                <td>{{ $product->price }}</td>
                                                <td>{{ $product->pivot->quantity * $product->price }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                                <a href="{{ route('order.index') }}" class="btn btn-secondary">Orqaga</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End order details -->

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
                            <p class="mb-0">Design & Develop by <a href="https://dora.uz/" target="_blank">Dora</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </footer> <!-- End footer -->

    </div> <!-- End page-content -->
</x-layouts.admin>
