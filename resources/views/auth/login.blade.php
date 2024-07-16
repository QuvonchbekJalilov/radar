<!DOCTYPE html>
<html lang="en" data-bs-theme="light" data-menu-color="brand" data-topbar-color="light">

<head>
    <meta charset="utf-8" />
    <title>Log In | Miracle Tour</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Myra Studio" name="author" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="/frontend/images/icon.png">

    <!-- App css -->
    <link href="assets/css/style.min.css" rel="stylesheet" type="text/css">
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css">
    <script src="assets/js/config.js"></script>
</head>

<body class="bg-primary d-flex justify-content-center align-items-center min-vh-100 p-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-4 col-md-5">
                <div class="card">
                    <div class="card-body p-4">

                        <div class="text-center w-75 mx-auto auth-logo mb-4">
                            <a href="{{ route('index')}}" class="logo-dark">
                                <span><img src="/frontend/images/MiracleTourLogoBlack.png" alt="" height="35"></span>
                            </a>

                            <a href="{{ route('index')}}" class="logo-light">
                                <span><img src="/frontend/images/MiracleTourLogo.png" alt="" height="35"></span>
                            </a>
                        </div>
                        @if (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif

                        <form action="{{ route('authenticate')}}" method="post">
                            @csrf

                            <div class="form-group mb-3">
                                <label class="form-label" for="emailaddress">Telefon raqam</label>
                                <input name="form_phone" id="phone_number" type="text" class="form-control" placeholder="+998 " required>
                            </div>

                            <div class="form-group mb-3">
                                <a href="pages-recoverpw.html" class="text-muted float-end"><small></small></a>
                                <label class="form-label" for="password">Password</label>
                                <input class="form-control" name="password" type="password" required="" id="password" placeholder="Enter your password">
                            </div>

                            <div class="form-group mb-0 text-center">
                                <button class="btn btn-primary w-100" type="submit"> Log In </button>
                            </div>

                        </form>
                    </div> <!-- end card-body -->
                </div>
                <!-- end card -->


            </div> <!-- end col -->
        </div>
        <!-- end row -->
    </div>

    <!-- App js -->
    <script src="assets/js/vendor.min.js"></script>
    <script src="assets/js/app.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            const phoneInput = document.getElementById('phone_number');
            const pattern = /^\+998[- ]?(90|91|93|94|95|98|99|33|97|71)[- ]?(\d{3})[- ]?(\d{2})[- ]?(\d{2})$/;

            // Set initial value to +998
            phoneInput.value = '+998 ';

            phoneInput.addEventListener('input', (e) => {
                let value = e.target.value;

                // Ensure the value always starts with +998
                if (!value.startsWith('+998 ')) {
                    value = '+998 ' + value.replace(/^\+998\s*/, '');
                }

                // Remove invalid characters
                value = value.replace(/[^\d+]/g, '');

                // Format value according to the pattern
                let match = value.match(/^\+998\s?(90|91|93|94|95|98|99|33|97|71)?\s?(\d{0,3})?\s?(\d{0,2})?\s?(\d{0,2})?/);
                if (match) {
                    let formattedValue = '+998 ';
                    if (match[1]) formattedValue += match[1] + ' ';
                    if (match[2]) formattedValue += match[2] + (match[2].length === 3 ? ' ' : '');
                    if (match[3]) formattedValue += match[3] + (match[3].length === 2 ? ' ' : '');
                    if (match[4]) formattedValue += match[4];
                    value = formattedValue;
                }

                e.target.value = value.trim();
            });

            phoneInput.addEventListener('keydown', (e) => {
                const value = e.target.value;
                // Allow user to clear the input completely
                if (e.key === 'Backspace' && value.length <= 5) {
                    phoneInput.value = ''; // Clear the input field
                }
            });

            document.getElementById('phone-form').addEventListener('submit', (e) => {
                if (!pattern.test(phoneInput.value)) {
                    e.preventDefault();
                    alert('Please enter a valid phone number: +998 (XX) XXX-XX-XX');
                }
            });
        });
    </script>
</body>

</html>