#!/usr/bin/python
# -*- coding: UTF-8 -*-

class CommonPythonClass:
    # {#{{{
    '测试Python的基类'
    __secretCount = 0  # 私有变量
    empCount = 0

    # 构造方法
    # def __init__(self, runFuncName):
    #    self.runFuncName = runFuncName

    # 运行函数--入口
    def run(self):
        # self.testOne()
        # self.testSomeCode()

        # 03 操作数据库
        self.testMysql()

        # 04 测试import导入包
        # self.testImport()

        # 05 测试python自带的web服务器
        # self.testPythonOwnWeb()

        # 06 测试GUI
        # self.testGUI()

    # 01 测试1
    def testOne(self):
        # 兼容 python 3.x
        print("hello world")

    # 02 测试2
    def testSomeCode(self):
        strOne = 'hello'
        print
        strOne * 2  # 重复输出字符串

    # 03 操作数据库
    def testMysql(self):
        # {#{{{
        # 要保证MySQL-Python已经安装，mac下安装：http://blog.csdn.net/u013107656/article/details/52245144
        # Linux下安装，下载安装包：http://blog.csdn.net/wklken/article/details/7271019
        import MySQLdb

        # 打开数据库连接
        db = MySQLdb.connect("localhost", "root", "111", "test_avatar")

        # 使用cursor()方法获取操作游标
        cursor = db.cursor()

        # 使用execute方法执行SQL语句
        # cursor.execute("SELECT VERSION()")
        cursor.execute("select * from room limit 1")

        # 使用 fetchone() 方法获取一条数据
        data = cursor.fetchone()

        # print "Database version : %s " % data
        print
        data

        # 关闭数据库连接
        db.close()

    # }#}}}

    # 04 测试import
    def testImport(self):
        # {#{{{

        # 导入自定义模块： http://blog.csdn.net/pwc1996/article/details/52577148
        # import sys
        # sys.path.append("your_path")
        import demo
        "创建 Employee 类的第一个对象"
        emp1 = demo.Employee("Zara", 2000)
        emp1.displayEmployee()
        print
        "Total Employee %d" % demo.Employee.empCount

    # }#}}}

    # 05 测试python自带的web服务器
    def testPythonOwnWeb(self):
        # {#{{{
        # 可用的  http://blog.csdn.net/tanghaiyu777/article/details/74315752
        # TODO
        print('test Web');

    # }#}}}

    # 06 测试python GUI -- 保证自己的机器上有GUI,比如mac windows，linux的云主机上是没有GUI,所以看不到效果
    def testGUI(self):
        # {#{{{
        from Tkinter import *  # 导入 Tkinter 库
        root = Tk()  # 创建窗口对象的背景色
        # 创建两个列表
        li = ['C', 'python', 'php', 'html', 'SQL', 'java']
        movie = ['CSS', 'jQuery', 'Bootstrap']
        listb = Listbox(root)  # 创建两个列表组件
        listb2 = Listbox(root)
        for item in li:  # 第一个小部件插入数据
            listb.insert(0, item)

        for item in movie:  # 第二个小部件插入数据
            listb2.insert(0, item)

        listb.pack()  # 将小部件放置到主窗口中
        listb2.pack()
        root.mainloop()  # 进入消息循环
    # }#}}}


# }#}}}

test = CommonPythonClass()
test.run()