<?php

return [
    'label'   => [
        'name'                       => 'Name',
        'email'                      => 'Email',
        'phone'                      => 'Phone',
        'product_name'               => 'Product Name',
        'product_category_id'        => 'Category',
        'product_brand_id'           => 'Brand',
        'barcode_id'                 => 'Barcode',
        'unit_id'                    => 'Unit',
        'tax_id'                     => 'Tax',
        'tax'                        => 'Tax',
        'buying_price'               => 'Buying Price',
        'selling_price'              => 'Selling Price',
        'can_purchasable'            => 'Can Purchasable',
        'purchasable'                => 'Purchasable',
        'show_stock_out'             => 'Show Stock Out',
        'maximum_purchase_quantity'  => 'Maximum Purchase Quantity',
        'low_stock_quantity_warning' => 'Low Stock Quantity Warning',
        'weight'                     => 'Weight',
        'refundable'                 => 'Refundable',
        'code'                       => 'Code',
        'sku'                        => 'SKU',
        'discount'                   => 'Discount',
        'discount_type'              => 'Discount Type',
        'start_date'                 => 'Start Date',
        'end_date'                   => 'End Date',
        'amount'                     => 'Amount',
        'status'                     => 'Status',
        'price'                      => 'Price',
        'role'                       => 'Role',
        'order_serial_no'            => 'Order Serial No',
        'date'                       => 'Date',
        'total'                      => 'Total',
        'shipping_charge'            => 'Shipping Charge',
        'payment_type'               => 'Payment Type',
        'payment_status'             => 'Payment Status',
        'quantity'                   => 'Quantity',
        'sold_quantity'              => 'Sold Quantity',
        'order_type'                 => 'Order Type',
        'customer'                   => 'Customer',
        'confirm'                    => 'Confirm',
        'congratulations'            => 'Congratulations!',
        'transaction_id'             => 'Transaction ID',
        'back_to_home'               => 'Back to Home',
        'back_to_payment'            => 'Back to Payment',
        'payment_method'             => 'Payment Method',
        'now'                        => 'Now',
        'balance'                    => 'Balance',
        'advance'                    => 'Advance',
        'all_roles'                  => 'All Roles',
        'all_users'                  => 'All Users',
        'user'                       => 'User',
        'title'                      => 'Title',
        'all_items'                  => 'All Items',
        'slug'                       => 'Slug',
        'type'                       => 'Type',
        "supplier"                   => "Supplier",
        "reference_no"               => "Reference No",
        "note"                       => "Note",
        "stock"                      => "Stock",
        "reason"                     => "Reason",
        "total_return_price"         => "Total Return Price",
        "source"                     => "Source",
        "parent_category"            => "Parent Category",
        "sales_report"               => "Sales Report",
        "product_report"             => "Product Report",
        "order_id"                   => "Order Id",
        "category"                   => "Category",
        "credit_balance_report"      => "Credit Balance Report"
    ],
    'message' => [
        'validation_error'                 => 'Validation Error.',
        'credentials_error'                => 'Credentials errors.',
        'credentials_invalid'              => 'Invalid credentials or you are blocked',
        'role_error'                       => 'Role errors.',
        'role_exist'                       => 'Role does not exist.',
        'login_success'                    => 'Login Successfully.',
        'logout_success'                   => 'Logged Out Successfully.',
        'invalid_api_key'                  => 'Invalid Api Key.',
        'user_match'                       => 'User not match.',
        'something_wrong'                  => 'Something wrong.',
        'permission_denied'                => 'The permission is denied.',
        'product_match'                    => 'Product not match.',
        'offer_product_exist'              => 'The product already added in another offer. When the offer is end then you can add this item again.',
        'minimum_order_amount'             => 'The minimum order amount is ',
        'coupon_date_expired'              => 'The coupon time is expired',
        'coupon_not_exist'                 => 'The coupon does not exist',
        'code_is_invalid'                  => 'The code is invalid.',
        'code_is_expired'                  => 'The code is expired.',
        'you_can_reset_your_password'      => 'Now you can reset your password.',
        'check_your_email_for_code'        => 'Please check your email for the code.',
        'check_your_phone_for_code'        => 'Please check your phone for the code.',
        'token_created_fail'               => 'The token created fail.',
        'email_does_not_exist'             => 'This email does not exist.',
        'phone_does_not_exist'             => 'This phone does not exist.',
        'user_does_not_exist'              => 'This User does not exist.',
        'phone_exist'                      => 'This phone already exist.',
        'otp_verify_success'               => 'The OTP verify is successfully.',
        'user_verify_success'              => 'The User verify is successfully.',
        'register_successfully'            => 'Register Successfully.',
        'reset_successfully'               => 'Your password reset Successfully.',
        'select_your_payment_method'       => 'Select your payment method',
        'payment_successful'               => 'Your payment has been successfully processed',
        'payment_canceled'                 => 'The payment is canceled',
        'payment_gateway_disable'          => 'The payment gateway is disable',
        'token_save'                       => 'The token saved successfully.',
        'token_is_invalid'                 => 'The token is invalid.',
        'order_accept'                     => 'The order already accepted.',
        'order_confirmed'                  => 'The order already confirmed.',
        'feature_disable'                  => 'This feature is disabled for the demo.',
        'time_slot_exist'                  => 'Time slots already exist.',
        'attribute_invalid'                => 'This attribute is invalid. Create attribute or attribute option.',
        'price_invalid'                    => 'This price amount provide invalid.',
        'product_attribute_invalid'        => 'This product attribute id provide invalid.',
        'product_attribute_option_invalid' => 'This product attribute option id provide invalid.',
        'sku_exist'                        => 'The sku has already been taken.',
        'resource_already_used'            => 'Cannot remove this resource permanently. It is related with another resource.',
        'variation_sku_required'           => 'The sku field is required.',
        'email_or_phone_required'          => 'The email or phone field is required.',
        'country_exist'                    => 'The Country has already been taken.',
        'product_tax_invalid'              => 'The tax field is required for all products.',
        'product_quantity_invalid'         => 'The quantity field is required for all products.',
        'product_invalid'                  => 'The product filed is required.',
        'product_price_invalid'            => 'The unit cost filed is required for all products.',
        'product_price_total_invalid'      => 'The total product unit cost is invalid.',
        'supplier_invalid'                 => 'The supplier is invalid.',
        'status_invalid'                   => 'The status is invalid.',
        'return_request_exist'             => 'The Return request already exist.',
        'minimum_one_outlet_required'      => 'The last outlet can not be delete',
        "email_send"                       => "Email Send Successfully.",
        "price_total_invalid"              => "The amount is invalid.",
        "the_form_is_valid"                => "The form is valid",
        'account_delete_success'           => 'Account Deleted Successfully.',
        'account_not_delete'               => 'You cannot delete your account if you have an active order.',
        "only_customer_delete"             => 'Only customers account can be delete',
        "phone_not_verified"               => "The phone is not verified",
        "email_not_verified"               => "The email is not verified",
        'coupon_limit_exceeded'            => 'The coupon limit has been exceeded',
        "register_not_completed"           => "Your registration has not been completed.",
        "the_price_field_is_required"      => "The price field is required",
        'product_attribute_required'        => 'This product attribute id provide required.',
    ]
];
