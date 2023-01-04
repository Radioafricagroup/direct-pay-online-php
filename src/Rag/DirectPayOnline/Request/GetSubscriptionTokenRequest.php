<?php
use Rag\DirectPayOnline\Request;

/**
 * Class GetSubscriptionTokenRequest
 * @package Rag\DirectPayOnline\Request
 *
 * @see     https://directpayonline.atlassian.net/wiki/spaces/API/pages/337903619/getSubscriptionToken
 */

class GetSubscriptionTokenRequest extends Request{

    private $_transactionToken = "";
    private $_companyRef = "";
    private $_veirfyTransaction = ""; // Documentation has typo too
    private $_accRef = "";
    private $_searchCriteria = "";
    private $_searchCriteriaValue = "";

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
     * @return string
     */
    function getSearchCriteria()
    {
        return $this->_searchCriteria;
    }

    /**
     * @param $searchCriteria
     */
    function setSearchCriteria($searchCriteria)
    {
        $this->_searchCriteria = $searchCriteria;
    }

    /**
     * @return string
     */
    function getSearchCriteriaValue()
    {
        return $this->_searchCriteriaValue;
    }

    /**
     * @param $searchCriteriaValue
     */
    function setSearchCriteriaValue($searchCriteriaValue)
    {
        $this->_searchCriteriaValue = $searchCriteriaValue;
    }
    function execute()
    {
        if(!$this->getTransactionToken() && !$this->getCompanyRef()) {
            exit("TransactionToken or CompanyRef must be set.");
        }

        $xml = "";

        $xml .= '<?xml version="1.0" encoding="utf-8"?>';
        $xml .= "<API3G>";
        $xml .= "<CompanyToken>{$this->_config->getCompanyToken()}</CompanyToken>";
        $xml .= "<Request>getSubscriptionToken</Request>";
        $xml .= "<SearchCriteria>{$this->getSearchCriteria()}</SearchCriteria>";
        $xml .= "<SearchCriteriaValue>{$this->getSearchCriteriaValue()}</SearchCriteriaValue>";
        $xml .= "</API3G>";

        return $this->_client->post("/v6/", $xml); // Do not delete the slash of the end
    }
}