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
                            <h4 class="page-title mb-0">Buyurtma qo'shish</h4>
                        </div>
                        <div class="col-lg-6">
                            <div class="d-none d-lg-block">
                                <ol class="breadcrumb m-0 float-end">
                                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Bosh sahifa</a></li>
                                    <li class="breadcrumb-item"><a href="{{ route('order.index') }}">Buyurtmalar</a></li>
                                    <li class="breadcrumb-item active">Buyurtma qo'shish</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End page title -->

                <!-- Order creation form -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <form action="{{ route('order.store') }}" method="POST">
                                    @csrf

                                    <div class="mb-3">
                                        <label for="user_id" class="form-label">Foydalanuvchi</label>
                                        <select id="user_id" name="user_id" class="form-control">
                                            @foreach($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->first_name }} {{ $user->last_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label for="product_ids" class="form-label">Mahsulotlar</label>
                                        <select id="product_ids" name="product_ids[]" class="form-control" multiple>
                                            @foreach($products as $product)
                                            <option value="{{ $product->id }}">{{ $product->name_uz }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label for="user_address_id" class="form-label">Foydalanuvchi manzili</label>
                                        <select id="user_address_id" name="user_address_id" class="form-control">
                                            <!-- Placeholder option -->
                                            <option value="">Select user first</option>
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label for="total_amount" class="form-label">Jami summa</label>
                                        <input type="text" id="total_amount" name="total_amount" class="form-control" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="shipping_method" class="form-label">Yetkazib berish usuli</label>
                                        <select class="form-select" id="shipping_method" name="shipping_method">
                                            <option value="">Yetkazib berish usulini tanlang</option>
                                            <option value="standart" {{ old('shipping_method') === 'standart' ? 'selected' : '' }}>Standart yetkazib berish</option>
                                            <option value="express" {{ old('shipping_method') === 'express' ? 'selected' : '' }}>Express yetkazib berish</option>
                                        </select>
                                    </div>


                                    <div class="mb-3">
                                        <label for="shipping_status" class="form-label">Yetkazib berish holati</label>
                                        <select class="form-select" id="shipping_status" name="shipping_status">
                                            <option value="">Yetkazib berish holatini tanlang</option>
                                            <option value="yetkazilmoqda" {{ old('shipping_status') === 'yetkazilmoqda' ? 'selected' : '' }}>Yetkazilmoqda</option>
                                            <option value="yo'lda" {{ old('shipping_status') === 'yo\'lda' ? 'selected' : '' }}>Yo'lda</option>
                                            <option value="yetkazildi" {{ old('shipping_status') === 'yetkazildi' ? 'selected' : '' }}>Yetkazildi</option>
                                        </select>
                                    </div>


                                    <div class="mb-3">
                                        <label for="payment_status" class="form-label">To'lov holati</label>
                                        <select class="form-select" id="payment_status" name="payment_status">
                                            <option value="">To'lov holatini tanlang</option>
                                            <option value="to'langan" {{ old('payment_status') === 'to\'langan' ? 'selected' : '' }}>To'langan</option>
                                            <option value="to'lanmagan" {{ old('payment_status') === 'to\'lanmagan' ? 'selected' : '' }}>To'lanmagan</option>
                                        </select>
                                    </div>


                                    <div class="mb-3">
                                        <label for="payment_method" class="form-label">To'lov usuli</label>
                                        <select class="form-select" id="payment_method" name="payment_method">
                                            <option value="">To'lov usulini tanlang</option>
                                            <option value="naqd" {{ old('payment_method') === 'naqd' ? 'selected' : '' }}>Naqd</option>
                                            <option value="karta" {{ old('payment_method') === 'karta' ? 'selected' : '' }}>Karta</option>
                                        </select>
                                    </div>


                                    <div class="mb-3">
                                        <label for="status" class="form-label">Holati</label>
                                        <select id="status" name="status" class="form-control">
                                            <option value="yangi">Yangi</option>
                                            <option value="tasdiqlangan">Tasdiqlangan</option>
                                            <option value="bekor_qilingan">Bekor qilingan</option>
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label for="order_date" class="form-label">Buyurtma sanasi</label>
                                        <input type="date" id="order_date" name="order_date" class="form-control">
                                    </div>

                                    <button type="submit" class="btn btn-primary">Saqlash</button>
                                    <a href="{{ route('order.index') }}" class="btn btn-secondary">Ortga</a>
                                </form>

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
                            <p class="mb-0">Design & Develop by <a href="https://dora.uz/" target="_blank">Dora</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </footer> <!-- End footer -->

    </div> <!-- End page-content -->

    <script>
        // Fetch user addresses when user is selected
        document.getElementById('user_id').addEventListener('change', function() {
            var userId = this.value;
            var addressSelect = document.getElementById('user_address_id');

            // Clear existing options
            addressSelect.innerHTML = '<option value="">Loading...</option>';

            // Fetch addresses via AJAX
            fetch(`/api/user/${userId}/addresses`)
                .then(response => response.json())
                .then(data => {
                    addressSelect.innerHTML = ''; // Clear loading option

                    // Append fetched addresses as options
                    data.forEach(address => {
                        var option = document.createElement('option');
                        option.value = address.id;
                        option.textContent = `${address.region}, ${address.district}, ${address.street}, ${address.home}`;
                        addressSelect.appendChild(option);
                    });
                })
                .catch(error => {
                    console.error('Error fetching addresses:', error);
                    addressSelect.innerHTML = '<option value="">Error loading addresses</option>';
                });
        });
    </script>
</x-layouts.admin>