<?php
namespace Strategy;


//XXXStrategy 具体策略类
class XXXStrategy extends BaseStrategyClass implements IStrategy
{/*{{{*/
    public $cooperation;

    public function __construct()
    {
        $this->cooperation = new XXXCooperation();
    }

    //实现策略
    public function testStrategy($argsOne, $argsTwo)
    {
        echo $argsOne." ".$argsTwo;
    }
}/*}}}*/

