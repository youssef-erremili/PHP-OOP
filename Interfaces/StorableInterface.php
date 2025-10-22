<?php 

interface StorableInterface 
{
    public function getAll();
    public function create(array $data);
    public function read(string $model, int $id, string $message = 'Desired record is not Found');
    public function update(int $id, array $data);
    public function delete(int $id);

}