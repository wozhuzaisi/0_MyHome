<?php

spl_autoload_register('autoInclude');
//вт╤╞╪сть
function autoInclude($className)
{
    if(false == class_exists($className))
    {
        $arr = explode('\\', $className);
        $fileName = end($arr);
        include_once($fileName.'.php');
    }
}
