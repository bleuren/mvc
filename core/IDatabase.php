<?php

namespace core;

interface IDatabase
{
    public function all();
    public function find(string $id);
    public function save(array $data);
    public function update(array $data, string $id);
    public function delete(string $id);
}
