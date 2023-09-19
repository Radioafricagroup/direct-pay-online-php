<?php
namespace Rag\DirectPayOnline\Request;
use Rag\DirectPayOnline\Request;

/**
 * Class RefundTokenRequest
 * @package Rag\DirectPayOnline\Request
 *
 * @see     https://directpayonline.atlassian.net/wiki/spaces/API/pages/808949/refundToken
 */
class RefundTokenRequest extends Request
{
	private $_transactionToken = "";
	private $_companyRef = "";

	/**
	 * @return string
	 */
	function getTransactionToken()
	{
		return $this->_transactionToken;
	}

	/**
	 * @param string $transactionToken
	 */
	function setTransactionToken($transactionToken)
	{
		$this->_transactionToken = $transactionToken;
	}

	/**
	 * @return string
	 */
	function getRefundAmount()
	{
		return $this->_transactionToken;
	}

	/**
	 * @param string $refundAmount
	 */
	function setRefundAmount($refundAmount)
	{
		$this->_transactionToken = $refundAmount;
	}

	/**
	 * @return string
	 */
	function getCompanyRef()
	{
		return $this->_companyRef;
	}

	/**
	 * @param string $companyRef
	 */
	function setCompanyRef($companyRef)
	{
		$this->_companyRef = $companyRef;
	}

	/**
	 * Makes verifyToken request
	 * The XML response will convert to PHP array.
	 *
	 * @return mixed
	 */
	function execute()
	{
		if(!$this->getTransactionToken() && !$this->getCompanyRef()) {
			exit("TransactionToken or CompanyRef must be set.");
		}

		$xml = "";

		$xml .= '<?xml version="1.0" encoding="utf-8"?>';
		$xml .= "<API3G>";
		$xml .= "<CompanyToken>{$this->_config->getCompanyToken()}</CompanyToken>";
		$xml .= "<Request>refundToken</Request>";
		$xml .= "<refundAmount>{$this->getRefundAmount()}</refundAmount>";
		$xml .= "<refundDetails>Refund description</refundDetails>";
		if($this->getTransactionToken()) {
			$xml .= "<TransactionToken>{$this->getTransactionToken()}</TransactionToken>";
		}
		if($this->getCompanyRef()) {
			$xml .= "<CompanyRef>{$this->getTransactionToken()}</CompanyRef>";
		}
		$xml .= "</API3G>";

		return $this->_client->post("/v7/", $xml); // Do not delete the slash of the end
	}
}