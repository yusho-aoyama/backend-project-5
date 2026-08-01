<?php

namespace Commands\Programs;

use Commands\AbstractCommand;
use Commands\Argument;

class Migrate extends AbstractCommand
{
    // 使用するコマンド名を設定
    protected static ?string $alias = 'migrate';

    // 引数を割り当て
    public static function getArguments(): array
    {
        return [
            (new Argument('rollback'))
                ->description('Roll backwards. An integer n may also be provided to rollback n times.')
                ->required(false)
                ->allowAsShort(true),

            (new Argument('init'))
                ->description("Create the migrations table if it doesn't exist.")
                ->required(false)
                ->allowAsShort(true),
        ];
    }

    public function execute(): int
    {
        $rollback = $this->getArgumentValue('rollback');

        if ($this->getArgumentValue('init')) $this->createMigrationsTable();

        if ($rollback === false) {
            $this->log("Starting migration......");
            $this->migrate();
        } else {
            // rollbackはtrueに設定されているか、それに関連付けられた値が整数として存在するかのいずれかです。
            $rollbackN = $rollback === true ? 1 : (int)$rollback;
            $this->log("Running rollback....");
            $this->rollback($rollbackN);
        }

        return 0;
    }

    private function createMigrationsTable(): void
    {
        $this->log("Creating migrations table if necessary...");

        $mysqli = new MySQLWrapper();

        $result = $mysqli->query("
            CREATE TABLE IF NOT EXISTS migrations (
                id INT AUTO_INCREMENT PRIMARY KEY,
                filename VARCHAR(255) NOT NULL
            );
        ");

        if ($result === false) throw new \Exception("Failed to create migration table.");

        $this->log("Done setting up migration tables.");
    }

    private function migrate(): void {
        $this->log("Running migrations...");
        $this->log("Migration ended...\n");
    }

    private function rollback(): void {
        $this->log("Rolling back migration...\n");
    }
}