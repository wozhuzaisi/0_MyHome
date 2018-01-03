<?php

//开始
run();

function run()
{
    $array = array(31, 54, 6, 8, 3, 100, 23, 38);
    //01 冒泡排序
    #$array = bubbleSort($array);
    
    //02 插入排序
    #$array = insertSort($array);

    //03 选择排序
    #$array = selectSort($array);

    //04 希尔排序
    #$array = shellSort($array);

    //05 堆排序
    #$array = heapSort($array);

    //06 归并排序
    $array = mergeSort($array);
    var_dump(1111,$array);exit;
}

//01 冒泡排序
function bubbleSort($array)
{/*{{{*/
    /**01 冒泡排序 说明：就是第一个位置上的数与他相邻第二个位置上的数比较，如果比他相邻的数小，则两者交换位置，否则不交换。接着第一个位置上的数与第三个位置上的数比较大小，也是小则交换，一直到和最后一个位置的数比较交换完毕。然后，是下一个循环，就是第二个位置上的数重复上面的比较交换操作，直到把整个数列变成是一个从小到大的有序序列。
     *  
     */
    $count = count($array);
    for($i=0; $i<$count; $i++)
    {
        for($j=$i+1; $j<$count; $j++)
        {
            if($array[$i] > $array[$j])
            {
                $res = $array[$i];
                $array[$i] = $array[$j];
                $array[$j] = $res;
            }
        }
    }
    return $array;
}/*}}}*/

//02 插入排序
function insertSort($array)
{/*{{{*/
    /**02 插入排序 说明：从一堆待排序的数列中选出来一个最小值(可以认为第一个数就是已排序的数列)，然后从剩余的带排序的数列中选出来最小值有序放到已排序的数列中，依次操作，直到最后的数列都是一个从小到大的有序数列为止
     *  
     */
    $count = count($array);
    for($i=1; $i< $count; $i++)
    {
        $min = $i;
        //拿出带排序中的最小值
        for($j = $i + 1; $j < $count; $j++)
        {
            if($array[$min] > $array[$j])
            {
                $min = $j;
            }
        }
        //交换，而不是直接赋值，否则会有数据丢失
        swap($array[$i], $array[$min]);

        //拿出的值插入到已排序的数列中
        for($k=$i-1; $k>=0; $k--)
        {
            if($array[$i] < $array[$k])
            {
                swap($array[$i], $array[$k]);
            }else{
                break;
            }

        }
    }
    return $array;
}/*}}}*/


//03 选择排序
function selectSort($array)
{/*{{{*/
    /**03 选择排序 说明：从一堆待排序的数列中选出来一个最小值，放到新的数组的第一个位置，继续从剩余的数列中选取最小值放入到数组中，重复上面的步骤，将数字都取出来排成新的有序数列
     *  
     */
    $count = count($array);
    $newArr = array();
    for($i=0; $i< $count; $i++)
    {
        $min = selectSortChild($array);
        $newArr[$i] = $array[$min];
        unset($array[$min]);
        $array = array_merge($array, array());
    }
    return $newArr;
}/*}}}*/

//03.1 选择排序子函数
function selectSortChild($array)
{/*{{{*/
    $count = count($array);
    $min = 0;
    //拿出带排序中的最小值
    for($j = 1; $j < $count; $j++)
    {
        if($array[$min] > $array[$j])
        {
            $min = $j;
        }
    }
    return $min;
}/*}}}*/

//04 希尔排序
function shellSort($array)
{/*{{{*/
    /**04 希尔排序 说明：插入排序的一种改进，先比较一定距离的元素成为有序数列，再比较缩小增量距离的元素(可为元素的数量的一半)，一直到比较的是相邻元素的时候，就成为了插入排序。
     *  
     */
    //三层循环
    for($loop = floor(count($array)); $loop > 0; $loop = floor($loop/2))
    {
        for($i=$loop; $i<count($array); $i++)
        {
            for($j=$i-$loop; $j>=0 && $array[$j] > $array[$j+$loop]; $j = $j-$loop)
            {
               swap($array[$j], $array[$j+$loop]); 
            }
        }
    }
    return $array;

}/*}}}*/

//05 堆排序
function heapSort($array)
{/*{{{*/
    /**05 堆排序 说明：1) 构造大顶堆 2）交换堆顶和堆底 3)重复前面的步骤升序排列完成 
     * https://www.cnblogs.com/chengxiao/p/6129630.html
     *  
     */
    $count = count($array);
    //1. 构造大顶堆
    for($i=floor($count/2) - 1; $i>=0; $i--)
    {
        adjustHeap($array, $i, $count);
    }

    //2. 排序
    for($j=$count-1; $j>=0; $j--)
    {
        swap($array[0], $array[$j]);
        adjustHeap($array, 0, $j);
    }

    return $array;

}/*}}}*/

//05.1 堆排序子函数
function adjustHeap(&$array, $i, $length)
{/*{{{*/
    if($i<0)
        return false;
    $tmp = $array[$i];
    for($j=$i*2+1; $j<$length; $j=$j*2+1)
    {
        if($j+1< $length && $array[$j] < $array[$j+1])//右子节点比左子节点大，则j指向右子节点
            $j++;

        if($array[$j] > $tmp)//子节点比父节点大，则将子节点的值赋给父节点(不用交换)
        {
            $array[$i] = $array[$j];
            $i = $j;
        }
        else
        {
            break;
        }

    }
    $array[$i] = $tmp;//实现交换(i有变化时)

}/*}}}*/

//06 归并排序
function mergeSort($array)
{/*{{{*/
    /**06 归并排序 说明：就是将待排序的数列看成是单个的有序的数列，然后进行合并，直到合并成最后的完整有序的数列
     *  
     */
    //1.进行归并
    $length = count($array);
    for($gap = 1; $gap<$length; $gap = $gap*2)
    {
        mergePass($array, $gap, $length);
    }
    return $array;

}/*}}}*/

//06.1 归并排序子函数1--合并
function mergePass(&$array, $gap, $length)
{/*{{{*/
    //1. 归并长度是gap的相邻两个子表
    for($i=0; $i+2*$gap-1<$length; $i=$i+2*$gap)
    {
        merge($array, $i, $i+$gap-1, $i+2*$gap-1);
    }

    //2. 余下的两个字表合并，后者的长度小于gap
    if($i+$gap-1 < $length)
    {
        merge($array, $i, $i+$gap-1, $length-1);
    }
}/*}}}*/

//06.02 归并排序子函数2--合并两个有序序列
function merge(&$array, $low, $mid, $high)
{/*{{{*/
    $i = $low;//第一段序列的下标
    $j = $mid + 1;//第二段序列的下标
    $k = 0;
    $arrayNew = array();//新的临时合并数组

    //扫描第一段序列和第二段序列，直到有一个序列扫描完毕
    while($i<=$mid && $j<=$high)
    {
        //比较两个合并的数组，小的放到新的临时合并数组中
        if($array[$i] > $array[$j])
        {
            $arrayNew[$k] = $array[$j];
            $k++;
            $j++;
        }else{
            $arrayNew[$k] = $array[$i];
            $k++;
            $i++;
        }
    }

    //数组1中有没扫描的元素，直接复制到新数组中
    while($i <= $mid)
    {
        $arrayNew[$k] = $array[$i];
        $k++;
        $i++;
    }

    //数组2中有没扫描的元素，直接复制到新数组中
    while($j <= $high)
    {
        $arrayNew[$k] = $array[$j];
        $k++;
        $j++;
    }

    //将合并新数组复制到原数组中
    for($i=$low,$k=0; $i<=$high; $i++,$k++)
    {
        $array[$i] = $arrayNew[$k];
    }
}/*}}}*/

//交换数据
function swap(&$a, &$b)
{/*{{{*/
    $res = $a;
    $a = $b;
    $b = $res;
}/*}}}*/
