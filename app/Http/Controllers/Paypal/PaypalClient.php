<?php

namespace App\Http\Controllers\Paypal;

use PayPalCheckoutSdk\Core\PayPalHttpClient;
use PayPalCheckoutSdk\Core\SandboxEnvironment;
use PayPalCheckoutSdk\Core\ProductionEnvironment;
use App\PaymentPaypalConfig;
// ini_set('error_reporting', E_ALL); // or error_reporting(E_ALL);
// ini_set('display_errors', '1');
// ini_set('display_startup_errors', '1');

class PayPalClient {
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