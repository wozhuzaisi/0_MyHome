#!/bin/bash
#---------------------------------------------------------------------------------
# 说明，Linux服务器--性能监控脚本 ,网址来源：http://bbs.51cto.com/thread-937759-1.html
# 主要监控: 01.监控cpu系统负载 02. 监控cpu使用率 03. 监控交换分区 04. 监控磁盘空间
# 生成的性能监控日志 $path/performance_%Y%m%d.log
# 2017.06.25 djp
#---------------------------------------------------------------------------------

path='/tmp/monitor/performance'

#01.监控cpu系统负载
{ #{{{
    IP=`ifconfig eth0 | grep "inet addr" | cut -f 2 -d ":" | cut -f 1 -d " "`
    cpu_num=`grep -c 'model name' /proc/cpuinfo`
    count_uptime=`uptime |wc -w`
    load_15=`uptime | awk '{print $'$count_uptime'}'`
    average_load=`echo "scale=2;a=$load_15/$cpu_num;if(length(a)==scale(a)) print 0;print a" | bc`  
    average_int=`echo $average_load | cut -f 1 -d "."`  
    load_warn=0.70  
    if [ $average_int -gt 0 ]
    then
        echo "$IP服务器单个核心15分钟的平均负载为$average_load，超过警戒值1.0，请立即处理！！！$(date +%Y%m%d/%H:%M:%S)" >>$path/performance_$(date +%Y%m%d).log
        echo "$IP服务器单个核心15分钟的平均负载为$average_load，超过警戒值1.0，请立即处理！！！$(date +%Y%m%d/%H:%M:%S)" | mail -s "$IP服务器系统负载严重告警" XXXX@qq.com
    else
        echo "$IP服务器单个核心15分钟的平均负载值为$average_load,负载正常   $(date +%Y%m%d/%H:%M:%S)">>$path/performance_$(date +%Y%m%d).log
    fi
} #}}}

#02. 监控cpu使用率
{ #{{{
    cpu_idle=`top -b -n 1 | grep Cpu | awk '{print $5}' | cut -f 1 -d "."`  
    if [ $cpu_idle -lt 20 ]
    then

        echo "$IP服务器cpu剩余$cpu_idle%,使用率已经超过80%,请及时处理。">>$path/performance_$(date +%Y%m%d).log

        echo "$IP服务器cpu剩余$cpu_idle%,使用率已经超过80%,请及时处理！！！" | mail -s "$IP服务器cpu告警" XXXX@qq.com
    else

        echo
        "$IP服务器cpu剩余$cpu_idle%,使用率正常">>$path/performance_$(date +%Y%m%d).log
    fi
} #}}}

#03. 监控交换分区
{ #{{{
    swap_total=`free -m | grep Swap | awk '{print  $2}'`
    swap_free=`free -m | grep Swap | awk '{print  $4}'`

    swap_used=`free -m | grep Swap | awk '{print  $3}'`

    if [ $swap_used -ne 0 ]
    then
        swap_per=0`echo "scale=2;$swap_free/$swap_total" | bc`
        swap_warn=0.20
        swap_now=`expr $swap_per \> $swap_warn`
        if [ $swap_now -eq 0 ]
        then
            echo "$IP服务器swap交换分区只剩下 $swap_free M 未使用，剩余不足20%，使用率已经超过80%，请及时处理。">>$path/performance_$(date +%Y%m%d).log

            echo "$IP服务器swap交换分区只剩下 $swap_free M 未使用，剩余不足20%, 使用率已经超过80%, 请及时处理。" | mail -s "$IP服务器内存告警" XXXX@qq.com
        else
            echo "$IP服务器swap交换分区剩下 $swap_free M未使用，使用率正常">>$path/performance_$(date +%Y%m%d).log
        fi

    else
        echo "$IP服务器交换分区未使用"  >>$path/performance_$(date +%Y%m%d).log
    fi
} #}}}

#04. 监控磁盘空间
{ #{{{
    disk_sda1=`df -h | grep /dev/sda1 | awk '{print $5}' | cut -f 1 -d "%"`
    if [ $disk_sda1 -gt 80 ]
    then
        echo "$IP服务器 /根分区 使用率已经超过80%,请及时处理。">>$path/performance_$(date +%Y%m%d).log

        echo "$IP服务器 /根分区 使用率已经超过80%,请及时处理。 " | mail -s "$IP服务器硬盘告警" XXXX@qq.com
    else
        echo "$IP服务器 /根分区 使用率为$disk_sda1%,使用率正常">>$path/performance_$(date +%Y%m%d).log
    fi

    #监控登录用户数
    users=`uptime |awk '{print $6}'`
    if [ $users -gt 2 ]
    then

        echo "$IP服务器用户数已经达到$users个，请及时处理。">>$path/performance_$(date +%Y%m%d).log

        echo "$IP服务器用户数已经达到$users个，请及时处理。" | mail -s "$IP服务器用户登录数告警" XXXX@qq.com
    else

        echo "$IP服务器当前登录用户为$users个，情况正常">>$path/performance_$(date +%Y%m%d).log
    fi
    ###############################################################################

} #}}}

