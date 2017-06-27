#!/bin/bash
#---------------------------------------------------------------------------------
# 说明，Linux服务器--流量分析脚本 ,网址来源：http://bbs.51cto.com/thread-937759-1.html
# 主要监控: 流量分析
# 生成的流量分析日志 
# 2017.06.25 djp
#---------------------------------------------------------------------------------

path='/tmp/monitor/network'
mkdir -p $path

TX=0;
RX=0;
MAX_TX=0;
MAX_RX=0;
while read line
do
    a=`echo $line | grep "eth0" |awk '{print $3}'`
    if [ $a -ge 0 ]
    then
        TX=$a
        if [ $TX -ge $MAX_TX ]
        then
            MAX_TX=$TX
        fi
    fi
    b=`echo $line | grep "eth0" |awk '{print $7}'`
    if [ $b -ge 0 ]
    then
        RX=$b
        if [ $RX -ge $MAX_RX ]
        then
            MAX_RX=$RX
        fi
    fi
done < $path/network_$(date +%Y%m%d).log
echo "最高上传速度为 $MAX_TX kb/s at $(date +%Y%m%d)">>$path/tongji.log

echo "最高下载速度为 $MAX_RX kb/s at $(date +%Y%m%d)">>$path/tongji.log
###############################################################################
