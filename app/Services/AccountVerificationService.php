<?php

namespace App\Services;

class AccountVerificationService
{
    protected $username, $password, $url;

    public function __construct() {
       $this->username = config('services.zenith.username');
       $this->password = config('services.zenith.password');
       $this->url = "https://newwebservicetest.zenithbank.com:8443/ZenithAcctEnquiry/acctenquiry.asmx?op=GetAccountDetails";
    }

    public function verifyAccountNumber($account_number)
    {
        $header = array(
            "Content-type: text/xml",
            "SOAPAction: http://zenithbank.com/acctenquiry/GetAccountDetails"
        );

        $payload = "<soap:Envelope xmlns:xsi='http://www.w3.org/2001/XMLSchema-instance' xmlns:xsd='http://www.w3.org/2001/XMLSchema' xmlns:soap='http://schemas.xmlsoap.org/soap/envelope/'><soap:Body><GetAccountDetails xmlns='http://zenithbank.com/acctenquiry/'><Username>{$this->username}</Username><Password>{$this->password}</Password><AccountNo>{$account_number}</AccountNo></GetAccountDetails></soap:Body></soap:Envelope>";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);

        $data = curl_exec($ch);
        $err = curl_error($ch);

        if ($err) {
            // info("Account Verification Error:".json_encode($err));
            return ('Whoops!!! Unable to verify account number this time. Please try again');
        }

        $result_array = xml_to_array($data, false);

        return $result_array;
    }
}
