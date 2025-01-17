<?php
namespace M2i\Core\ORM;

use PDO;

class DAO{

    public function __construct(
        private PDO $pdo,
        private QueryBuilder $qb,
        private string $tableName
    ){}

    public function findOneById(int $id): array{
        $sql = $this    ->qb  ->select()
                        ->from($this->tableName)
                        ->addField('id')
                        ->addField('user_name')
                        ->addField('login_name')
                        ->addWhere("id=?");
        $statement = $this->pdo->prepare($this->qb->getQuery());
        $statement->execute([$id]);
        return $statement->fetch(PDO::FETCH_ASSOC);
    }

}