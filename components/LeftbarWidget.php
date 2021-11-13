<?php


namespace app\components;


use app\models\Category;
use yii\base\Widget;

class LeftbarWidget extends Widget
{
    public $tpl;//для работы с более чем одним шаблоном
    public $ul_class;//для присвоения класса меню (<ul>)
    public $data;//массив всех категорий
    public $tree;//для формирования дерева массива
    public $menuHtml;//готовая верста меню Для метода run

    public function init()
    {
        parent::init();
        if($this->ul_class === null)//если класс не передан присвой ему имя
            $this->ul_class = 'menu';

        if($this->tpl === null)//если шаблон не передан присвой ему имя
            $this->tpl = 'menu';

        $this->tpl .= '.php';//пристыкуй к переданному (или нет)
    }

    public function run()
    {
        $menu = \Yii::$app->cache->get('menu');//получаем кэшированные данные по ключу
        if($menu)
            return $menu;//после ретюрна код не выполняется типо?

        $this->data = Category::find()->select('id, parent_id, title')->indexBy('id')->asArray()->all();
        //найди такие столбцы, придай ключям массива значение столбца id, сделай из объекта массивов - массив массивов и покажи все
        $this->tree = $this->getTree();//примени метод getTree на свойство tree
        $this->menuHtml = '<ul class="' . $this->ul_class . '">';//добавляем класс к свойству
        $this->menuHtml .= $this->getMenuHtml($this->tree);//примени метод getMenuHtml на переданное дерево (для верстки) и приклей к свойству
        $this->menuHtml .= '</ul>';

        \Yii::$app->cache->set('menu', $this->menuHtml, 60);//кэшируем данные

        return $this->menuHtml;
    }

    protected function getTree()
    {
        $tree = [];
        foreach ($this->data as $id=>&$node) //перебери массив как ключи массивов первой ступени => ключи массивов второй ступени
        {
            if (!$node['parent_id'])//если значение ключа массива второй ступени = 0
                $tree[$id] = &$node;//нужно пояснение
            else
                $this->data[$node['parent_id']]['children'][$node['id']] = &$node;//создай дочерний массив. нужно пояснение
        }
        return $tree;
    }
    protected function getMenuHtml($tree)
    {
        $str = '';
        foreach ($tree as $category)
        {
            $str .= $this->catToTemplate($category);//прогони каждую категорию дерева через метод
        }
        return $str;
    }

    protected function catToTemplate($category)
    {
        ob_start();//буферизация вывода
        include __DIR__ . '/leftbar_tpl/' . $this->tpl;//подключаем шаблон из свойства tpl
        return ob_get_clean();//возвращает что-то и складывает все в str. Нужно пояснение
    }
}