<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>
<body class="hold-transition skin-blue layout-top-nav">
<div class="wrapper">

	<?php include 'includes/navbar.php'; ?>
	 
	  <div class="content-wrapper">
	    <div class="container">

	      <!-- Main content -->
	      <section class="content">
	        <div class="row">
	        	<div class="col-sm-9">
	        		<?php
	        			if(isset($_SESSION['error'])){
	        				echo "
	        					<div class='alert alert-danger'>
	        						".$_SESSION['error']."
	        					</div>
	        				";
	        				unset($_SESSION['error']);
	        			}
	        		?>
	        		
					<br>
					<div class="col-sm-9 box">
						<div class='box-header with-border'>
		           			<h2 class="text-center">Contactos</h2>
						</div>
						<div class='box-body'>
							<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3767.540136052484!2d-98.2416330850967!3d19.21527778700822!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x85cfdb41c6e31623%3A0xd6c82aa9d52a6834!2sParroquia%20de%20Santa%20In%C3%A9s!5e0!3m2!1ses-419!2smx!4v1596850719424!5m2!1ses-419!2smx" width="100%" height="450" frameborder="0" style="border:0; margin: auto;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
						</div>
					</div>
					<div class="col-sm-9 box">
						<!--Section: Contact v.2-->


						<!--Section heading-->
						<h2 class="h1-responsive font-weight-bold text-center my-4">Medios de contacto</h2>
						<!--Section description-->
						<p class="text-center w-responsive mx-auto mb-5">¿Tiene usted alguna pregunta? No dude en contactarnos directamente. Nuestro equipo se pondrá en contacto con usted en cuestión de horas para ayudarlo.</p>

						<div class="row">

							<!--Grid column-->
							<div class="col-md-9 mb-md-0 mb-5">
								<form id="contact-form"  method="POST">

									<!--Grid row-->
									<div class="row">

										<!--Grid column-->
										<div class="col-md-6">
											<div class="md-form mb-0">
												<input type="text" id="name" name="name" class="form-control">
												<label for="name" class="">Nombre completo</label>
											</div>
										</div>
										<!--Grid column-->

										<!--Grid column-->
										<div class="col-md-6">
											<div class="md-form mb-0">
												<input type="text" id="email" name="email" class="form-control">
												<label for="email" class="">Correo electronico</label>
											</div>
										</div>
										<!--Grid column-->

									</div>
									<!--Grid row-->

									<!--Grid row-->
									<div class="row">
										<div class="col-md-12">
											<div class="md-form mb-0">
												<input type="text" id="subject" name="subject" class="form-control">
												<label for="subject" class="">Asunto</label>
											</div>
										</div>
									</div>
									<!--Grid row-->

									<!--Grid row-->
									<div class="row">

										<!--Grid column-->
										<div class="col-md-12">

											<div class="md-form">
												<textarea type="text" id="message" name="message" rows="2" class="form-control md-textarea"></textarea>
												<label for="message">Mensaje</label>
											</div>

										</div>
									</div>
									<!--Grid row-->
									<input type="submit" class="btn btn-success pull-center" value="Enviar" name="enviar">
									<br>
									<br>
								</form>
								<?php 
									if(isset($_POST['enviar'])){
										$data = array($_POST['name'], $_POST['email'], $_POST['subject'],$_POST['message']); 
										$stmt = $conn->prepare("INSERT INTO contacto ( Nombre, Correo, Asunto, Mensaje) VALUES(?,?,?,?)");
						    			$stmt->execute($data);
									}
								?>
								
								<div class="status"></div>
							</div>
							<!--Grid column-->

							<!--Grid column-->
							<div class="col-md-3 text-center">
								<ul class="list-unstyled mb-0">
									<li><i class="glyphicon glyphicon-phone"></i>
										<p>2464900835</p>
									</li>

									<li><i class="glyphicon glyphicon-phone-alt"></i>
										<p>246784684</p>
									</li>

									<li><i class="glyphicon glyphicon-envelope"></i>
										<p style="font-size: 90%;">Contacto@embeddedsystems.com</p>
									</li>
								</ul>
							</div>
							<!--Grid column-->

						</div>


						<!--Section: Contact v.2-->
					</div>
					
		       		<?php
		       			$month = date('m');
		       			$conn = $pdo->open();

		       			try{
		       			 	$inc = 3;	
						    $stmt = $conn->prepare("SELECT *, SUM(quantity) AS total_qty FROM details LEFT JOIN sales ON sales.id=details.sales_id LEFT JOIN products ON products.id=details.product_id WHERE MONTH(sales_date) = '$month' GROUP BY details.product_id ORDER BY total_qty DESC LIMIT 6");
						    $stmt->execute();
						    foreach ($stmt as $row) {
						    	$image = (!empty($row['photo'])) ? 'images/'.$row['photo'] : 'images/noimage.jpg';
						    	$inc = ($inc == 3) ? 1 : $inc + 1;
	       						if($inc == 1) echo "<div class='row'>";
	       						echo "
	       							<div class='col-sm-4'>
	       								<div class='box box-solid'>
		       								<div class='box-body prod-body'>
		       									<img src='".$image."' width='100%' height='230px' class='thumbnail'>
		       									<h5><a href='product.php?product=".$row['slug']."'>".$row['name']."</a></h5>
		       								</div>
		       								<div class='box-footer'>
		       									<b>&#36; ".number_format($row['price'], 2)."</b>
		       								</div>
	       								</div>
	       							</div>
	       						";
	       						if($inc == 3) echo "</div>";
						    }
						    if($inc == 1) echo "<div class='col-sm-4'></div><div class='col-sm-4'></div></div>"; 
							if($inc == 2) echo "<div class='col-sm-4'></div></div>";
						}
						catch(PDOException $e){
							echo "There is some problem in connection: " . $e->getMessage();
						}

						$pdo->close();

		       		?> 
	        	</div>
	        	<div class="col-sm-3">
	        		<?php include 'includes/sidebar.php'; ?>
	        	</div>
	        </div>
	      </section>
	     
	    </div>
	  </div>
  
  	<?php include 'includes/footer.php'; ?>
</div>

<?php include 'includes/scripts.php'; ?>
</body>
</html>