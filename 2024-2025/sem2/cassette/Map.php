<?php

namespace sem2\cassette;
class Map
{
    private array $keys;
    private array $values;

    public function __construct()
    {
        $this->keys = [];
        $this->values = [];
    }

    public function put($key, $value): void
    {
        if (!in_array($key, $this->keys)) {
            $this->keys[] = $key;
            $this->values[] = $value;
        }
    }

    public function modify($key, $value): void
    {
        $index = array_search($key, $this->keys);
        if ($index !== false) {
            $this->values[$index] = $value;
        }
    }

    public function get($key)
    {
        $index = array_search($key, $this->keys);
        if ($index !== false) {
            return $this->values[$index];
        }
        return null;
    }

    public function remove($key): void
    {
        $index = array_search($key, $this->keys);
        if ($index !== false) {
            unset($this->keys[$index]);
            unset($this->values[$index]);
            $this->keys = array_values($this->keys);
            $this->values = array_values($this->values);
        }
    }

    public function containsKey($key): bool
    {
        return in_array($key, $this->keys);
    }

    public function containsValue($value): bool
    {
        return in_array($value, $this->values);
    }

    public function size(): int
    {
        return count($this->keys);
    }

    public function isEmpty(): bool
    {
        return empty($this->keys);
    }

    public function clear(): void
    {
        $this->keys = [];
        $this->values = [];
    }

    public function keys(): array
    {
        return $this->keys;
    }

    public function values(): array
    {
        return $this->values;
    }

    public function entries(): array
    {
        $entries = [];
        foreach ($this->keys as $index => $key) {
            $entries[] = [
                'k' => $key,
                'v' => $this->values[$index]];
        }
        return $entries;
    }
}