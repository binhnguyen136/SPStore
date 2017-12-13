                <!-- BEGIN SIDEBAR -->
                <div class="page-sidebar-wrapper">
                    <!-- BEGIN SIDEBAR --> -->
                    <div class="page-sidebar navbar-collapse collapse">
                        <!-- BEGIN SIDEBAR MENU -->
   
                        <ul class="page-sidebar-menu  page-header-fixed " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200" style="padding-top: 20px">
                            <!-- DOC: To remove the sidebar toggler from the sidebar you just need to completely remove the below "sidebar-toggler-wrapper" LI element -->
                            <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
                            <li class="sidebar-toggler-wrapper hide">
                                <div class="sidebar-toggler">
                                    <span></span>
                                </div>
                            </li>
                            <!-- END SIDEBAR TOGGLER BUTTON -->

                            <li class="nav-item @yield('homeActive')">
                                <a href="{{ url('admin') }}" class="nav-link">
                                    <i class="icon-home"></i>
                                    <span class="title">Thống kê</span>
                                    @yield('homeSelected')
                                </a>

                            </li>
                            <li class="heading">
                                <h3 class="uppercase">Cài đặt chung</h3>
                            </li>
                            <li class="nav-item @yield('infoActive')">
                                <a href="{{ url('admin/info') }}" class="nav-link">
                                    <i class="icon-info"></i>
                                    <span class="title">Thông tin chung</span>
                                    @yield('infoSelected')
                                </a>
                            </li>
                            <li class="nav-item @yield('navActive')">
                                <a href="{{ url('admin/nav') }}" class="nav-link">
                                    <i class="icon-grid"></i>
                                    <span class="title">Thanh điều hướng</span>
                                    @yield('navSelected')
                                </a>
                            </li>
                            <li class="nav-item @yield('slideActive')">
                                <a href="{{ url('admin/slide') }}" class="nav-link">
                                    <i class="icon-picture"></i>
                                    <span class="title">Slide ảnh</span>
                                    @yield('slideSelected')
                                </a>
                            </li>

                            <li class="heading">
                                <h3 class="uppercase">Nội dung</h3>
                            </li>
                            <li class="nav-item @yield('catActive')">
                                <a href="{{ url('admin/category') }}" class="nav-link">
                                    <i class="icon-pin"></i>
                                    <span class="title">Danh mục sản phẩm</span>
                                    @yield('catSelected')
                                </a>
                            </li>
                            <li class="nav-item @yield('productActive')">
                                <a href="{{ url('admin/product') }}" class="nav-link">
                                    <i class="icon-pin"></i>
                                    <span class="title">Sản phẩm</span>
                                    @yield('productSelected')
                                </a>
                            </li>

                            <li class="heading">
                                <h3 class="uppercase">Tài khoản</h3>
                            </li>
                            <li class="nav-item @yield('profileActive')">
                                <a href="{{ url('admin/profile') }}" class="nav-link">
                                    <i class="icon-settings"></i>
                                    <span class="title">Tài khoản của tôi</span>
                                    @yield('profileSelected')
                                </a>
                            </li>
                            <li class="nav-item @yield('cartActive')">
                                <a href="{{ url('admin/cart') }}" class="nav-link">
                                    <i class="fa fa-shopping-cart"></i>
                                    <span class="title">Đơn hàng</span>
                                    @yield('cartSelected')
                                </a>
                            </li>

                        </ul>
                        <!-- END SIDEBAR MENU -->
                        <!-- END SIDEBAR MENU -->
                    </div>
                    <!-- END SIDEBAR -->
                </div>
                <!-- END SIDEBAR -->