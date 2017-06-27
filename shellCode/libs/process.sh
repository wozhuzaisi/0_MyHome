#!/bin/bash
#---------------------------------------------------------------------------------
# 说明，Linux服务器--进程监控脚本 ,网址来源：http://bbs.51cto.com/thread-937759-1.html
# 主要监控: 
# 生成的进程监控日志 
# 2017.06.25 djp
#---------------------------------------------------------------------------------

path='/tmp/monitor/process'

IP=`ifconfig eth0 | grep "inet addr" | cut -f 2 -d ":" | cut -f 1 -d " "`

#tomcat_dir="/opt/apache-tomcat-7.0.8"
#mysql_dir="/usr/local/mysql/bin/mysqld_safe"
#vsftp_dir="/usr/sbin/vsftpd"
tomcat_dir=""
mysql_dir=""
vsftp_dir=""
ssh_dir="/usr/sbin/sshd"

#进程监控
{ #{{{
    for dir in $tomcat_dir $mysql_dir $vsftp_dir  $ssh_dir
    do
        process_count=$(ps -ef | grep "$dir" | grep -v grep | wc -l)

        for service in tomcat mysql vsftp ssh
        do
            echo "$dir" |grep -q "$service"
            if [ $? -eq 0 ]
            then
                if [ $process_count -eq 0 ]
                then
                    echo "$service is down at $(date +%Y%m%d%H:%M:%S)" >>$path/process_$(date +%Y%m%d).log
                    echo "$service is down at $(date +%Y%m%d%H:%M:%S)" | mail -s "$IP服务器 $service服务关闭告警" XXXX@qq.com
                else
                    echo "$service is running at $(date +%Y%m%d%H:%M:%S)" >>$path/process_$(date +%Y%m%d).log
                fi
            else
                continue
            fi
        done
    done
} #}}}
