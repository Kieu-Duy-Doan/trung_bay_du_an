<?php

namespace App\Models;

use App\Model;

class Banner extends Model
{
    public function countAll($options = [])
    {
        $keyword = $options['keyword'] ?? false;
        $queryBuilder = $this->connection->createQueryBuilder();
        $stmt = $queryBuilder->select('COUNT(*) as total')->from('banners');
        if ($keyword) {
            $stmt->where("name LIKE :value")->setParameter('value', "%$keyword%");
        }
        return $stmt->fetchOne();
    }

    public function getAll($options = [])
    {
        $offset = $options['offset'] ?? 0;
        $limit = $options['limit'] ?? 0;
        $order = $options['order'] ?? 'ASC';
        $sort = $options['sort'] ?? 'id';
        $keyword = $options['keyword'] ?? '';

        $queryBuilder = $this->connection->createQueryBuilder();

        if ($limit == 0) {
            $stmt = $queryBuilder->select('*')->from('banners');
        } else {
            $stmt = $queryBuilder->select('*')->from('banners', 'p')->setFirstResult($offset)->setMaxResults($limit)->orderBy($sort, $order);
        }

        if ($keyword) {
            $stmt->where("p.name LIKE :value")->setParameters([
                'value' => "%$keyword%"
            ]);
        }

        return $stmt->fetchAllAssociative();
    }

    public function getById($id)
    {

        $queryBuilder = $this->connection->createQueryBuilder();
        $stmt = $queryBuilder->select('*')->from('banners')->where('banners.id = :id')->setParameter('id', $id);
        return $stmt->fetchAssociative();
    }

    public function insert($data)
    {
        return $this->connection->insert('banners', $data);
    }

    public function update($data, $where)
    {
        return $this->connection->update('banners', $data, $where);
    }

    public function delete($where)
    {
        return $this->connection->delete('banners', $where);
    }

    public function updateOneColunm($options = [])
    {
        $column = $options['column'];
        $value = $options['columnValue'];
        $queryBuilder = $this->connection->createQueryBuilder();
        $stmt = $queryBuilder->update('banners')->set($options['key'], ':value')->setParameter('value', $options['value'])->where("$column = :value2")->setParameter('value2', $value);
        return $stmt->executeStatement();
    }
}
