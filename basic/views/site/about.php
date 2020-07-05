<?php

/* @var $this yii\web\View */

$h1 = "About";

$this->title = $h1;

?>


<div class="view_1__base_con">

	<div class="view_1__con_H1">
		<h1>
			<?= $h1 ?>
		</h1>
	</div>

	
	<div style="color: #fff; padding: 20px 30px 20px 30px; ">
		* JQuery - реализован, но я бы ещё пересмотрел код. ReactJs - Не реализован. 
		* API не разделял сознательно (в реальном проекте если действительно есть необходиомсть в разделении API, тогда стоило бы его разделять)
		<br>
	    * Ограничитель запросов не делал и почти никакой дополнительной защиты, кроме проверки: XSS, SQLinjection and a couple more.
	    <br>
	    * Для отдачи ответа с API в некоторых случаях стоит использовать сериализатор с 
	    сохранением типов, но так как этот проект тестовый, я не использовал эту возможность. 
	    <br>
	    * Robots.txt - not use
	    <br>
	    * sitemap.txt - not use
	    <br>
	    * structured-data - not use	  
	    <br>
	    * minification HTMl - not use
	    <br>
	    * Validation HTML page - not use
	    <br>
	    * Cross-browser testing - not use 	 
	    <br>
	    * Cross-browser testing - not use 	
	    <br>
	    * Testing on various monitors - not use  
	    <br>
	    * And other...	         			    	      
	</div>
	
</div>