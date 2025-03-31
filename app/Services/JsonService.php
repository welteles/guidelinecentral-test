<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

abstract class JsonService implements JsonServiceInterface
{
    protected string $disk = 'local';
    protected string $path = 'json/';
    protected string $modelClass;

    public function all(): array
    {
        $data = $this->readFile();
        return array_map(
            fn($item) => new $this->modelClass($item),
            $data
        );
    }

    public function find(string $id): ?object
    {
        foreach ($this->readFile() as $item) {
            if ($item['id'] === $id) {
                return new $this->modelClass($item);
            }
        }
        return null;
    }

    public function save(object $model): void
    {
        $items = $this->readFile();
        $data = get_object_vars($model);

        // Generate UUID if missing
        if (empty($data['id'])) {
            $data['id'] = (string) Str::uuid();
            $items[] = $data;
        } else {
            $found = false;
            foreach ($items as &$item) {
                if ($item['id'] === $data['id']) {
                    $item = $data;
                    $found = true;
                    break;
                }
            }

            if (!$found) {
                $items[] = $data;
            }
        }

        $this->writeFile($items);
    }

    protected function readFile(): array
    {
        $file = $this->path . $this->modelClass::$table . '.json';
        if (!Storage::disk($this->disk)->get($file)) {
            return [];
        }
        $json = Storage::disk($this->disk)->get($file);
        return json_decode($json, true) ?? [];
    }

    protected function writeFile(array $items): void
    {
        $file = $this->path . $this->modelClass::$table . '.json';
        Storage::disk($this->disk)->put(
            $file,
            json_encode($items, JSON_PRETTY_PRINT)
        );
    }
}