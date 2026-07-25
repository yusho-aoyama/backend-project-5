<?php

namespace Commands\Programs;

use Commands\AbstractCommand;
use Commands\Argument;

class DbWipe extends AbstractCommand
{
    protected static ?string $alias = 'db-wipe';

    public static function getArguments(): array
    {
        return [
            (new Argument('backup'))
                ->description('Backup the database.')
                ->required(false)
                ->allowAsShort(true),
        ];
    }

    public function execute(): int
    {
        $backup = $this->getArgumentValue('backup');

        if ($backup !== false) {
            $this->log('Starting backup...');
            $this->backup();
        }

        $this->log('Starting database wipe...');
        $this->wipe();

        return 0;
    }

    private function backup(): void
    {
        $this->log('Creating database backup...');
    }

    private function wipe(): void
    {
        $this->log('Database wipe command executed.');
    }
}