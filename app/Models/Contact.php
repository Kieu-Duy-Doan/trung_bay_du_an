<?php

namespace App\Models;

use App\Model;

class Contact extends Model
{
    public function countAll($options = [])
    {
        $keyword = $options['keyword'] ?? false;
        $queryBuilder = $this->connection->createQueryBuilder();
        $stmt = $queryBuilder->select('COUNT(*) as total')->from('contacts');
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
            $stmt = $queryBuilder->select('*')->from('contacts');
        } else {
            $stmt = $queryBuilder->select('*')->from('contacts')->setFirstResult($offset)->setMaxResults($limit)->orderBy($sort, $order);
        }

        if ($keyword) {
            $stmt->where("name LIKE :value")->setParameters([
                'value' => "%$keyword%"
            ]);
        }

        return $stmt->fetchAllAssociative();
    }

    public function getById($id)
    {

        $queryBuilder = $this->connection->createQueryBuilder();
        $stmt = $queryBuilder->select('*')->from('contacts')->where('contacts.id = :id')->setParameter('id', $id);
        return $stmt->fetchAssociative();
    }

    public function insert($data)
    {
        return $this->connection->insert('contacts', $data);
    }

    public function update($data, $where)
    {
        return $this->connection->update('contacts', $data, $where);
    }

    public function delete($where)
    {
        return $this->connection->delete('contacts', $where);
    }
}
