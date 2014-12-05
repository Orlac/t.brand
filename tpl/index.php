<html>
<head>
<title>Test :: index</title>
<style>
	body {background-color: <?=\test\S('Config')->bgColor?>;}
</style>
</head>
<body>
	<?=\test\S('Config')->customerName?>, Вы подписвны на сервис.<br/>
	<a href="<?=$glob['baseurl']?>/unsubscribe">Отписаться</a>
</body>
</html>
