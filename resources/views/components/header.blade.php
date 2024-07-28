<div class="main-menu">
    <!-- Brand Logo -->
    <div class="logo-box">
        <!-- Brand Logo Light -->
        <a href="index.html" class="logo-light">
            <img src="/assets/images/logo-light.png" alt="logo" class="logo-lg" height="28">
            <img src="/assets/images/logo-sm.png" alt="small logo" class="logo-sm" height="28">
        </a>

        <!-- Brand Logo Dark -->
        <a href="index.html" class="logo-dark">
            <img src="/assets/images/logo-dark.png" alt="dark logo" class="logo-lg" height="28">
            <img src="/assets/images/logo-sm.png" alt="small logo" class="logo-sm" height="28">
        </a>
    </div>

    <!--- Menu -->
    <div data-simplebar>
        <ul class="app-menu">

            <li class="menu-title">Menu</li>

            <li class="menu-item">
                <a href="{{ route('dashboard')}}" class="menu-link waves-effect waves-light">
                    <span class="menu-icon"><i class="bx bx-home-smile"></i></span>
                    <span class="menu-text"> Bosh sahifa </span>
                    <span class="badge bg-primary rounded ms-auto">01</span>
                </a>
            </li>

            <li class="menu-item">
                <a href="{{ route('user.index')}}" class="menu-link waves-effect waves-light">
                    <span class="menu-icon"><i class="bx bx-user"></i></span>
                    <span class="menu-text"> Foydalanuvchilar </span>
                </a>
            </li>
            <li class="menu-item">
                <a href="{{ route('banners.index')}}" class="menu-link waves-effect waves-light">
                    <span class="menu-icon"><i class="bx bx-category"></i></span>
                    <span class="menu-text"> Bannerlar </span>
                </a>
            </li>
            <li class="menu-item">
                <a href="{{ route('discounts.index')}}" class="menu-link waves-effect waves-light">
                    <span class="menu-icon"><i class="bx bx-category"></i></span>
                    <span class="menu-text"> Chegirmali Mahsulotlar </span>
                </a>
            </li>
            <li class="menu-item">
                <a href="{{ route('category.index')}}" class="menu-link waves-effect waves-light">
                    <span class="menu-icon"><i class="bx bx-category"></i></span>
                    <span class="menu-text"> Kategoriyalar </span>
                </a>
            </li>

            <li class="menu-item">
                <a href="{{ route('product.index') }}" class="menu-link waves-effect waves-light">
                    <span class="menu-icon"><i class="bx bx-store-alt"></i></span>
                    <span class="menu-text"> Mahsulotlar </span>
                </a>
            </li>
            <li class="menu-item">
                <a href="{{ route('brands.index') }}" class="menu-link waves-effect waves-light">
                    <span class="menu-icon"><i class="bx bx-store-alt"></i></span>
                    <span class="menu-text"> Brand </span>
                </a>
            </li>
            
            <li class="menu-item">
                <a href="{{ route('order.index')}}" class="menu-link waves-effect waves-light">
                    <span class="menu-icon"><i class="bx bx-basket"></i></span>
                    <span class="menu-text"> Buyurtmalar </span>
                </a>
            </li>


            

            
        </ul>
    </div>
</div>