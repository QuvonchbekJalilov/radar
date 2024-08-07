<x-layouts.admin>
    <div class="page-content">

        <x-navbar></x-navbar>

        <div class="px-3">

            <!-- Start Content-->
            <div class="container-fluid">

                <!-- start page title -->
                <div class="py-3 py-lg-4">
                    <div class="row">
                        <div class="col-lg-6">
                            <h4 class="page-title mb-0">Dashboard</h4>
                        </div>
                        <div class="col-lg-6">
                            <div class="d-none d-lg-block">
                                <ol class="breadcrumb m-0 float-end">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Dashtrap</a></li>
                                    <li class="breadcrumb-item active">Dashboard</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <div class="row">
                    <!-- Product Count -->
                    <div class="col-md-6 col-xl-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="mb-4">
                                    <span class="badge badge-soft-primary float-end">Hammasi</span>
                                    <h5 class="card-title mb-0">Mahsulotlar soni</h5>
                                </div>
                                <div class="row d-flex align-items-center mb-4">
                                    <div class="col-8">
                                        <h2 class="d-flex align-items-center mb-0">{{ $products }}</h2>
                                    </div>
                                </div>
                            </div>
                            <!--end card body-->
                        </div>
                        <!-- end card-->
                    </div>
                    <!-- end col -->

                    <!-- Order Count -->
                    <div class="col-md-6 col-xl-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="mb-4">
                                    <span class="badge badge-soft-primary float-end">Bir haftalik</span>
                                    <h5 class="card-title mb-0">Buyurtma soni</h5>
                                </div>
                                <div class="row d-flex align-items-center mb-4">
                                    <div class="col-8">
                                        <h2 class="d-flex align-items-center mb-0">{{ $orderCount }}</h2>
                                    </div>
                                    <div class="col-4 text-end">
                                        <span class="text-muted">
                                            {{ number_format($percentageChange, 2) }}%
                                            <i class="mdi mdi-arrow-{{ $percentageChange >= 0 ? 'up' : 'down' }} text-{{ $percentageChange >= 0 ? 'success' : 'danger' }}"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="progress shadow-sm" style="height: 5px;">
                                    <div class="progress-bar bg-{{ $percentageChange >= 0 ? 'success' : 'danger' }}" role="progressbar" style="width: {{ min($progressBarWidth, 100) }}%;"></div>
                                </div>
                            </div>
                            <!--end card body-->
                        </div>
                        <!-- end card-->
                    </div>
                    <!-- end col -->

                    <!-- Order Profit -->
                    <div class="col-md-6 col-xl-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="mb-4">
                                    <span class="badge badge-soft-primary float-end">Per Month</span>
                                    <h5 class="card-title mb-0">Buyurtma foydasi</h5>
                                </div>
                                <div class="row d-flex align-items-center mb-4">
                                    <div class="col-8">
                                        <h2 class="d-flex align-items-center mb-0">{{ number_format($totalAmountMonth, 2) }}</h2>
                                    </div>
                                    <div class="col-4 text-end">
                                        <span class="text-muted">{{ number_format($percentageChangeExp, 2) }}%
                                            <i class="mdi mdi-arrow-{{ $percentageChangeExp > 0 ? 'up' : 'down' }} text-{{ $percentageChangeExp > 0 ? 'success' : 'danger' }}"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="progress shadow-sm" style="height: 5px;">
                                    <div class="progress-bar bg-warning" role="progressbar" style="width: {{ abs($percentageChangeExp) }}%;"></div>
                                </div>
                            </div>
                            <!--end card body-->
                        </div>
                        <!-- end card-->
                    </div>
                    <!-- end col -->

                    <!-- Visits -->
                    <div class="col-md-6 col-xl-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="mb-4">
                                    <span class="badge badge-soft-primary float-end">All Time</span>
                                    <h5 class="card-title mb-0">Saytga Tashrif Buyurganlar</h5>
                                </div>
                                <div class="row d-flex align-items-center mb-4">
                                    <div class="col-8">
                                        <h2 class="d-flex align-items-center mb-0">{{ $todayVisits }}</h2>
                                    </div>
                                    <div class="col-4 text-end">
                                        <span class="text-muted">17.8% <i class="mdi mdi-arrow-down text-danger"></i></span>
                                    </div>
                                </div>
                                <div class="progress shadow-sm" style="height: 5px;">
                                    <div class="progress-bar bg-info" role="progressbar" style="width: 57%;"></div>
                                </div>
                            </div>
                            <!--end card body-->
                        </div>
                        <!-- end card-->
                    </div>
                    <!-- end col -->
                </div>
                <!-- end row -->


                <div class="row">
                    <div class="col-lg-5">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Sales Analytics</h4>
                                <p class="card-subtitle mb-4">From date of 1st Jan 2020 to continue</p>
                                <div id="morris-bar-example" class="morris-chart"></div>
                            </div> <!--end card body-->
                        </div> <!-- end card-->
                    </div> <!-- end col -->

                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Stock</h4>
                                <p class="card-subtitle mb-4">Recent Stock</p>

                                <div class="text-center">
                                    <input data-plugin="knob" data-width="165" data-height="165" data-linecap=round data-fgColor="#7a08c2" value="95" data-skin="tron" data-angleOffset="180" data-readOnly=true data-thickness=".15" />
                                    <h5 class="text-muted mt-3">Total sales made today</h5>


                                    <p class="text-muted w-75 mx-auto sp-line-2">Traditional heading
                                        elements are
                                        designed to work best in the meat of your page content.</p>

                                    <div class="row mt-3">
                                        <div class="col-6">
                                            <p class="text-muted font-15 mb-1 text-truncate">Target</p>
                                            <h4><i class="fas fa-arrow-up text-success me-1"></i>$7.8k</h4>

                                        </div>
                                        <div class="col-6">
                                            <p class="text-muted font-15 mb-1 text-truncate">Last week</p>
                                            <h4><i class="fas fa-arrow-down text-danger me-1"></i>$1.4k</h4>
                                        </div>

                                    </div>
                                </div>
                            </div> <!--end card body-->
                        </div> <!-- end card-->
                    </div> <!-- end col -->

                    <div class="col-lg-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <h4 class="card-title">Account Transactions</h4>
                                        <p class="card-subtitle mb-4">Transaction period from 21 July to
                                            25 Aug</p>
                                        <h3>$7841.12 <span class="badge badge-soft-success float-end">+7.5%</span>
                                        </h3>
                                    </div>
                                </div> <!-- end row -->

                                <div id="sparkline1" class="mt-3"></div>
                            </div>
                            <!--end card body-->
                        </div>
                        <!--end card-->

                    </div><!-- end col -->
                </div>
                <!--end row-->

                <div class="row">
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="dropdown float-end position-relative">
                                    <a href="#" class="dropdown-toggle h4 text-muted" data-toggle="dropdown" aria-expanded="false">
                                        <i class="mdi mdi-dots-vertical"></i>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-right">
                                        <li><a href="#" class="dropdown-item">Action</a></li>
                                        <li><a href="#" class="dropdown-item">Another action</a></li>
                                        <li><a href="#" class="dropdown-item">Something else here</a></li>
                                        <li class="dropdown-divider"></li>
                                        <li><a href="#" class="dropdown-item">Separated link</a></li>
                                    </ul>
                                </div>
                                <h4 class="card-title d-inline-block">Total Revenue</h4>

                                <div id="morris-line-example" class="morris-chart" style="height: 290px;"></div>

                                <div class="row text-center mt-4">
                                    <div class="col-6">
                                        <h4>$7841.12</h4>
                                        <p class="text-muted mb-0">Total Revenue</p>
                                    </div>
                                    <div class="col-6">
                                        <h4>17</h4>
                                        <p class="text-muted mb-0">Open Compaign</p>
                                    </div>
                                </div>

                            </div>
                            <!--end card body-->

                        </div>
                        <!--end card-->
                    </div>
                    <!--end col-->
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">

                                <h4 class="card-title">Top 5 Customers</h4>
                                <p class="card-subtitle mb-4 font-size-13">Transaction period from 21 July to 25 Aug
                                </p>

                                <div class="table-responsive">
                                    <table class="table table-centered table-striped table-nowrap mb-0">
                                        <thead>
                                            <tr>
                                                <th>Customer</th>
                                                <th>Phone</th>
                                                <th>Email</th>
                                                <th>Location</th>
                                                <th>Create Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="table-user">
                                                    <img src="/assets/images/users/avatar-4.jpg" alt="table-user" class="mr-2 avatar-xs rounded-circle">
                                                    <a href="javascript:void(0);" class="text-body font-weight-semibold">Paul J. Friend</a>
                                                </td>
                                                <td>
                                                    937-330-1634
                                                </td>
                                                <td>
                                                    pauljfrnd@jourrapide.com
                                                </td>
                                                <td>
                                                    New York
                                                </td>
                                                <td>
                                                    07/07/2018
                                                </td>
                                            </tr>

                                            <tr>
                                                <td class="table-user">
                                                    <img src="/assets/images/users/avatar-3.jpg" alt="table-user" class="mr-2 avatar-xs rounded-circle">
                                                    <a href="javascript:void(0);" class="text-body font-weight-semibold">Bryan J. Luellen</a>
                                                </td>
                                                <td>
                                                    215-302-3376
                                                </td>
                                                <td>
                                                    bryuellen@dayrep.com
                                                </td>
                                                <td>
                                                    New York
                                                </td>
                                                <td>
                                                    09/12/2018
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="table-user">
                                                    <img src="/assets/images/users/avatar-8.jpg" alt="table-user" class="mr-2 avatar-xs rounded-circle">
                                                    <a href="javascript:void(0);" class="text-body font-weight-semibold">Kathryn S.
                                                        Collier</a>
                                                </td>
                                                <td>
                                                    828-216-2190
                                                </td>
                                                <td>
                                                    collier@jourrapide.com
                                                </td>
                                                <td>
                                                    Canada
                                                </td>
                                                <td>
                                                    06/30/2018
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="table-user">
                                                    <img src="/assets/images/users/avatar-1.jpg" alt="table-user" class="mr-2 avatar-xs rounded-circle">
                                                    <a href="javascript:void(0);" class="text-body font-weight-semibold">Timothy Kauper</a>
                                                </td>
                                                <td>
                                                    (216) 75 612 706
                                                </td>
                                                <td>
                                                    thykauper@rhyta.com
                                                </td>
                                                <td>
                                                    Denmark
                                                </td>
                                                <td>
                                                    09/08/2018
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="table-user">
                                                    <img src="/assets/images/users/avatar-5.jpg" alt="table-user" class="mr-2 avatar-xs rounded-circle">
                                                    <a href="javascript:void(0);" class="text-body font-weight-semibold">Zara Raws</a>
                                                </td>
                                                <td>
                                                    (02) 75 150 655
                                                </td>
                                                <td>
                                                    austin@dayrep.com
                                                </td>
                                                <td>
                                                    Germany
                                                </td>
                                                <td>
                                                    07/15/2018
                                                </td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div>

                            </div>
                            <!--end card body-->

                        </div>
                        <!--end card-->
                    </div>
                    <!--end col-->

                </div>
                <!--end row-->

            </div> <!-- container -->

        </div> <!-- content -->

        <!-- Footer Start -->
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
        </footer>
        <!-- end Footer -->

    </div>
</x-layouts.admin>