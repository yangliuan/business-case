<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laravel Echo 测试页</title>
       <!-- 引入laravel-echo工具，其实使用Larave自带的也可以。但是，使用自带的还需要用到node前端构建工具，我这里只简单的演示后端实现过程，就不用node了 -->
       <script src="https://cdn.jsdelivr.net/npm/laravel-echo@1.10.0/dist/echo.iife.js"></script>
       <!-- 引入pusher工具，pusher是Laravel-echo底层，Laravel-echo是pusher的一层封装 -->
       <script src="https://cdn.jsdelivr.net/npm/pusher-js@7.0.3/dist/web/pusher.min.js"></script>
</head>
<body>
</body>
<script type="text/javascript">

    // 初始化 laravel-echo 插件
    window.Echo = new Echo({
        // 这里是固定值 pusher
        broadcaster: 'pusher',
        // 这里要和你在 .env 中配置的 PUSHER_APP_KEY 保持一致
        key: 'yangliuan',
        wsHost: window.location.hostname,
        // 这里是我们在上一步启动 socket 监听的端口
        wsPort: 6001,
        // 这个也要加上
        forceTLS: false,
        enabledTransports: ['ws', 'wss'],
    });

    //监听excel频道
    Echo.channel('excel')
    //监听excel下载完成事件
    .listen('ExcelExportCompletedEvent', (e) => {
      console.log(111);
      console.log(e);
    });
</script>
</html>
