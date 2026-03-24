<?php

namespace App\Models;

use App\Model;

class MemberTeam extends Model
{
    public function countAll($options = [])
    {
        $keyword = $options['keyword'] ?? false;
        $queryBuilder = $this->connection->createQueryBuilder();
        $stmt = $queryBuilder->select('COUNT(*) as total')->from('member_team');
        if ($keyword) {
            $stmt->where("name LIKE :value")->setParameter('value', "%$keyword%");
        }
        return $stmt->fetchOne();
    }

    public function getAllByCondition($options = [])
    {

        $teamId = $options['teamId'] ?? false;

        $queryBuilder = $this->connection->createQueryBuilder();

        $stmt = $queryBuilder->select('*')->from('member_team');

        if ($teamId) {
            $stmt->andWhere('team_id = :teamId')->setParameter('teamId', $teamId);
        }
        return $stmt->fetchAllAssociative();
    }

    public function getById($id)
    {

        $queryBuilder = $this->connection->createQueryBuilder();
        $stmt = $queryBuilder->select('*')->from('member_team')->where('member_team.id = :id')->setParameter('id', $id);
        return $stmt->fetchAssociative();
    }

    public function insert($data)
    {
        return $this->connection->insert('member_team', $data);
    }

    public function update($data, $where)
    {
        return $this->connection->update('member_team', $data, $where);
    }

    public function delete($where)
    {
        return $this->connection->delete('member_team', $where);
    }
}
