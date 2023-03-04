<?php

return [
    'FROM_EMAIL' => 'info@send1.in',
    'WHATSAPP_TOKEN'=>'Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJqdGkiOiIzMmZjZWQ4Zi1iYTY3LTRmMTUtODhiMC1lNTFhNmVkMzg4MmIiLCJ1bmlxdWVfbmFtZSI6ImluZm9Ac2VuZDEuaW4iLCJuYW1laWQiOiJpbmZvQHNlbmQxLmluIiwiZW1haWwiOiJpbmZvQHNlbmQxLmluIiwiYXV0aF90aW1lIjoiMTAvMTcvMjAyMiAxNDozNjo0OSIsImRiX25hbWUiOiIxNjI5OSIsImh0dHA6Ly9zY2hlbWFzLm1pY3Jvc29mdC5jb20vd3MvMjAwOC8wNi9pZGVudGl0eS9jbGFpbXMvcm9sZSI6IkFETUlOSVNUUkFUT1IiLCJleHAiOjI1MzQwMjMwMDgwMCwiaXNzIjoiQ2xhcmVfQUkiLCJhdWQiOiJDbGFyZV9BSSJ9.-fxDv9Gmo4janrs2HBmh7q0pYQqUA68-0T84po7nQGc',
    'VERIFICATION_OTP_SENT_SUCCESS' => "Verification otp sent to your phone successfully.",
    'OTP_VALID' => "OTP is valid.",
    'NO_RECORD_FOUND' => "No record found.",
    'TOKEN_EXPIRED' => "Token has been expired.",
    'INVALID_TOKEN' => "Token is invalid.",
    'INVALID_REQUIRED' => "Token is required.",
    'EMAIL_NOT_FOUND' => "This email not found.",
    'PHONE_NOT_FOUND' => "This phone is not found.",
    'UNAUTHORIZED' => "Unauthorized credentials.",
    'INVALID_CREDENTIALS' => "Unauthorized credentials.",
    'INVALID_USER_CREDENTIAL' => "Invalid email or password for this account.",
    'USER_IS_INACTIVE' => "The user is inactive.",
    'USER_IS_BANNED' => "The user is banned.",
    'SOMETHING_WENT_WRONG' => "Opps! something went wrong.",
    'LOGGED_OUT' => "Successfully logged out.",
    'TRY_AGAIN' => "Please try again.",
    'DATA_SAVED' => "Details saved successfully.",
    /* registration constants */
    'USER_REGISTERED_SUCCESS' => "Registration successfully, please check your email for verification.",
    'CLIENT_ADDED_SUCCESS' => "Client details has been save successfully.",
    'CLIENT_INACTIVE_SUCCESS' => "Client account inactive successfully.",
    'CLIENT_ACTIVE_SUCCESS' => "Client account active successfully.",
    'CLIENT_ADMIN_ADDED_SUCCESS' => "Client Admin user created successfully.",
    'CLIENT_ADMIN_DELETED_SUCCESS' => "Client Admin has been deleted successfully.",
    'CAMPAIGN_ADDED_SUCCESS' => "Campaign has been added successfully.",

    'PRODUCT_ADDED_SUCCESS' => "Product has been added successfully.",
    'PRODUCT_UPDATE_SUCCESS' => "Product has been updated successfully.",

    'PRODUCT_ACTIVE_SUCCESS' => "Product has been active successfully.",
    'PRODUCT_INACTIVE_SUCCESS' => "Product has been inactive successfully.",

    'PRODUCT_DELETED_SUCCESS' => "Product has been deleted successfully.",
    'RECIPIENT_ADDED_SUCCESS' => "Recipient details has been saved successfully.",
    'RECIPIENT_INACTIVE_SUCCESS' => "Recipient account inactive successfully.",
    'RECIPIENT_ACTIVE_SUCCESS' => "Recipient account active successfully.",
    'RECIPIENT_DELETED_SUCCESS' => "Recipient deleted successfully.",
    'RECIPIENT_BULKUPLOAD_SUCCESS' => "Recipient bulk uploaded successfully.",
    'RECIPIENT_EMAIL_TAKEN' => "Recipient already taken for this company.",


    'PRODUCT_REDEEMED_SUCCESS' => "Product redeemed successfully.",

    'MANAGER_ADDED_SUCCESS' => "Manager has been added successfully.",
    'MANAGER_INACTIVE_SUCCESS' => "Manager account inactive successfully.",
    'MANAGER_ACTIVE_SUCCESS' => "Manager account active successfully.",
    'MANAGER_DELETED_SUCCESS' => "Manager deleted successfully.",
    'GROUP_ADDED_SUCCESS' => "Group added successfully.",
    'COMPANY_INACTIVATED' => "Campany inactivated.",
    'LEAD_ADDED_SUCCESS' => "Enquiry submitted successfully.",
    'LEAD_ADDED_FAIL' => "Enquiry can't submitted same day.",
    'LOGO_ADDED_SUCCESS' => "Logo saved successfully.",
    'WHATSAPP_SETTING_ADDED_SUCCESS' =>'Setting saved successfully.',
    'MANAGER_EMAIL_TAKEN' => "Manager already taken for this company.",




    'CAMPAIGN_STATUS' => "Order dispatched successfully.",


    'WALLET_ADDED_SUCCESS' => "Wallet add successfully.",


    'S3_HOST_URL' => "https://send-staging.s3.ap-south-1.amazonaws.com/",

    // prod
    'PICKER_PRO_AUTH_TOKEN'=> '78f8c07b17ceeec0f4c51f00c9793cb6828167',
    'PICKER_PRO_FROM_PINCODE' => '401208',
    'PICKER_PRO_FROM_PHONE_NUMBER' => '7777051898',
    'PICKER_AUTH_TOKEN'=>'78f8c07b17ceeec0f4c51f00c9793cb6828167',
    'PICKER_FROM_PINCODE' => '401208',
    'PICKER_FROM_PHONE_NUMBER' => '07014585810',

    // staging
    // 'PICKER_AUTH_TOKEN'=> 'e2495ab1f1aa403c0fcb12e9e7fffed9135608',
    // 'PICKER_FROM_PINCODE' => '400059',
    // 'PICKER_FROM_PHONE_NUMBER' => '5432245432'


    // constants for pickker deliver status

    // refrence from https://docs.pickrr.com/#api-Tracking-Track_Order
    'PICKER_ORDER_DISPATCHED_STATUS' => [
        'OP' => 'Order Placed',
        'OM' => 'Order Manifested',
        'OC' => 'Order Cancelled',
        'PP' => 'Order Picked Up',
        'OD' => 'Order Dispatched',
        'OT' => 'Order in Transit',
        'OO' => 'Order Out for Delivery',
        'NDR' => 'Failed Attempt at Delivery',
        'DL' => 'Order Delivered',
        'RTO' => 'Order Returned Back',
        'RTO-OT' => 'RTO in Transit',
        'RTO-OO' => 'RTO out for delivery',
        'RTP' => 'RTO Reached Pickrr Warehouse',
        'RTD' => 'Order Returned to Consignee'
    ],
];
