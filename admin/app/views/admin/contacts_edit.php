<?php
    $contacts_title='';
    $contacts_text='';
    $contacts_map='';
    $res = $DB->query(\DB\parse('SELECT * FROM settings WHERE name=? OR name=? OR name=?','contacts_title','contacts_text','contacts_map'),MYSQLI_USE_RESULT);
    while ($row = $res->fetch_assoc()) {
        if($row['name']=='contacts_title'){
            $contacts_title=$row['value'];
        }
        if($row['name']=='contacts_text'){
            $contacts_text=$row['value'];
        }
        if($row['name']=='contacts_map'){
            $contacts_map=$row['value'];
        }
    }
?>
<div class="card card-primary">
	<div class="card-header">
    	<h3 class="card-title">Контакты</h3>
    </div>
    <form role="form" method="POST">
    	<div class="card-body">
            <script type="text/javascript" src="/js/jquery-3.3.1.min.js"></script>
            <script type="text/javascript" src="/js/adm-script.js" async></script>
    		<div class="form-group">
                <label for="name">Заголовок:</label>
            	<input type="text" class="form-control" id="name" name="name" value="<?php echo $contacts_title; ?>">
            </div>
            <link rel="stylesheet" type="text/css" href="/css/adm-style.css" async>
        	<div class="form-group">
        		<label for="description">Текст:</label>
                <textarea class="form-control" id="description" name="description" rows="6"><?php echo $contacts_text; ?></textarea>
        	</div>
        	<script type="text/javascript" src="/js/ckeditor/ckeditor.js"></script>
            <script type="text/javascript" src="/js/AjexFileManager/ajex.js"></script>
            <div class="form-group">
                <p>Для получения кода карты перейдите <a href="https://www.google.com.ua/maps/" target="_blanc">сюда</a>, в поиск вбейте адрес и нажмите кнопку "Поделиться". Переключите на вкладку "Встраивание карт", нажмите кнопку "Копировать HTML" и вставьте в поле "Код карты"</p>
                <label for="map">Код карты:</label>
                <input type="text" class="form-control" id="map" name="map" value='<?php echo $contacts_map; ?>'>
            </div>
    	</div>
    	<div class="card-footer">
            <button type="submit" class="btn btn-primary">Сохранить</button>
        </div>
    </form>
</div>