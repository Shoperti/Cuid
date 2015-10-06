<?php

/*
 * This file is part of Shoperti.
 *
 * (c) Joseph Cohen <joe@shoperti.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Shoperti\Tests\Cuid;

use Shoperti\Cuid\Cuid;

/**
 * This is the Cuid test class.
 *
 * @author Joseph Cohen <joe@shoperti.com>
 */
class CuidTest extends \PHPUnit_Framework_TestCase
{
    const MAX = 100000;

    /** @test */
    public function it_shoud_return_string()
    {
        $Cuid = Cuid::cuid();

        $this->assertInternalType('string', $Cuid);
    }

    /** @test */
    public function it_shoud_return_string_making_slug()
    {
        $Cuid = Cuid::slug();

        $this->assertInternalType('string', $Cuid);
    }

    /** @test */
    public function it_should_not_collide()
    {
        $ids = [];

        for ($i = 1; $i <= static::MAX; $i++) {
            $id = Cuid::cuid();

            $this->assertFalse(isset($ids[$id]));

            $ids[$id] = $i;
        }
    }

    /** @test */
    public function it_should_not_collide_making_slug()
    {
        $ids = [];

        for ($i = 1; $i <= static::MAX; $i++) {
            $id = Cuid::slug();

            $this->assertFalse(isset($ids[$id]));

            $ids[$id] = $i;
        }
    }
}
