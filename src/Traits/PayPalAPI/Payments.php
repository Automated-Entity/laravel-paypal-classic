<?php

namespace Srmklive\PayPal\Traits\PayPalAPI;

/**
 * Trait created for old API, using new codebase
 */
trait Payments
{
	/**
	 * @param  int  $page
	 * @param  int  $size
	 * @param  bool  $totals
	 *
	 * @throws \Throwable
	 * @return array|\Psr\Http\Message\StreamInterface|string
	 */
	public function listBillingPlans(int $page = 1, int $size = 20, bool $totals = true)
	: \Psr\Http\Message\StreamInterface|array|string {
		$total_required = ($totals) ? 'yes' : 'no';
		$this->apiEndPoint = "v1/payments/billing-plans?page={$page}&page_size={$size}&total_required={$total_required}";

		$this->verb = 'get';

		return $this->doPayPalRequest(false);
	}

}
