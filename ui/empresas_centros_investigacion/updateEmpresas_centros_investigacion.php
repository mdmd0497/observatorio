<?php
$processed=false;
$idEmpresas_centros_investigacion = $_GET['idEmpresas_centros_investigacion'];
$updateEmpresas_centros_investigacion = new Empresas_centros_investigacion($idEmpresas_centros_investigacion);
$updateEmpresas_centros_investigacion -> select();
$variable="";
if(isset($_POST['variable'])){
	$variable=$_POST['variable'];
}
$calificacion="";
if(isset($_POST['calificacion'])){
	$calificacion=$_POST['calificacion'];
}
$grupo_de_investigacion="";
if(isset($_POST['grupo_de_investigacion'])){
	$grupo_de_investigacion=$_POST['grupo_de_investigacion'];
}
if(isset($_POST['update'])){
	$updateEmpresas_centros_investigacion = new Empresas_centros_investigacion($idEmpresas_centros_investigacion, $variable, $calificacion, $grupo_de_investigacion);
	$updateEmpresas_centros_investigacion -> update();
	$updateEmpresas_centros_investigacion -> select();
	$objGrupo_de_investigacion = new Grupo_de_investigacion($grupo_de_investigacion);
	$objGrupo_de_investigacion -> select();
	$nameGrupo_de_investigacion = $objGrupo_de_investigacion -> getNombre();
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
		$logAdministrador = new LogAdministrador("","Editar Empresas_centros_investigacion", "Variable: " . $variable . "; Calificacion: " . $calificacion . "; Grupo_de_investigacion: " . $nameGrupo_de_investigacion , date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $_SESSION['id']);
		$logAdministrador -> insert();
	}
	else if($_SESSION['entity'] == 'Usuario_ud'){
		$logUsuario_ud = new LogUsuario_ud("","Editar Empresas_centros_investigacion", "Variable: " . $variable . "; Calificacion: " . $calificacion . "; Grupo_de_investigacion: " . $nameGrupo_de_investigacion , date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $_SESSION['id']);
		$logUsuario_ud -> insert();
	}
	else if($_SESSION['entity'] == 'Grupo_de_investigacion'){
		$logGrupo_de_investigacion = new LogGrupo_de_investigacion("","Editar Empresas_centros_investigacion", "Variable: " . $variable . "; Calificacion: " . $calificacion . "; Grupo_de_investigacion: " . $nameGrupo_de_investigacion , date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $_SESSION['id']);
		$logGrupo_de_investigacion -> insert();
	}
	$processed=true;
}
?>
<div class="container">
	<div class="row">
		<div class="col-md-2"></div>
		<div class="col-md-8">
			<div class="card">
				<div class="card-header">
					<h4 class="card-title">Editar Empresas_centros_investigacion</h4>
				</div>
				<div class="card-body">
					<?php if($processed){ ?>
					<div class="alert alert-success" >Datos Editados
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<?php } ?>
					<form id="form" method="post" action="index.php?pid=<?php echo base64_encode("ui/empresas_centros_investigacion/updateEmpresas_centros_investigacion.php") . "&idEmpresas_centros_investigacion=" . $idEmpresas_centros_investigacion ?>" class="bootstrap-form needs-validation"   >
						<div class="form-group">
							<label>Variable</label>
							<textarea id="variable" name="variable" ><?php echo $updateEmpresas_centros_investigacion -> getVariable() ?></textarea>
							<script>
								$('#variable').summernote({
									tabsize: 2,
									height: 100
								});
							</script>
						</div>
						<div class="form-group">
							<label>Calificacion</label>
							<input type="text" class="form-control" name="calificacion" value="<?php echo $updateEmpresas_centros_investigacion -> getCalificacion() ?>"/>
						</div>
					<div class="form-group">
						<label>Grupo_de_investigacion*</label>
						<select class="form-control" name="grupo_de_investigacion">
							<?php
							$objGrupo_de_investigacion = new Grupo_de_investigacion();
							$grupo_de_investigacions = $objGrupo_de_investigacion -> selectAllOrder("nombre", "asc");
							foreach($grupo_de_investigacions as $currentGrupo_de_investigacion){
								echo "<option value='" . $currentGrupo_de_investigacion -> getIdGrupo_de_investigacion() . "'";
								if($currentGrupo_de_investigacion -> getIdGrupo_de_investigacion() == $updateEmpresas_centros_investigacion -> getGrupo_de_investigacion() -> getIdGrupo_de_investigacion()){
									echo " selected";
								}
								echo ">" . $currentGrupo_de_investigacion -> getNombre() . "</option>";
							}
							?>
						</select>
					</div>
						<button type="submit" class="btn btn-info" name="update">Editar</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
