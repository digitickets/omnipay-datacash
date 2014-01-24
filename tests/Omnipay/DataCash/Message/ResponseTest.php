<?php

namespace Omnipay\DataCash\Message;

use Mockery as m;
use Omnipay\Tests\TestCase;

class ResponseTest extends TestCase
{

    public function testPurchaseSuccess()
    {
        $httpResponse = $this->getMockHttpResponse('PurchaseSuccess.txt');
        $response = new Response($this->getMockRequest(), $httpResponse->getBody());

        $this->assertTrue($response->isSuccessful());
        $this->assertEquals('123456', $response->getTransactionId());
        $this->assertSame('ACCEPTED', $response->getMessage());
        $this->assertEmpty($response->getRedirectUrl());
    }

    public function testPurchaseFailure()
    {
        $httpResponse = $this->getMockHttpResponse('PurchaseFailure.txt');
        $response = new Response($this->getMockRequest(), $httpResponse->getBody());

        $this->assertFalse($response->isSuccessful());
        $this->assertSame('Invalid CLIENT/PASS', $response->getMessage());
    }

    public function testRedirect()
    {
        $httpResponse = $this->getMockHttpResponse('PurchaseRedirect.txt');

        $request = m::mock('\Omnipay\Common\Message\AbstractRequest');
        $request->shouldReceive('getReturnUrl')->once()->andReturn('http://store.example.com/');

        $response = new Response($request, $httpResponse->getBody());

        $this->assertTrue($response->isRedirect());
        $this->assertSame('POST', $response->getRedirectMethod());
        $this->assertSame('https://secure.barclaycard.co.uk/barclays/tdsecure/pa.jsp', $response->getRedirectUrl());

        $expectedData = array(
            'PaReq' => 'Some PaREQ',
            'TermUrl' => 'http://store.example.com/',
            'MD' => '123456',
        );
        $this->assertEquals($expectedData, $response->getRedirectData());
    }
}
