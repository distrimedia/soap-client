<?php

declare(strict_types=1);

namespace DistriMedia\SoapClientTest\Service;

use DistriMedia\SoapClient\InvalidOrderException;
use DistriMedia\SoapClient\Struct\Customer;
use DistriMedia\SoapClient\Struct\Order;
use DistriMedia\SoapClient\Struct\OrderItem;
use DistriMedia\SoapClient\Struct\OrderLine;
use DistriMedia\SoapClient\Struct\Product;
use DistriMedia\SoapClient\Service\Order as OrderService;

class OrderTest extends TestCase
{

    /**
     * @return OrderService
     */
    private function createOrderService(): OrderService
    {
        $uri = $_ENV['API_URI'] ?: '';
        $webshopCode = $_ENV['WEBSHOP_CODE'] ?: '';
        $password = $_ENV['API_PASSWORD'] ?: '';

        $orderService = new OrderService($uri, $webshopCode, $password);

        return $orderService;
    }

    /**
     * @covers ::OrderService
     */
    public function testCreateService()
    {
        $orderService = $this->createOrderService();

        self::assertInstanceOf(\DistriMedia\SoapClient\Service\Order::class, $orderService);
    }

    /**
     * @covers ::OrderService
     */
    public function testPushEmptyOrder()
    {
        $orderService = $this->createOrderService();

        $order = new Order();

        $this->expectException(InvalidOrderException::class);
        $orderService->createOrder($order);
    }

    /**
     * @return Customer
     */
    private function getCustomer(): Customer
    {
        $customer = new Customer();

        $customer->setName("John");
        $customer->setName2("Doe");
        $customer->setAddress1("Dendermondsesteenweg 140c");
        $customer->setCity("Gent");
        $customer->setCountry("BE");
        $customer->setEmail("wedoeneenszot@baldwin.be");
        $customer->setMobile("123456789");
        $customer->setPostcode1("9000");

        return $customer;
    }

    /**
     * @return Product
     */
    private function getProduct(): Product
    {
        $product = new Product();
        $product->setEan("5707302342443");
        $product->setExternalRef('tofvel3-42');
        $product->setDescription1("some text");
        return $product;
    }

    /**
     * @return OrderLine
     */
    private function getOrderLine(): OrderLine
    {
        $orderLine = new OrderLine();

        $orderLine->setProductId("5707302342443");
        $orderLine->setPieces(10);
        //$orderLine->setSupplier("BALDWIN");
        $orderLine->setProduct($this->getProduct());
        return $orderLine;
    }

    private function getOrderItem($orderId): OrderItem
    {
        $orderItem = new OrderItem();
        $orderItem->setOrderNumber($orderId);

        return $orderItem;
    }

    /**
     * @covers ::OrderService
     */
    public function testPushOrderWithSingleOrderLines()
    {
        $customer = $this->getCustomer();
        $orderLine = $this->getOrderLine();
        $orderItem = $this->getOrderItem('00212859');

        $order = new Order();
        $order->setCustomer($customer);
        $order->setOrderLines([$orderLine]);
        $order->setOrderItem($orderItem);

        $orderService = $this->createOrderService();

        $result = $orderService->createOrder($order);

        var_dump($result);
        self::assertInstanceOf(\DistriMedia\SoapClient\Struct\Response\Order::class, $result);
    }

    /**
     * @covers ::OrderService
     */
    public function testCancelOrderByOrderNumber()
    {
        $orderService = $this->createOrderService();
        $orderNumber = '00212857';
        $result = $orderService->changeOrderStatusByOrderNumber($orderNumber, \DistriMedia\SoapClient\Service\Order::ORDER_STATUS_CANCEL);

        self::assertInstanceOf(\DistriMedia\SoapClient\Struct\Response\Order::class, $result);
    }
}
