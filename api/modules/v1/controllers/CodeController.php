<?php

namespace api\modules\v1\controllers;

use api\behaviors\returnStatusBehavior\JsonSuccess;
use api\behaviors\returnStatusBehavior\RequestFormData;
use common\components\exceptions\ModelSaveException;
use common\models\Code;
use OpenApi\Attributes\Post;
use OpenApi\Attributes\Property;
use Yii;
use yii\db\Exception;
use yii\helpers\ArrayHelper;

class CodeController extends AppController
{
    /**
     * @throws Exception
     * @throws ModelSaveException
     */
    #[Post(
        path: '/code/register',
        operationId: 'register',
        description: 'Code',
        summary: 'Code',
        security: [['bearerAuth' => []]],
        tags: ['code']
    )]
    #[RequestFormData(
        requiredProps: ['code'],
        properties: [
            new Property(property: 'code', description: 'Code', type: 'string'),
        ]
    )]
    #[JsonSuccess(content: [
        new Property(property: 'promocode', type: 'string')
    ])]

    public function actionRegister(): array
    {
        $userId = Yii::$app->user->id;
        $code = Yii::$app->request->post('code');

        if (!$code) {
            return $this->returnError('Code is required.');
        }

        $params = Yii::$app->params;
        $cacheKey = "block_data_{$userId}";

        $blockData = Yii::$app->cache->get($cacheKey); // Получаем данные о блокировке из кэша

        if ($blockData === false) {
            $blockData = [
                'attempts' => 0,
                'blocked_until' => null,
            ];
        }
        if (time() < $blockData['blocked_until']) {
            return $this->returnError(['Вы все еще заблокированы']);
        }

        $codeModel = Code::findOne(['code' => $code, 'public_status' => 0]);

        if (!$codeModel) {
            $blockData['attempts'] += 1;
            if ($blockData['attempts'] >= $params['maxAttempts']) {
                if ($blockData['attempts'] == $params['maxAttempts']) {
                    $blockData['blocked_until'] = time() + $params['blockTimeFirst'];
                    $blockMessage = Yii::$app->formatter->asDuration($params['blockTimeFirst']);
                } elseif ($blockData['attempts'] == $params['maxAttempts'] + 1) {
                    $blockData['blocked_until'] = time() + $params['blockTimeSecond'];
                    $blockMessage = Yii::$app->formatter->asDuration($params['blockTimeSecond']);
                } else {
                    Yii::$app->user->identity->ban();
                }
            }
        } else {
            $blockData['attempts'] = 0;
        }
        Yii::$app->cache->set($cacheKey, $blockData, 3600); // Сохраняем данные о блокировке в кэш. Время хранения в кэше 1 час
        if (isset($blockMessage)) {
            return $this->returnError("Вы временно заблокированы на $blockMessage.");
        }
        $codeModel->user_id = $userId;
        $codeModel->taken_at = time();
        $codeModel->user_ip = Yii::$app->request->longUserIp;
        $codeModel->public_status = 1;
        $codeModel->save();

        return $this->returnSuccess([
            'promocode' => $codeModel->promocode
        ]);
    }
}
