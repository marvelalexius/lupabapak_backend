<?php

namespace App\Http\Controllers\Paypal;

use PayPalCheckoutSdk\Core\PayPalHttpClient;
use PayPalCheckoutSdk\Core\SandboxEnvironment;

trait PaypalPaymentTrait {
  /**
    * View directory of Payment Doku
    * @param null
    * @return string
    **/
    public function viewPrefix()
    {
        return 'payment.paypal.';
    }

    /**
     * Returns PayPal HTTP client instance with environment that has access
     * credentials context. Use this instance to invoke PayPal APIs, provided the
     * credentials have access.
     */
    public static function client()
    {
        return new PayPalHttpClient(self::environment());
    }

    public static function environment()
    {
        $clientId = env('PAYPAL_CLIENT');
        $clientSecret = env('PAYPAL_SECRET');

        return new SandboxEnvironment($clientId, $clientSecret);
    }
}