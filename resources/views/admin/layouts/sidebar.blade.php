<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="">{{ $settings->site_name }}</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="">||</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="dropdown active">
                <a href="{{ route('admin.dashboard') }}" class="nav-link"><i
                        class="fas fa-fire"></i><span>Dashboard</span></a>

            </li>
            <li class="menu-header">Thương mại điện tử</li>

            <li
                class="dropdown {{ setActive(['admin.category.*', 'admin.sub-category.*', 'admin.child-category.*']) }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-list"></i>
                    <span>Quản lí doanh mục </span></a>
                <ul class="dropdown-menu">
                    <li class="{{ setActive(['admin.category.*']) }}"><a class="nav-link"
                            href="{{ route('admin.category.index') }}">Danh mục</a></li>
                    <li class="{{ setActive(['admin.sub-category.*']) }}"><a class="nav-link"
                            href="{{ route('admin.sub-category.index') }}">Danh mục phụ</a></li>
                    {{-- <li class="{{ setActive(['admin.child-category.*']) }}"> <a class="nav-link"
                            href="{{ route('admin.child-category.index') }}">Danh mục cấp dưới</a></li> --}}

                </ul>
            </li>

            <li
                class="dropdown {{ setActive([
                    'admin.brand.*',
                    'admin.products.*',
                    'admin.products-image-gallery.*',
                    'admin.products-variant.*',
                    'admin.products-variant-item.*',
                    'admin.seller-products.*',
                    'admin.seller-pending-products.*',
                    'admin.warehouse.*',
                    'admin.reviews.*',
                ]) }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-box"></i>
                    <span>Quản lí sản phẩm</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ setActive(['admin.brand.*']) }}"><a class="nav-link"
                            href="{{ route('admin.brand.index') }}">Thương hiệu</a></li>
                    <li
                        class="{{ setActive([
                            'admin.products.*',
                            'admin.products-image-gallery.*',
                            'admin.products-variant.*',
                            'admin.products-variant-item.*',
                            //     'admin.reviews.*',
                            //     'admin.warehouse.*',
                        ]) }}">
                        <a class="nav-link" href="{{ route('admin.products.index') }}">Sản phẩm</a>
                    </li>
                    {{-- <li class="{{ setActive(['admin.seller-products.*']) }}"><a class="nav-link"
                            href="{{ route('admin.seller-products.index') }}">Seller Products</a></li>
                    <li class="{{ setActive(['admin.seller-pending-products.*']) }}"><a class="nav-link"
                            href="{{ route('admin.seller-pending-products.index') }}">Seller Pending Products</a></li> --}}
                    <li class="{{ setActive(['admin.warehouse.*']) }}"><a class="nav-link"
                            href="{{ route('admin.warehouse.index') }}">Kho hàng</a></li>
                    <li class="{{ setActive(['admin.reviews.*']) }}"><a class="nav-link"
                            href="{{ route('admin.reviews.index') }}">Đánh giá sản phẩm</a></li>

                </ul>
            </li>



            <li
                class="dropdown {{ setActive([
                    'admin.order.*',
                    'admin.pending-orders',
                    'admin.processed-orders',
                    'admin.dropped-off-orders',
                    'admin.shipped-orders',
                    'admin.out-for-delivery-orders',
                    'admin.delivered-orders',
                    'admin.canceled-orders',
                ]) }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-cart-plus"></i>
                    <span>Đơn hàng</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ setActive(['admin.order.*']) }}"><a class="nav-link"
                            href="{{ route('admin.order.index') }}">Tất cả đơn hàng</a></li>
                    <li class="{{ setActive(['admin.pending-orders']) }}"><a class="nav-link"
                            href="{{ route('admin.pending-orders') }}">Tất cả đơn hàng chờ xử lý</a></li>
                    <li class="{{ setActive(['admin.processed-orders']) }}"><a class="nav-link"
                            href="{{ route('admin.processed-orders') }}">Tất cả đơn hàng đã xử lý</a></li>
                    <li class="{{ setActive(['admin.dropped-off-orders']) }}"><a class="nav-link"
                            href="{{ route('admin.dropped-off-orders') }}">Tất cả đơn hàng đã gửi đi</a></li>

                    <li class="{{ setActive(['admin.shipped-orders']) }}"><a class="nav-link"
                            href="{{ route('admin.shipped-orders') }}"> Đơn hàng đã vận chuyển</a></li>
                    <li class="{{ setActive(['admin.out-for-delivery-orders']) }}"><a class="nav-link"
                            href="{{ route('admin.out-for-delivery-orders') }}">Tất cả đơn hàng đang giao</a></li>


                    <li class="{{ setActive(['admin.delivered-orders']) }}"><a class="nav-link"
                            href="{{ route('admin.delivered-orders') }}">Tất cả đơn hàng đã giao</a></li>

                    <li class="{{ setActive(['admin.canceled-orders']) }}"><a class="nav-link"
                            href="{{ route('admin.canceled-orders') }}">Tất cả đơn hàng đã hủy</a></li>

                </ul>
            </li>

            <li class="{{ setActive(['admin.transaction']) }}"><a class="nav-link"
                    href="{{ route('admin.transaction') }}"><i class="fas fa-money-bill-alt"></i>
                    <span>Giao dịch</span></a>
            </li>

            <li
                class="dropdown {{ setActive([
                    'admin.vendor-profile.*',
                    'admin.coupons.*',
                    'admin.shipping-rule.*',
                    'admin.payment-settings.*',
                    'admin.flash-sale.*',
                ]) }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i>
                    <span>Thương mại</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ setActive(['admin.flash-sale.*']) }}"><a class="nav-link"
                            href="{{ route('admin.flash-sale.index') }}"> Khuyến mãi </a></li>
                    <li class="{{ setActive(['admin.coupons.*']) }}"><a class="nav-link"
                            href="{{ route('admin.coupons.index') }}">Phiếu giảm giá</a></li>
                    <li class="{{ setActive(['admin.shipping-rule.*']) }}"><a class="nav-link"
                            href="{{ route('admin.shipping-rule.index') }}">Quy định vận chuyển</a></li>
                    <li class="{{ setActive(['admin.vendor-profile.*']) }}"><a class="nav-link"
                            href="{{ route('admin.vendor-profile.index') }}">Hồ sơ nhà cung cấp</a></li>
                    <li class="{{ setActive(['admin.payment-settings.*']) }}"><a class="nav-link"
                            href="{{ route('admin.payment-settings.index') }}">Cài đặt thanh toán</a></li>

                </ul>
            </li>

            {{-- <li class="dropdown {{ setActive(['admin.withdraw-method.*', 'admin.withdraw.index']) }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-wallet"></i>
                    <span>Withdraw Payments</span></a>
                <ul class="dropdown-menu">

                    <li class="{{ setActive(['admin.withdraw-method.*']) }}"><a class="nav-link"
                            href="{{ route('admin.withdraw-method.index') }}">Withdraw Mehtod</a></li>

                    <li class="{{ setActive(['admin.withdraw.index']) }}"><a class="nav-link"
                            href="{{ route('admin.withdraw.index') }}">Withdraw List</a></li>

                </ul>
            </li> --}}

            <li
                class="dropdown {{ setActive([
                    'admin.slider.*',
                    'admin.vendor-condition.index',
                    'admin.about.index',
                    'admin.terms-and-conditions.index',
                    'admin.home-page-setting',
                ]) }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-cog"></i>
                    <span>Quản lý trang web</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ setActive(['admin.slider.*']) }}"><a class="nav-link"
                            href="{{ route('admin.slider.index') }}">Slider</a></li>

                    <li class="{{ setActive(['admin.home-page-setting']) }}"><a class="nav-link"
                            href="{{ route('admin.home-page-setting') }}">Cài đặt trang chủ</a></li>

                    {{-- <li class="{{ setActive(['admin.vendor-condition.index']) }}"><a class="nav-link"
                            href="{{ route('admin.vendor-condition.index') }}">Vendor Condition</a></li> --}}
                    <li class="{{ setActive(['admin.about.index']) }}"><a class="nav-link"
                            href="{{ route('admin.about.index') }}">Giới thiệu trang</a></li>
                    <li class="{{ setActive(['admin.terms-and-conditions.index']) }}"><a class="nav-link"
                            href="{{ route('admin.terms-and-conditions.index') }}">Trang điều khoản</a></li>

                </ul>
            </li>

            <li
                class="dropdown {{ setActive(['admin.advertisement.*']) }}">


                <a class="nav-link {{ setActive(['admin.advertisement.*']) }}"
                    href="{{ route('admin.advertisement.index') }}"><i class="fas fa-ad"></i>
                    <span>Quảng cáo</span></a>
            </li>

            {{-- <li
                class="dropdown {{ setActive(['admin.blog-category.*', 'admin.blog.*', 'admin.blog-comments.index']) }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                        class="fab fa-blogger-b"></i> <span>Manage Blog</span></a>
                <ul class="dropdown-menu">

                    <li class="{{ setActive(['admin.blog-category.*']) }}"><a class="nav-link"
                            href="{{ route('admin.blog-category.index') }}">Categories</a></li>
                    <li class="{{ setActive(['admin.blog.*']) }}"><a class="nav-link"
                            href="{{ route('admin.blog.index') }}">Blogs</a></li>
                    <li class="{{ setActive(['admin.blog-comments.index']) }}"><a class="nav-link"
                            href="{{ route('admin.blog-comments.index') }}">Blog Comments</a></li>
                </ul>
            </li> --}}

            {{-- <li><a class="nav-link {{ setActive(['admin.messages.index']) }}"
                href="{{ route('admin.messages.index') }}"><i class="fas fa-user"></i>
                <span>Messages</span></a></li> --}}



            <li class="menu-header">Cài đặt & Thêm</li>


            <li
                class="dropdown {{ setActive([
                    'admin.footer-info.index',
                    'admin.footer-socials.*',
                    'admin.footer-grid-two.*',
                    'admin.footer-grid-three.*',
                ]) }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                        class="fas fa-th-large"></i><span>Chân trang</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ setActive(['admin.footer-info.index']) }}"><a class="nav-link"
                            href="{{ route('admin.footer-info.index') }}">Thông tin chân trang</a></li>

                    <li class="{{ setActive(['admin.footer-socials.*']) }}"><a class="nav-link"
                            href="{{ route('admin.footer-socials.index') }}">Chân trang mạng xã hội</a></li>

                    <li class="{{ setActive(['admin.footer-grid-two.*']) }}"><a class="nav-link"
                            href="{{ route('admin.footer-grid-two.index') }}">Chân trang Grid 2</a></li>

                    <li class="{{ setActive(['admin.footer-grid-three.*']) }}"><a class="nav-link"
                            href="{{ route('admin.footer-grid-three.index') }}">Chân trang Grid 3</a></li>

                </ul>
            </li>
            <li
                class="dropdown {{ setActive([
                    'admin.vendor-requests.index',
                    'admin.customer.index',
                    'admin.vendor-list.index',
                    'admin.manage-user.index',
                    'admin-list.index',
                    'admin.admin-list.index',
                ]) }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-users"></i>
                    <span>Người dùng</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ setActive(['admin.customer.index']) }}"><a class="nav-link"
                            href="{{ route('admin.customer.index') }}">Danh sách khách hàng</a></li>
                    <li class="{{ setActive(['admin.vendor-list.index']) }}"><a class="nav-link"
                            href="{{ route('admin.vendor-list.index') }}">Danh sách nhà cung cấp</a></li>
                    {{-- 
                    <li class="{{ setActive(['admin.vendor-requests.index']) }}"><a class="nav-link"
                            href="{{ route('admin.vendor-requests.index') }}">Pending vendors</a></li> --}}

                    <li class="{{ setActive(['admin.admin-list.index']) }}"><a class="nav-link"
                            href="{{ route('admin.admin-list.index') }}">Danh sách admin</a></li>

                    <li class="{{ setActive(['admin.manage-user.index']) }}"><a class="nav-link"
                            href="{{ route('admin.manage-user.index') }}">Quản lí người dùng</a></li>

                </ul>
            </li>
            <li
                class="dropdown {{ setActive(['admin.subscribers.*']) }}">


                <a class="nav-link {{ setActive(['admin.subscribers.*']) }}"
                    href="{{ route('admin.subscribers.index') }}"><i class="fas fa-user"></i>
                    <span>Người đăng kí</span></a>
            </li>





            <li
                class="dropdown {{ setActive(['admin.settings.*']) }}">
                <a class="nav-link {{ setActive(['admin.settings.*']) }}"
                    href="{{ route('admin.settings.index') }}"><i class="fas fa-user"></i>
                    <span>Cài đặt</span></a>
            </li>

        </ul>

    </aside>
</div>
