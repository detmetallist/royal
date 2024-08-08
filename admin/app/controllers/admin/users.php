<div class="clearfix"><a class="btn btn-primary float-right" href="/admin/user_add">Добавить нового пользователя</a></div>
<br />
<table class="table table-bordered">
                  <thead>                  
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Имя</th>
                      <th>Почта</th>
                      <th>Права</th>
                      <th style="width: 120px">Действие</th>
                    </tr>
                  </thead>
                  <tbody>
<?php

$res = $DB->query('SELECT * FROM users',MYSQLI_USE_RESULT);
  
while ($row = $res->fetch_assoc()) {
  echo '<tr>';
  //var_dump($row);
  echo '<td>',$row['id'],'.</td>';
  echo '<td>',$row['name'],'</td>';
  echo '<td>',$row['email'],'</td>';
  echo '<td>',$row['role'],'</td>';
  echo '<td><div class="row"><div class="col-6"><a href="/admin/user_edit?id=',$row['id'],'" class="btn btn-primary" data-toggle="tooltip" title="Редактировать"><i class="fas fa-pencil-alt"></i></a></div><div class="col-6"><a href="/admin/user_del?id=',$row['id'],'" class="btn btn-danger" data-toggle="tooltip" title="Удалить" onclick="return confirm(\'Данное действие необратимо. Вы уверены?\');"><i class="fas fa-trash-alt"></i></a></div></div></td>';
  echo '</tr>';
}

$res->free();

?>                    
                  </tbody>
                </table>

<!--
<tr>
                      <td>1.</td>
                      <td>Update software</td>
                      <td>
                        <div class="progress progress-xs">
                          <div class="progress-bar progress-bar-danger" style="width: 55%"></div>
                        </div>
                      </td>
                      <td><span class="badge bg-danger">55%</span></td>
                    </tr>
                    <tr>
                      <td>2.</td>
                      <td>Clean database</td>
                      <td>
                        <div class="progress progress-xs">
                          <div class="progress-bar bg-warning" style="width: 70%"></div>
                        </div>
                      </td>
                      <td><span class="badge bg-warning">70%</span></td>
                    </tr>
                    <tr>
                      <td>3.</td>
                      <td>Cron job running</td>
                      <td>
                        <div class="progress progress-xs progress-striped active">
                          <div class="progress-bar bg-primary" style="width: 30%"></div>
                        </div>
                      </td>
                      <td><span class="badge bg-primary">30%</span></td>
                    </tr>
                    <tr>
                      <td>4.</td>
                      <td>Fix and squish bugs</td>
                      <td>
                        <div class="progress progress-xs progress-striped active">
                          <div class="progress-bar bg-success" style="width: 90%"></div>
                        </div>
                      </td>
                      <td><span class="badge bg-success">90%</span></td>
                    </tr>
  -->