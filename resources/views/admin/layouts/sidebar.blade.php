<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="index.html">Luxury Sneakers</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">LS</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Bảng điều khiển</li>
            <li class="dropdown active">
                <a href="{{ route('admin.dashboard') }}" class="nav-link "><i class="fas fa-fire"></i><span>Dashboard</span></a>
            </li>
            <li class="menu-header">Starter</li>

            <li class="dropdown {{ setActive(['admin.category.*', 'admin.sub-category.*', 'admin.child-category.*']) }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-list"></i>
                    <span>Quản lý danh mục</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ setActive(['admin.category.*']) }}"><a class="nav-link" href="{{ route('admin.category.index') }}">Danh mục</a></li>
                    <li class="{{ setActive(['admin.sub-category.*']) }}"><a class="nav-link" href="{{ route('admin.sub-category.index') }}">Danh mục phụ</a></li>
                    <li class="{{ setActive(['admin.child-category.*']) }}"> <a class="nav-link" href="{{ route('admin.child-category.index') }}">Danh mục con </a></li>

                </ul>
            </li>

            <li class="dropdown {{ setActive(['admin.brand.*']) }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-cog"></i>
                    <span>Quản lý sản phẩm</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ setActive(['admin.brand.*']) }}"><a class="nav-link" href="{{ route('admin.brand.index') }}">Thương hiệu</a></li>
                </ul>
                <ul class="dropdown-menu">
                    <li class="{{ setActive(['admin.product.*']) }}"><a class="nav-link" href="{{ route('admin.products.index') }}">Sản phẩm</a></li>
                </ul>
            </li>

            <li class="dropdown {{ setActive([
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
                    <li class="{{ setActive(['admin.order.*']) }}"><a class="nav-link" href="{{ route('admin.order.index') }}">Tất cả đơn hàng </a></li>
                    <li class="{{ setActive(['admin.pending-orders']) }}"><a class="nav-link" href="{{ route('admin.pending-orders') }}">Đơn hàng chờ xử lý</a></li>
                    <li class="{{ setActive(['admin.processed-orders']) }}"><a class="nav-link" href="{{ route('admin.processed-orders') }}">Đơn hàng đã xử lý</a></li>
                    <li class="{{ setActive(['admin.dropped-off']) }}"><a class="nav-link" href="{{ route('admin.dropped-off-orders') }}">Đơn hàng đã gửi đi</a></li>

                    <li class="{{ setActive(['admin.shipped-orders']) }}"><a class="nav-link" href="{{ route('admin.shipped-orders') }}">Đơn hàng đã vận chuyển</a></li>
                    <li class="{{ setActive(['admin.out-for-delivery-orders']) }}"><a class="nav-link" href="{{ route('admin.out-for-delivery-orders') }}">Đơn hàng đang giao</a></li>


                    <li class="{{ setActive(['admin.delivered-orders']) }}"><a class="nav-link" href="{{ route('admin.delivered-orders') }}">Đơn hàng đã giao</a></li>

                    <li class="{{ setActive(['admin.canceled-orders']) }}"><a class="nav-link" href="{{ route('admin.canceled-orders') }}">Đơn hàng đã hủy</a></li>

                </ul>
            </li>

            <li class="{{ setActive(['admin.transaction']) }}"><a class="nav-link" href="{{ route('admin.transaction') }}"><i class="fas fa-money-bill-alt"></i>
                    <span>Giao dịch</span></a>
            </li>

            <li class="dropdown {{ setActive([
                    'admin.vendor-profile.*',
                    'admin.coupons.*',
                    'admin.shipping-rule.*',
                    'admin.payment-settings.*',
                ]) }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i>
                    <span>Thương mại điện tử</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ setActive(['admin.vendor-profile.*']) }}"><a class="nav-link" href="{{ route('admin.flash-sale.index') }}">Khuyến mãi nhanh</a></li>
                    <li class="{{ setActive(['admin.coupons.*']) }}"><a class="nav-link" href="{{ route('admin.coupons.index') }}">Mã giảm giá</a>
                    </li>
                    <li class="{{ setActive(['admin.shipping-rule.*']) }}"><a class="nav-link" href="{{ route('admin.shipping-rule.index') }}">Quy tắc giao hàng</a></li>
                    <li class="{{ setActive(['admin.vendor-profile.*']) }}"><a class="nav-link" href="{{ route('admin.vendor-profile.index') }}">Hồ sơ nhà cung cấp</a></li>
                    <li class="{{ setActive(['admin.payment-settings.*']) }}"><a class="nav-link" href="{{ route('admin.payment-settings.index') }}">Cài đặt thanh toán</a></li>

                </ul>
            </li>

            <li class="dropdown {{ setActive(['admin.slider.*']) }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-cog"></i>
                    <span>Quản lý trang Web</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ setActive(['admin.slider.*']) }}"><a class="nav-link" href="{{ route('admin.slider.index') }}">Slider</a></li>

                    <li class="{{ setActive(['admin.slider.*']) }}"><a class="nav-link" href="{{ route('admin.home-page-setting') }}">Cài đặt trang chủ</a></li>
                </ul>
            </li>

            <li><a class="nav-link" href="{{ route('admin.settings.index') }}"><i class="fas fa-wrench"></i>
                    <span>Cài đặt</span></a></li>
            {{-- <li class="dropdown">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i>
                    <span>Bố cục</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="layout-default.html">Bố cục mặc định</a></li>
                   
                    <li><a class="nav-link" href="layout-top-navigation.html">Điều hướng</a></li>
                </ul>
            </li> --}}



        </ul>
    </aside>
</div>