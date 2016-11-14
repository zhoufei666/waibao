<!DOCTYPE html>
<html>
    <head>
        <title>welcome 飞毛腿摄影</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
        <!-- 新 Bootstrap 核心 CSS 文件 -->
        <link rel="stylesheet" href="//cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap.min.css">


        <style>
             html {
                font-family: sans-serif;
                -ms-text-size-adjust: 100%;
                -webkit-text-size-adjust: 100%
            }
            html, body {
                height: 100%;
            }

            body {
                margin: 0;
                padding: 0;
                width: 100%;
                display: table;
                font-weight: 100;
                font-family: 'Lato';
                background-color: #efefef;
            }

            .container {
                text-align: center;
                display: table-cell;
                vertical-align: middle;
            }

            .content {
                text-align: center;
                display: inline-block;
            }

            .title {
                font-size: 96px;
            }
            .tip{
                text-align:center;
                height: 40px;
            }
            .tip a{
                color: #ee9285;
                text-decoration: none;
                display: block;
                background-color: #fff;
                border-radius: 5px;
                width: 160px;
                margin: auto;
                font-size: 14px;
                line-height: 40px;
                font-weight: bold;
            }
            @media (max-width: 768px) {/*目前只适配iphone5s*/
                body{
                    width: 100%;
                }
                .container{
                    width: 100%;
                }
                .title{
                    font-size: 5em;
                    font-weight: bold;
                }
                .tip{
                    width: 100%;
                    min-height:5em;
                    height: 12em;
                }
                .tip a{
                    min-width: 70%;
                    margin: auto;
                    padding: 0.1em;
                    font-size: 2em;
                }
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="content">
                <div class="title">Welcome To  Here!</div>
            </div>
            <div class="tip">
                <a href="{{url('home')}}"><h3>开始检查生活品质</h3></a>
            </div>
        </div>
    </body>
</html>
