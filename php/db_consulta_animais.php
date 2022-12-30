<?php

  require_once 'config.php';

  class Database extends Config {

    public function buscar() {
    	$f0012 = 0;
    	$f1324 = 0;
    	$f2536 = 0;
    	$f36 = 0;
    	$m0012 = 0;
    	$m1324 = 0;
    	$m2536 = 0;
    	$m36 = 0;
    	$total = 0;
    	$sql = 'SELECT sexo, data FROM animais ORDER BY id ASC';
      	$stmt = $this->conn->prepare($sql);
      	$stmt->execute();
      	$result = $stmt->fetchAll();
      	foreach ($result as $row) {
      		$total++;
      		$data = $row['data'];
			    $d1 = new DateTime('now');
     		  $d2 = new DateTime($data);
      		$intervalo = $d1->diff( $d2 );
      		$ano = $intervalo->y;
      		$meses = $intervalo->m;
      		$numero_meses = 0;
	      	if($ano > 0){
	        	$numero_meses = ($ano * 12) + $meses;
	      	}else{
	       	 	$numero_meses = $meses;
	      	}
	      	if($row['sexo'] == "femea"){
	      		if($numero_meses > 36){
	      			$f36++;
	      		}else{
	      			if($numero_meses < 12){
	      				$f0012++;
	      			}else{
	      				if($numero_meses > 12 && $numero_meses <= 24){
	      					$f1324++;
	      				}else{
	      					$f2536++;
	      				}
	      			}
	      		}
	      	}else{
	      		if($numero_meses > 36){
	      			$m36++;
	      		}else{
	      			if($numero_meses < 12){
	      				$m0012++;
	      			}else{
	      				if($numero_meses > 12 && $numero_meses <= 24){
	      					$m1324++;
	      				}else{
	      					$m2536++;
	      				}
	      			}
	      		}
	      	}
      	}

      	$output = "";

		    $output .= '<tr>
                      <td>' . $f0012 . '</td>
                      <td>' . $f1324 . '</td>
                      <td>' . $f2536 . '</td>
                      <td>' . $f36 . '</td>
                      <td>' . $m0012 . '</td>
                      <td>' . $m1324 . '</td>
                      <td>' . $m2536 . '</td>
                      <td>' . $m36 . '</td>
                      <td>' . $total. '</td>
                    </tr>';

      	return $output;
    }
  }

?>