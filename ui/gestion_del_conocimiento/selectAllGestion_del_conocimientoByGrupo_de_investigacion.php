<?php
$order = "";
if(isset($_GET['order'])){
	$order = $_GET['order'];
}
$dir = "";
if(isset($_GET['dir'])){
	$dir = $_GET['dir'];
}
$grupo_de_investigacion = new Grupo_de_investigacion($_GET['idGrupo_de_investigacion']); 
$grupo_de_investigacion -> select();
$error = 0;
if(!empty($_GET['action']) && $_GET['action']=="delete"){
	$deleteGestion_del_conocimiento = new Gestion_del_conocimiento($_GET['idGestion_del_conocimiento']);
	$deleteGestion_del_conocimiento -> select();
	if($deleteGestion_del_conocimiento -> delete()){
		$nameGrupo_de_investigacion = $deleteGestion_del_conocimiento -> getGrupo_de_investigacion() -> getNombre() . " " . $deleteGestion_del_conocimiento -> getGrupo_de_investigacion() -> getApellido() . " " . $deleteGestion_del_conocimiento -> getGrupo_de_investigacion() -> getClasificacion() . " " . $deleteGestion_del_conocimiento -> getGrupo_de_investigacion() -> getLider() . " " . $deleteGestion_del_conocimiento -> getGrupo_de_investigacion() -> getArea() . " " . $deleteGestion_del_conocimiento -> getGrupo_de_investigacion() -> getPagina_web();
		$user_ip = getenv('REMOTE_ADDR');
		$agent = $_SERVER["HTTP_USER_AGENT"];
		$browser = "-";
		if( preg_match('/MSIE (\d+\.\d+);/', $agent) ) {
			$browser = "Internet Explorer";
		} else if (preg_match('/Chrome[\/\s](\d+\.\d+)/', $agent) ) {
			$browser = "Chrome";
		} else if (preg_match('/Edge\/\d+/', $agent) ) {
			$browser = "Edge";
		} else if ( preg_match('/Firefox[\/\s](\d+\.\d+)/', $agent) ) {
			$browser = "Firefox";
		} else if ( preg_match('/OPR[\/\s](\d+\.\d+)/', $agent) ) {
			$browser = "Opera";
		} else if (preg_match('/Safari[\/\s](\d+\.\d+)/', $agent) ) {
			$browser = "Safari";
		}
		if($_SESSION['entity'] == 'Administrador'){
			$logAdministrador = new LogAdministrador("","Delete Gestion_del_conocimiento", "Variable: " . $deleteGestion_del_conocimiento -> getVariable() . ";; Calificacion: " . $deleteGestion_del_conocimiento -> getCalificacion() . ";; Grupo_de_investigacion: " . $nameGrupo_de_investigacion, date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $_SESSION['id']);
			$logAdministrador -> insert();
		}
		else if($_SESSION['entity'] == 'Usuario_ud'){
			$logUsuario_ud = new LogUsuario_ud("","Delete Gestion_del_conocimiento", "Variable: " . $deleteGestion_del_conocimiento -> getVariable() . ";; Calificacion: " . $deleteGestion_del_conocimiento -> getCalificacion() . ";; Grupo_de_investigacion: " . $nameGrupo_de_investigacion, date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $_SESSION['id']);
			$logUsuario_ud -> insert();
		}
		else if($_SESSION['entity'] == 'Grupo_de_investigacion'){
			$logGrupo_de_investigacion = new LogGrupo_de_investigacion("","Delete Gestion_del_conocimiento", "Variable: " . $deleteGestion_del_conocimiento -> getVariable() . ";; Calificacion: " . $deleteGestion_del_conocimiento -> getCalificacion() . ";; Grupo_de_investigacion: " . $nameGrupo_de_investigacion, date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $_SESSION['id']);
			$logGrupo_de_investigacion -> insert();
		}
	}else{
		$error = 1;
	}
}
?>
<div class="container-fluid">
	<div class="card">
		<div class="card-header">
			<h4 class="card-title">Consultar Gestion_del_conocimiento de Grupo_de_investigacion: <em><?php echo $grupo_de_investigacion -> getNombre() . " " . $grupo_de_investigacion -> getApellido() . " " . $grupo_de_investigacion -> getClasificacion() . " " . $grupo_de_investigacion -> getLider() . " " . $grupo_de_investigacion -> getArea() . " " . $grupo_de_investigacion -> getPagina_web() ?></em></h4>
		</div>
		<div class="card-body">
		<?php if(isset($_GET['action']) && $_GET['action']=="delete"){ ?>
			<?php if($error == 0){ ?>
				<div class="alert alert-success" >The registry was succesfully deleted.
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<?php } else { ?>
				<div class="alert alert-danger" >The registry was not deleted. Check it does not have related information
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<?php }
			} ?>
			<div class="table-responsive">
			<table class="table table-striped table-hover">
				<thead>
					<tr><th></th>
						<th nowrap>Variable 
						<?php if($order=="variable" && $dir=="asc") { ?>
							<span class='fas fa-sort-up'></span>
						<?php } else { ?>
							<a data-toggle='tooltip' class='tooltipLink' data-original-title='Ordenar Ascendente' href='index.php?pid=<?php echo base64_encode("ui/gestion_del_conocimiento/selectAllGestion_del_conocimientoByGrupo_de_investigacion.php") ?>&idGrupo_de_investigacion=<?php echo $_GET['idGrupo_de_investigacion'] ?>&order=variable&dir=asc'>
							<span class='fas fa-sort-amount-up'></span></a>
						<?php } ?>
						<?php if($order=="variable" && $dir=="desc") { ?>
							<span class='fas fa-sort-down'></span>
						<?php } else { ?>
							<a data-toggle='tooltip' class='tooltipLink' data-original-title='Ordenar Descendente' href='index.php?pid=<?php echo base64_encode("ui/gestion_del_conocimiento/selectAllGestion_del_conocimientoByGrupo_de_investigacion.php") ?>&idGrupo_de_investigacion=<?php echo $_GET['idGrupo_de_investigacion'] ?>&order=variable&dir=desc'>
							<span class='fas fa-sort-amount-down'></span></a>
						<?php } ?>
						</th>
						<th nowrap>Calificacion 
						<?php if($order=="calificacion" && $dir=="asc") { ?>
							<span class='fas fa-sort-up'></span>
						<?php } else { ?>
							<a data-toggle='tooltip' class='tooltipLink' data-original-title='Ordenar Ascendente' href='index.php?pid=<?php echo base64_encode("ui/gestion_del_conocimiento/selectAllGestion_del_conocimientoByGrupo_de_investigacion.php") ?>&idGrupo_de_investigacion=<?php echo $_GET['idGrupo_de_investigacion'] ?>&order=calificacion&dir=asc'>
							<span class='fas fa-sort-amount-up'></span></a>
						<?php } ?>
						<?php if($order=="calificacion" && $dir=="desc") { ?>
							<span class='fas fa-sort-down'></span>
						<?php } else { ?>
							<a data-toggle='tooltip' class='tooltipLink' data-original-title='Ordenar Descendente' href='index.php?pid=<?php echo base64_encode("ui/gestion_del_conocimiento/selectAllGestion_del_conocimientoByGrupo_de_investigacion.php") ?>&idGrupo_de_investigacion=<?php echo $_GET['idGrupo_de_investigacion'] ?>&order=calificacion&dir=desc'>
							<span class='fas fa-sort-amount-down'></span></a>
						<?php } ?>
						</th>
						<th>Grupo_de_investigacion</th>
						<th nowrap></th>
					</tr>
				</thead>
				</tbody>
					<?php
					$gestion_del_conocimiento = new Gestion_del_conocimiento("", "", "", $_GET['idGrupo_de_investigacion']);
					if($order!="" && $dir!="") {
						$gestion_del_conocimientos = $gestion_del_conocimiento -> selectAllByGrupo_de_investigacionOrder($order, $dir);
					} else {
						$gestion_del_conocimientos = $gestion_del_conocimiento -> selectAllByGrupo_de_investigacion();
					}
					$counter = 1;
					foreach ($gestion_del_conocimientos as $currentGestion_del_conocimiento) {
						echo "<tr><td>" . $counter . "</td>";
						echo "<td>" . $currentGestion_del_conocimiento -> getVariable() . "</td>";
						echo "<td>" . $currentGestion_del_conocimiento -> getCalificacion() . "</td>";
						echo "<td><a href='modalGrupo_de_investigacion.php?idGrupo_de_investigacion=" . $currentGestion_del_conocimiento -> getGrupo_de_investigacion() -> getIdGrupo_de_investigacion() . "' data-toggle='modal' data-target='#modalGestion_del_conocimiento' >" . $currentGestion_del_conocimiento -> getGrupo_de_investigacion() -> getNombre() . " " . $currentGestion_del_conocimiento -> getGrupo_de_investigacion() -> getApellido() . " " . $currentGestion_del_conocimiento -> getGrupo_de_investigacion() -> getClasificacion() . " " . $currentGestion_del_conocimiento -> getGrupo_de_investigacion() -> getLider() . " " . $currentGestion_del_conocimiento -> getGrupo_de_investigacion() -> getArea() . " " . $currentGestion_del_conocimiento -> getGrupo_de_investigacion() -> getPagina_web() . "</a></td>";
						echo "<td class='text-right' nowrap>";
						if($_SESSION['entity'] == 'Administrador' || $_SESSION['entity'] == 'Grupo_de_investigacion') {
							echo "<a href='index.php?pid=" . base64_encode("ui/gestion_del_conocimiento/updateGestion_del_conocimiento.php") . "&idGestion_del_conocimiento=" . $currentGestion_del_conocimiento -> getIdGestion_del_conocimiento() . "'><span class='fas fa-edit' data-toggle='tooltip' data-placement='left' class='tooltipLink' data-original-title='Editar Gestion_del_conocimiento' ></span></a> ";
						}
						if($_SESSION['entity'] == 'Administrador') {
							echo "<a href='index.php?pid=" . base64_encode("ui/gestion_del_conocimiento/selectAllGestion_del_conocimientoByGrupo_de_investigacion.php") . "&idGrupo_de_investigacion=" . $_GET['idGrupo_de_investigacion'] . "&idGestion_del_conocimiento=" . $currentGestion_del_conocimiento -> getIdGestion_del_conocimiento() . "&action=delete' onclick='return confirm(\"Confirm to delete Gestion_del_conocimiento: " . $currentGestion_del_conocimiento -> getVariable() . " " . $currentGestion_del_conocimiento -> getCalificacion() . "\")'> <span class='fas fa-backspace' data-toggle='tooltip' data-placement='left' class='tooltipLink' data-original-title='Delete Gestion_del_conocimiento' ></span></a> ";
						}
						echo "</td>";
						echo "</tr>";
						$counter++;
					};
					?>
				</tbody>
			</table>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="modalGestion_del_conocimiento" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" >
		<div class="modal-content" id="modalContent">
		</div>
	</div>
</div>
<script>
	$('body').on('show.bs.modal', '.modal', function (e) {
		var link = $(e.relatedTarget);
		$(this).find(".modal-content").load(link.attr("href"));
	});
</script>
