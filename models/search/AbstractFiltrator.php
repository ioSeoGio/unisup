<?php declare(strict_types=1);

namespace models\search;

use data\FiltratorInterface;
use seog\base\ModelAdapter;
use seog\web\RequestAdapterInterface;
use yii\data\ActiveDataProvider;

abstract class AbstractFiltrator extends ModelAdapter implements FiltratorInterface
{
    public function __construct(
        protected RequestAdapterInterface $request,
        $config = [],
    ) {
        parent::__construct($config);
    }

    abstract public function search(): ActiveDataProvider;
}
