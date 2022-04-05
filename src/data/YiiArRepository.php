<?php

namespace data;

use yii\data\ActiveDataProvider;
use yii\db\ActiveQuery;
use factories\RepositoryFactoryInterface;

abstract class YiiArRepository implements RepositoryInterface
{
    /**
     * Backup of query, setted in constructor
     * Used to restore query to default state
     */
    private ActiveQuery $queryBackup;


    public function __construct(
    	private ActiveQuery $query,
    	private RepositoryFactoryInterface $factory
    ) {
        $this->queryBackup = clone $query;
    }

    /**
     * Restores query to default
     */
    private function resetQuery(): void
    {
        $this->query = clone $this->queryBackup;
    }

    /**
     * @param $with array
     * @return self
     */
    public function with(array $with = []): self
    {
    	$this->query
            ->with($with);
    	return $this;
    }

    /**
     * @param $columns array
     * @return self
     */
    public function select(array $columns = ['*']): self
    {
    	$this->query
            ->select($columns);
    	return $this;
    }

    /**
     * @param $limit int
     * @return self
     */
    public function limit(int $limit = 50): self
    {
    	$this->query
            ->limit($limit);
    	return $this;
    }

    /**
     * @param $columns Pairs *column name* => *sort order*
     * @return self
     */
    public function orderBy($columns = [self::PRIMARY_KEY => self::ASC]): self
    {
    	$this->query
            ->orderBy($columns);
    	return $this;
    }

    /**
     * @return object
     */
    public function one(): object
    {
    	$dto = $this->getDTO($this->query);
    	$this->resetQuery();
    	return $dto;
    }

    /**
     * Return all records
     * @return array
     */
    public function all(): array
    {
    	$dtos = $this->getDTOs($this->query);
    	$this->resetQuery();
    	return $dtos;
    }

    public function asDataProvider(int $pageSize = 50): ActiveDataProvider
    {
    	$dataProvider = new ActiveDataProvider([
    		'query' => $this->query,
    		'pagination' => [
    			'pageSize' => $pageSize,
    		],
    	]);
    	$this->resetQuery();
    	return $dataProvider;
    }

    /**
     * @param $id int
     * @return object
     */
    public function findOneById(int $id): object
    {
        $this->query
            ->where([self::PRIMARY_KEY => $id]);
    	return $this->getDTO();
    }

    /**
     * @param $ids array
     * @param $limit int
     *
     * @return array
     */
    public function findManyByIds(array $ids, int $limit = 50): array
    {
    	$this->query
            ->where(['in', self::PRIMARY_KEY, $ids])
    		->limit(50);
    	return $this->getDTOs();
    }

    /**
     * @param $criteria array
     * @param $with array
     *
     * @return object
     */
    public function findOneByCriteria(array $criteria = [], array $with = []): object
    {
		$this->query
            ->where($criteria)
    		->with($with);
    	return $this->getDTO();
    }

    /**
     * @param $criteria array
     * @param $limit int
     * @param $with array
     *
     * @return array
     */
    public function findManyByCriteria(array $criteria = [], int $limit = 50, array $with = []): array
    {
    	$this->query
            ->where($criteria)
    		->with($with)
    		->limit($limit);
    	return $this->getDTOs();
    }

    /**
     * @param $limit int
     * @return array
     */
    public function findAll(int $limit = 50): array
    {
    	$this->query
            ->limit($limit);
    	return $this->getDTOs();
    }


    /**
     * @return object
     */
    private function getDTO(): object
    {
    	return $this->factory->makeDTO(
            $this->query->one()
        );
    }

    /**
     * @return array
     */
    private function getDTOs(): array
    {
    	$dtos = [];
    	foreach ($this->query->batch() as $model) {
    		$dtos[] = $this->getDTO($model); 
    	}
    	return $dtos;
    }
}
