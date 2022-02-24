<?php

namespace Srmklive\PayPal\Tests\Unit\Client;

use GuzzleHttp\Utils;
use PHPUnit\Framework\TestCase;
use Srmklive\PayPal\Tests\MockClientClasses;
use Srmklive\PayPal\Tests\MockRequestPayloads;
use Srmklive\PayPal\Tests\MockResponsePayloads;

class PaymentsTest extends TestCase
{
	use MockClientClasses;
	use MockRequestPayloads;
	use MockResponsePayloads;


	/** @test */
	public function it_can_show_billing_plan_details()
	: void
	{
		$expectedResponse = $this->showBatchPayoutResponse();

		$expectedEndpoint = 'https://api-m.sandbox.paypal.com/v1/payments/billing-plans/FYXMPQTX4JC9N';
		$expectedParams   = [
			'headers' => [
				'Accept'          => 'application/json',
				'Accept-Language' => 'en_US',
				'Authorization'   => 'Bearer some-token',
			],
		];

		$mockHttpClient = $this->mock_http_request(Utils::jsonEncode($expectedResponse), $expectedEndpoint, $expectedParams, 'get');

		$this->assertEquals($expectedResponse, Utils::jsonDecode($mockHttpClient->get($expectedEndpoint, $expectedParams)->getBody(), true));
	}
}
