<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Fruitables - Vegetable Website Template</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Raleway:wght@600;800&display=swap"
        rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Libraries Stylesheet -->
    <link href="{{ asset('customer/lib/lightbox/css/lightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('customer/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">


    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('customer/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{ asset('customer/css/style.css') }}" rel="stylesheet">

    {{-- custom css --}}
    <link rel="stylesheet" href="{{asset('customer/css/custom.css')}}">
</head>

<body>

    <!-- Spinner Start -->
    <div id="spinner"
        class="show w-100 vh-100 bg-white position-fixed translate-middle top-50 start-50  d-flex align-items-center justify-content-center">
        <div class="spinner-grow text-primary" role="status"></div>
    </div>
    <!-- Spinner End -->


    <!-- Navbar start -->
    <div class="container-fluid fixed-top">
        <div class="container topbar bg-primary d-none d-lg-block">
            <div class="d-flex justify-content-between">
                <div class="top-info ps-2">
                    <small class="me-3"><i class="fas fa-map-marker-alt me-2 text-secondary"></i> <a href="#"
                            class="text-white">449 Street,Bahan Yangon</a></small>
                    <small class="me-3"><i class="fas fa-envelope me-2 text-secondary"></i><a href="#"
                            class="text-white">koshwe@Example.com</a></small>
                </div>
                <div class="top-link pe-2">
                    <a href="#" class="text-white"><small class="text-white mx-2">Privacy Policy</small>/</a>
                    <a href="#" class="text-white"><small class="text-white mx-2">Terms of Use</small>/</a>
                    <a href="#" class="text-white"><small class="text-white ms-2">Sales and Refunds</small></a>
                </div>
            </div>
        </div>
        <div class="container px-0">
            <nav class="navbar navbar-light bg-white navbar-expand-xl">
                <a href="{{ route('userDashboard') }}" class="navbar-brand">
                    <h1 class="text-primary display-6 fs-3">KO SHWE'S KITCHEN</h1>
                </a>
                <button class="navbar-toggler py-2 px-3" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarCollapse">
                    <span class="fa fa-bars text-primary"></span>
                </button>
                <div class="collapse navbar-collapse bg-white" id="navbarCollapse">
                    <div class="navbar-nav mx-auto">
                        <a href="{{ route('userDashboard') }}" class="nav-item nav-link active">Home</a>
                        <a href="{{ route('shopList') }}" class="nav-item nav-link">Shop</a>
                        <a href="{{ route('contact')}}" class="nav-item nav-link">Contact</a>

                    </div>
                    <div class="d-flex align-items-center justify-content-center">
                        <a href="{{ route('cartDetails')}}"
                            class="btn-search btn border border-secondary btn-md-square rounded-circle bg-white me-4"
                          >
                            <i class="fa-solid fa-cart-shopping text-primary"></i>
                        </a>
                        <a href="{{ route('orderList')}}" class="position-relative me-4 my-auto">
                            <i class="fa-solid fa-bag-shopping fa-2x"></i>
                        </a>
                        <li class="nav-item dropdown no-arrow me-4">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                                    @if (auth()->user()->name != null)
                                        {{auth()->user()->name}}
                                    @else
                                        {{auth()->user()->nickname}}
                                    @endif
                                </span>
                                @if (auth()->user()->profile == null)
                                    <img class="img-profile rounded-circle" style="width:40px; height:40px;"
                                         src="{{ asset('admin/img/images.png') }}">
                                @else
                                    <img class="img-profile rounded-circle" style="width:40px; height:40px;"
                                         src="{{ asset('adminProfile/'.auth()->user()->profile) }}">
                                @endif
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                 aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="{{route('userProfileDetails')}}">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>

                                @if (auth()->user()->provider == 'simple')
                                    <a class="dropdown-item" href="{{ route('userPasswordChange')}}">
                                        <i class="fa-solid fa-lock fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Change Password
                                    </a>
                                @endif

                                <div class="dropdown-divider"></div>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <input type="submit" value="Logout" class="btn btn-outline-success ms-2">
                                </form>
                            </div>
                        </li>
                    </div>

                </div>
            </nav>
        </div>
    </div>
    <!-- Navbar End -->
    @yield('content')
  <!-- Footer Start -->
<div class="container-fluid bg-dark text-white footer pt-5 mt-5">
    <div class="container py-5">
        <div class="pb-4 mb-4" style="border-bottom: 1px solid rgba(226, 175, 24, 0.5);">
            <div class="row g-4">
                <div class="col-lg-3">
                    <a href="#">
                        <h4 class="text-primary mb-0">KO SHWE'S KITCHEN</h4>
                        <p class="text-secondary mb-0">Fresh products</p>
                    </a>
                </div>
                <div class="col-lg-6">
                    <div class="position-relative mx-auto">
                        <input class="form-control border-0 w-100 py-3 px-4 rounded-pill" type="email" placeholder="Your Email" aria-label="Your Email">
                        <button type="submit" class="btn btn-primary border-0 py-3 px-4 position-absolute rounded-pill text-white" style="top: 0; right: 0;">Subscribe Now</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="row g-5">
            <div class="col-lg-3 col-md-6">
                <div class="footer-item">
                    <h4 class="text-light mb-3">Why People Like Us!</h4>
                    <p class="mb-4">At Ko Shwe Kitchen, we serve authentic dishes made from fresh, local ingredients, creating a warm atmosphere that delights every guest with unforgettable flavors and memorable experiences.</p>
                    <a href="#" class="btn btn-outline-secondary py-2 px-4 rounded-pill text-light">Read More</a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="d-flex flex-column text-start footer-item">
                    <h4 class="text-light mb-3">Shop Info</h4>
                    <a class="btn-link text-secondary" href="{{route('userDashboard')}}">Home</a>
                    <a class="btn-link text-secondary" href="{{route('shopList')}}">Shop</a>
                    <a class="btn-link text-secondary" href="{{route('contact')}}">Contact</a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="footer-item">
                    <h4 class="text-light mb-3">Contact</h4>
                    <p>Address: 1429 Bahan Rd, Yangon</p>
                    <p>Email: <a href="mailto:Example@gmail.com" class="text-secondary">koshwe@gmail.com</a></p>
                    <p>Phone: <a href="#" class="text-secondary">+09 23 4567 891</a></p>
                    <p>Payment Accepted</p>
                    <img src="img/payment.png" class="img-fluid" alt="Payment Methods">
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Footer End -->


    <!-- Copyright Start -->
    <div class="container-fluid copyright bg-dark py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                    <span class="text-light"><a href="#"><i class="fas fa-copyright text-light me-2"></i>KoShweKitchen's</a>, All right reserved.</span>
                </div>
                <div class="col-md-6 my-auto text-center text-md-end text-white">
                    <!--/*** This template is free as long as you keep the below author’s credit link/attribution link/backlink. ***/-->
                    <!--/*** If you'd like to use the template without the below author’s credit link/attribution link/backlink, ***/-->
                    <!--/*** you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". ***/-->
                    Designed By <a class="border-bottom">Ko Shwe</a> Distributed By Ko Shwe's Team
                </div>
            </div>
        </div>
    </div>
    <!-- Copyright End -->



    <!-- Back to Top -->
    <a href="#" class="btn btn-primary border-3 border-primary rounded-circle back-to-top"><i
            class="fa fa-arrow-up"></i></a>
    <!-- JavaScript Libraries -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-JobWAqYk5CSjWuVV3mxgS+MmccJqkrBaDhk8SKS1BW+71dJ9gzascwzW85UwGhxiSyR7Pxhu50k+Nl3+o5I49A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="{{ asset('customer/lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('customer/lib/waypoints/waypoints.min.js') }}"></script>
    <script src="{{ asset('customer/lib/lightbox/js/lightbox.min.js') }}"></script>
    <script src="{{ asset('customer/lib/owlcarousel/owl.carousel.min.js') }}"></script>

    <!-- Template Javascript -->
    <script src="{{ asset('customer/js/main.js') }}"></script>
    <script>
        function loadFile(event){
            var reader = new FileReader();

            reader.onload = function(){
                var output = document.getElementById('output')
                output.src = reader.result
            }
            reader.readAsDataURL(event.target.files[0])
        }
</script>
@yield('js-section')
</body>

</html>
