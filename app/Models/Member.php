<?php

namespace App\Models;

use App\Model;

class Member extends Model
{
    public function countAll($options = [])
    {
        $keyword = $options['keyword'] ?? false;
        $queryBuilder = $this->connection->createQueryBuilder();
        $stmt = $queryBuilder->select('COUNT(*) as total')->from('members');
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
            $stmt = $queryBuilder->select('*')->from('members');
        } else {
            $stmt = $queryBuilder->select('m.*', 't.name as team_name')->from('members', 'm')->leftJoin('m', 'teams', 't', 'm.team_id=t.id')->setFirstResult($offset)->setMaxResults($limit)->orderBy($sort, $order);
        }

        if ($keyword) {
            $stmt->where("m.name LIKE :value")->setParameters([
                'value' => "%$keyword%"
            ]);
        }

        return $stmt->fetchAllAssociative();
    }

    public function getById($id)
    {

        $queryBuilder = $this->connection->createQueryBuilder();
        $stmt = $queryBuilder->select('*')->from('members')->where('members.id = :id')->setParameter('id', $id);
        return $stmt->fetchAssociative();
    }

    public function insert($data)
    {
        return $this->connection->insert('members', $data);
    }

    public function update($data, $where)
    {
        return $this->connection->update('members', $data, $where);
    }

    public function delete($where)
    {
        return $this->connection->delete('members', $where);
    }
}
