<?php

class ContainerTest extends \PHPUnit\Framework\TestCase
{

    public function testInitializeWithParams()
    {
        $std = new \stdClass();

        $container = new OtherCode\Container\Container(array(
            'api' => 'some api key',
            'std' => $std
        ));

        $this->assertTrue($container->has('api'));

    }
}