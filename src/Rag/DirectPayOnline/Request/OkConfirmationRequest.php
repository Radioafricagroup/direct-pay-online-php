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

    function execute()
    {
        $xml = "";

        $xml .= '<?xml version="1.0" encoding="utf-8"?>';
        $xml .= "<API3G>";
        $xml .= "<Response>OK</Response>";
        $xml .= "</API3G>";

        return $this->_client->post("/v6/", $xml); // Do not delete the slash of the end
    }
}