<?php

/*
 * This file is part of Shoperti.
 *
 * (c) Joseph Cohen <joe@shoperti.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Shoperti\Ciud;

/**
 * This is the Ciud class.
 *
 * @author Joseph Cohen <joe@shoperti.com>
 */
class Ciud
{
    /**
     * The factory to use when creating UUIDs.
     *
     * @var \Shoperti\Ciud\CiudFactory
     */
    private static $factory = null;

    /**
     * Returns the currently set factory used to create Ciuds.
     *
     * @return \Shoperti\Ciud\CiudFactory
     */
    public static function getFactory()
    {
        if (!self::$factory) {
            self::$factory = new CiudFactory();
        }

        return self::$factory;
    }

    /**
     * Generates a new ciud.
     *
     * @param string|null $prefix
     *
     * @return string
     */
    public static function ciud($prefix = null)
    {
        return static::getFactory()->ciud($prefix);
    }

    /**
     * Generates a new slug string.
     *
     * @return string
     */
    public static function slug($prefix = null)
    {
        return static::getFactory()->slug($prefix);
    }
}
