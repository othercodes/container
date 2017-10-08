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
        $this->assertEquals('some api key', $container->get('api'));

        $this->assertTrue($container->has('std'));
        $this->assertInstanceOf('\stdClass', $container->get('std'));
        $this->assertEquals($std, $container->get('std'));

        $this->assertCount(2, $container);

        $this->assertEquals(array('api', 'std'), $container->keys());
    }

    public function testSetAndGet()
    {
        $container = new \OtherCode\Container\Container();
        $container->set('one', 1);
        $container->offsetSet('two', 2);
        $container['three'] = 3;
        $container->four = 4;

        $this->assertCount(4, $container);

        $this->assertTrue($container->has('one'));
        $this->assertEquals(1, $container->get('one'));

        $this->assertTrue($container->has('two'));
        $this->assertEquals(2, $container->get('two'));

        $this->assertTrue($container->has('three'));
        $this->assertEquals(3, $container->get('three'));

        $this->assertTrue($container->has('four'));
        $this->assertEquals(4, $container->get('four'));

        $this->assertTrue($container->has('one'));
        $this->assertEquals(1, $container['one']);

        $this->assertTrue($container->has('two'));
        $this->assertEquals(2, $container['two']);

        $this->assertTrue($container->has('three'));
        $this->assertEquals(3, $container['three']);

        $this->assertTrue($container->has('four'));
        $this->assertEquals(4, $container['four']);
    }

    /**
     * @expectedException \OtherCode\Container\Exceptions\NotFoundException
     */
    public function testGetNotFoundException()
    {
        $container = new \OtherCode\Container\Container();
        $container->get('notfound');
    }

    public function testArrayIterator()
    {
        $container = new \OtherCode\Container\Container();
        $this->assertInstanceOf('\ArrayIterator', $container->getIterator());
    }

    public function testExitsUnset()
    {
        $container = new \OtherCode\Container\Container();
        $container['key'] = 'value';

        $this->assertTrue($container->offsetExists('key'));
        $container->offsetUnset('key');
        $this->assertNotTrue($container->offsetExists('key'));

    }
}