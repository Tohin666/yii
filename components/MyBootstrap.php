<?php

namespace app\components;

use app\models\tables\Tasks;
use app\models\tables\Users;
use yii\base\Component;
use yii\base\Event;
use yii\db\ActiveRecord;
use Yii;

/**
 * Класс-компонент для подписки на события. Для того чтоб стал компонентом, добавили его в конфиг - components.
 * А чтобы он загружался сразу, добавили его там в bootstrap. И переопределили метод init чтобы подписка на события
 * выполнялась сразу при загрузке компонента.
 */
class MyBootstrap extends Component
{
    // переопределяем метод инит. Он вызывается из конструктора родителя при создании объекта, и по умолчанию всегда
    // пустой.
    public function init()
    {
        parent::init();


        $anonymousFunction = function ($event) {

            $responsible_id = $event->sender->responsible_id;
            $email = Users::findOne($responsible_id)->email;

            Yii::$app->mailer->compose()
                ->setTo($email)
                ->setFrom(['admin@mail.ru' => 'admin'])
                ->setSubject($event->sender->title)
                ->setTextBody($event->sender->description)
                ->send();

//            echo "Емайл отправлен!";
//            var_dump($event, $email);
//            exit;
        };

        Event::on(Tasks::class, ActiveRecord::EVENT_AFTER_INSERT, $anonymousFunction);
        Event::on(Tasks::class, ActiveRecord::EVENT_AFTER_UPDATE, $anonymousFunction);
    }


}