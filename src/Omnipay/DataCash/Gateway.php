<?php

namespace Omnipay\DataCash;

use Omnipay\DataCash\Message\CompletePurchaseRequest;
use Omnipay\DataCash\Message\PurchaseRequest;
use Omnipay\Common\AbstractGateway;

/**
 * DataCash Gateway
 *
 * @link https://www.datacash.com/developersarea.php
 */
class Gateway extends AbstractGateway
{
    public function getName()
    {
        return 'DataCash';
    }

    public function getDefaultParameters()
    {
        return array(
            'merchantId' => '',
            'password' => '',
            'testMode' => false
        );
    }

    public function getMerchantId()
    {
        return $this->getParameter('merchantId');
    }

    public function setMerchantId($value)
    {
        return $this->setParameter('merchantId', $value);
    }

    public function getPassword()
    {
        return $this->getParameter('password');
    }

    public function setPassword($value)
    {
        return $this->setParameter('password', $value);
    }

    public function purchase(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\DataCash\Message\PurchaseRequest', $parameters);
    }

    public function completePurchase(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\DataCash\Message\CompletePurchaseRequest', $parameters);
    }

    public function refund(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\DataCash\Message\RefundRequest', $parameters);
    }
}
