<?php

namespace data;

use yii\db\ActiveDataProvider;

abstract class YiiArRepository implements RepositoryInterface
{
	private object $query;

    public function __construct(
    	private string $modelClass
    ) {
    	$this->resetQuery();
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
    	$model = $this->query->one();
    	$this->resetQuery();
    	return $model;
    }


    /**
     * Return all records
     * @return array
     */
    public function all(): array
    {
    	$models = $this->query->all();
    	$this->resetQuery();
    	return $models;
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
     * Restores query to default
     */
    public function resetQuery(): void
    {
    	$this->query = new $this->modelClass();
    }

    /**
     * @param $id int
     * @return object
     */
    public static function findOneById(int $id): object
    {
    	return $this->modelClass::findOne($id);
    }

    /**
     * @param $ids array
     * @param $limit int
     *
     * @return array
     */
    public static function findManyByIds(array $ids, int $limit = 50): array
    {
    	return $this->modelClass::find()
    		->where(['in', self::PRIMARY_KEY, $ids])
    		->limit(50)
    		->all();
    }

    /**
     * @param $criteria array
     * @param $with array
     *
     * @return object
     */
    public static function findOneByCriteria(array $criteria = [], array $with = []): object
    {
    	return $this->modelClass::find()
    		->where($criteria)
    		->with($with)
    		->one();
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
    	return $this->modelClass::find()
    		->where($criteria)
    		->with($with)
    		->limit($limit)
    		->all();
    }

    /**
     * @param $limit int
     * @return array
     */
    public static function findAll(int $limit = 50): array
    {
    	return $this->modelClass::find()
    		->limit($limit)
    		->all();
    }
}
