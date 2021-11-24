<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $roles array */

$this->title = 'Пользователи';
$this->params['breadcrumbs'][] = $this->title;


function changeRole($role, $userId)
{
    $roles = [
        0 => [
            'Сделать администратором',
            'makeadmin'
        ],
        1 => [
            'Сделать пользователем',
            'makeuser'
        ]
    ];
    return Html::a($roles[$role][0], sprintf("user/%s/?id=%d", $roles[$role][1], $userId));
}

?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Добавить пользователя', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'email:email',
            'name',
            'surname',
            ['attribute' => 'active', 'value' => function ($data) {
                return $data->getActiveUser();
            }],
            ['attribute' => 'role', 'value' => function ($data) {
                return $data->getRoleUser();
            }],
            [
                'format' => 'html',
                'value' => function ($data) {
                    switch ($data->is_active) {
                        case 0:
                            return Html::a('Активировать', 'user/activate/?id=' . $data->id);
                        case 1:
                            return Html::a('Деактивировать', 'user/deactivate/?id=' . $data->id);
                    }
                }
            ],
            [
                'format' => 'html',
                'value' => function ($data) {
//                    switch ($data->role) {
//                        case 0:
//                            return Html::a('Сделать администратором', 'user/makeadmin/?id=' . $data->id);
//                        case 1:
//                            return Html::a('Сделать пользователем', 'user/makeuser/?id=' . $data->id);
//                    }
                    return changeRole($data->role, $data->id);
                }
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'headerOptions' => ['style' => 'width: 100%'],
            ],
        ],
        'options' => [
            'class' => 'shadow-lg rounded',
        ],
    ]); ?>


</div>
