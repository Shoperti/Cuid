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
class CiudFactory
{
    /**
     * The base string constant.
     *
     * @return int
     */
    const BASE = 36;

    /**
     * The block size constant.
     *
     * @return int
     */
    const BLOCK_SIZE = 4;

    /**
     * The counter.
     *
     * @return int
     */
    protected $counter = 0;

    /**
     * Generates discrete values.
     *
     * @return string
     */
    private $discreteValues;

    /**
     * Creates a new ciud factory instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->discreteValues = pow(self::BASE, self::BLOCK_SIZE);
    }

    /**
     * Pads the input string into specific size
     *
     * @param string $str
     * @param int    $size
     *
     * @return string
     */
    protected function pad($str, $size)
    {
        $str = '000000000'.$str;

        return substr($str, strlen($str) - $size);
    }

    /**
     * Generates a random number.
     *
     * @return string
     */
    protected function random()
    {
        return mt_rand() / mt_getrandmax();
    }

    /**
     * Creates a random block.
     *
     * @return string
     */
    protected function randomBlock()
    {
        return $this->pad(
            base_convert((int) ($this->random() * $this->discreteValues << 0), 10, self::BASE),
            self::BLOCK_SIZE
        );
    }

    /**
     * Gets a safe counter.
     *
     * @return int
     */
    protected function safeCounter()
    {
        $this->counter = ($this->counter < $this->discreteValues) ? $this->counter : 0;
        ++$this->counter;
        return $this->counter - 1;
    }

    /**
     * Gets a utf8 char code.
     *
     * @param string $str
     *
     * @return string
     */
    protected function charCodeAt($str) {
        list(, $ord) = unpack('N', mb_convert_encoding($str, 'UCS-4BE', 'UTF-8'));
        return $ord;
    }

    /**
     * Generates a unique fingerprint based on the host.
     *
     * @return string
     */
    protected function fingerprint()
    {
        $padding = 2;

        $pid = $this->pad(
            base_convert((int) getmypid(), 10, 36), $padding
        );

        $hostname = gethostname();
        $length = strlen($hostname);

        $hostId = $this->pad(
            base_convert((int) array_reduce(str_split($hostname), function ($prev, $char) {
                return +$prev + $this->charCodeAt($char);
            }, +$length + 36), 10, 36),
            $padding
        );

        return $pid.$hostId;
    }

    /**
     * Generates a new ciud.
     *
     * @param string|null $prefix
     *
     * @return string
     */
    public function ciud($prefix = null)
    {
        // Starting with a lowercase letter makes
        // it HTML element ID friendly.
        $letter = $prefix ?: 'c'; // hard-coded allows for sequential access

        // timestamp
        // warning: this exposes the exact date and time
        // that the uid was created.
        $timestamp = base_convert(substr(microtime(true)*1000, 0, 13), 10, self::BASE);

        // A few chars to generate distinct ids for different
        // clients (so different computers are far less
        // likely to generate the same id)
        $fingerprint = $this->fingerprint();

        // Grab some more chars from Math.random()
        $random = $this->randomBlock().$this->randomBlock();

        // Prevent same-machine collisions.
        $counter = $this->pad(base_convert((int) $this->safeCounter(), 10, self::BASE), self::BLOCK_SIZE);

        return ($letter.$timestamp.$counter.$fingerprint.$random);
    }

    /**
     * Generates a new slug string.
     *
     * @return string
     */
    public function slug()
    {
        $timestamp = base_convert(substr(microtime(true)*1000, 0, 13), 10, self::BASE);
        $counter = substr(base_convert((int) $this->safeCounter(), 10, self::BASE), -4);
        $fingerprint = substr($this->fingerprint(), 0 ,1).substr($this->fingerprint(), -1);
        $random = substr($this->randomBlock(), -2);
        return (substr($timestamp, -2).$counter.$fingerprint.$random);
    }
}
