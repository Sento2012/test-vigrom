<?php

namespace App\Repository;

use Illuminate\Database\Capsule\Manager as Capsule;

abstract class BaseDatabase
{
    public const PARAM_FIELD = 'field';
    public const PARAM_OPERATOR = 'operator';
    public const PARAM_VALUE = 'value';

    abstract protected function getTable(): string;

    protected function getAll(array $params = []): array
    {
        $capsule = Capsule::table($this->getTable());
        foreach ($params as $param) {
            $capsule->where($param[self::PARAM_FIELD], $param[self::PARAM_OPERATOR], $param[self::PARAM_VALUE]);
        }

        return $capsule->get()->all();
    }

    protected function getOneByField(string $id, string $field): ?array
    {
        $record = $this->getAll([
            [
                self::PARAM_FIELD => $field,
                self::PARAM_OPERATOR => '=',
                self::PARAM_VALUE => $id,
            ],
        ]);

        return $record ? get_object_vars(current($record)) : null;
    }

    protected function addRecord(array $params): bool
    {
        return Capsule::table($this->getTable())
            ->insert($params);
    }

    public function updateRecord(array $params): bool
    {
        return (bool) Capsule::table($this->getTable())
            ->where('id', '=', $params['id'])
            ->update($params);
    }
}