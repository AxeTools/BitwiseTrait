<?php

namespace AxeTools\Traits\Tests;

use AxeTools\Traits\BitFlag;
use PHPUnit\Framework\TestCase;

class BitFlagTraitTest extends TestCase {
    use BitFlag\BitFlagTrait;

    /**
     * @test
     * @dataProvider setFlagsDataProvider
     *
     * @param int  $flagSet
     * @param int  $flag
     * @param bool $expected
     *
     * @return void
     */
    public function setFlagTest($flagSet, $flag, $expected) {
        self::setFlag($flagSet, $flag, $expected);
        $this->assertEquals($expected, self::getFlag($flagSet, $flag));
    }

    /**
     * @test
     * @dataProvider getFlagsDataProvider
     *
     * @param int  $flagSet
     * @param int  $flag
     * @param bool $expected
     *
     * @return void
     */
    public function getFlagTest($flagSet, $flag, $expected) {
        $this->assertEquals($expected, self::getFlag($flagSet, $flag));
    }

    /**
     * @test
     * @dataProvider toggleFlagDataProvider
     *
     * @param int  $flagSet
     * @param int  $flag
     * @param bool $expected
     *
     * @return void
     */
    public function toggleFlagTest($flagSet, $flag, $expected) {
        self::toggleFlag($flagSet, $flag);
        $this->assertEquals($expected, self::getFlag($flagSet, $flag));
    }

    public static function toggleFlagDataProvider() {
        return [
            'Initial unset state to 0, first bit false' => [0b00000000, 0b00000001, true],
            'Initial unset state to 1, first bit false' => [0b00000001, 0b00000001, false],
            'Initial unset state to 0, second bit false' => [0b00000000, 0b00000010, true],
            'Initial unset state to 1, second bit false' => [0b00000010, 0b00000010, false],
            'Initial unset state to 0, third bit false' => [0b00000000, 0b00000100, true],
            'Initial unset state to 1, third bit false' => [0b00000100, 0b00000100, false],
            'Initial unset state to 0, multi bit false' => [0b00000000, 0b00010101, true],
            'set initial fully set state, first bit true' => [0b11111111, 0b00000001, false],
            'set initial fully set state, second bit true' => [0b11111111, 0b00000010, false],
            'set initial fully set state, third bit true' => [0b11111111, 0b00000100, false],
            'set initial fully set state, multi bit true' => [0b11111111, 0b00010101, false],
            'set initial fully set state inverse, first bit true' => [0b11111110, 0b00000001, true],
            'set initial fully set state inverse, second bit true' => [0b11111101, 0b00000010, true],
            'set initial fully set state inverse, third bit true' => [0b11111011, 0b00000100, true],
            'set initial fully set state inverse, multi bit true' => [0b11101010, 0b00010101, true],
            'Set initial state to every other, first bit false' => [0b10101010, 0b00000001, true],
            'Set initial state to every other, second bit true' => [0b10101010, 0b00000010, false],
            'Set initial state to every other, third bit false' => [0b10101010, 0b00000100, true],
            'Set initial state to every other, multi bit false' => [0b10101010, 0b00010101, true],
            'Set initial state to inverse, first bit true' => [0b01010101, 0b00000001, false],
            'Set initial state to inverse, second bit false' => [0b01010101, 0b00000010, true],
            'Set initial state to inverse, third bit true' => [0b01010101, 0b00000100, false],
            'Set initial state to inverse, multi bit true' => [0b01010101, 0b00010101, false],
        ];
    }

    public static function getFlagsDataProvider() {
        return [
            'Initial unset state to 0, first bit false' => [0b00000000, 0b00000001, false],
            'Initial unset state to 1, first bit false' => [0b00000001, 0b00000001, true],
            'Initial unset state to 0, second bit false' => [0b00000000, 0b00000010, false],
            'Initial unset state to 1, second bit false' => [0b00000010, 0b00000010, true],
            'Initial unset state to 0, third bit false' => [0b00000000, 0b00000100, false],
            'Initial unset state to 1, third bit false' => [0b00000100, 0b00000100, true],
            'Initial unset state to 0, multi bit false' => [0b00000000, 0b00010101, false],
            'set initial fully set state, first bit true' => [0b11111111, 0b00000001, true],
            'set initial fully set state, second bit true' => [0b11111111, 0b00000010, true],
            'set initial fully set state, third bit true' => [0b11111111, 0b00000100, true],
            'set initial fully set state, multi bit true' => [0b11111111, 0b00010101, true],
            'set initial fully set state inverse, first bit true' => [0b11111110, 0b00000001, false],
            'set initial fully set state inverse, second bit true' => [0b11111101, 0b00000010, false],
            'set initial fully set state inverse, third bit true' => [0b11111011, 0b00000100, false],
            'set initial fully set state inverse, multi bit true' => [0b11101010, 0b00010101, false],
            'Set initial state to every other, first bit false' => [0b10101010, 0b00000001, false],
            'Set initial state to every other, second bit true' => [0b10101010, 0b00000010, true],
            'Set initial state to every other, third bit false' => [0b10101010, 0b00000100, false],
            'Set initial state to every other, multi bit false' => [0b10101010, 0b00010101, false],
            'Set initial state to inverse, first bit true' => [0b01010101, 0b00000001, true],
            'Set initial state to inverse, second bit false' => [0b01010101, 0b00000010, false],
            'Set initial state to inverse, third bit true' => [0b01010101, 0b00000100, true],
            'Set initial state to inverse, multi bit true' => [0b01010101, 0b00010101, true],
        ];
    }

    public static function setFlagsDataProvider() {
        return [
            'Initial unset state to 0, first bit true' => [0b00000000, 0b00000001, true],
            'Initial unset state to 0, first bit false' => [0b00000000, 0b00000001, false],
            'Initial unset state to 0, second bit true' => [0b00000000, 0b00000010, true],
            'Initial unset state to 0, second bit false' => [0b00000000, 0b00000010, false],
            'Initial unset state to 0, third bit true' => [0b00000000, 0b00000100, true],
            'Initial unset state to 0, third bit false' => [0b00000000, 0b00000100, false],
            'Initial unset state to 0, multi bit true' => [0b00000000, 0b00010101, true],
            'Initial unset state to 0, multi bit false' => [0b00000000, 0b00010101, false],
            'set initial fully set state, first bit true' => [0b11111111, 0b00000001, true],
            'set initial fully set state, first bit false' => [0b11111111, 0b00000001, false],
            'set initial fully set state, second bit true' => [0b11111111, 0b00000010, true],
            'set initial fully set state, second bit false' => [0b11111111, 0b00000010, false],
            'set initial fully set state, third bit true' => [0b11111111, 0b00000100, true],
            'set initial fully set state, third bit false' => [0b11111111, 0b00000100, false],
            'set initial fully set state, multi bit true' => [0b11111111, 0b00010101, true],
            'set initial fully set state, multi bit false' => [0b11111111, 0b00010101, false],
            'Set initial state to every other, first bit true' => [0b10101010, 0b00000001, true],
            'Set initial state to every other, first bit false' => [0b10101010, 0b00000001, false],
            'Set initial state to every other, second bit true' => [0b10101010, 0b00000010, true],
            'Set initial state to every other, second bit false' => [0b10101010, 0b00000010, false],
            'Set initial state to every other, third bit true' => [0b10101010, 0b00000100, true],
            'Set initial state to every other, third bit false' => [0b10101010, 0b00000100, false],
            'Set initial state to every other, multi bit true' => [0b10101010, 0b00010101, true],
            'Set initial state to every other, multi bit false' => [0b10101010, 0b00010101, false],
            'Set initial state to inverse, first bit true' => [0b01010101, 0b00000001, true],
            'Set initial state to inverse, first bit false' => [0b01010101, 0b00000001, false],
            'Set initial state to inverse, second bit true' => [0b01010101, 0b00000010, true],
            'Set initial state to inverse, second bit false' => [0b01010101, 0b00000010, false],
            'Set initial state to inverse, third bit true' => [0b01010101, 0b00000100, true],
            'Set initial state to inverse, third bit false' => [0b01010101, 0b00000100, false],
            'Set initial state to inverse, multi bit true' => [0b01010101, 0b00010101, true],
            'Set initial state to inverse, multi bit false' => [0b01010101, 0b00010101, false],
        ];
    }
}
