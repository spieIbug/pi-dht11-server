<?php
namespace Src\Api\Repositories;
use Src\Api\Common\RepositoryException;
trait RepositoryLauncher
{
    /**
     * executes query, and handle errors
     * @param $stmt
     * @throws RepositoryException
     */
    public static function launch($stmt){
        try{
            $stmt->execute();
        } catch(\PDOException $e){
            throw new RepositoryException($e->getMessage(), $e->errorInfo[1]);
        }
    }
}