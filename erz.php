<?php
require_once('index.php');

    $Client1= new ApiClient();
    /*echo "<pre>";
    var_dump($Client1->erzData(null,"organic", 6));
    echo "<pre>";*/
 ?>

<!DOCTYPE HTML>
<html>
	<head>
		<title>ErzData</title>
		<meta charset="utf-8">
	    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="main.css">
	</head>
		<body>
			<h1>Welcome to Open ERZ-Calendar</h1>
			<form action="erz.php" method="get" >
					<div class="form-group">
						 <label for="zip">zip</label>
					    <input type="text" name="zip" class="form-control"  id="zip">
				  	</div>
				  	<div class="radio">
  						<label>
					    <input type="radio" name="waste" id="optionsRadios1" value="paper" >paper
					  </label>
					</div>
					<div class="radio">
	  					<label>
						    <input type="radio" name="waste" id="optionsRadios2" value="textile">textile
						</label>
					</div>
					<div class="radio">
	  					<label>
						    <input type="radio" name="waste" id="optionsRadios3" value="organic">organic
						 </label>
					</div>
					<div class="radio">
		  				<label>
							  <input type="radio" name="waste" id="optionsRadios4" value="special">special
						</label>
					</div>
					<div class="form-group">
						 <label for="start">start</label>
					    <input type="text" name="start" class="form-control"  id="start">
				  	</div>
					<div class="form-group">
						 <label for="end">end</label>
					    <input type="text" name="end" class="form-control"  id="end">
				  	</div>
					<div class="form-group">
				      	<button type="submit" class="btn btn-default">suchen</button>
					</div>
					<input type="hidden" name="page" value="1">


			</form>
			<br>
    			<br>
			   <table class="table table-bordered">
			      <thead>
			        <tr><th>zip</th><th>date<th>type</th></tr>
			      </thead>
      			<tbody>
					<?php

					/*$zip = null;
					$waste = null;
					$page = 1;

					if (!empty ($_GET['zip'])) {
						$zip = $_GET['zip'];
					}
					if (!empty ($_GET['waste'])) {
						$waste = $_GET['waste'];
					}*/
					//print_r($_GET);
					if (!empty($_GET)) {
						 $data = $Client1->erzData($_GET['zip'], $_GET['waste'],$_GET['page']);
						 print_r($data->_metadata);
						 foreach ($data->result as $row) {
						    echo '<tr>';
						    foreach ($row as $item) {
						      echo "<td>{$item}</td>";
						    }
						    echo '</tr>';
						  }
					

					$pageSize = 10;
					// totaldaten dada holt eigenschaf meta_daten und greift auf objekten
					$totalCount = $data->_metadata->total_count;
					$totalpages = ceil($totalCount / $pageSize);

					echo $totalpages;
					echo "<br />";

				}
					//echo $_GET['page']; <-- ist für die aktuelle page

					/*for ($i=0; $i<$totalpages; $i++) { 
						echo '<nav';
						echo '<ul class="pagination>';
						echo $totalpages;
						echo '</nav>';
						echo '</ul>';
					}*/

					?>
      			</tbody>
    			</table>
    				<nav>
					  <ul class="pagination">
					    <li class="disabled"><a href="#" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>
					    <?php
					    for ($i=1; $i<=$totalpages; $i++) { 
				
				
							echo "<li><a href='erz.php?zip=" .$_GET["zip"] . "&waste=" . $_GET["waste"] . "&page=" . $_GET["page"] . "'>" . $i . "</a></li>";
							
						}
						?>
					    <li><a href="#" aria-label="Next"> <span aria-hidden="true">&raquo;</span></a></li>
					  </ul>
					</nav>
		</body>
</html>