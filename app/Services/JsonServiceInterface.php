<?php

namespace App\Services;

interface JsonServiceInterface
{
    public function all(): array;
    public function find(string $id): ?object;
    public function save(object $model): void;
}