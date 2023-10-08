<?php

namespace MrLinter\Metrics\CollectorManager;

use MrLinter\Contracts\Metrics\Collector;
use MrLinter\Contracts\Metrics\CollectorManager;
use MrLinter\Contracts\Metrics\Commit;
use MrLinter\Contracts\Metrics\Storage;

final class NoFlushManager implements CollectorManager
{
    public function __construct(
        private readonly CollectorManager $manager,
    ) {
    }

    public function register(Collector $collector): void
    {
        $this->manager->register($collector);
    }

    public function get(string $key): Collector
    {
        return $this->manager->get($key);
    }

    public function flush(Storage $storage, Commit $commit): void
    {
        // null
    }
}
