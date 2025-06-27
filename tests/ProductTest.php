<?php
use PHPUnit\Framework\TestCase;

require_once 'Product.php';

class ProductTest extends TestCase
{
    public function testProductCreation()
    {
        $data = [
            'brand_name'     => 'Apple',
            'model_name'     => 'iPhone 13',
            'colour_name'    => 'Blue',
            'gb_spec_name'   => '128GB',
            'network_name'   => 'Unlocked',
            'grade_name'     => 'Grade A',
            'condition_name' => 'Working',
        ];

        $product = new Product($data);

        $this->assertEquals('Apple', $product->make);
        $this->assertEquals(
            'apple|iphone 13|blue|128gb|unlocked|grade a|working',
            $product->getCombinationKey()
        );
    }

    public function testMissingMakeThrowsException()
    {
        $this->expectException(Exception::class);
        $this->expectExceptionMessage('Missing required fields: make or model.');

        $data = [
            'model_name'     => 'iPhone 13',
            'colour_name'    => 'Blue',
            'gb_spec_name'   => '128GB',
            'network_name'   => 'Unlocked',
            'grade_name'     => 'Grade A',
            'condition_name' => 'Working',
        ];

        new Product($data);
    }

    public function testMissingModelThrowsException()
    {
        $this->expectException(Exception::class);
        $this->expectExceptionMessage('Missing required fields: make or model.');

        $data = [
            'brand_name'     => 'Apple',
            'colour_name'    => 'Blue',
            'gb_spec_name'   => '128GB',
            'network_name'   => 'Unlocked',
            'grade_name'     => 'Grade A',
            'condition_name' => 'Working',
        ];

        new Product($data);
    }
}
