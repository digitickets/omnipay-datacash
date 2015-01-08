<?php

namespace Omnipay\DataCash\Message;

use DOMDocument;
use Omnipay\Common\Exception\InvalidResponseException;
use Omnipay\Common\Message\AbstractResponse;
use Omnipay\Common\Message\RedirectResponseInterface;
use Omnipay\Common\Message\RequestInterface;

/**
 * DataCash Response
 */
class Response extends AbstractResponse implements RedirectResponseInterface
{
    public function __construct(RequestInterface $request, $data)
    {
        $this->request = $request;
        $this->data = new \SimpleXMLElement($data);
        if (!isset($this->data->status)) {
            throw new InvalidResponseException;
        }
    }

    public function isSuccessful()
    {
        return 1 === (int) $this->data->status;
    }

    public function isRedirect()
    {
        // 150 is the 3D Secure status code
        return 150 === (int) $this->data->status;
    }

    public function getTransactionReference()
    {
        return (string) $this->data->datacash_reference;
    }

    public function getTransactionId()
    {
        return (string) $this->data->merchantreference;
    }

    public function getAuthCode()
    {
        return (string) (isset($this->data->CardTxn->authcode) ? $this->data->CardTxn->authcode : '');
    }

    public function getMessage()
    {
        return (string) $this->data->reason;
    }

    public function getRedirectUrl()
    {
        if ($this->isRedirect()) {
            return (string) $this->data->CardTxn->ThreeDSecure->acs_url;
        }

        return '';
    }

    public function getRedirectMethod()
    {
        return 'POST';
    }
    
    protected function getPaReq()
    {
        if (isset($this->data->CardTxn->ThreeDSecure->pareq_message)) {
            return (string)$this->data->CardTxn->ThreeDSecure->pareq_message;
        } else {
            return '';
        }
    }

    public function getRedirectData()
    {
        
        return array(
            'PaReq' => $this->getPaReq(),
            'TermUrl' => $this->getRequest()->getReturnUrl(),
            'MD' => (string) $this->getTransactionId(),
        );
    }
}
