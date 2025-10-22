<?php

interface StorableInterface
{
    public function getAll();
    public function create(string $model, array $data, array $fillable);
    public function get(int $id, string $message = 'Desired record is not Found');
    public function edit(int $id, array $data);
    public function delete(int $id);
}
