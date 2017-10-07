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
        $this->assertTrue($container->has('std'));
        $this->assertInstanceOf('\stdClass', $container->get('std'));
        $this->assertEquals($std, $container->get('std'));

    }
}