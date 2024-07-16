<x-layouts.admin>
    <div class="page-content">
        <x-navbar></x-navbar>
        <div class="px-3">
            <div class="container-fluid">
                <div class="py-3 py-lg-4">
                    <div class="row">
                        <div class="col-lg-6">
                            <h4 class="page-title mb-0">Foydalanuvchini Tahrirlash</h4>
                        </div>
                        <div class="col-lg-6">
                            <ol class="breadcrumb m-0 float-end">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Bosh sahifa</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('user.index') }}">Foydalanuvchilar</a></li>
                                <li class="breadcrumb-item active">Tahrirlash</li>
                            </ol>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <form action="{{ route('user.update', $user->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="mb-3">
                                        <label for="first_name" class="form-label">Ism</label>
                                        <input type="text" name="first_name" class="form-control" id="first_name" value="{{ $user->first_name }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="last_name" class="form-label">Familiya</label>
                                        <input type="text" name="last_name" class="form-control" id="last_name" value="{{ $user->last_name }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="phone_number" class="form-label">Telefon Raqam</label>
                                        <input type="text" name="phone_number" class="form-control" id="phone_number" value="{{ $user->phone_number }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="role" class="form-label">Ro'l</label>
                                        <select name="role" class="form-control" id="role" required>
                                            <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                                            <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>User</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="password" class="form-label">Parol (o'zgartirishni xohlasangiz, kiriting)</label>
                                        <input type="password" name="password" class="form-control" id="password">
                                    </div>
                                    <button type="submit" class="btn btn-primary">Yangilash</button>
                                    <a href="{{ route('user.index') }}" class="btn btn-secondary">Bekor qilish</a>
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
                        <div class="d-none d-md-flex gap-4 align-item-center justify-content-md-end">
                            <p class="mb-0">Design & Develop by <a href="https://myrathemes.com/" target="_blank">MyraStudio</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</x-layouts.admin>
