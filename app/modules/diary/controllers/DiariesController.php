<?php

namespace diary\modules\diary\controllers;

use yii\filters\Cors;
use yii\helpers\ArrayHelper;
use yii\web\Response;
use yii\rest\ActiveController as Controller;


/**
 * Class DiariesController
 * For example diary API Restful
 * @package diary\modules\diary\controllers
 */
class DiariesController extends Controller
{
    /**
     * @var \yii\db\ActiveRecordInterface
     */
    public $modelClass = 'diary\modules\diary\models\Diary';

    /**
     * For example only rules CORS - Same origin
     */

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        $parentBehaviors = parent::behaviors();

        $parentBehaviors['contentNegotiator']['formats'] = [
            'application/json' => Response::FORMAT_JSON,
        ];

        unset($parentBehaviors['rateLimiter']);

        $parentBehaviors['cors'] = [
            'class' => Cors::class,
            'cors' => [
                'Origin' => ['*'],
                'Access-Control-Request-Method' => ['GET', 'HEAD', 'POST', 'PUT', 'PATCH', 'DELETE', 'OPTIONS'],
                'Access-Control-Request-Headers' => ['*'],
                'Access-Control-Allow-Credentials' => null,
                'Access-Control-Max-Age' => 86400,
                'Access-Control-Expose-Headers' => ['X-Pagination-Total-Count', 'X-Pagination-Page-Count', 'X-Pagination-Current-Page', 'X-Pagination-Per-Page', 'Link'],
            ],
        ];

        return $parentBehaviors;
    }

}

