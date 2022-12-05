<?php

namespace app\commands;

use Yii;
use yii\console\Controller;
use yii\console\ExitCode;

class SwaggerController extends Controller
{
    public function actionGenerate(): int
    {
        $file = Yii::getAlias('@web/doc/swagger.json');
        $handle = fopen($file, 'wb');

        $toScan = [
            Yii::getAlias('@app/controllers/'),
            Yii::getAlias('@app/modules/admin/controllers/'),
            Yii::getAlias('@app/modules/documentBuilder/controllers/'),
        ];

        $openApi = \OpenApi\Generator::scan($toScan);
        fwrite($handle, $openApi->toJson());

        fclose($handle);
        echo ("Created.\n");

        return ExitCode::OK;
    }
}
