<?php
namespace Rag\DirectPayOnline;

/**
 * Class Request
 * @package Rag\DirectPayOnline
 */
class Request
{
	const PRODUCTION_API_ENDPOINT = "https://secure.3gdirectpay.com/API";
	const TEST_API_ENDPOINT = "https://secure1.sandbox.directpay.online/API";

	protected $_config;
	protected $_client;

	/**
	 * Request constructor
	 *
	 * @param Config $config
	 */
	function __construct(Config $config)
	{
		$this->_config = $config;
		$this->_client = $this->createHttpClient();
	}

	/**
	 * Creates HttpClient based on the test mode
	 *
	 * @return HttpClient
	 */
	private function createHttpClient()
	{
		return new HttpClient($this->_config->isTestMode() ? self::TEST_API_ENDPOINT : self::PRODUCTION_API_ENDPOINT);
	}
}