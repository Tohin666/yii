<?php

namespace app\controllers;

use app\behaviors\MyBehavior;
use app\models\tables\Test;
use yii\base\Event;
use yii\web\Controller;

class EventController extends Controller
{
    public function actionIndex()
    {
//        $model = new Test();

        // подписчик вызывается методом on. Есть несколько вариантов вызова подписчика:
//        $model->on(Test::EVENT_RUN_COMPLETE, 'foo'); // вызывается какая-то функция
//        $model->on(Test::EVENT_RUN_COMPLETE, [new \stdClass(), 'handler']); //вызывается метод объекта
//        $model->on(Test::EVENT_RUN_COMPLETE, ['stdClass', 'handler']); //вызывается статический метод класса
//        $model->on(Test::EVENT_RUN_COMPLETE, function () {
//            echo "типа сигнал получен";
//        }); //вызывается анонимная функция


//        $anonymousFunction = function () {
//            echo "Сработало стартовое событие";
//        };
//        $model->on(Test::EVENT_RUN_START, $anonymousFunction); //вызывается анонимная функция
//
//
//        $model->run();


        // отключается методом off.

        // с анонимной функцией так не сработает:
//        $model->off(Test::EVENT_RUN_COMPLETE, function () {
//            echo "типа сигнал получен";
//        });

//        $model->off(Test::EVENT_RUN_START, $anonymousFunction);
//
//
//        $model->run();


        // Обработчики выше срабатывают только для конкретной модели $model. А чтобы повесить обработчики на все
        // экземпляры класса надо вызвать метод on у класса Event
        $anonymousFunction = function ($event) {
            echo "Сработало стартовое событие";
            var_dump($event);
        };
        Event::on(Test::class, Test::EVENT_RUN_START, $anonymousFunction);

        $model = new Test();

        $model->run();


        exit;
    }


    public function actionBehavior()
    {
        $model = new Test();

        // данным методом прикрепляем поведение к экземпляру объекта. Если надо прикрепить ко всем экземпляром, то
        // переопределяем поведение в самом классе.
        $model->attachBehavior('someBehaviorName', [
            'class' => MyBehavior::class,
//            'message' => "мое поведение!",
        ]);

        // теперь можем вызвать метод фу из поведения
        $model->foo();
        exit;
    }
}