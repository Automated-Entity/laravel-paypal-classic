<?php

namespace Srmklive\PayPal\Tests\Mocks\Responses;

use GuzzleHttp\Utils;

trait Payments
{
	/**
	 * @return array
	 */
	private function showListBillingPlans()
	: array
	{
		return Utils::jsonDecode(
			'{
  "total_items": "166",
  "total_pages": "83",
  "plans": [
    {
      "id": "P-7DC96732KA7763723UOPKETA",
      "state": "ACTIVE",
      "name": "Plan with Regular and Trial Payment Definitions",
      "description": "Plan with regular and trial billing payment definitions.",
      "type": "FIXED",
      "create_time": "2017-08-22T04:41:52.836Z",
      "update_time": "2017-08-22T04:41:53.169Z",
      "links": [
        {
          "href": "https://api-m.sandbox.paypal.com//v1/payments/billing-plans/P-7DC96732KA7763723UOPKETA",
          "rel": "self",
          "method": "GET"
        }
      ]
    },
    {
      "id": "P-1TV69435N82273154UPWDU4I",
      "state": "INACTIVE",
      "name": "Plan with Regular Payment Definition",
      "description": "Plan with one regular payment definition, minimal merchant preferences, and no shipping fees or tax.",
      "type": "INFINITE",
      "create_time": "2017-08-22T04:41:55.623Z",
      "update_time": "2017-08-22T04:41:56.055Z",
      "links": [
        {
          "href": "https://api-m.sandbox.paypal.com//v1/payments/billing-plans/P-1TV69435N82273154UPWDU4I",
          "rel": "self",
          "method": "GET"
        }
      ]
    }
  ],
  "links": [
    {
      "href": "https://api-m.sandbox.paypal.com/v1/payments/billing-plans?page_size=2&page=1&start=3&status=active",
      "rel": "start",
      "method": "GET"
    },
    {
      "href": "https://api-m.sandbox.paypal.com/v1/payments/billing-plans?page_size=2&page=0&status=active",
      "rel": "previous_page",
      "method": "GET"
    },
    {
      "href": "https://api-m.sandbox.paypal.com/v1/payments/billing-plans?page_size=2&page=2&status=active",
      "rel": "next_page",
      "method": "GET"
    },
    {
      "href": "https://api-m.sandbox.paypal.com/v1/payments/billing-plans?page_size=2&page=82&status=active",
      "rel": "last",
      "method": "GET"
    }
  ]
}'
		);
	}
}
