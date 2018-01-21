#!/usr/bin/python
# -*- coding: UTF-8 -*-
 
class CommonPyClass:
#{#{{{
   '测试Python的基类'
   __secretCount = 0  # 私有变量
   empCount = 0

    #构造方法
   #def __init__(self, runFuncName):
   #    self.runFuncName = runFuncName 

    #运行函数--入口
   def run(self):
       #self.testOne()
       #self.testSomeCode()
       self.testMysql()

    #01 测试1
   def testOne(self):
       print "hello world"
       print "您好"

    #02 测试2
   def testSomeCode(self):
       strOne = 'hello'
       print strOne * 2 #重复输出字符串

    #03 操作数据库
   def testMysql(self):
   #{#{{{
        import MySQLdb

        # 打开数据库连接
        db = MySQLdb.connect("localhost","user","passwd","database" )

        # 使用cursor()方法获取操作游标 
        cursor = db.cursor()

        # 使用execute方法执行SQL语句
        cursor.execute("SELECT VERSION()")

        # 使用 fetchone() 方法获取一条数据
        data = cursor.fetchone()

        print "Database version : %s " % data

        # 关闭数据库连接
        db.close()

   #}#}}}

#}#}}}

test = CommonPyClass()
test.run()
