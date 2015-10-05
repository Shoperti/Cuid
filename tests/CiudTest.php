<?php

/*
 * This file is part of Shoperti.
 *
 * (c) Joseph Cohen <joe@shoperti.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Shoperti\Tests\Ciud;

use Shoperti\Ciud\Ciud;

/**
 * This is the Ciud test class.
 *
 * @author Joseph Cohen <joe@shoperti.com>
 */
class CiudTest extends \PHPUnit_Framework_TestCase
{
    const MAX = 100000;

    // function testSlug()
    // {
    //     Ciud::slug();
    // }

    function testCollition()
    {
        $i = 0;
        $ids = [];
        $pass = true;

        while ($i < self::MAX) {
            $id = Ciud::ciud();

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

    function testSlugCollition()
    {
        $i = 0;
        $ids = [];
        $pass = true;

        while ($i < self::MAX) {
            $id = Ciud::slug();

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
