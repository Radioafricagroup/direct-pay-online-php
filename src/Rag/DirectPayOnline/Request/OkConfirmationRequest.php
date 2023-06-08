<?php
namespace Rag\DirectPayOnline\Request;
use Rag\DirectPayOnline\Request;


/**
 * Class OkConfirmationRequest
 * @package Rag\DirectPayOnline\Request
 *
 * @see     https://directpayonline.atlassian.net/wiki/spaces/API/pages/810126/pushPayments
 */

class OkConfirmationRequest extends Request{

    private $_transactionRef = "";
    private $_companyRef = "";

    /**
     * @return string
     */
    function getTransactionRef()
    {
        return $this->_transactionRef;
    }

    /**
     * @param string $transactionRef
     */
    function setTransactionRef($transactionRef)
    {
        $this->_transactionRef = $transactionRef;
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

    function execute()
    {
        $xml = "";

        $xml .= '<?xml version="1.0" encoding="utf-8"?>';
        $xml .= "<API3G>";
        $xml .= "<Response>OK</Response>";
        $xml .= "<CompanyRef>{$this->getCompanyRef()}</CompanyRef>";
        $xml .= "<AccRef>{$this->getTransactionRef()}</AccRef>";
        $xml .= "</API3G>";

        return $this->_client->post("/v6/", $xml); // Do not delete the slash of the end
    }
}