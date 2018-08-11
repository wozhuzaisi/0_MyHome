<?php
namespace Strategy;

//工厂类
class FacultyClass
{/*{{{*/
    public $strategyName;
    public function __construct($strategyName)
    {
        $strategyClass = 'Strategy\\'.$strategyName.'Strategy';
        $this->strategyName = new $strategyClass; 
        return $this->strategyName;//外部接收不到这个，还是工厂类自己的实例
    }

    public static function getStrategyInstance($strategyName)
    {
        static $ins;
        $strategyClass = 'Strategy\\'.$strategyName.'Strategy';
        //单例模式
        if(false == $ins instanceOf $strategyClass)
        {
            $ins = new $strategyClass;
        }

        return $ins;
    }
}/*}}}*/

//策略基类
class BaseStrategyClass
{

}

//第三方交互基类
class BaseCooperationClass
{

}


//策略接口
interface IStrategy
{
    public function testStrategy($argsOne, $argsTwo);
}
