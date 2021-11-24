<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\commands;

use yii\console\Controller;
use yii\console\ExitCode;
use Faker;


class SeederController extends Controller
{
    /**
     * Создание админа.
     * @return int Exit code
     */
    public function actionAdminUser()
    {
        try {
            echo \Yii::$app->db->createCommand()->insert('users',
                [
                    'email' => 'admin@admin.ru',
                    'name' => 'Eugene',
                    'surname' => 'Kerov',
                    'password' => md5('admin'),
                    'role' => 1
                ]
            )->execute();
        } catch (\Exception $exception) {
            echo $exception->getMessage();
        }
        return ExitCode::OK;
    }

    /**
     * Создание тем. Кол-во тем = введенное кол-во * кол-во пользователей
     * @param int $count
     * @return int
     * @throws \yii\db\Exception/
     */
    public function actionTheme($count = 1)
    {
        $faker = Faker\Factory::create();
        $users = \Yii::$app->db->createCommand('SELECT id FROM users')->queryAll();
        foreach ($users as $user) {
            for ($i = 0; $i < $count; $i++) {
                try {
                    echo \Yii::$app->db->createCommand()->insert('themes',
                        [
                            'user_id' => $user['id'],
                            'name' => $faker->name,
                            'text' => $faker->text,
                        ]
                    )->execute();
                } catch (\Exception $exception) {
                    echo $exception->getMessage();
                }
            }
        }
        return ExitCode::OK;
    }

    /**
     * Создание ответов. Кол-во ответов = введенное кол-во * кол-во пользователей * кол-во тем
     * @param int $count
     * @return int
     * @throws \yii\db\Exception
     */
    public function actionAnswer($count = 1)
    {
        $faker = Faker\Factory::create();
        $users = \Yii::$app->db->createCommand('SELECT id FROM users')->queryAll();
        $themes = \Yii::$app->db->createCommand('SELECT id FROM themes')->queryAll();
        foreach ($users as $user) {
            foreach ($themes as $theme) {
                for ($i = 0; $i < $count; $i++) {
                    try {
                        echo \Yii::$app->db->createCommand()->insert('answers',
                            [
                                'user_id' => $user['id'],
                                'theme_id' => $theme['id'],
                                'text' => $faker->text(),
                            ]
                        )->execute();
                    } catch (\Exception $exception) {
                        echo $exception->getMessage();
                    }
                }
            }
        }
        return ExitCode::OK;
    }


}
