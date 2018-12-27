<?php

namespace app\widgets;

use yii\base\Widget;
use yii\helpers\Html;

class HelloWidget extends Widget
{
    public $message;

    public function init()
    {
        parent::init();
        if ($this->message === null) {
            $this->message = 'Hell Word!';
        }
    }

    public function run()
    {
        return Html::encode($this->message);
    }



//    public function init()
//    {
//        // При вызове метода yii\base\Widget::begin() будет создан новый экземпляр виджета, при этом вызов метода init()
//        //произойдет сразу после выполнения остального кода в конструкторе виджета.
//        parent::init();
//        //происходит включение буферизации вывода PHP таким образом, что весь вывод между вызовами init() и run() может
//        // быть перехвачен, обработан и возвращен в run()
//        ob_start();
//    }
//
//    //При вызове метода yii\base\Widget::end(), будет вызван метод run(), а возвращенное им значение будет выведено
//    // методом end().
//    public function run()
//    {
//        $content = ob_get_clean();
//        return Html::encode($content);
//    }


}