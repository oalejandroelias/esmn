
		<div class="container">
			<h1>Integration test NodeJS + PHP</h1>
			<p>
				This is a simple application, showing integration between nodeJS and PHP.
			</p>
<?php print_r($_SESSION); ?>
			<form class="form-inline" id="messageForm">
				<input id="nameInput" type="text" class="input-medium" placeholder="Name" />
				<input id="messageInput" type="text" class="input-xxlarge" placeHolder="Message" />

				<input type="submit" value="Send" />
			</form>

			<!-- <div>
				<ul id="messages">
					<?php
						foreach( $messages as $message ):
					?>
						<li> <strong><?php echo $message['name']; ?></strong> : <?php echo $message['message']; ?> </li>
					<?php endforeach; ?>
				</ul>
			</div> -->
			<!-- End #messages -->
		</div>
