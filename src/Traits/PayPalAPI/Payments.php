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
		$total_required    = ($totals) ? 'yes' : 'no';
		$this->apiEndPoint = "v1/payments/billing-plans?page={$page}&page_size={$size}&total_required={$total_required}";

		$this->verb = 'get';

		return $this->doPayPalRequest(false);
	}

	/**
	 * @throws \Throwable
	 */
	public function listPayments(int $page = 1, int $size = 20)
	: \Psr\Http\Message\StreamInterface|array|string {
		$this->apiEndPoint = "v1/payments/payment?start_index={$page}&count={$size}&sort_by=create_time&sort_order=desc";

		$this->verb = 'get';

		return $this->doPayPalRequest(false);
	}

	/**
	 * @throws \Throwable
	 */
	public function classicSearchPayment(int $page = 1)
	: \Psr\Http\Message\StreamInterface|array|string {
		$this->apiEndPoint = "v1/payments/payment/";

		$this->verb = 'get';

		return $this->doPayPalRequest(false);
	}

	/**
	 * @throws \Throwable
	 */
	public function classicListInvoices(int $page = 0, int $size = 20, bool $totals = true)
	: \Psr\Http\Message\StreamInterface|array|string {
		$total_required = ($totals) ? 'true' : 'false';

		$this->apiEndPoint = "v1/invoicing/invoices?page={$page}&page_size={$size}&total_count_required={$total_required}";
		$this->verb        = 'get';


		return $this->doPayPalRequest(false);
	}

	/**
	 * @throws \Throwable
	 */
	public function classicSearchInvoices(int $page = 1, int $size = 20, bool $totals = true)
	: \Psr\Http\Message\StreamInterface|array|string {
		$totals = ($totals === true) ? 'true' : 'false';

		if (collect($this->invoice_search_filters)->count() < 1) {
			$this->invoice_search_filters = [
				'currency_code' => $this->getCurrency(),
			];
		}

		$this->apiEndPoint = "v1/invoicing/invoices?page={$page}&page_size={$size}&total_required={$totals}";

//		$this->options['json'] = $this->invoice_search_filters;

		$this->verb = 'get';

		return $this->doPayPalRequest();
	}
}
