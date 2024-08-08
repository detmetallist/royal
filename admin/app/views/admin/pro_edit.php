<?php
    $pro_title='';
    $pro_text='';
    $res = $DB->query(\DB\parse('SELECT * FROM settings WHERE name=? OR name=?','pro_title','pro_text'),MYSQLI_USE_RESULT);
    while ($row = $res->fetch_assoc()) {
        if($row['name']=='pro_title'){
            $pro_title=$row['value'];
        }
        if($row['name']=='pro_text'){
            $pro_text=$row['value'];
        }
    }
?>
<div class="card card-primary">
	<div class="card-header">
    	<h3 class="card-title">Про компанию</h3>
    </div>
    <form role="form" method="POST">
    	<div class="card-body">
            <script type="text/javascript" src="/js/jquery-3.3.1.min.js"></script>
            <script type="text/javascript" src="/js/adm-script.js" async></script>
    		<div class="form-group">
                <label for="name">Заголовок:</label>
            	<input type="text" class="form-control" id="name" name="name" value="<?php echo $pro_title; ?>">
            </div>
            <link rel="stylesheet" type="text/css" href="/css/adm-style.css" async>
        	<div class="form-group">
        		<label for="description">Текст:</label>
                <textarea class="form-control" id="description" name="description" rows="6"><?php echo $pro_text; ?></textarea>
        	</div>
        	<script type="text/javascript" src="/js/ckeditor/ckeditor.js"></script>
            <script type="text/javascript" src="/js/AjexFileManager/ajex.js"></script>
    	</div>
    	<div class="card-footer">
            <button type="submit" class="btn btn-primary">Сохранить</button>
        </div>
    </form>
</div>