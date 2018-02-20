<?php

declare(strict_types=1);

namespace Tests\KHerGe\Rust;

use KHerGe\Rust\Move;
use PHPUnit\Framework\TestCase;
use RuntimeException;

/**
 * Verifies that the moveable value functions as intended.
 *
 * @author Kevin Herrera <kevin@herrera.io>
 */
class MoveTest extends TestCase
{
    /**
     * The moveable value.
     *
     * @var Move
     */
    private $value;

    /**
     * Verify that the value is moved.
     */
    public function testMove()
    {
        self::assertFalse($this->value->isMoved(), 'The value should not be marked as moved.');
        self::assertSame(123, $this->value->move(), 'The value was not moved out of the container.');
        self::assertTrue($this->value->isMoved(), 'The value should be marked as moved.');
    }

    /**
     * @depends testMove
     *
     * Verify that a subsequent move fails.
     */
    public function testMoveAgain()
    {
        $this->value->move();

        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage('use of moved value');

        $this->value->move();
    }

    /**
     * @depends testMove
     *
     * Verify that the intention of a move is signaled.
     */
    public function testSignalMoveIntent()
    {
        $this->value->move();

        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage('use of moved value');

        $this->value->willMove();
    }

    /**
     * Creates a new moveable value.
     */
    protected function setUp()
    {
        $this->value = new Move(123);
    }
}