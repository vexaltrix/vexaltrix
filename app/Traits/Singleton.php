<?php

namespace Vexaltrix\Traits;

trait Singleton
{
    /** @var static|null */
    private static $instance = null;

    final public static function instance(): static
    {
        return static::$instance ??= new static();
    }

    final protected function __construct()
    {
    }

    private function __clone()
    {
    }

    final public function __wakeup(): void
    {
        throw new \LogicException('Cannot unserialize singleton.');
    }
}
