<?php

declare(strict_types=1);

namespace KHerGe\Rust;

use RuntimeException;

/**
 * Manages a moveable value.
 *
 * @author Kevin Herrera <kevin@herrera.io>
 */
class Move
{
    /**
     * The move state.
     *
     * @var boolean
     */
    private $moved;

    /**
     * The value.
     *
     * @var mixed
     */
    private $value;

    /**
     * Initializes the new moveable value.
     *
     * @param mixed $value The value.
     */
    public function __construct($value)
    {
        $this->moved = false;
        $this->value = $value;
    }

    /**
     * Checks if the value has been moved.
     *
     * @return boolean Returns `true` if the value is moved or `false` if not.
     */
    public function isMoved() : bool
    {
        return $this->moved;
    }

    /**
     * Moves the value out of the container.
     *
     * @return mixed The value.
     *
     * @throws RuntimeException If the value could not be moved.
     */
    public function move()
    {
        $this->willMove();

        $value = $this->value;

        $this->moved = true;
        $this->value = null;

        return $value;
    }

    /**
     * Signals the intention of moving the value.
     *
     * @throws RuntimeException If the value cannot be moved.
     */
    public function willMove() : void
    {
        if ($this->moved) {
            throw new RuntimeException('use of moved value');
        }
    }
}