<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // add product into cart
        $(document).on('submit', '.shopping-cart-form', function(e) {
            e.preventDefault();
            let formData = $(this).serialize();

            $.ajax({
                method: 'POST',
                data: formData,
                url: "{{ route('add-to-cart') }}",
                success: function(data) {
                    if (data.status === 'success') {
                        getCartCount()
                        fetchSidebarCartProducts()
                        $('.mini_cart_actions').removeClass('d-none');
                        toastr.success(data.message);
                    } else if (data.status === 'error') {
                        toastr.error(data.message);
                    }
                },
                error: function(data) {

                }
            })
        })

        function getCartCount() {
            $.ajax({
                method: 'GET',
                url: "{{ route('cart-count') }}",
                success: function(data) {
                    $('#cart-count').text(data);
                },
                error: function(data) {

                }
            })
        }

        function fetchSidebarCartProducts() {
            $.ajax({
                method: 'GET',
                url: "{{ route('cart-products') }}",
                success: function(data) {
                    console.log(data);
                    $('.mini_cart_wrapper').html("");
                    var html = '';
                    for (let item in data) {
                        let product = data[item];
                        html += `
                        <li id="mini_cart_${product.rowId}">
                            <div class="wsus__cart_img">
                                <a href="{{ url('product-detail') }}/${product.options.slug}"><img src="{{ asset('/') }}${product.options.image}" alt="product" class="img-fluid w-100"></a>
                                <a class="wsis__del_icon remove_sidebar_product" data-id="${product.rowId}" href=""><i class="fas fa-minus-circle"></i></a>
                            </div>
                            <div class="wsus__cart_text">
                                <a class="wsus__cart_title" href="{{ url('product-detail') }}/${product.options.slug}">${product.name}</a>
                                <p><span class="cart-price">${formatCurrency(product.price)}</span> {{ $settings->currency_icon }}</p>
                                <small>Tổng cộng: <span class="cart-price">${formatCurrency(product.options.variants_total)}</span> {{ $settings->currency_icon }}</small>
                                <br>
                                <small>Số lượng: ${product.qty}</small>
                            </div>
                        </li>`
                    }

                    $('.mini_cart_wrapper').html(html);
                    formatCartPrices(); // Định dạng số tiền sau khi hiển thị giỏ hàng
                    getSidebarCartSubtoal();

                },
                error: function(data) {

                }
            })
        }

        // remove product from sidebar cart
        $('body').on('click', '.remove_sidebar_product', function(e) {
            e.preventDefault()
            let rowId = $(this).data('id');
            $.ajax({
                method: 'POST',
                url: "{{ route('cart.remove-sidebar-product') }}",
                data: {
                    rowId: rowId
                },
                success: function(data) {
                    let productId = '#mini_cart_' + rowId;
                    $(productId).remove()

                    getSidebarCartSubtoal()

                    if ($('.mini_cart_wrapper').find('li').length === 0) {
                        $('.mini_cart_actions').addClass('d-none');
                        $('.mini_cart_wrapper').html(
                            '<li class="text-center">Cart Is Empty!</li>');
                    }
                    toastr.success(data.message)
                },
                error: function(data) {
                    console.log(data);
                }
            })
        })

        // get sidebar cart sub total
        function getSidebarCartSubtoal() {
            $.ajax({
                method: 'GET',
                url: "{{ route('cart.sidebar-product-total') }}",
                success: function(data) {
                    $('#mini_cart_subtotal').text(formatCurrency(data) +
                        " {{ $settings->currency_icon }}");
                },
                error: function(data) {

                }
            })
        }

        // Hàm để định dạng số tiền với dấu chấm phân cách hàng nghìn
        function formatCurrency(value) {
            return parseFloat(value).toLocaleString('vi-VN'); // Định dạng tiền tệ theo chuẩn Việt Nam
        }

        // Định dạng lại số tiền sau khi thêm vào giỏ hàng hoặc xóa sản phẩm
        function formatCartPrices() {
            $('.cart-price').each(function() {
                let price = parseFloat($(this).text().replace(/[^\d]/g, ''));
                $(this).text(formatCurrency(price));
            });
        }

        // add product to wishlist
        $('.add_to_wishlist').on('click', function(e) {
            e.preventDefault();
            let id = $(this).data('id');

            $.ajax({
                method: 'GET',
                url: "{{ route('wishlist.store') }}",
                data: {
                    id: id
                },
                success: function(data) {
                    if (data.status === 'success') {
                        $('#wishlist_count').text(data.count)
                        toastr.success(data.message);
                    } else if (data.status === 'error') {
                        toastr.error(data.message);
                    }
                },
                error: function(data) {
                    console.log(data);
                }
            })
        })

        // newsletter
        $('#newsletter').on('submit', function(e) {
            e.preventDefault();
            let data = $(this).serialize();

            $.ajax({
                method: 'POST',
                url: "{{ route('newsletter-request') }}",
                data: data,
                beforeSend: function() {
                    $('.subscribe_btn').text('Loading...');
                },
                success: function(data) {
                    if (data.status === 'success') {
                        $('.subscribe_btn').text('Subscribe');
                        $('.newsletter_email').val('');
                        toastr.success(data.message);

                    } else if (data.status === 'error') {

                        $('.subscribe_btn').text('Subscribe');
                        toastr.error(data.message);
                    }
                },
                error: function(data) {
                    let errors = data.responseJSON.errors;
                    if (errors) {
                        $.each(errors, function(key, value) {
                            toastr.error(value);
                        })
                    }
                    $('.subscribe_btn').text('Subscribe');
                }
            })
        })

        // Show product modal
        $('.show_product_modal').on('click', function() {
            let id = $(this).data('id');

            $.ajax({
                method: 'GET',
                url: '{{ route('show-product-modal', ':id') }}'.replace(":id", id),
                beforeSend: function() {
                    $('.product-modal-content').html('<span class="loader"></span>')
                },
                success: function(response) {
                    $('.product-modal-content').html(response)
                },
                error: function(xhr, status, error) {

                },
                complete: function() {

                }
            })
        })
    })
</script>
