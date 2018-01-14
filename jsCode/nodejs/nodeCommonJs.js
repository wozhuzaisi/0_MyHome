

//在nodejs中，类型定义就像定义函数一样，其实该函数就是NodeCommonJs 类的构造函数
var NodeCommonJs =function()
{//{{{
    //如果需要定义该类对象的字段、方法等，需加上this关键字，否则就认为是该函数中的临时变量
    this.ClassName="NodeCommonJs";
    this.author ="yeliangchen";
    
    //00 定义对象方法
    this.run =function()
    {//{{{
        //01. 测试http
        //this.testHttp();

        //02. 测试数据库
        this.testMysql();

    };//}}}

    //01 测试http
    /**
     *  来源参考: http://www.runoob.com/nodejs/nodejs-http-server.html
     *  运行步骤：node http.js ,浏览器中输入 http://127.0.0.1:8888/ 就可以看到 Hello World
     */
    this.testHttp=function()
    {//{{{
        //test
        console.log('http is runing');
        return false;

        var http = require('http');

        http.createServer(function (request, response) {

                // 发送 HTTP 头部 
                // HTTP 状态值: 200 : OK
                // 内容类型: text/plain
                response.writeHead(200, {'Content-Type': 'text/plain'});

                // 发送响应数据 "Hello World"
                response.end('Hello World\n');
                }).listen(8888);

        // 终端打印如下信息
        console.log('Server running at http://127.0.0.1:8888/');
    };//}}}

    //02 查询数据库
    /**
     *  来源参考: http://www.gbin1.com/technology/javautilities/20120904-node-js-for-beginners/
     *  依赖： npm install mysql(不要指定版本否则查询不出来 http://www.bcty365.com/content-74-5887-1.html ) ,保证node_module目录下有mysql的组件
     */
    this.testMysql=function()
    {//{{{
        var mysql  = require('mysql');

        var connection = mysql.createConnection({
            host     : 'your_host',
            user     : 'your_user',
            password : 'your_passwd',
            port: '3306',
            database: 'your_database',
        });

        connection.connect();

        var  sql = 'SELECT * FROM your_table limit 1';
        //查
        connection.query(sql,function (err, result) {
            if(err){
                console.log('[SELECT ERROR] - ',err.message);
                return;
            }

            console.log('--------------------------SELECT----------------------------');
            console.log(result);
            console.log('------------------------------------------------------------\n\n');
        });

        connection.end();
    };//}}}
};//}}}

var testCommon = new NodeCommonJs();
testCommon.run();
