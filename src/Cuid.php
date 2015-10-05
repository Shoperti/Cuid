<?php

/*
 * This file is part of Shoperti.
 *
 * (c) Joseph Cohen <joe@shoperti.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Shoperti\Cuid;

/**
 * This is the Cuid class.
 *
 * @author Joseph Cohen <joe@shoperti.com>
 */
class Cuid
{
    /**
     * The factory to use when creating UUIDs.
     *
     * @var \Shoperti\Cuid\CuidFactory
     */
    private static $factory = null;

    /**
     * Returns the currently set factory used to create Cuids.
     *
     * @return \Shoperti\Cuid\CuidFactory
     */
    public static function getFactory()
    {
        if (!self::$factory) {
            self::$factory = new CuidFactory();
        }

        return self::$factory;
    }

    /**
     * Generates a new Cuid.
     *
     * @return string
     */
    public static function cuid()
    {
        return static::getFactory()->cuid();
    }

    /**
     * Generates a new slug string.
     *
     * @return string
     */
    public static function slug()
    {
        return static::getFactory()->slug();
    }
}
