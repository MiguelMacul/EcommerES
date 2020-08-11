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
		           			<h2 class="text-center">Embedded systems</h2>
						</div>
						<div class='box-body'>
							<p class="lead text-justify" >
								En EMBEDDED SYSTEMS somos una empresa dedicada a la industria del desarrollo de software empresarial y desarrollo de sitios web, así como manejo de marketing
							</p>
						</div>
					</div>
					<div class="col-sm-9 box">
						<div class='box-header with-border'>
		           			<h2 class="text-center">Fundadores</h2>
						</div>
						<div class='box-body'>
							<p class="lead text-justify" >
							 	EMBEDDED SYSTEMS fue fundada en el año 2018 por Ari Valencia Delgado y Miguel Alejandro Macuil Angeles estudiantes de la carrera de tecnolgias de la información 
							</p>
						</div>
					</div>
					<div class="col-sm-9 box">
						<div class='box-header with-border'>
		           			<h2 class="text-center">Misión</h2>
						</div>
						<div class='box-body'>
							<p class="lead text-justify" >
							Desarrollar proyectos de software de alta calidad ofrecen las mejores soluciones hacia nuestros clientes
							</p>
						</div>
					</div>
					<div class="col-sm-9 box">
						<div class='box-header with-border'>
		           			<h2 class="text-center">Visión</h2>
						</div>
						<div class='box-body'>
							<p class="lead text-justify" >
							Ser una empresa líder en las Ti a nivel mundial
							</p>
						</div>
					</div>
					
					<div class="col-sm-9 box">
						<div class='box-header with-border'>
		           			<h2 class="text-center">Valores</h2>
						</div>
						<div class='box-body'>
							<ul class="list-group">
								<li class="list-group-item">	
									Honestidad: Es un valor moral fundamental para entablar relaciones interpersonales basadas en la confianza, la sinceridad y el respeto mutuo
								</li>
								<li class="list-group-item">	
									Responsabilidad: Es el cumplimiento de las obligaciones, o el cuidado al tomar decisiones o realizar algo.Transparencia: La capacidad que tiene un ser humano para que los otros entiendan claramente sus motivaciones, intenciones y objetivos
								</li>
								<li class="list-group-item">	
									Transparencia: La capacidad que tiene un ser humano para que los otros entiendan claramente sus motivaciones, intenciones y objetivos
								</li>
								<li class="list-group-item">	
									Pasión: Se define como un sentimiento muy fuerte hacia algo, en esta ocasión, nuestra empresa. La pasión por lo que luchamos es tan fuerte que anula o atenúa temporalmente por ejemplo nuestras necesidades básicas: sueño, hambre, dolor, o comportamientos relacionados con el miedo, el retraimiento o la duda
								</li>
								<li class="list-group-item">	
									Confianza: Es la seguridad o esperanza firme que alguien tiene de otro individuo o de algo
								</li>
								<li class="list-group-item">	
									Constancia: Es la firmeza y perseverancia en las resoluciones. Se trata de una actitud o de una predisposición del ánimo respecto a un propósito
								</li>
							</ul>
						</div>
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