<?php
namespace Rag\DirectPayOnline\Request;
use Rag\DirectPayOnline\Request;


/**
 * Class ChargeTokenRecurrentRequest
 * @package Rag\DirectPayOnline\Request
 *
 * @see     https://directpayonline.atlassian.net/wiki/spaces/API/pages/337903619/chargeTokenRecurrentRequest
 */

class ChargeTokenRecurrentRequest extends Request{

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
    function getSubscriptionToken()
    {
        return $this->_searchCriteriaValue;
    }

    /**
     * @param $searchCriteriaValue
     */
    function setSubscriptionToken($searchCriteriaValue)
    {
        $this->_searchCriteriaValue = $searchCriteriaValue;
    }
    function execute()
    {
        if(!$this->getCompanyRef()) {
            exit("CompanyRef must be set.");
        }

        $xml = "";

        $xml .= '<?xml version="1.0" encoding="utf-8"?>';
        $xml .= "<API3G>";
        $xml .= "<CompanyToken>{$this->_config->getCompanyToken()}</CompanyToken>";
        $xml .= "<Request>chargeTokenRecurrent</Request>";
        $xml .= "<TransactionToken>{$this->getTransactionToken()}</TransactionToken>";
        $xml .= "<SubscriptionToken>{$this->getSubscriptionToken()}</SubscriptionToken>";
        $xml .= "</API3G>";

        return $this->_client->post("/v6/", $xml); // Do not delete the slash of the end
    }
}