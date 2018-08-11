<?php
//测试脚本
include_once("init.php");
use \Strategy\FacultyClass;


//1.工厂类是唯一入口，构造方法返回的是类自己实例
$res = (new FacultyClass('XXX'))->strategyName->testStrategy('Hello', 'World');//echo Hello World

//2.走单例模式
//$res = FacultyClass::getStrategyInstance('XXX')->testStrategy('Hello', 'World');//echo Hello World

//3.直接访问 XXXStrategy 不行,错误是 Class 'Strategy\BaseStrategyClass' not found 
//$res = new XXXStrategy();
