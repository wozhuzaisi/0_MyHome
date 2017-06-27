#!/bin/bash
#---------------------------------------------------------------------------------
# 说明，Linux服务器--流量监控脚本 ,网址来源：http://bbs.51cto.com/thread-937759-1.html
# 主要监控: 流量监控
# 生成的流量监控日志 
# 2017.06.25 djp
#---------------------------------------------------------------------------------

path='/tmp/monitor/network'
mkdir -p $path
R1=`cat /sys/class/net/eth0/statistics/rx_bytes`
T1=`cat /sys/class/net/eth0/statistics/tx_bytes`
sleep 1
R2=`cat /sys/class/net/eth0/statistics/rx_bytes`
T2=`cat /sys/class/net/eth0/statistics/tx_bytes`
TBPS=`expr $T2 - $T1`
RBPS=`expr $R2 - $R1`
TKBPS=`expr $TBPS / 1024`
RKBPS=`expr $RBPS / 1024`
echo "上传速率 eth0: $TKBPS kb/s 下载速率 eth0: $RKBPS kb/s at $(date +%Y%m%d%H:%M:%S)" >>$path/network_$(date +%Y%m%d).log
