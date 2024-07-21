<!-- resources/views/admin/order/edit.blade.php -->

<x-layouts.admin>
    <!-- Include jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

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
                            <h4 class="page-title mb-0">Edit Order #{{ $order->id }}</h4>
                        </div>
                        <div class="col-lg-6">
                            <div class="d-none d-lg-block">
                                <ol class="breadcrumb m-0 float-end">
                                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                                    <li class="breadcrumb-item"><a href="{{ route('order.index') }}">Orders</a></li>
                                    <li class="breadcrumb-item active">Edit Order</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End page title -->

                <!-- Form to edit order -->
                <div class="row">
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-body">
                                <form action="{{ route('order.update', ['order' => $order->id]) }}" method="POST">
                                    @csrf
                                    @method('PUT')

                                    <!-- User selection -->
                                    <div class="mb-3">
                                        <label for="user_id" class="form-label">Select User</label>
                                        <input type="text" readonly class="form-control" id="user_id" value="{{ $order->user->first_name }} {{ $order->user->last_name }}">
                                        <input type="hidden" name="user_id" value="{{ $order->user_id}}">
                                    </div>

                                    <!-- User Address selection -->
                                    <div class="mb-3">
                                        <label for="user_address_id" class="form-label">Select User Address</label>
                                        <input type="text" readonly class="form-control" id="user_address_id" name="user_address_id" value="{{ $address->region }} {{ $address->district }} {{ $address->street }} {{ $address->home }}">
                                        <input type="hidden" name="user_address_id" value="{{$order->user_address_id}}">
                                    </div>

                                    <div class="mb-3">
                                        <label for="product_ids" class="form-label">Selected Products</label>
                                        <select name="product_ids[]" id="product_ids" class="form-select" multiple>
                                            @foreach ($order->products as $product)
                                            <option value="{{ $product->id }}" {{ in_array($product->id, old('product_ids', $order->products->pluck('id')->toArray())) ? 'selected' : '' }}>
                                                {{ $product->name_uz }}
                                            </option>
                                            @endforeach
                                        </select>
                                        @error('product_ids')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Total Amount -->
                                    <div class="mb-3">
                                        <label for="total_amount" class="form-label">Total Amount</label>
                                        <input type="text" class="form-control" id="total_amount" name="total_amount" value="{{ old('total_amount', $order->total_amount) }}">
                                        @error('total_amount')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Payment Method Dropdown -->
                                    <div class="mb-3">
                                        <label for="payment_method" class="form-label">To'lov usuli</label>
                                        <select class="form-select" id="payment_method" name="payment_method">
                                            <option value="">To'lov usulini tanlang</option>
                                            <option value="naqd" {{ old('payment_method', $order->payment_method) === 'naqd' ? 'selected' : '' }}>Naqd</option>
                                            <option value="karta" {{ old('payment_method', $order->payment_method) === 'karta' ? 'selected' : '' }}>Karta</option>
                                        </select>
                                        @error('payment_method')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Shipping Method Dropdown -->
                                    <div class="mb-3">
                                        <label for="shipping_method" class="form-label">Yetkazib berish usuli</label>
                                        <select class="form-select" id="shipping_method" name="shipping_method">
                                            <option value="">Yetkazib berish usulini tanlang</option>
                                            <option value="standart" {{ old('shipping_method', $order->shipping_method) === 'standart' ? 'selected' : '' }}>Standart yetkazib berish</option>
                                            <option value="express" {{ old('shipping_method', $order->shipping_method) === 'express' ? 'selected' : '' }}>Express yetkazib berish</option>
                                        </select>
                                        @error('shipping_method')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Payment Status Dropdown -->
                                    <div class="mb-3">
                                        <label for="payment_status" class="form-label">To'lov holati</label>
                                        <select class="form-select" id="payment_status" name="payment_status">
                                            <option value="">To'lov holatini tanlang</option>
                                            <option value="to'langan" {{ old('payment_status', $order->payment_status) === "to'langan" ? 'selected' : '' }}>To'langan</option>
                                            <option value="to'lanmagan" {{ old('payment_status', $order->payment_status) === "to'lanmagan" ? 'selected' : '' }}>To'lanmagan</option>
                                        </select>
                                        @error('payment_status')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Shipping Status Dropdown -->
                                    <div class="mb-3">
                                        <label for="shipping_status" class="form-label">Yetkazib berish holati</label>
                                        <select class="form-select" id="shipping_status" name="shipping_status">
                                            <option value="">Yetkazib berish holatini tanlang</option>
                                            <option value="yetkazilmoqda" {{ old('shipping_status', $order->shipping_status) === 'yetkazilmoqda' ? 'selected' : '' }}>Yetkazilmoqda</option>
                                            <option value="yo'lda" {{ old('shipping_status', $order->shipping_status) === "yo'lda" ? 'selected' : '' }}>Yo'lda</option>
                                            <option value="yetkazildi" {{ old('shipping_status', $order->shipping_status) === 'yetkazildi' ? 'selected' : '' }}>Yetkazildi</option>
                                        </select>
                                        @error('shipping_status')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Status -->
                                    <div class="mb-3">
                                        <label for="status" class="form-label">Status</label>
                                        <select class="form-select" id="status" name="status">
                                            <option value="">Yetkazib berish holatini tanlang</option>
                                            <option value="yangi" {{ old('status', $order->status) === 'yangi' ? 'selected' : '' }}>Yangi</option>
                                            <option value="tasdiqlangan" {{ old('status', $order->status) === 'tasdiqlangan' ? 'selected' : '' }}>Tasdiqlangan</option>
                                            <option value="bekor_qilingan" {{ old('status', $order->status) === 'bekor_qilingan' ? 'selected' : '' }}>Bekor qilingan</option>
                                        </select>                                        @error('status')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Order Date -->
                                    <div class="mb-3">
                                        <label for="order_date" class="form-label">Order Date</label>
                                        <input type="date" class="form-control" id="order_date" name="order_date" value="{{ old('order_date', $order->order_date) }}">
                                        @error('order_date')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Products Selection -->


                                    <!-- Submit Button -->
                                    <button type="submit" class="btn btn-primary">Update Order</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End form to edit order -->

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