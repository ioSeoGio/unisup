<?php

namespace data;

use yii\db\ActiveDataProvider;
use factories\RepositoryFactoryInterface;

abstract class YiiArRepository implements RepositoryInterface
{
	private object $query;

    public function __construct(
    	private string $modelClass,
    	private RepositoryFactoryInterface $factory
    ) {
    	$this->resetQuery();
    }

    /**
     * Restores query to default
     */
    public function resetQuery(): void
    {
    	$this->query = $this->modelClass::find();
    }

    /**
     * @param $with array
     * @return self
     */
    public function with(array $with = []): self
    {
    	$this->query->with($with);
    	return $this;
    }

    /**
     * @param $columns array
     * @return self
     */
    public function columns(array $columns = ['*']): self
    {
    	$this->query->columns($columns);
    	return $this;
    }

    /**
     * @param $limit int
     * @return self
     */
    public function limit(int $limit = 50): self
    {
    	$this->query->limit($limit);
    	return $this;
    }

    /**
     * @param $columns Pairs *column name* => *sort order*
     * @return self
     */
    public function orderBy($columns): self
    {
    	$this->query->orderBy($columns);
    	return $this;
    }

    /**
     * @return object
     */
    public function one(): object
    {
    	$dto = $this->getDTO($this->query->one());
    	$this->resetQuery();
    	return $dto;
    }

    /**
     * Return all records
     * @return array
     */
    public function all(): array
    {
    	$dtos = $this->getDTOs($query);
    	$this->resetQuery();
    	return $dtos;
    }

    public function asDataProvider(int $pageSize = 50)
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
    public static function findOneById(int $id): object
    {
    	return $this->getDTO(
    		$this->modelClass::findOne($id)
    	);
    }

    /**
     * @param $ids array
     * @param $limit int
     *
     * @return array
     */
    public static function findManyByIds(array $ids, int $limit = 50): array
    {
    	$query = $this->modelClass::find()
    		->where(['in', self::PRIMARY_KEY, $ids])
    		->limit(50);
    	return $this->getDTOs($query);
    }

    /**
     * @param $criteria array
     * @param $with array
     *
     * @return object
     */
    public static function findOneByCriteria(array $criteria = [], array $with = []): object
    {
		$model = $this->modelClass::find()
    		->where($criteria)
    		->with($with)
    		->one();
    	return $this->getDTO($model);
    }

    /**
     * @param $criteria array
     * @param $limit int
     * @param $with array
     *
     * @return array
     */
    public static function findManyByCriteria(array $criteria = [], int $limit = 50, array $with = []): array
    {
    	$query = $this->modelClass::find()
    		->where($criteria)
    		->with($with)
    		->limit($limit);
    	return $this->getDTOs($query);
    }

    /**
     * @param $limit int
     * @return array
     */
    public static function findAll(int $limit = 50): array
    {
    	$query = $this->modelClass::find()
    		->limit($limit);
    	return $this->getDTOs($query);
    }

    /**
     * @param $model ActiveRecord
     * @return object
     */
    private function getDTO(ActiveRecord $model): object
    {
    	return $this->factory::makeDTO($model);
    }

    /**
     * @param $query ActiveQuery
     * @return array
     */
    private function getDTOs(ActiveQuery $query): array
    {
    	$dtos = [];
    	foreach ($query->batch() as $model) {
    		$dtos[] = $this->getDTO($model); 
    	}
    	return $dtos;
    }
}
