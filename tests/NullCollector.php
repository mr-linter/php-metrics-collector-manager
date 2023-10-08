<?php

namespace MrLinter\Metrics\CollectorManager\Tests;

use MrLinter\Contracts\Metrics\Collector;
use MrLinter\Contracts\Metrics\Snapshot;
use MrLinter\Contracts\Metrics\Subject;

final class NullCollector implements Collector
{
    public function subject(): Subject
    {
        return new Subject('null', 'null', '');
    }

    public function collect(): Snapshot
    {
        // TODO: Implement collect() method.
    }
}
