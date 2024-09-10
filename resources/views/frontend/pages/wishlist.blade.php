@extends('frontend.layouts.master')

@section('title')
{{$settings->site_name}} ||  Danh sách yêu thích
@endsection

@section('content')
    <!--============================
        BREADCRUMB START
    ==============================-->
    <section id="wsus__breadcrumb">
        <div class="wsus_breadcrumb_overlay">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h4> Danh sách yêu thích</h4>
                        <ul>
                            <li><a href="#">trang chủ</a></li>
                            <li><a href="#">sản phẩm</a></li>
                            <li><a href="#"> Danh sách yêu thích</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--============================
        BREADCRUMB END
    ==============================-->


    <!--============================
        CART VIEW PAGE START
    ==============================-->
    <section id="wsus__cart_view">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="wsus__cart_list wishlist">
                        <div class="table-responsive">
                            <table>
                                <tbody>
                                    <tr class="d-flex">
                                        <th class="wsus__pro_img">
                                            Mục sản phẩm
                                        </th>

                                        <th class="wsus__pro_name" style="width:500px">
                                            Chi tiết sản phẩm
                                        </th>

                                        <th class="wsus__pro_status">
                                            Số lượng
                                        </th>

                                        <th class="wsus__pro_tk" style="width:238px" >
                                            Giá
                                        </th>

                                        <th class="wsus__pro_icon">
                                            Hành động
                                        </th>
                                    </tr>
                                    @foreach ($wishlistProducts as $item)

                                    <tr class="d-flex">
                                        <td class="wsus__pro_img"><img src="{{asset($item->product->thumb_image)}}" alt="product"
                                                class="img-fluid w-100">
                                            <a href="{{route('user.wishlist.destory', $item->id)}}"><i class="far fa-times"></i></a>
                                        </td>

                                        <td class="wsus__pro_name" style="width:500px">
                                            <p>{{$item->product->name}}</p>
                                        </td>

                                        <td class="wsus__pro_status">
                                            <p>{{$item->product->qty}}</p>
                                        </td>

                                        <td class="wsus__pro_tk" style="width:238px">
                                            <h6>
                                                {{ number_format($item->product->price, 0, ',', '.') }}{{$settings->currency_icon}}
                                            </h6>
                                        </td>

                                        <td class="">
                                            <a class="common_btn" href="{{route('product-detail', $item->product->slug)}}">Xem sản phẩm</a>
                                        </td>
                                    </tr>

                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--============================
        CART VIEW PAGE END
    ==============================-->
@endsection

@push('scripts')

@endpush
