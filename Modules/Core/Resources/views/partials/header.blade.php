<!-- Start Navbar -->
<nav id="topnav" class="defaultscroll is-sticky bg-white dark:bg-slate-900">
    <div class="container relative py-0">
        <!-- Logo container-->
        <a class="logo w-28" href="{{ url('/') }}">
            <img src="{{ asset('assets/images/logo/logo.png') }}" class="inline-block dark:hidden" alt="">
            <img src="{{ asset('assets/images/logo/logo-dark.png') }}" class="hidden dark:inline-block" alt="">
        </a>

        <!-- End Logo container-->
        <div class="menu-extras">
            <div class="menu-item">
                <!-- Mobile menu toggle-->
                <a class="navbar-toggle" id="isToggle" onclick="toggleMenu()">
                    <div class="lines">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                </a>
                <!-- End mobile menu toggle-->
            </div>
        </div>

        <!--Login button Start-->
        <ul class="buy-button list-none mb-0">
            <li class="dropdown inline-block relative me-1">
                <button data-dropdown-toggle="dropdown" class="dropdown-toggle text-[20px]" type="button">
                    <i class="uil uil-search align-middle"></i>
                </button>
                <!-- Dropdown menu -->
                <div class="dropdown-menu absolute overflow-hidden end-0 m-0 mt-4 z-10 w-52 rounded-md bg-white dark:bg-slate-900 shadow dark:shadow-gray-800 hidden"
                    onclick="event.stopPropagation();">
                    <div class="relative">
                        <i class="uil uil-search text-lg absolute top-[3px] end-3"></i>
                        <input type="text" class="form-input h-9 pe-10 sm:w-44 w-36 border-0 focus:ring-0"
                            name="s" id="searchItem" placeholder="Search...">
                    </div>
                </div>
            </li>

            @if (Module::find('cart')->isEnabled())
                <livewire:cart::components.header-cart />
            @endif

            <li class="inline-block">
                <a href="javascript:void(0)"
                    class="h-9 w-9 inline-flex items-center justify-center tracking-wide align-middle duration-500 text-base text-center rounded-full bg-purple-600 hover:bg-purple-700 border border-purple-600 hover:border-purple-700 text-white"
                    data-modal-toggle="ContactUs">
                    <i class="mdi mdi-heart"></i>
                </a>
            </li>

            <li class="dropdown inline-block relative">
                <button data-dropdown-toggle="dropdown"
                    class="dropdown-toggle h-9 w-9 inline-flex items-center justify-center tracking-wide align-middle duration-500 text-base text-center rounded-full bg-purple-600 hover:bg-purple-700 border border-purple-600 hover:border-purple-700 text-white"
                    type="button">
                    <i class="mdi mdi-account"></i>
                </button>
                <!-- Dropdown menu -->
                <div class="dropdown-menu absolute end-0 m-0 mt-4 z-10 w-44 rounded-md bg-white dark:bg-slate-900 shadow dark:shadow-gray-800 hidden"
                    onclick="event.stopPropagation();">
                    <ul class="py-2 text-start" aria-labelledby="dropdownDefault">
                        <li>
                            <a href="shop-account.html" class="block py-1.5 px-4 hover:text-purple-600"><i
                                    class="uil uil-user align-middle me-1"></i> Account</a>
                        </li>
                        <li>
                            <a href="shop-cart.html" class="block py-1.5 px-4 hover:text-purple-600"><i
                                    class="uil uil-clipboard-notes align-middle me-1"></i> Order History</a>
                        </li>
                        <li>
                            <a href="shop-checkout.html" class="block py-1.5 px-4 hover:text-purple-600"><i
                                    class="uil uil-arrow-circle-down align-middle me-1"></i> Download</a>
                        </li>
                        <li class="border-t border-gray-100 dark:border-gray-800 my-2"></li>
                        <li>
                            <a href="auth-login.html" class="block py-1.5 px-4 hover:text-purple-600"><i
                                    class="uil uil-sign-out-alt align-middle me-1"></i> Logout</a>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
        <!--Login button End-->

        <div id="navigation">
            <!-- Navigation Menu-->
            <ul class="navigation-menu">

                @if (Route::has('home'))
                    <li>
                        <a href="{{ route('home') }}" class="sub-menu-item">Home</a>
                    </li>
                @endif


                @if (Route::has('real-estates'))
                    <li>
                        <a href="{{ route('real-estates') }}" class="sub-menu-item">Real Estates</a>
                    </li>
                @endif

                @if (Route::has('store'))
                    <li>
                        <a href="{{ route('store') }}" class="sub-menu-item">Store</a>
                    </li>
                @endif


                @if (Route::has('posts'))
                    <li>
                        <a href="{{ route('posts') }}" class="sub-menu-item">Blog</a>
                    </li>
                @endif

                @if (Route::has('contact-us'))
                    <li>
                        <a href="{{ route('contact-us') }}" class="sub-menu-item">Contact</a>
                    </li>
                @endif

            </ul><!--end navigation menu-->
        </div><!--end navigation-->
    </div><!--end container-->
</nav><!--end header-->
<!-- End Navbar -->

