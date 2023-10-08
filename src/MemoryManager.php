<?php

namespace MrLinter\Metrics\CollectorManager;

use MrLinter\Contracts\Metrics\Collector;
use MrLinter\Contracts\Metrics\CollectorAlreadyRegisteredException;
use MrLinter\Contracts\Metrics\CollectorManager;
use MrLinter\Contracts\Metrics\CollectorNotFoundException;
use MrLinter\Contracts\Metrics\Commit;
use MrLinter\Contracts\Metrics\Snapshot;
use MrLinter\Contracts\Metrics\Storage;

final class MemoryManager implements CollectorManager
{
    /** @var array<string, Collector> */
    private array $collectors = [];

    public function register(Collector $collector): void
    {
        $key = $collector->subject()->key;

        if (isset($this->collectors[$key])) {
            throw new CollectorAlreadyRegisteredException(sprintf(
                'Collector for subject with key "%s" already registered',
                $key,
            ));
        }

        $this->collectors[$key] = $collector;
    }

    public function get(string $key): Collector
    {
        if (! isset($this->collectors[$key])) {
            throw new CollectorNotFoundException(sprintf(
                'Collector with key "%s" not found',
                $key,
            ));
        }

        return $this->collectors[$key];
    }

    public function flush(Storage $storage, Commit $commit): void
    {
        $storage->flush($commit, $this->collect());
    }

    /**
     * @return array<string, Collector>
     */
    public function all(): array
    {
        return $this->collectors;
    }

    /**
     * @return iterable<Snapshot>
     */
    private function collect(): iterable
    {
        $snapshots = [];

        foreach ($this->collectors as $collector) {
            $snapshots[] = $collector->collect();
        }

        return $snapshots;
    }
}
