<?php

namespace Srmklive\PayPal\Tests\Unit\Adapter;

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
	{
		$expectedResponse = $this->showBatchPayoutResponse();

		$expectedParams = 'FYXMPQTX4JC9N';

		$expectedMethod = '';

		$mockClient = $this->mock_client($expectedResponse, $expectedMethod, true);

		$mockClient->setApiCredentials($this->getMockCredentials());
		$mockClient->getAccessToken();

		$this->assertEquals($expectedResponse, $mockClient->{$expectedMethod}($expectedParams));
	}

}
