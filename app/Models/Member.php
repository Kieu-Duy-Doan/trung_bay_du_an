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
        $condition = $options['condition'] ?? false;

        $queryBuilder = $this->connection->createQueryBuilder();

        if ($limit == 0) {
            $stmt = $queryBuilder->select('m.*')->from('members', 'm')->setFirstResult($offset)->orderBy($sort, $order);
        } else {
            $stmt = $queryBuilder->select('m.*')->from('members', 'm')->setFirstResult($offset)->setMaxResults($limit)->orderBy($sort, $order);
        }

        if ($condition) {
            $stmt->where($condition);
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

    public function updateTeamID($memberID, $teamID)
    {
        $queryBuilder = $this->connection->createQueryBuilder();
        $stmt = $queryBuilder->update('members')
            ->set('team_id', ':team_id')
            ->where('id = :id')
            ->setParameter('team_id', $teamID)
            ->setParameter('id', $memberID);
        return $stmt->executeStatement();
    }
}
