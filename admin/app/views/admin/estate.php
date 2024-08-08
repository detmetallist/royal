<div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Описание объекта недвижимости</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" method="POST">
                <div class="card-body">
                  <div class="form-group">
                    <label for="name">Название обьекта</label>
                    <input type="text" class="form-control" id="name" name="name">
                  </div>

                  <div class="form-group">
                    <label for="type">Тип нерухомості:</label>
                    <select class="form-control" id="type" name="type">
                      <?php
                        foreach ($config['estateType'] as $key => $value) {
                          echo '<option value="',$key,'">',$value,'</option>';
                        }
                      ?>
                    </select>
                  </div>

                  </br>
                  <?php
                  foreach ($config['estateMarket'] as $key => $value) {
                    echo '<div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" id="market',$key,'" name="market" value="',$key,'" required>
                    <label class="form-check-label" for="market',$key,'">',$value,'</label>
                  </div>';
                  }
                  ?>

                  </br></br>
                  <link rel="stylesheet" type="text/css" href="/css/adm-style.css" async>
                  <script type="text/javascript" src="/js/jquery-3.3.1.min.js"></script>
                  <script src="/js/jquery-ui.min.js"></script>
                  <script type="text/javascript" src="/js/adm-script.js" async></script>
                  <div class="pictures" data-id="0">
                    <h3>Фото</h3>
                    <p>Первое фото будет на обложке обьявления. Добавьте картинки нажатием или перетяните картинку на этот блок. Перетяните мышкой одну картинку на место другой, если хотите изменить порядок фото</p>
                    <div class="form-pictures">
                      <?php for ($i=1; $i<=8; $i++): ?>
                        <div class="picture-block" data-order="<?php echo $i-1; ?>" style="order:<?php echo $i-1; ?>">
                          <i class="fas fa-camera"></i>
                          <p>Добавить фото</p>
                          <div class="img-container"></div>
                          <?php if($i==1): ?>
                            <div class="main_picture">Главное фото</div>
                          <?php endif; ?>
                        </div>
                        <?php if($i==1): ?>
                          <input type="file" name="img">
                        <?php endif; ?>
                      <?php endfor; ?>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="arenda_prodazha">Аренда чи продаж:</label>
                    <select class="form-control" id="arenda_prodazha" name="arenda_prodazha">
                      <option value="0">Аренда</option>
                      <option value="1">Продаж</option>
                    </select>
                  </div>

                  <div class="checkboxes">
                    <div class="checkbox">
                      <label for="remont">Ремонт:</label>
                      <input type="checkbox" name="remont" id="remont">
                    </div>
                    <div class="checkbox">
                      <label for="mebel">Мебель:</label>
                      <input type="checkbox" name="mebel" id="mebel">
                    </div>
                    <div class="checkbox">
                      <label for="posle_stroiteley">После строителей:</label>
                      <input type="checkbox" name="posle_stroiteley" id="posle_stroiteley">
                    </div>
                    <div class="checkbox">
                      <label for="parking">Паркинг:</label>
                      <input type="checkbox" name="parking" id="parking">
                    </div>
                    <div class="checkbox">
                      <label for="terasa">Тераса:</label>
                      <input type="checkbox" name="terasa" id="terasa">
                    </div>
                    <div class="checkbox">
                      <label for="penthouse">Пентхаус:</label>
                      <input type="checkbox" name="penthouse" id="penthouse">
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="rooms">Кімнат:</label>
                    <select class="form-control" id="rooms" name="rooms">
                      <?php
                        for ($i = 1; $i <= 10; $i++) {
                          echo '<option value="',$i,'">',$i,'</option>';
                        }
                      ?>
                    </select>
                  </div>

                  <div class="form-group">
                    <label for="walls">Тип стін:</label>
                    <select class="form-control" id="walls" name="walls">
                      <?php
                        foreach ($config['estateWalls'] as $key => $value) {
                          echo '<option value="',$key,'">',$value,'</option>';
                        }
                      ?>
                    </select>
                  </div>

                  <div class="form-group">
                    <label for="totalSq">Загальна (кв. м)</label>
                    <input type="text" class="form-control" id="totalSq" name="totalSq">
                  </div>

                  <div class="form-group">
                    <label for="residentialSq">Житлова (кв. м)</label>
                    <input type="text" class="form-control" id="residentialSq" name="residentialSq">
                  </div>

                  <div class="form-group">
                    <label for="kitchenSq">Кухня (кв. м)</label>
                    <input type="text" class="form-control" id="kitchenSq" name="kitchenSq">
                  </div>

                  <div class="form-group">
                    <label for="floor">Поверх:</label>
                    <select class="form-control" id="floor" name="floor">
                      <option value="0">цокольний</option>
                      <?php
                        for ($i = 1; $i <= 50; $i++) {
                          echo '<option value="',$i,'">',$i,'</option>';
                        }
                      ?>
                    </select>
                  </div>

                  <div class="form-group">
                    <label for="superficiality">Поверховість:</label>
                    <select class="form-control" id="superficiality" name="superficiality">
                      <?php
                        for ($i = 1; $i <= 50; $i++) {
                          echo '<option value="',$i,'">',$i,'</option>';
                        }
                      ?>
                    </select>
                  </div>

                  <label>Опалення:</label>
                  <br/>
                  <?php
                  foreach ($config['estateHeating'] as $key => $value) {
                    echo '<div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" id="heating',$key,'" name="heating" value="',$key,'" required>
                    <label class="form-check-label" for="heating',$key,'">',$value,'</label>
                  </div>';
                  }
                  ?>
                  </br></br>

                  <div class="form-group">
                    <label for="yearOfConstruction">Рік побудови:</label>
                    <select class="form-control" id="yearOfConstruction" name="yearOfConstruction">
                      <?php
                        foreach ($config['yearOfConstruction'] as $key => $value) {
                          echo '<option value="',$key,'">',$value,'</option>';
                        }
                      ?>
                    </select>
                  </div>

                  <label>Розмір комунальних (грн):</label>
                  <div class="form-group">
                    <input type="text" class="form-control" id="utilitiesWinter" name="utilitiesWinter" placeholder="зима">  
                  </div>
                  <div class="form-group">
                    <input type="text" class="form-control" id="utilitiesSummer" name="utilitiesSummer" placeholder="літо">
                  </div>

                  <div class="form-group">
                    <label for="registrationNumber">Реєстраційний №:</label>
                    <input type="text" class="form-control" id="registrationNumber" name="registrationNumber">
                  </div>

                  <div class="form-group">
                    <label for="price">Вартість (usd):</label>
                    <input type="text" class="form-control" id="price" name="price">
                  </div>

                  <div class="form-group">
                    <label for="country">Страна:</label>
                    <input type="text" class="form-control" id="country" name="country">
                  </div>

                  <div class="form-group">
                    <label for="oblast">Область:</label>
                    <input type="text" class="form-control" id="oblast" name="oblast">
                  </div>

                  <div class="form-group">
                    <label for="city">Населений пункт:</label>
                    <input type="text" class="form-control" id="city" name="city">
                  </div>

                  <div class="form-group">
                    <label for="adress">Адреса:</label>
                    <input type="text" class="form-control" id="adress" name="adress">
                  </div>

                  <div class="form-group">
                    <h3>Координаты</h3>
                    <p>Введите в поля выше страну, область, населённый пункт и адрес, нажмите "Найти координаты"</p>
                    <div class="coords_block">
                      <input type="text" name="coord_x" class="form-control" placeholder="Координата x">
                      <input type="text" name="coord_y" class="form-control" placeholder="Координата y">
                      <a href="#coords_calc">Найти координаты</a>
                    </div>
                  </div>

                  <div class="form-group">
                    <div id="map"></div>
                  </div>

                  <?php 
                    $res = $DB->query("SELECT * FROM settings WHERE name='google_api'",MYSQLI_USE_RESULT);
                    while ($row = $res->fetch_assoc()) {
                      $google_api = $row['value'];
                    }
                    $res->free();
                  ?>
                  <script src="https://maps.googleapis.com/maps/api/js?key=<?=$google_api?>&callback=initMap&v=weekly" defer></script>
                  <script type="text/javascript">
                    let map;
                    function initMap() {
                        map = new google.maps.Map(document.getElementById("map"), {
                              center: { lat: 48.657, lng: 34.88 },
                              zoom: 8,
                        });
                      }
                    window.initMap = initMap;
                  </script>

                  <div class="form-group">
                    <label for="description">Опис об'єкту:</label>
                    <textarea class="form-control" id="description" name="description" rows="6"></textarea>
                  </div>
                  <div class="invisible google_api"><?=$google_api?></div>
                  <script type="text/javascript" src="/js/ckeditor/ckeditor.js"></script>
                  <script type="text/javascript" src="/js/AjexFileManager/ajex.js"></script>

                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Сохранить</button>
                </div>
              </form>
            </div>