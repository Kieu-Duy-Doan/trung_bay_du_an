<?php

namespace App\Models;

use App\Model;

class Contact extends Model
{
    public function countAll($options = [])
    {
        $keyword = $options['keyword'] ?? false;
        $key = $options['key'] ?? false;
        $value = $options['value'] ?? false;
        $queryBuilder = $this->connection->createQueryBuilder();
        $stmt = $queryBuilder->select('COUNT(*) as total')->from('contacts');
        if ($keyword) {
            $stmt->where("name LIKE :value")->setParameter('value', "%$keyword%");
        }

        if ($key !== false && $value !== false) {
            $stmt->where("$key = :value")->setParameter('value', $value);
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
        $key = $options['key'] ?? false;
        $value = $options['value'] ?? false;

        $queryBuilder = $this->connection->createQueryBuilder();

        if ($limit == 0) {
            $stmt = $queryBuilder->select('*')->from('contacts');
        } else {
            $stmt = $queryBuilder->select('*')->from('contacts')->setFirstResult($offset)->setMaxResults($limit)->orderBy($sort, $order);
        }

        if ($key !== false && $value !== false) {
            $stmt->andWhere("$key = :value")->setParameter('value', $value);
        }

        if ($keyword) {
            $stmt->andWhere("name LIKE :value")->setParameters([
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

    public function updateStatus($id, $options = [])
    {
        $queryBuilder = $this->connection->createQueryBuilder();
        $stmt = $queryBuilder->update('contacts');
        for ($i = 0; $i < count($options); $i++) {
            $stmt->set($options[$i]['key'], ":value$i")->setParameter("value$i", $options[$i]['value']);
        }
        $stmt->where('contacts.id = :id')->setParameter('id', $id);
        return $stmt->executeStatement();
    }
}
