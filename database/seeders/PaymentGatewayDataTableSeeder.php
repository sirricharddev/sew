<?php

namespace Database\Seeders;

use App\Enums\GatewayMode;
use App\Enums\Activity;
use App\Models\GatewayOption;
use App\Models\PaymentGateway;
use Dipokhalder\EnvEditor\EnvEditor;
use Illuminate\Database\Seeder;

class PaymentGatewayDataTableSeeder extends Seeder
{

    public array $gateways = [
        [
            "slug"    => "paypal",
            "status"  => Activity::ENABLE,
            "options" => [
                [
                    "option" => 'paypal_app_id',
                    "value"  => 'sb-qzxs18789565@business.example.com',
                ],
                [
                    "option" => 'paypal_client_id',
                    "value"  => 'AbcV-BG5b30hjofcp2dj41GB1OYXE8_9-egRlV8z4R7vHiA-1mgL3Fvj3pkrOJyq0dC_vHNRAh_tp74p'
                ],
                [
                    "option" => 'paypal_client_secret',
                    "value"  => 'EP6r5hEtBc6icJeEseZIiOJqSRnFvqNLI7yxjplzITaObh-t-516gGJ_EysXisLtEavaIMcjrG9aYprz'
                ],
                [
                    "option" => 'paypal_mode',
                    "value"  => GatewayMode::SANDBOX
                ],
                [
                    "option" => 'paypal_status',
                    "value"  => Activity::ENABLE
                ],
            ]
        ],
        [
            "slug"    => "stripe",
            "status"  => Activity::ENABLE,
            "options" => [
                [
                    "option" => 'stripe_key',
                    "value"  => 'pk_test_6rhnZv1NmRtSp5DfziBO8YFb00X65CfFwq',
                ],
                [
                    "option" => 'stripe_secret',
                    "value"  => 'sk_test_YKyuAoMHjXaUADW4SuKuXeIn0079Pu1OSD',
                ],
                [
                    "option" => 'stripe_mode',
                    "value"  => GatewayMode::SANDBOX,
                ],
                [
                    "option" => 'stripe_status',
                    "value"  => Activity::ENABLE,
                ],
            ]
        ],
        [
            "slug"    => "flutterwave",
            "status"  => Activity::ENABLE,
            "options" => [
                [
                    "option" => 'flutterwave_public_key',
                    "value"  => 'FLWPUBK_TEST-6902f8e874fe91b422045b09c02fff65-X',
                ],
                [
                    "option" => 'flutterwave_secret_key',
                    "value"  => 'FLWSECK_TEST-0890a04ecd60e99c0bb1c1adc1fb3422-X',
                ],
                [
                    "option" => 'flutterwave_mode',
                    "value"  => GatewayMode::SANDBOX,
                ],
                [
                    "option" => 'flutterwave_status',
                    "value"  => Activity::ENABLE,
                ],
            ]
        ],
        [
            "slug"    => "paystack",
            "status"  => Activity::ENABLE,
            "options" => [
                [
                    "option" => 'paystack_public_key',
                    "value"  => 'pk_test_370ce5565f2a937efae6314df2dccba2781bfa69',
                ],
                [
                    "option" => 'paystack_secret_key',
                    "value"  => 'sk_test_e3c7763a083c0fa457da5f105b8bdbe75312235d',
                ],
                [
                    "option" => 'paystack_payment_url',
                    "value"  => 'https://api.paystack.co',
                ],
                [
                    "option" => 'paystack_mode',
                    "value"  => GatewayMode::SANDBOX,
                ],
                [
                    "option" => 'paystack_status',
                    "value"  => Activity::ENABLE,
                ],
            ]
        ],
        [
            "slug"    => "sslcommerz",
            "status"  => Activity::ENABLE,
            "options" => [
                [
                    "option" => 'sslcommerz_store_name',
                    "value"  => 'testfoodkp1pi',
                ],
                [
                    "option" => 'sslcommerz_store_id',
                    "value"  => 'foodk6472ed754a400',
                ],
                [
                    "option" => 'sslcommerz_store_password',
                    "value"  => 'foodk6472ed754a400@ssl',
                ],
                [
                    "option" => 'sslcommerz_mode',
                    "value"  => GatewayMode::SANDBOX,
                ],
                [
                    "option" => 'sslcommerz_status',
                    "value"  => Activity::ENABLE,
                ],
            ]
        ],
        [
            "slug"    => "mollie",
            "status"  => Activity::ENABLE,
            "options" => [
                [
                    "option" => 'mollie_api_key',
                    "value"  => 'test_HfykwhBcTtAPeG7kc5MsRAgfMs9UgS',
                ],
                [
                    "option" => 'mollie_mode',
                    "value"  => GatewayMode::SANDBOX,
                ],
                [
                    "option" => 'mollie_status',
                    "value"  => Activity::ENABLE,
                ],
            ]
        ],
        [
            "slug"    => "senangpay",
            "status"  => Activity::ENABLE,
            "options" => [
                [
                    "option" => 'senangpay_merchant_id',
                    "value"  => '108168665310430',
                ],
                [
                    "option" => 'senangpay_secret_key',
                    "value"  => '5678-969',
                ],
                [
                    "option" => 'senangpay_mode',
                    "value"  => GatewayMode::SANDBOX,
                ],
                [
                    "option" => 'senangpay_status',
                    "value"  => Activity::ENABLE,
                ],
            ]
        ],
        [
            "slug"    => "bkash",
            "status"  => Activity::ENABLE,
            "options" => [
                [
                    "option" => 'bkash_app_key',
                    "value"  => '4f6o0cjiki2rfm34kfdadl1eqq',
                ],
                [
                    "option" => 'bkash_app_secret',
                    "value"  => '2is7hdktrekvrbljjh44ll3d9l1dtjo4pasmjvs5vl5qr3fug4b',
                ],
                [
                    "option" => 'bkash_username',
                    "value"  => 'sandboxTokenizedUser02'
                ],
                [
                    "option" => 'bkash_password',
                    "value"  => 'sandboxTokenizedUser02@12345'
                ],
                [
                    "option" => 'bkash_mode',
                    "value"  => GatewayMode::SANDBOX,
                ],
                [
                    "option" => 'bkash_status',
                    "value"  => Activity::ENABLE,
                ],
            ]
        ],
        [
            "slug"    => "paytm",
            "status"  => Activity::ENABLE,
            "options" => [
                [
                    "option" => 'paytm_merchant_id',
                    "value"  => 'MhjqFc42556626519745',
                ],
                [
                    "option" => 'paytm_merchant_key',
                    "value"  => '0dC_Dq!nif6e1Kie',
                ],
                [
                    "option" => 'paytm_merchant_website',
                    "value"  => 'WEBSTAGING',
                ],
                [
                    "option" => 'paytm_channel',
                    "value"  => 'WEB',
                ],
                [
                    "option" => 'paytm_industry_type',
                    "value"  => 'Retail',
                ],
                [
                    "option" => 'paytm_mode',
                    "value"  => GatewayMode::SANDBOX,
                ],
                [
                    "option" => 'paytm_status',
                    "value"  => Activity::ENABLE,
                ],
            ]
        ],
        [
            "slug"    => "razorpay",
            "status"  => Activity::ENABLE,
            "options" => [
                [
                    "option" => 'razorpay_key',
                    "value"  => 'rzp_test_eeBR6yhSmKHB65',
                ],
                [
                    "option" => 'razorpay_secret',
                    "value"  => '3wdPy38X8rge55MDf8VDf9k0',
                ],
                [
                    "option" => 'razorpay_mode',
                    "value"  => GatewayMode::SANDBOX,
                ],
                [
                    "option" => 'razorpay_status',
                    "value"  => Activity::ENABLE,
                ],
            ]
        ],
        [
            "slug"    => "mercadopago",
            "status"  => Activity::ENABLE,
            "options" => [
                [
                    "option" => 'mercadopago_client_id',
                    "value"  => '8223421224707412',
                ],
                [
                    "option" => 'mercadopago_client_secret',
                    "value"  => 'KBwpM55jmjgSa1hPBGtQlv4i5atxibJL',
                ],
                [
                    "option" => 'mercadopago_mode',
                    "value"  => GatewayMode::SANDBOX,
                ],
                [
                    "option" => 'mercadopago_status',
                    "value"  => Activity::ENABLE,
                ],
            ]
        ],
        [
            "slug"    => "cashfree",
            "status"  => Activity::ENABLE,
            "options" => [
                [
                    "option" => 'cashfree_app_id',
                    "value"  => 'TEST408093487955435d9cfa4c9493390804',
                ],
                [
                    "option" => 'cashfree_secret_key',
                    "value"  => 'TESTf3be36214baf99f6e3c9b0a15ed681794eb0006',
                ],
                [
                    "option" => 'cashfree_mode',
                    "value"  => GatewayMode::SANDBOX,
                ],
                [
                    "option" => 'cashfree_status',
                    "value"  => Activity::ENABLE,
                ],
            ]
        ],
        [
            "slug"    => "payfast",
            "status"  => Activity::ENABLE,
            "options" => [
                [
                    "option" => 'payfast_merchant_id',
                    "value"  => '10004002',
                ],
                [
                    "option" => 'payfast_merchant_key',
                    "value"  => 'q1cd2rdny4a53',
                ],
                [
                    "option" => 'payfast_passphrase',
                    "value"  => 'payfast',
                ],
                [
                    "option" => 'payfast_mode',
                    "value"  => GatewayMode::SANDBOX,
                ],
                [
                    "option" => 'payfast_status',
                    "value"  => Activity::ENABLE,
                ],
            ]
        ],
        [
            "slug"    => "skrill",
            "status"  => Activity::ENABLE,
            "options" => [
                [
                    "option" => 'skrill_merchant_email',
                    "value"  => 'demoqco@sun-fish.com',
                ],
                [
                    "option" => 'skrill_merchant_api_password',
                    "value"  => '60cede4a5aee9a3827f212ba45f88c61',
                ],
                [
                    "option" => 'skrill_mode',
                    "value"  => GatewayMode::SANDBOX,
                ],
                [
                    "option" => 'skrill_status',
                    "value"  => Activity::ENABLE,
                ],
            ]
        ],
        [
            "slug"    => "phonepe",
            "status"  => Activity::ENABLE,
            "options" => [
                [
                    "option" => 'phonepe_merchant_id',
                    "value"  => 'PGTESTPAYUAT',
                ],
                [
                    "option" => 'phonepe_merchant_user_id',
                    "value"  => 'MUID123',
                ],
                [
                    "option" => 'phonepe_key_index',
                    "value"  => '1',
                ],
                [
                    "option" => 'phonepe_key',
                    "value"  => '099eb0cd-02cf-4e2a-8aca-3e6c6aff0399',
                ],
                [
                    "option" => 'phonepe_mode',
                    "value"  => GatewayMode::SANDBOX,
                ],
                [
                    "option" => 'phonepe_status',
                    "value"  => Activity::ENABLE,
                ],
            ]
        ],
        [
            "slug"    => "iyzico",
            "status"  => Activity::ENABLE,
            "options" => [
                [
                    "option" => 'iyzico_api_key',
                    "value"  => 'sandbox-cOLruTj9vDbsesJqlQHFmtXl0UH7V84X',
                ],
                [
                    "option" => 'iyzico_secret_key',
                    "value"  => 'sandbox-kJ8SduMLlgGVeXgzHcmvQBKE7RcNR8Gs',
                ],
                [
                    "option" => 'iyzico_mode',
                    "value"  => GatewayMode::SANDBOX,
                ],
                [
                    "option" => 'iyzico_status',
                    "value"  => Activity::ENABLE,
                ],
            ]
        ],
        [
            "slug"    => "pesapal",
            "status"  => Activity::ENABLE,
            "options" => [
                [
                    "option" => 'pesapal_consumer_key',
                    "value"  => 'TDpigBOOhs+zAl8cwH2Fl82jJGyD8xev',
                ],
                [
                    "option" => 'pesapal_consumer_secret',
                    "value"  => '1KpqkfsMaihIcOlhnBo/gBZ5smw=',
                ],
                [
                    "option" => 'pesapal_ipn_id',
                    "value"  => '26872da4-2f3c-43a1-acdd-dd204344304b',
                ],
                [
                    "option" => 'pesapal_mode',
                    "value"  => GatewayMode::SANDBOX,
                ],
                [
                    "option" => 'pesapal_status',
                    "value"  => Activity::ENABLE,
                ],
            ]
        ],
        [
            "slug" => "midtrans",
            "status" => Activity::ENABLE,
            "options" => [
                [
                    "option" => 'midtrans_server_key',
                    "value" => 'SB-Mid-server-EToGodhQrotc5PtXM-FVDeuZ',
                ],
                [
                    "option" => 'midtrans_client_key',
                    "value" => 'SB-Mid-client-atvQnnDtM4Ih31c8',
                ],
                [
                    "option" => 'midtrans_mode',
                    "value" => GatewayMode::SANDBOX,
                ],
                [
                    "option" => 'midtrans_status',
                    "value" => Activity::ENABLE,
                ],
            ]
            ],
            [
                "slug" => "twocheckout",
                "status" => Activity::ENABLE,
                "options" => [
                    
                    [
                        "option" => 'twocheckout_seller_id',
                        "value"  => '255390680365',
                    ],
                    [
                        "option" => 'twocheckout_secret_key',
                        "value"  => 'iF^(4!VoE|NQqn+~v0gp',
                    ],
                    [
                        "option" => 'twocheckout_buy_link_secret_word',
                        "value"  => '*-x?QhYtu#Hc%6$nRd?WJGk2F!FcH6%**bT7vzgBf?3d2-sJeFHd-QATyY?vfmWQ',
                    ],
                    [
                        "option" => 'twocheckout_mode',
                        "value"  => GatewayMode::SANDBOX,
                    ],
                    [
                        "option" => 'twocheckout_status',
                        "value"  => Activity::ENABLE,
                    ],
                ]
            ]
    ];

    public function run(): void
    {
        $envService = new EnvEditor();
        if ($envService->getValue('DEMO')) {
            foreach ($this->gateways as $gateway) {
                $payment = PaymentGateway::where(['slug' => $gateway['slug']])->first();
                if ($payment) {
                    $payment->status = $gateway['status'];
                    $payment->save();
                }
                $this->gatewayOption($gateway['options']);
            }
        }
    }

    public function gatewayOption($options): void
    {
        if (!blank($options)) {
            foreach ($options as $option) {
                $gatewayOption = GatewayOption::where(['option' => $option['option']])->first();
                if ($gatewayOption) {
                    $gatewayOption->value = $option['value'];
                    $gatewayOption->save();
                }
            }
        }
    }
}
