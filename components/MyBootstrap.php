<?php

namespace app\components;

use app\models\tables\Tasks;
use app\models\tables\Users;
use yii\base\Application;
use yii\base\BootstrapInterface;
use yii\base\Component;
use yii\base\Event;
use yii\db\ActiveRecord;
use Yii;

/**
 * Класс-компонент для подписки на события. Для того чтоб стал компонентом, добавили его в конфиг - components.
 * А чтобы он загружался сразу, добавили его там в bootstrap. И переопределили метод init чтобы подписка на события
 * выполнялась сразу при загрузке компонента. *переделал с метода инит на бутстрап.
 */
class MyBootstrap extends Component implements BootstrapInterface
{
    // переопределяем метод инит. Он вызывается из конструктора родителя при создании объекта, и по умолчанию всегда
    // пустой.
//    public function init()
//    {
//        parent::init();
//
//        $anonymousFunction = function ($event) {
//
//            $responsible_id = $event->sender->responsible_id;
//            $email = Users::findOne($responsible_id)->email;
//
//            Yii::$app->mailer->compose()
//                ->setTo($email)
//                ->setFrom(['admin@mail.ru' => 'admin'])
//                ->setSubject($event->sender->title)
//                ->setTextBody($event->sender->description)
//                ->send();
//
//        };
//
//        Event::on(Tasks::class, ActiveRecord::EVENT_AFTER_INSERT, $anonymousFunction);
//        // Это может пригодится если вдруг в таске поменяли ответственного, и его нужно об этом оповестить.
////        Event::on(Tasks::class, ActiveRecord::EVENT_AFTER_UPDATE, $anonymousFunction);
//    }



    // такой вариант будет правильнее чем через инит. сам этот бутстрап вызывается через инит.
    // сюда приходит аппликейшн - экземпляр нашего класса
    public function bootstrap($app)
    {
        $this->myAttachEventsHandlers();
    }

    protected function myAttachEventsHandlers()
    {
        Event::on(Tasks::class, ActiveRecord::EVENT_AFTER_INSERT, function ($event) {

            $task = $event->sender; // сюда приходит модель Tasks
            $user = $task->users;

            Yii::$app->mailer->compose()
                ->setTo($user->email)
                ->setFrom(['admin@mail.ru' => 'admin'])
                ->setSubject("You received new task: {$task->title}")
                ->setTextBody(
                    "Dear {$user->username}, you received new task: {$task->description}.
                    Task link: " . \yii\helpers\Url::toRoute(['task/view', 'id' => $task->id], true)
                )
                ->send();
        });
    }


}