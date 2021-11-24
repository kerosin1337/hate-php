<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Модерация тем';
$this->params['breadcrumbs'][] = $this->title;
function changeRole($status, $userId)
{
    $status = [
        0 => 'Сделать администратором',
        1 => 'Сделать пользователем'
    ];
    return Html::a($roles[$role], "user/makeuser/?id=$userId");
}
?>
<div class="theme-index">
    <h1><?= Html::encode($this->title) ?></h1>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'Имя',
                'format' => 'raw',
                'value' => function ($model) {
                    return $model->user->name . ' ' . $model->user->surname;
                },
            ],
            'name',
            'text:ntext',
            ['attribute' => 'status', 'value' => function ($data) {
                return $data->getStatusText();
            }],
            ['attribute' => 'date', 'format' => ['date', 'd.MM.Y - H:i:s']],

            [
                'attribute' => 'Администрирование',
                'format' => 'html',
                'value' => function ($data) {
                    switch ($data->status) {
                        case 1:
                            return Html::a('Одобрить', 'approve/?id=' . $data->id) . " | " .
                                Html::a('Отклонить', 'reject/?id=' . $data->id);
                        case 2:
                            return Html::a('Отклонить', 'reject/?id=' . $data->id);
                        case 0:
                            return Html::a('Одобрить', 'approve/?id=' . $data->id);
                    }
                }
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
        'options' => [
            'class' => 'shadow-lg rounded',
        ],
    ]); ?>

</div>
