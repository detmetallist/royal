<div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Настройки сайта</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" method="POST">
                <div class="card-body">
                  <div class="form-group">
                    	<label for="footer_text_1">Тексти внизу страницы 1</label>
                    	<textarea name="footer_text_1" class="form-control" id="footer_text_1" placeholder="Введите текст"><?=$footer_text_1?></textarea>
                  </div>
                  <div class="form-group">
                      <label for="footer_text_2">Тексти внизу страницы 2</label>
                      <textarea name="footer_text_2" class="form-control" id="footer_text_2" placeholder="Введите текст"><?=$footer_text_2?></textarea>
                  </div>
                  <div class="form-group">
                      <label for="viber_social">Ссылка на Viber</label>
                      <input type="text" name="viber_social" class="form-control" id="viber_social" value="<?=$viber_social?>" placeholder="Введите текст" />
                  </div>
                  <div class="form-group">
                      <label for="whatsapp_social">Ссылка на Whatsapp</label>
                      <input type="text" name="whatsapp_social" class="form-control" id="whatsapp_social" value="<?=$whatsapp_social?>" placeholder="Введите текст" />
                  </div>
                  <div class="form-group">
                      <label for="telegram_social">Ссылка на Telegram</label>
                      <input type="text" name="telegram_social" class="form-control" id="telegram_social" value="<?=$telegram_social?>" placeholder="Введите текст" />
                  </div>
                  <div class="form-group">
                      <label for="facebook_social">Ссылка на Facebook</label>
                      <input type="text" name="facebook_social" class="form-control" id="facebook_social" value="<?=$facebook_social?>" placeholder="Введите текст" />
                  </div>
                  <div class="form-group">
                      <label for="facebook_social">Ссылка на Facebook</label>
                      <input type="text" name="facebook_social" class="form-control" id="facebook_social" value="<?=$facebook_social?>" placeholder="Введите текст" />
                  </div>
                  <div class="form-group">
                      <label for="instagram_social">Ссылка на Instagram</label>
                      <input type="text" name="instagram_social" class="form-control" id="instagram_social" value="<?=$instagram_social?>" placeholder="Введите текст" />
                  </div>
                  <div class="form-group">
                      <label for="youtube_social">Ссылка на Youtube</label>
                      <input type="text" name="youtube_social" class="form-control" id="youtube_social" value="<?=$youtube_social?>" placeholder="Введите текст" />
                  </div>
                  <div class="form-group">
                      <label for="twitter_social">Ссылка на Twitter</label>
                      <input type="text" name="twitter_social" class="form-control" id="twitter_social" value="<?=$twitter_social?>" placeholder="Введите текст" />
                  </div>
                  <div class="form-group">
                      <label for="instagram_social">Ссылка на Tiktok</label>
                      <input type="text" name="tiktok_social" class="form-control" id="tiktok_social" value="<?=$tiktok_social?>" placeholder="Введите текст" />
                  </div>
                  <div class="form-group">
                      <label for="instagram_social">Ключ API для гугл карт</label>
                      <input type="text" name="google_api" class="form-control" id="google_api" value="<?=$google_api?>" placeholder="Введите текст" />
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Сохранить</button>
                </div>
              </form>
            </div>