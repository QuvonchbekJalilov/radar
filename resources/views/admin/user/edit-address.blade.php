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
                            <h4 class="page-title mb-0">Edit User Address</h4>
                        </div>
                        <div class="col-lg-6">
                            <div class="d-none d-lg-block">
                                <ol class="breadcrumb m-0 float-end">
                                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                                    <li class="breadcrumb-item"><a href="{{ route('user.index') }}">Users</a></li>
                                    <li class="breadcrumb-item"><a href="{{ route('user.edit', $user->id) }}">Edit User</a></li>
                                    <li class="breadcrumb-item active">Edit Address</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End page title -->

                <!-- Address edit form -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <form action="{{ route('user.update-address', $user->id) }}" method="POST">
                                    @csrf
                                    @method("PUT")
                                    <div class="mb-3">
                                        <label for="longitude" class="form-label">Longitude</label>
                                        <input type="text" id="longitude" name="longitude" class="form-control" value="{{ $address->longitude ?? null }}">
                                    </div>

                                    <div class="mb-3">
                                        <label for="latitude" class="form-label">Latitude</label>
                                        <input type="text" id="latitude" name="latitude" class="form-control" value="{{ $address->latitude ?? null }}">
                                    </div>

                                    <div class="mb-3">
                                        <label for="region" class="form-label">Region</label>
                                        <input type="text" id="region" name="region" class="form-control" value="{{ $address->region ?? null }}">
                                    </div>

                                    <div class="mb-3">
                                        <label for="district" class="form-label">District</label>
                                        <input type="text" id="district" name="district" class="form-control" value="{{ $address->district ?? null }}">
                                    </div>

                                    <div class="mb-3">
                                        <label for="street" class="form-label">Street</label>
                                        <input type="text" id="street" name="street" class="form-control" value="{{ $address->street  ?? null }}">
                                    </div>

                                    <div class="mb-3">
                                        <label for="home" class="form-label">Home</label>
                                        <input type="text" id="home" name="home" class="form-control" value="{{ $address->home ?? null }}">
                                    </div>

                                    <button type="submit" class="btn btn-primary">Yangilash</button>
                                    <a href="{{ route('user.index') }}" class="btn btn-secondary">Bekor qilish</a>
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

    <!-- Script to fetch user location -->
    <script>
        function getUserLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showPosition);
            } else {
                alert("Geolocation is not supported by this browser.");
            }
        }

        function showPosition(position) {
            document.getElementById('longitude').value = position.coords.longitude;
            document.getElementById('latitude').value = position.coords.latitude;
        }
    </script>
</x-layouts.admin>
