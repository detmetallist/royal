<?php
    $res = $DB->query(\DB\parse('SELECT * FROM news WHERE id=?',$_GET['id']),MYSQLI_USE_RESULT);
    while ($row = $res->fetch_assoc()) {
        $name=$row['name'];
        $description=$row['text'];
        $img3=$row['img3'];
    }
?>
<div class="card card-primary">
	<div class="card-header">
    	<h3 class="card-title">Описание новости</h3>
    </div>
    <form role="form" method="POST">
    	<div class="card-body">
    		<div class="form-group">
                <label for="name">Заголовок новости:</label>
            	<input type="text" class="form-control" id="name" name="name" value="<?php echo $name; ?>">
            </div>
            <link rel="stylesheet" type="text/css" href="/css/adm-style.css" async>
            <script type="text/javascript" src="/js/jquery-3.3.1.min.js"></script>
            <script src="/js/jquery-ui.min.js"></script>
            <script type="text/javascript" src="/js/adm-script.js" async></script>
            <div class="form-group picture-group">
            	<h3>Фото</h3>
            	<div class="picture">
            		<p>Добавить фото</p>
            		<div class="img-container">
                        <img src="<?php echo $img3; ?>">      
                    </div>
            	</div>
            	<input type="file" name="img">
        	</div>
        	<div class="form-group">
        		<label for="description">Текст новости:</label>
                <textarea class="form-control" id="description" name="description" rows="6"><?php echo $description; ?></textarea>
        	</div>
        	<script type="text/javascript" src="/js/ckeditor/ckeditor.js"></script>
            <script type="text/javascript" src="/js/AjexFileManager/ajex.js"></script>
            <input type="hidden" name="news_id" value="<?php echo $_GET['id']; ?>">
    	</div>
    	<div class="card-footer">
            <button type="submit" class="btn btn-primary">Сохранить</button>
        </div>
    </form>
</div>