<div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Пользователь</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form">
                <div class="card-body">
                	<div class="form-group">
                    	<label for="name">Имя</label>
                    	<input type="text" class="form-control" id="name" placeholder="Введите имя">
                  	</div>
                  <div class="form-group">
                    <label for="email">Почта</label>
                    <input type="email" class="form-control" id="email" placeholder="Введите email">
                  </div>
                  <div class="form-group">
                    <label for="password">Пароль</label>
                    <input type="password" class="form-control" id="password" placeholder="Введите новый пароль">
                  </div>
                  <div class="form-group">
                    <label for="role">Права доступа</label>
                    <select class="form-control" name="role" id="role">
                          <option value="manager"><?=$vars['users']['manager']?></option>
                          <option value="admin"><?=$vars['users']['admin']?></option>
                    </select>
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Сохранить</button>
                </div>
              </form>
            </div>