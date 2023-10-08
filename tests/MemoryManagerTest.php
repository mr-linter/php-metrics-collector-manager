<?php

namespace MrLinter\Metrics\CollectorManager\Tests;

use MrLinter\Contracts\Metrics\CollectorAlreadyRegisteredException;
use MrLinter\Metrics\CollectorManager\MemoryManager;
use PHPUnit\Framework\TestCase;

final class MemoryManagerTest extends TestCase
{
    /**
     * @covers \MrLinter\Metrics\CollectorManager\MemoryManager::register
     * @covers \MrLinter\Metrics\CollectorManager\MemoryManager::all
     */
    public function testRegister(): void
    {
        $manager = new MemoryManager();

        $manager->register($c = new NullCollector());

        self::assertEquals(['null' => $c], $manager->all());
    }

    /**
     * @covers \MrLinter\Metrics\CollectorManager\MemoryRegistry::register
     */
    public function testRegisterOnAlreadyRegisteredException(): void
    {
        $manager = new MemoryManager();

        $manager->register($c = new NullCollector());

        self::expectException(CollectorAlreadyRegisteredException::class);

        $manager->register($c);
    }
}
