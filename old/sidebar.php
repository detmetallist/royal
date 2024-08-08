		<div class="sidebar <?php if ($_SERVER['REQUEST_URI']=="/"){ echo 'main_sidebar'; } ?>">
			<a href="/" class="logo"><img src="img/logo.svg"></a>
			<h1>Агенство нерухомості</h1>
			<form id="sidebar_form">
				<div class="input_search">
					<input name="search" placeholder="Пошук по ID...">
					<button class="search_button"><i class="fa fa-search"></i></button>
				</div>
				<div class="radio_blocks">
					<div class="radio_block">
						<div class="radio_col">
							<input type="radio" name="orenda_prodazha" value="0" id="input_radio_rent">
							<label for="input_radio_orenda">оренда</label>
						</div>
						<div class="radio_col">
							<input type="radio" name="orenda_prodazha" value="1" id="input_radio_sell">
							<label for="input_radio_prodazha">продаж</label>
						</div>
					</div>
					<div class="radio_block">
						<div class="radio_col">
							<input type="radio" name="property_type" value="1" id="input_radio_flats">
							<label for="input_radio_flats">квартири</label>
						</div>
						<div class="radio_col">
							<input type="radio" name="property_type" value="2" id="input_radio_houses">
							<label for="input_radio_houses">будинки</label>
						</div>
						<div class="radio_col">
							<input type="radio" name="property_type" value="3" id="input_radio_lands">
							<label for="input_radio_lands">земельні ділянки</label>
						</div>
						<div class="radio_col">
							<input type="radio" name="property_type" value="4" id="input_radio_commerce">
							<label for="input_radio_commerce">комерційна нерухомість</label>
						</div>
					</div>
				</div>
				<div class="price_switch">
					<h3>Ціна</h3>
					<a href="#price_usd">USD</a>
					<a href="#price_eur">EUR</a>
					<a href="#price_uah">UAH</a>
					<input type="hidden" name="price_switch">
				</div>
				<?php 
					$res = $DB->query('SELECT price FROM estate ORDER BY price LIMIT 1',MYSQLI_USE_RESULT);
					while ($row = $res->fetch_assoc()) {
						$price_min=$row['price'];
					}
					$res = $DB->query('SELECT price FROM estate ORDER BY price DESC LIMIT 1',MYSQLI_USE_RESULT);
					while ($row = $res->fetch_assoc()) {
						$price_max=$row['price'];
					}
					$res = $DB->query('SELECT totalSq FROM estate ORDER BY totalSq LIMIT 1',MYSQLI_USE_RESULT);
					while ($row = $res->fetch_assoc()) {
						$totalSq_min=$row['totalSq'];
					}
					$res = $DB->query('SELECT totalSq FROM estate ORDER BY totalSq DESC LIMIT 1',MYSQLI_USE_RESULT);
					while ($row = $res->fetch_assoc()) {
						$totalSq_max=$row['totalSq'];
					}
					echo '<p class="price_min invisible">'.$price_min.'</p>';
					echo '<p class="price_max invisible">'.$price_max.'</p>';
					echo '<p class="totalSq_min invisible">'.$totalSq_min.'</p>';
					echo '<p class="totalSq_max invisible">'.$totalSq_max.'</p>';
				?>
				<div id="slider-range_price"></div>
				<div class="price_ot_do">
					<label for="price_ot">Від</label>
					<input type="text" name="price_ot" id="price_ot">
					<label for="price_do">До</label>
					<input type="text" name="price_do" id="price_do">
				</div>
				<h3>Площа</h3>
				<div id="slider-range_ploshad"></div>
				<div class="ploshad_ot_do">
					<label for="ploshad_ot">Від</label>
					<input type="text" name="ploshad_ot" id="ploshad_ot">
					<label for="ploshad_do">До</label>
					<input type="text" name="ploshad_do" id="ploshad_do">
				</div>
				<div class="radio_blocks">
					<div class="radio_col">
						<input type="radio" name="s_remontom_bez" value="1" id="s_remontom">
						<label for="s_remontom">з ремонтом</label>
					</div>
					<div class="radio_col">
						<input type="radio" name="s_remontom_bez" value="0" id="bez_remonta">
						<label for="bez_remonta">без ремонту</label>
					</div>
				</div>
				<h3>Кількість кімнат</h3>
				<div class="kol_komnat">
					<div class="tri_comnati_container">
						<input type="checkbox" name="komnat_1" id="komnat_1">
						<label for="komnat_1">1</label>
						<input type="checkbox" name="komnat_2" id="komnat_2">
						<label for="komnat_2">2</label>
						<input type="checkbox" name="komnat_3" id="komnat_3">
						<label for="komnat_3">3</label>
					</div>
					<div class="tri_comnati_container">
						<input type="checkbox" name="komnat_4" id="komnat_4">
						<label for="komnat_4">4</label>
						<input type="checkbox" name="komnat_5" id="komnat_5">
						<label for="komnat_5">5</label>
						<input type="checkbox" name="komnat_6" id="komnat_6">
						<label for="komnat_6">6</label>
					</div>
					<div class="tri_comnati_container">
						<input type="checkbox" name="komnat_7" id="komnat_7">
						<label for="komnat_7">7</label>
						<input type="checkbox" name="komnat_8" id="komnat_8">
						<label for="komnat_8">8</label>
						<input type="checkbox" name="komnat_9" id="komnat_9">
						<label for="komnat_9">9</label>
					</div>
					<div class="tri_comnati_container">
						<input type="checkbox" name="komnat_10" id="komnat_10">
						<label for="komnat_10">10</label>
						<input type="checkbox" name="penthouse" id="penthouse">
						<label for="penthouse">Пентхаус</label>
					</div>
				</div>
				<button id="sbros">Скидання</button>
			</form>
		</div>