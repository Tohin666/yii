<?php


namespace app\commands;

use app\models\tables\Tasks;
use app\models\tables\Users;
use yii\console\Controller;
use yii\console\ExitCode;
use yii\db\ActiveQuery;
use yii\helpers\Console;

class TaskController extends Controller
{
    // это опция, определяется внизу
    public $message = 'hello';

    /**
     * This is my index action of task controller
     */
    public function actionIndex()
    {
        echo "запустите task/find чтобы найти задачи с истекающим сроком";
    }


    /**
     * Ищет задачи с истекающим сроком и отправляет оповещения ответственным на почту.
     */
    public function actionFind()
    {
//        /** @var ActiveQuery $tasks */
        /** @var Tasks[] $tasks */

//        $date = mktime(0, 0, 0, date('m'), date('d') + 1, date('Y'));
//        $date = date('Y-m-d', $date);
        // SELECT * FROM tasks WHERE DATEDIFF(tasks.date, NOW()) <=1;
        $tasks = Tasks::find()
            ->where('DATEDIFF(tasks.date, NOW()) <=1')
            // жадная загрузка, подгрузка таксков по связям с ответственным (users), теперь будет всего два запроса:
            // SELECT * FROM `tasks`;
            // SELECT * FROM `users` WHERE `id` IN (айдишники юзеров);
            ->with('users')
//            ->select(['title', 'date', 'responsible_id'])
//            ->where(['<', 'date', $date])
//            ->asArray()
            ->all();
//        $users = Users::find()->select(['email', 'id'])->asArray()->indexBy('id')->column();


        // batch - пакетная выборка, по умолчанию по 100, получает все сразу в массив, а each делает тоже самое только
        // получает не сразу массив, а перебирает их
//        foreach ($tasks->each() as $task) {
        foreach ($tasks as $task) {

            \Yii::$app->mailer->compose()
                // чтобы тут не делал много лишних запросов, сделали сверху жадную загрузку
                ->setTo($task->users->email)
//                ->setTo($users[$task['responsible_id']])
                ->setFrom(['admin@mail.ru' => 'admin'])
                ->setSubject('Your task expired!')
                ->setTextBody('Your task ' . $task->title . ' expire at ' . $task->date . '!')
                ->send();

//            echo $users[$task['responsible_id']];
//            echo 'Your task ' . $task->title . ' expire at ' . $task->date . '!';
        }


    }



    /**
     * Test action
     */
    // параметры передаются из консоли через пробел
    public function actionTest($id)
    {
        if ($user = Users::findOne($id)) {
            // stdout вместо эхо позволяет при помощи хелпера украшать текст
            $this->stdout("{$this->message}, {$user->username}", Console::FG_RED);
            // хорошей практикой является возвращать какой-то код
            return ExitCode::OK; // 0
        }
        return ExitCode::UNSPECIFIED_ERROR; // 1
    }


    public function actionProcess()
    {
        // отображает прогресс-бар
        Console::startProgress(0, 100);
        for ($i = 1; $i < 100; $i++) {
            sleep(1);
            Console::updateProgress($i, 100);
        }
        Console::endProgress();
    }


    // так создаются опции, они вызываеются через --. Переопределяем метод options
    public function options($actionId) // $actionId - имя метода куда передается по умолчанию
    {
        // указываем какие переменные будут являться опциями
        return ['message'];
    }

    // так задаются короткие флаги, которые вызываются с одной -
    public function optionAliases()
    {
        return ['m' => 'message'];
    }
}


