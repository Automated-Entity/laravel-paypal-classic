<?php

namespace Srmklive\PayPal\Tests;

use GuzzleHttp\Utils;
use JetBrains\PhpStorm\ArrayShape;
use GuzzleHttp\Client as HttpClient;
use Psr\Http\Message\ResponseInterface;
use GuzzleHttp\Psr7\Response as HttpResponse;
use GuzzleHttp\HandlerStack as HttpHandlerStack;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use GuzzleHttp\Handler\MockHandler as HttpMockHandler;

trait MockClientClasses
{
	private function mock_http_client($response)
	: HttpClient {
		$mock = new HttpMockHandler([
										new HttpResponse(
											200,
                [],
                ($response === false) ? '' : Utils::jsonEncode($response)
            ),
        ]);

        $handler = HttpHandlerStack::create($mock);

        return new HttpClient(['handler' => $handler]);
    }

    private function mock_http_request($expectedResponse, $expectedEndpoint, $expectedParams, $expectedMethod = 'post')
    {
        $set_method_name = 'setMethods';
        if (function_exists('onlyMethods')) {
            $set_method_name = 'onlyMethods';
        }

        $mockResponse = $this->getMockBuilder(ResponseInterface::class)
            ->getMock();
        $mockResponse->expects($this->exactly(1))
            ->method('getBody')
            ->willReturn($expectedResponse);

        $mockHttpClient = $this->getMockBuilder(HttpClient::class)
            ->{$set_method_name}([$expectedMethod])
            ->getMock();
        $mockHttpClient->expects($this->once())
            ->method($expectedMethod)
            ->with($expectedEndpoint, $expectedParams)
            ->willReturn($mockResponse);

        return $mockHttpClient;
    }

	private function mock_client($expectedResponse, $expectedMethod, $token = false)
	: \PHPUnit\Framework\MockObject\MockObject {
		$set_method_name = 'setMethods';
		if (function_exists('onlyMethods')) {
			$set_method_name = 'onlyMethods';
		}

		$methods = [$expectedMethod, 'setApiCredentials'];
		if ($token) {
			$methods[] = 'getAccessToken';
		}

        $mockClient = $this->getMockBuilder(PayPalClient::class)
            ->{$set_method_name}($methods)
            ->getMock();

        if ($token) {
            $mockClient->expects($this->exactly(1))
                ->method('getAccessToken');
        }

        $mockClient->expects($this->exactly(1))
            ->method('setApiCredentials');

        $mockClient->expects($this->exactly(1))
            ->method($expectedMethod)
            ->willReturn($expectedResponse);

        return $mockClient;
    }

    private function getMockCredentials(): array
    {
        return [
            'mode'    => 'sandbox',
            'sandbox' => [
				'client_id'     => 'some-client-id',
				'client_secret' => 'some-access-token',
				'app_id'        => 'some-app-id',
			],
			'payment_action' => 'Sale',
			'currency' => 'USD',
			'notify_url' => '',
			'locale' => 'en_US',
			'validate_ssl' => true,
		];
	}

	#[ArrayShape(['mode' => "string", 'sandbox' => "string[]", 'payment_action' => "string", 'currency' => "string", 'notify_url' => "string", 'locale' => "string", 'validate_ssl' => "bool"])]
	private function getApiCredentials()
	: array
	{
		return [
			'mode'           => 'sandbox',
			'sandbox'        => [
				'client_id'     => 'AbJgVQM6g57qPrXimGkBz1UaBOXn1dKLSdUj7BgiB3JhzJRCapzCnkPq6ycOOmgXHtnDZcjwLMJ2IdAI',
				'client_secret' => 'EPd_XBNkfhU3-MlSw6gpa6EJj9x8QBdsC3o77jZZWjcFy_hrjR4kzBP8QN3MPPH4g52U_acG4-ogWUxI',
				'app_id'        => 'APP-80W284485P519543T',
			],
			'payment_action' => 'Sale',
			'currency'       => 'USD',
            'notify_url'     => '',
            'locale'         => 'en_US',
            'validate_ssl'   => true,
        ];
    }
}
