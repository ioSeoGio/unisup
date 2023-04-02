<?php declare(strict_types=1);

namespace domain\common\responses;

use yii\data\BaseDataProvider;

final class PaginatedResponse implements \JsonSerializable
{
    public function __construct(
        public array $data,
        BaseDataProvider $dataProvider,
    ) {
        $this->data['totalPages'] = $dataProvider->getPagination()->getPageCount();
    }

    public function jsonSerialize(): array
    {
        return $this->data;
    }
}
