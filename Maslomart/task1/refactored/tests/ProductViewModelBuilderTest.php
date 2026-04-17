<?php

declare(strict_types=1);

namespace Maslomart\Tests;

use Maslomart\Catalog\ProductViewModelBuilder;
use PHPUnit\Framework\TestCase;

final class ProductViewModelBuilderTest extends TestCase
{
    public function test_marks_sale_when_price_not_greater_than_threshold(): void
    {
        $builder = new ProductViewModelBuilder(1000.0);
        $result  = $builder->build([
            'id'    => 1,
            'name'  => 'sale_item',
            'price' => 500.0,
            'raw'   => [],
        ]);

        $this->assertTrue($result['is_sale']);
        $this->assertSame(500.0, $result['price']);
    }

    public function test_no_sale_when_price_above_threshold(): void
    {
        $builder = new ProductViewModelBuilder(1000.0);
        $result  = $builder->build([
            'id'    => 2,
            'name'  => 'non_sale_item',
            'price' => 1000.01,
            'raw'   => [],
        ]);

        $this->assertFalse($result['is_sale']);
    }

    public function test_no_sale_when_price_missing(): void
    {
        $builder = new ProductViewModelBuilder(1000.0);
        $result  = $builder->build([
            'id'    => 3,
            'name'  => 'null_price_item',
            'price' => null,
            'raw'   => [],
        ]);

        $this->assertFalse($result['is_sale']);
        $this->assertNull($result['price']);
    }

    public function test_sale_at_exact_threshold(): void
    {
        $builder = new ProductViewModelBuilder(1000.0);
        $result  = $builder->build([
            'id'    => 4,
            'name'  => 'threshold_item',
            'price' => 1000.0,
            'raw'   => [],
        ]);

        $this->assertTrue($result['is_sale']);
    }

    public function test_no_sale_when_threshold_is_null(): void
    {
        $builder = new ProductViewModelBuilder(null);
        $result = $builder->build([
            'id' => 5,
            'name' => 'no_threshold_item',
            'price' => 100.0,
            'raw' => [],
        ]);

        $this->assertFalse($result['is_sale']);
    }
}
