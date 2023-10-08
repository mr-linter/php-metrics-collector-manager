<?php

namespace MrLinter\Metrics\CollectorManager\Tests;

use MrLinter\Contracts\Metrics\CollectorManager;
use MrLinter\Contracts\Metrics\Commit;
use MrLinter\Contracts\Metrics\NullStorage;
use MrLinter\Metrics\CollectorManager\NoFlushManager;
use PHPUnit\Framework\MockObject\Rule\InvokedCount;
use PHPUnit\Framework\TestCase;

final class NoFlushManagerTest extends TestCase
{
    /**
     * @covers \MrLinter\Metrics\CollectorManager\NoFlushManager::flush
     */
    public function testFlush(): void
    {
        $decorated = $this->createMock(CollectorManager::class);
        $decorated
            ->expects(new InvokedCount(0))
            ->method('flush');

        $manager = new NoFlushManager($decorated);

        $manager->flush(new NullStorage(), new Commit(''));
    }
}
