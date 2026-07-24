<?php

declare(strict_types=1);

namespace Database\Migrations;

interface Migration
{
    /**
     * Returns SQL queries to apply the migration.
     *
     * @return string[]
     */
    public function up(): array;

    /**
     * Returns SQL queries to rollback the migration.
     *
     * @return string[]
     */
    public function down(): array;
}