<link rel="stylesheet" type="text/css" href="/css/adm-style.css" async>
<div class="clearfix"><a class="btn btn-primary float-right" href="/admin/news_add">Создать новость</a></div>
<br />
<table class="table table-bordered">
                  <thead>                  
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Название</th>
                      <th>Дата</th>
                      <th style="width: 120px">Действие</th>
                    </tr>
                  </thead>
                  <tbody>
<?php
$res = $DB->query("SELECT count(*) FROM news",MYSQLI_USE_RESULT);
if($res!=false){
  $row = $res->fetch_row();
  $news_count = $row[0];
  $pages_count=intdiv($news_count,$config['news_admin_length']);
  $ostatok=$news_count % $config['news_admin_length'];
  if($ostatok>0){
    $pages_count++;
  }
  $res->free();
}
if(!empty($_GET['page'])){
  if($_GET['page']=='1'){
    $limit=intval($config['news_admin_length']);
    $limit_query=$limit;
  } else {
    $limit=intval($config['news_admin_length'])*($_GET['page']-1);
    $limit_query=$limit.','.intval($config['news_admin_length']);
  }
} else {
  $limit=intval($config['news_admin_length']);
  $limit_query=$limit;
}
$query='SELECT * FROM news';
if(!empty($_GET['search_id'])){
  $query.=' WHERE id='.$_GET['search_id'];
} else {
  $query.=' LIMIT '.$limit_query;
}
$res = $DB->query($query,MYSQLI_USE_RESULT);
  
while ($row = $res->fetch_assoc()) {
  echo '<tr>';
  //var_dump($row);
  echo '<td>',$row['id'],'.</td>';
  echo '<td>',$row['name'],'</td>';
  echo '<td>',$row['public_date'],'</td>';
  echo '<td><div class="row"><div class="col-6"><a href="/admin/news_edit?id=',$row['id'],'" class="btn btn-primary" data-toggle="tooltip" title="Редактировать"><i class="fas fa-pencil-alt"></i></a></div><div class="col-6"><a href="/admin/news_del?id=',$row['id'],'" class="btn btn-danger" data-toggle="tooltip" title="Удалить" onclick="return confirm(\'Данное действие необратимо. Вы уверены?\');"><i class="fas fa-trash-alt"></i></a></div></div></td>';
  echo '</tr>';
}

$res->free();

?>                    
                  </tbody>
                </table>

  <?php if($pages_count>1&&empty($_GET['search_id'])): ?>
    <div class="pagination">
      <?php 
        $page=1;
        if(!empty($_GET['page'])){
          $page=$_GET['page'];
        }
        if($page>=1&&$page<=4){
          for($i=1; $i<=$page; $i++){
            if($page==$i){
              echo '<span>'.$i.'</span>';
            } else {
              echo '<a href="/admin/news?page='.$i.'">'.$i.'</a>';
            }
          }
        } else {
          $page_minus=$page-1;
          echo '<a href="/admin/news">1</a><a href="/admin/news?page=2">2</a><span>..</span><a href="/admin/news?page='.$page_minus.'">'.$page_minus.'</a><span>'.$page.'</span>';
        }
        if($pages_count>$page){
          $page_plus=$page+1;
          echo '<a href="/admin/news?page='.$page_plus.'">'.$page_plus.'</a>';
        }
        if($pages_count>$page+1){
          if($pages_count==$page+2){
            echo '<a href="/admin/news?page='.$pages_count.'">'.$pages_count.'</a>';
          } else if($pages_count==$page+3){
            $pages_count_minus=$pages_count-1;
            echo '<a href="/admin/news?page='.$pages_count_minus.'">'.$pages_count_minus.'</a><a href="/admin/news?page='.$pages_count.'">'.$pages_count.'</a>';
          } else {
            $pages_count_minus=$pages_count-1;
            echo '<span>..</span><a href="/admin/news?page='.$pages_count_minus.'">'.$pages_count_minus.'</a><a href="/admin/news?page='.$pages_count.'">'.$pages_count.'</a>';
          }
        }
      ?>
    </div>
  <?php endif; ?>