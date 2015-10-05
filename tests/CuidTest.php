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
    function it_shoud_return_string()
    {
        $Cuid = Cuid::Cuid();

        $this->assertInternalType('string', $Cuid);
    }

    /** @test */
    function it_should_not_collide()
    {
        $i = 0;
        $ids = [];
        $pass = true;

        while ($i < self::MAX) {
            $id = Cuid::Cuid();

            if (!isset($ids[$id])) {
                $ids[$id] = $id;
            } else {
                $pass = false;
                break;
            }

            ++$i;
        }

        $this->assertTrue($pass);
    }

    /** @test */
    function it_should_not_collide_making_slug()
    {
        $i = 0;
        $ids = [];
        $pass = true;

        while ($i < self::MAX) {
            $id = Cuid::slug();

            if (!isset($ids[$id])) {
                $ids[$id] = $id;
            } else {
                $pass = false;
                break;
            }

            ++$i;
        }

        $this->assertTrue($pass);
    }
}
