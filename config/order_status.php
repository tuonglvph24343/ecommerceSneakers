<?php

return [

    'order_status_admin' => [
        'pending' => [
            'status' => 'Chờ xử lý',
            'details' => 'Đơn hàng của bạn hiện đang chờ xử lý'
        ],
        'processed_and_ready_to_ship' => [
            'status' => 'Đã xử lý và sẵn sàng giao hàng',
            'details' => 'Gói hàng của bạn đã được xử lý và sẽ sớm được gửi cho đối tác giao hàng của chúng tôi'
        ],
        'dropped_off' => [
            'status' => 'Đã gửi đi',
            'details' => 'Gói hàng của bạn đã được người bán gửi đi'
        ],
        'shipped' => [
            'status' => 'Đã vận chuyển',
            'details' => 'Gói hàng của bạn đã đến cơ sở logistics của chúng tôi'
        ],
        'out_for_delivery' => [
            'status' => 'Đang giao',
            'details' => 'Đối tác giao hàng của chúng tôi sẽ cố gắng giao gói hàng của bạn'
        ],
        'delivered' => [
            'status' => 'Đã giao',
            'details' => 'Đã giao'
        ],
        'canceled' => [
            'status' => 'Đã hủy',
            'details' => 'Đã hủy'
        ]

    ],


    'order_status_vendor' => [
        'pending' => [
            'status' => 'Pending',
            'details' => 'Your order is currently pending'
        ],
        'processed_and_ready_to_ship' => [
            'status' => 'Processed and ready to ship',
            'details' => 'Your pacakge has been processed and will be with our delivery parter soon'
        ]
    ]
];
