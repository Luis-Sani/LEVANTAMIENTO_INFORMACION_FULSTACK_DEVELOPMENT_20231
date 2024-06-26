<?php
require_once ($_SESSION['raiz'] . '/modules/sections/role-access-admin-editor.php');

include_once 'load_data.php';

?>

<div class="form-data form-config-user">
	<div class="loader-user"></div>
	<div class="body">
		<div class="section-croppie-image">
			<div class="image-crop"></div>
			<div class="options">
				<a href="#" class="change-btn"><span class="icon">sync</span></a>
				<a href="#" class="crop-btn"><span class="icon">crop</span></a>
				<a href="/user" class="cancel-btn"><span class="icon">close</span></a>
			</div>
		</div>
		<form name="form-update-users" action="update.php" enctype="multipart/form-data" method="POST"
			onsubmit="return confirmPass()">
			<div class="wrap">
				<div class="first">
					<div class="section-user-image">
						<img src="<?php echo '/images/users/' . $_SESSION['user_image']; ?>" />
						<?php
						$date_time_start = isset ($_SESSION['image_updated_at']) ? date_create($_SESSION['image_updated_at']) : date_create('2000-12-23 10:30:15');
						$date_time_end = date_create(date('Y-m-d'));
						$interval = date_diff($date_time_start, $date_time_end);
						$days = intval($interval->format('%a'));

						if ($days >= 15 or $_SESSION['image_updated_at'] == null or $_SESSION['user_image'] == 'user.png') {
							echo '
						<a href="#" class="file"><span class="icon">add_a_photo</span></a>
						<input id="fileuploadimage" style="display: none;" type="file" name="fileuploadimage" accept=".jpg, .jpeg, .png" />
						';
						} else {
							echo '
						<a class="file disabled"><span class="icon">add_a_photo</span></a>
						';
							if ((15 - $days) >= 1) {
								$_SESSION['msgbox_info'] = 1;
								$_SESSION['msgbox_error'] = 0;
								$_SESSION['text_msgbox_info'] = 'Imagen de usuario actualizada recientemente.';
							}
						}
						?>
						<div class="section-user-info">
							<span class="user-name">
								<?php echo $_SESSION['name'] . ' ' . $_SESSION['surnames']; ?>
							</span>
							<span class="user-rol">
								<?php
								if ($_SESSION['user_rol'] == "student") {
									echo "Estudiante";
								} else if ($_SESSION['user_rol'] == "admin") {
									echo "Administrador";
								} else {
									echo $_SESSION['user_rol'];
								}
								?>
							</span>

						</div>
					</div>
				</div>
				<div class="last">

					<div class="body">


						<?php if ($_SESSION['user_rol'] === 'student') { ?>
							<form name="form-update-students" action="update.php" method="POST" autocomplete="off"
								autocapitalize="on">
								<div class="wrap">
									<div class="section-user-info">
										<h1 class="titulo">Perfil</h1>
									</div>
									<div class="first">
										<label for="txtuserid" class="label">Usuario</label>
										<input id="txtuserid" style="display: none;" type="text" name="txtuserid"
											value="<?php echo $_SESSION['user_id']; ?>" maxlength="50">
										<input class="text" type="text" name="txt"
											value="<?php echo $_SESSION['user_id']; ?>" maxlength="50" disabled />
										<label for="txtusername" class="label">Nombre</label>
										<input id="txtusername" class="text" type="text" name="txtname"
											value="<?php echo $_SESSION['student_name']; ?>" placeholder="Nombre" autofocus
											maxlength="30" required />
										<label for="txtusersurnames" class="label">Apellidos</label>
										<input id="txtusersurnames" class="text" type="text" name="txtsurnames"
											value="<?php echo $_SESSION['student_surnames']; ?>" placeholder="Apellidos"
											maxlength="60" required />
										<label for="txtuseremail" class="label">Correo</label>
										<input id="txtuseremail" class="text" type="email" name="txtemailupdate"
											value="<?php echo $_SESSION['student_email']; ?>"
											placeholder="ejemplo@email.com" maxlength="200" autofocus />
										<label for="dateofbirth" class="label">Fecha de nacimiento</label>
										<input id="dateofbirth" class="date" type="date" name="dateofbirth"
											value="<?php echo $_SESSION['student_date_of_birth']; ?>"
											pattern="\d{4}-\d{2}-\d{2}" placeholder="aaaa-mm-dd" maxlength="10" required />
										<label for="selectsede" class="label">Sede</label>
										<select id="selectsede" class="select" name="selectSede" required>
											<?php
											if ($_SESSION['student_sede'] == '') {
												echo '
								<option value="">Seleccione</option>
								<option value="matriz">Matriz</option>
								<option value="latacunga">Latacunga</option>
								
								<option value="stodomingo">Sto. Domingo</option>
							';
											} elseif ($_SESSION['student_sede'] == 'matriz') {
												echo '
								<option value="matriz">Matriz</option>
								<option value="latacunga">Latacunga</option>
								
								<option value="stodomingo">Sto. Domingo</option>
							';
											} elseif ($_SESSION['student_sede'] == 'latacunga') {
												echo '
								<option value="latacunga">Latacunga</option>
								<option value="matriz">Matriz</option>
								
								<option value="stodomingo">Sto. Domingo</option>
							';
											} elseif ($_SESSION['student_sede'] == 'stodomingo') {
												echo '
								<option value="stodomingo">Sto. Domingo</option>								
								<option value="matriz">Matriz</option>
								<option value="latacunga">Latacunga</option>
							';
											}
											?>
										</select>

										<label for="selectuserdocumentation" class="label">Documentación</label>
										<select id="selectuserdocumentation" class="select" name="selectDocumentation"
											disabled>
											<?php
											if ($_SESSION['student_documentation'] == '') {
												echo '
								<option value="">Seleccioné</option>
								<option value="REPROBADO">REPROBADO</option>
								<option value="EN PROCESO">EN PROCESO</option>
								<option value="APROBADO">APROBADO</option>
							';
											} else if ($_SESSION['student_documentation'] == 'REPROBADO') {
												echo
													'
								<option value="REPROBADO">REPROBADO</option>
								<option value="EN PROCESO">EN PROCESO</option>
								<option value="APROBADO">APROBADO</option>
							';
											} elseif ($_SESSION['student_documentation'] == 'EN PROCESO') {
												echo
													'
								<option value="EN PROCESO">EN PROCESO</option>
								<option value="REPROBADO">REPROBADO</option>
								<option value="APROBADO">APROBADO</option>
							';
											} elseif ($_SESSION['student_documentation'] == 'APROBADO') {
												echo
													'   <option value="APROBADO">APROBADO</option>
								<option value="EN PROCESO">EN PROCESO</option>
								<option value="REPROBADO">REPROBADO</option>
							';
											}
											?>
										</select>

										<label for="selectuserestado" class="label">Estado</label>
										<select id="selectuserestado" class="select" name="selectEstado" disabled>
											<?php
											if ($_SESSION['student_status'] == '') {
												echo '
							<option value="">Seleccione</option>
							<option value="activo">Activo</option>
							<option value="en_proceso">En proceso</option>
							<option value="finalizado">Finalizado</option>
							';
											} elseif ($_SESSION['student_status'] == 'activo') {
												echo '
							<option value="activo">Activo</option>
							<option value="en_proceso">En proceso</option>
							<option value="finalizado">Finalizado</option>
							';
											} elseif ($_SESSION['student_status'] == 'en_proceso') {
												echo '
							<option value="en_proceso">En proceso</option>
							<option value="activo">Activo</option>
							<option value="finalizado">Finalizado</option>
							';
											} elseif ($_SESSION['student_status'] == 'finalizado') {
												echo '
							<option value="finalizado">Finalizado</option>
							<option value="activo">Activo</option>
							<option value="en_proceso">En proceso</option>
							';
											}

											?>
										</select>



										<label class="label">Departamento</label>
										<input class="text" type="text" name="txtdepartamento"
											value="<?php echo $_SESSION['student_departamento']; ?>" disabled />
									</div>
									<div class="first">
										<label for="txtusercedula" class="label">Cédula</label>
										<input id="txtusercedula" class="text" type="text" name="txtcedula"
											value="<?php echo $_SESSION['student_cedula']; ?>"
											placeholder="Cédula de Identidad" pattern="[0-9]{10}" maxlength="10" required />
										<label for="txtuserpass" class="label">Contraseña</label>
										<input id="txtuserpass" class="text" type="text" name="txtpass"
											value="<?php echo $_SESSION['student_pass']; ?>" placeholder="XXXXXXXXX"
											pattern="[A-Za-z0-9]{8}" maxlength="8" required />
										<label for="txtuserid" class="label">ID</label>
										<input id="txtuserid" class="text" type="text" name="txtid"
											value="<?php echo $_SESSION['student_id']; ?>" placeholder="L00XXXXXXX"
											pattern="[A-Za-z0-9]{9}" maxlength="9"
											onkeyup="this.value = this.value.toUpperCase()" required />
										<label for="txtuserphone" class="label">Número de teléfono</label>
										<input id="txtuserphone" class="text" type="text" name="txtphone"
											value="<?php echo $_SESSION['student_phone']; ?>" pattern="[0-9]{10}"
											title="Ingresa un número de teléfono válido." placeholder="09999XXXXX"
											maxlength="10" required />




										<label for="selectuserjerarquia" class="label">Jerarquia</label>
										<select id="selectuserjerarquia" class="select" name="selectJerarquia" disabled>

											<?php
											if ($_SESSION['student_jerarquia'] == 'LIDER') {
												echo '
						<option value="LIDER">LIDER</option>
						<option value="COLIDER">COLIDER</option>
						<option value="APOYO1">APOYO 1</option>
						<option value="APOYO2">APOYO 2</option>
						<option value="APOYO3">APOYO 3</option>
						<option value="APOYO4">APOYO 4</option>
						<option value="APOYO5">APOYO 5</option>
						<option value="APOYO6">APOYO 6</option>
						<option value="APOYO7">APOYO 7</option>
						<option value="APOYO8">APOYO 8</option>

						';
											} elseif ($_SESSION['student_jerarquia'] == 'COLIDER') {
												echo '
						<option value="COLIDER">COLIDER</option>
						<option value="LIDER">LIDER</option>
						<option value="APOYO1">APOYO 1</option>
						<option value="APOYO2">APOYO 2</option>
						<option value="APOYO3">APOYO 3</option>
						<option value="APOYO4">APOYO 4</option>
						<option value="APOYO5">APOYO 5</option>
						<option value="APOYO6">APOYO 6</option>
						<option value="APOYO7">APOYO 7</option>
						<option value="APOYO8">APOYO 8</option>
						
						';
											} elseif ($_SESSION['student_jerarquia'] == 'APOYO1') {
												echo '
						<option value="APOYO1">APOYO 1</option>
						<option value="LIDER">LIDER</option>
						<option value="COLIDER">COLIDER</option>
						<option value="APOYO2">APOYO 2</option>
						<option value="APOYO3">APOYO 3</option>
						<option value="APOYO4">APOYO 4</option>
						<option value="APOYO5">APOYO 5</option>
						<option value="APOYO6">APOYO 6</option>
						<option value="APOYO7">APOYO 7</option>
						<option value="APOYO8">APOYO 8</option>
						
						';
											} elseif ($_SESSION['student_jerarquia'] == 'APOYO2') {
												echo '
						<option value="APOYO2">APOYO 2</option>
						<option value="LIDER">LIDER</option>
						<option value="COLIDER">COLIDER</option>
						<option value="APOYO1">APOYO 1</option>
						<option value="APOYO3">APOYO 3</option>
						<option value="APOYO4">APOYO 4</option>
						<option value="APOYO5">APOYO 5</option>
						<option value="APOYO6">APOYO 6</option>
						<option value="APOYO7">APOYO 7</option>
						<option value="APOYO8">APOYO 8</option>
						';
											} elseif ($_SESSION['student_jerarquia'] == 'APOYO3') {
												echo '
						<option value="APOYO3">APOYO 3</option>
						<option value="LIDER">LIDER</option>
						<option value="COLIDER">COLIDER</option>
						<option value="APOYO1">APOYO 1</option>
						<option value="APOYO2">APOYO 2</option>
						<option value="APOYO4">APOYO 4</option>
						<option value="APOYO5">APOYO 5</option>
						<option value="APOYO6">APOYO 6</option>
						<option value="APOYO7">APOYO 7</option>
						<option value="APOYO8">APOYO 8</option>
						';
											} elseif ($_SESSION['student_jerarquia'] == 'APOYO4') {
												echo '
						<option value="APOYO4">APOYO 4</option>
						<option value="LIDER">LIDER</option>
						<option value="COLIDER">COLIDER</option>
						<option value="APOYO1">APOYO 1</option>
						<option value="APOYO2">APOYO 2</option>
						<option value="APOYO3">APOYO 3</option>
						<option value="APOYO5">APOYO 5</option>
						<option value="APOYO6">APOYO 6</option>
						<option value="APOYO7">APOYO 7</option>
						<option value="APOYO8">APOYO 8</option>

						';
											} elseif ($_SESSION['student_jerarquia'] == 'APOYO5') {
												echo '
						<option value="APOYO5">APOYO 5</option>
						<option value="LIDER">LIDER</option>
						<option value="COLIDER">COLIDER</option>
						<option value="APOYO1">APOYO 1</option>
						<option value="APOYO2">APOYO 2</option>
						<option value="APOYO3">APOYO 3</option>
						<option value="APOYO4">APOYO 4</option>
						<option value="APOYO6">APOYO 6</option>
						<option value="APOYO7">APOYO 7</option>
						<option value="APOYO8">APOYO 8</option>
						
						';
											} elseif ($_SESSION['student_jerarquia'] == 'APOYO6') {
												echo '
						<option value="APOYO6">APOYO 6</option>
						<option value="LIDER">LIDER</option>
						<option value="COLIDER">COLIDER</option>
						<option value="APOYO1">APOYO 1</option>
						<option value="APOYO2">APOYO 2</option>
						<option value="APOYO3">APOYO 3</option>
						<option value="APOYO4">APOYO 4</option>
						<option value="APOYO5">APOYO 5</option>
						<option value="APOYO7">APOYO 7</option>
						<option value="APOYO8">APOYO 8</option>
						
						';
											} elseif ($_SESSION['student_jerarquia'] == 'APOYO7') {
												echo '
						<option value="APOYO7">APOYO 7</option>
						<option value="LIDER">LIDER</option>
						<option value="COLIDER">COLIDER</option>
						<option value="APOYO1">APOYO 1</option>
						<option value="APOYO2">APOYO 2</option>
						<option value="APOYO3">APOYO 3</option>
						<option value="APOYO4">APOYO 4</option>
						<option value="APOYO5">APOYO 5</option>
						<option value="APOYO6">APOYO 6</option>
						<option value="APOYO8">APOYO 8</option>
						
						';
											} elseif ($_SESSION['student_jerarquia'] == 'APOYO8') {
												echo '
						<option value="APOYO8">APOYO 8</option>
						<option value="LIDER">LIDER</option>
						<option value="COLIDER">COLIDER</option>
						<option value="APOYO1">APOYO 1</option>
						<option value="APOYO2">APOYO 2</option>
						<option value="APOYO3">APOYO 3</option>
						<option value="APOYO4">APOYO 4</option>
						<option value="APOYO5">APOYO 5</option>
						<option value="APOYO6">APOYO 6</option>
						<option value="APOYO7">APOYO 7</option>
						
						';
											}
											?>
										</select>

										<label for="selectuserjornada" class="label">Jornada</label>
										<select id="selectuserjornada" class="select" name="selectJornada" disabled>
											<?php
											if ($_SESSION['student_jornada'] == '') {
												echo '
						<option value="">Seleccione</option>
                        <option value="Vespertino">Vespertino</option>
                        <option value="Matutino">Matutino</option>
                        <option value="Otra">Otra</option>
						';
											} elseif ($_SESSION['student_jornada'] == 'Vespertino') {
												echo '
						<option value="Vespertino">Vespertino</option>
						<option value="Matutino">Matutino</option>
						<option value="Otra">Otra</option>
						';
											} elseif ($_SESSION['student_jornada'] == 'Matutino') {
												echo '
						<option value="Matutino">Matutino</option>
						<option value="Vespertino">Vespertino</option>	
						<option value="Otro">Otro</option>
						';
											} elseif ($_SESSION['student_jornada'] == 'Otro') {
												echo '
						<option value="Otro">Otro</option> 
						<option value="Matutino">Matutino</option>
						<option value="Vespertino">Vespertino</option>
						';
											}
											?>
										</select>


										<label for="txtuseraddress" class="label">Domicilio</label>
										<input id="txtuseraddress" class="text" type="text" name="txtaddress"
											value="<?php echo $_SESSION['student_address']; ?>" placeholder="Domicilio"
											maxlength="200" required />
										<label for="selectusercareers" class="label">Carrera</label>
										<select id="selectusercareers" class="select" name="selectCareer" disabled>
											<?php
											$career = $_SESSION['student_career'];

											if ($career == '') {
												echo
													'
								<option value="">Seleccione</option>
							';
											}

											$sql = "SELECT career, name FROM careers";

											if ($result = $conexion->query($sql)) {
												while ($row = mysqli_fetch_array($result)) {
													if ($row['career'] == $career) {
														echo
															'
										<option value="' . $row['career'] . '" selected>' . $row['name'] . '</option>
									';
													} else {
														echo
															'
										<option value="' . $row['career'] . '">' . $row['name'] . '</option>
									';
													}
												}
											}
											?>
										</select>
										<label for="dateuseradmission" class="label">Fecha de admisión</label>
										<input id="dateuseradmission" class="date" type="date" name="dateadmission"
											value="<?php echo $_SESSION['student_admission_date']; ?>" disabled />
									</div>
									<div class="last">
										<label class="label" for="txthours">
											<label for="txttotalhours_hidden" class="label"
												placeholder="Suma de las horas">Horas de Vinculación</label>
											<input class="text" type="text" name="txttotalhours_hidden"
												id="txttotalhours_hidden"
												style="height: 50px; width: 40px; font-size: 16px;" readonly wrap="soft"
												value="<?php echo $_SESSION['student_horas']; ?>" disabled>
									</div>

									<div class="first">
										<label for="txtuserhours" class="label">Horarios Establecidos</label>
										<input id="txtuserhours" class="text" type="text" name="txtuserhours"
											placeholder="Seleccione el horario" maxlength="20000"
											style="height: 50px; width: 200px; font-size: 16px;" readonly wrap="soft"
											value="<?php echo $_SESSION['student_horario']; ?>" data-expandable disabled />
									</div>

									<div class="first">
										<label for="txtuserdates" class="label">Asistencia</label>
										<textarea id="txtuserdates" class="textarea" name="txtuserdates"
											placeholder="Seleccione fechas"
											style="height: 200px; width: 400px; font-size: 16px;" readonly wrap="soft"
											disabled><?php echo $_SESSION['student_asistencia']; ?></textarea>
									</div>


								</div>
								<div style="margin-left: 0px;">
									<label for="dateuserfinish" class="label">Fecha estimada de salida</label>
									<input id="dateuserfinish" class="date" type="date" name="datefinish" readonly
										style="width: 400px;" />
								</div>



							</form>


						<?php } else if ($_SESSION['user_rol'] === 'teacher') { ?>
								<form name="form-update-teachers" action="update.php" method="POST" autocomplete="off"
									autocapitalize="on">
									<div class="wrap">
										<div class="section-user-info">
											<h1 class="titulo">Perfil</h1>
										</div>
										<div class="first">
											<label for="txtuserid" class="label">Usuario</label>
											<input id="txtuserid" style="display: none;" type="text" name="txtuserid"
												value="<?php echo $_SESSION['user_id']; ?>" maxlength="50">
											<input class="text" type="text" name="txt"
												value="<?php echo $_SESSION['user_id']; ?>" maxlength="50" disabled />
											<label for="txtusername" class="label">Nombre</label>
											<input id="txtusername" class="text" type="text" name="txtname"
												value="<?php echo $_SESSION['teacher_name']; ?>" placeholder="Nombre" autofocus
												maxlength="30" required />
											<label for="txtusersurnames" class="label">Apellidos</label>
											<input id="txtusersurnames" class="text" type="text" name="txtsurnames"
												value="<?php echo $_SESSION['teacher_surnames']; ?>" placeholder="Apellidos"
												maxlength="60" required />
											<label for="dateofbirth" class="label">Fecha de nacimiento</label>
											<input id="dateofbirth" class="date" type="text" name="dateofbirth"
												value="<?php echo $_SESSION['teacher_date_of_birth']; ?>"
												pattern="\d{4}-\d{2}-\d{2}" placeholder="aaaa-mm-dd" maxlength="10" required />
											<label for="selectgender" class="label">Género</label>
											<select id="selectgender" class="select" name="selectgender" required>
												<?php
												if ($_SESSION['teacher_gender'] == '') {
													echo '
								<option value="">SeleccionE</option>
								<option value="mujer">Mujer</option>
								<option value="hombre">Hombre</option>
								<option value="otro">Otro</option>
								<option value="nodecirlo">Prefiero no decirlo</option>
							';
												} elseif ($_SESSION['teacher_gender'] == 'mujer') {
													echo '
								<option value="mujer">Mujer</option>
								<option value="hombre">Hombre</option>
								<option value="otro">Otro</option>
								<option value="nodecirlo">Prefiero no decirlo</option>
							';
												} elseif ($_SESSION['teacher_gender'] == 'hombre') {
													echo '
								<option value="hombre">Hombre</option>
								<option value="mujer">Mujer</option>
								<option value="otro">Otro</option>
								<option value="nodecirlo">Prefiero no decirlo</option>
							';
												} elseif ($_SESSION['teacher_gender'] == 'otro') {
													echo '
								<option value="otro">Otro</option>
								<option value="mujer">Mujer</option>
								<option value="hombre">Hombre</option>
								<option value="nodecirlo">Prefiero no decirlo</option>
							';
												} elseif ($_SESSION['teacher_gender'] == 'nodecirlo') {
													echo '
								<option value="nodecirlo">Prefiero no decirlo</option>
								<option value="otro">Otro</option>
								<option value="mujer">Mujer</option>
								<option value="hombre">Hombre</option>
							';
												}
												?>
											</select>
											<label for="txtuseremail" class="label">Correo</label>
											<input id="txtuseremail" class="text" type="email" name="txtemail"
												value="<?php echo $_SESSION['teacher_email']; ?>"
												placeholder="ejemplo@email.com" maxlength="100" required />
										</div>
										<div class="first">
											<label for="txtusercedula" class="label">Cedula</label>
											<input id="txtusercedula" class="text" type="text" name="txtcedula"
												value="<?php echo $_SESSION['teacher_cedula']; ?>"
												placeholder="Cédula de Identidad" pattern="[0-9]{10}" maxlength="10" required />
											<label for="txtuserid" class="label">ID</label>
											<input id="txtuserid" class="text" type="text" name="txtid"
												value="<?php echo $_SESSION['teacher_id']; ?>" placeholder="L00XXXXXXX"
												pattern="[A-Za-z0-9]{9}" maxlength="9"
												onkeyup="this.value = this.value.toUpperCase()" required />
											<label for="txtuserpass" class="label">Contraseña</label>
											<input id="txtuserpass" class="text" type="text" name="txtpass"
												value="<?php echo $_SESSION['teacher_pass']; ?>" placeholder="XXXXXXXXX"
												pattern="[A-Za-z0-9]{8}" maxlength="8" required />
											<label for="txtuserphone" class="label">Número de teléfono</label>
											<input id="txtuserphone" class="text" type="text" name="txtphone"
												value="<?php echo $_SESSION['teacher_phone']; ?>" pattern="[0-9]{10}"
												title="Ingresa un número de teléfono válido." placeholder="09999XXXXX"
												maxlength="10" required />
											<label for="txtuseraddress" class="label">Domicilio</label>
											<input id="txtuseraddress" class="text" type="text" name="txtaddress"
												value="<?php echo $_SESSION['teacher_address']; ?>" placeholder="Domicilio"
												maxlength="200" required />

											<label for="selectuserlevelstudies" class="label">Nivel de estudios</label>
											<select id="selectuserlevelstudies" class="select" name="selectlevelstudies"
												required>
												<?php
												if ($_SESSION['teacher_level_studies'] == 'Licenciatura') {
													echo
														'
								<option value="Licenciatura">Licenciatura</option>
								<option value="Ingenieria">Ingenieria</option>
								<option value="Maestria">Maestria</option>
								<option value="Doctorado">Doctorado</option>
							';
												} elseif ($_SESSION['teacher_level_studies'] == 'Ingenieria') {
													echo
														'
								<option value="Ingenieria">Ingenieria</option>
								<option value="Licenciatura">Licenciatura</option>
								<option value="Maestria">Maestria</option>
								<option value="Doctorado">Doctorado</option>
							';
												} elseif ($_SESSION['teacher_level_studies'] == 'Maestria') {
													echo
														'
								<option value="Maestria">Maestria</option>
								<option value="Licenciatura">Licenciatura</option>
								<option value="Ingenieria">Ingenieria</option>
								<option value="Doctorado">Doctorado</option>
							';
												} elseif ($_SESSION['teacher_level_studies'] == 'Doctorado') {
													echo
														'
								<option value="Doctorado">Doctorado</option>
								<option value="Licenciatura">Licenciatura</option>
								<option value="Ingenieria">Ingenieria</option>
								<option value="Maestria">Maestria</option>
							';
												}
												?>
											</select>
										</div>
										<div class="first">
											<label for="selectusercareers" class="label">Carrera</label>
											<select id="selectusercareers" class="select" name="selectCareer" required>
												<?php
												$_SESSION['teacher_career'] = trim($_SESSION['teacher_career'], ',');
												$careers = explode(',', $_SESSION['teacher_career']);

												$i = 0;

												$sql = "SELECT career, name FROM careers";

												if ($result = $conexion->query($sql)) {
													while ($row = mysqli_fetch_array($result)) {
														if ($row['career'] == $careers[$i]) {
															echo
																'
										<option value="' . $row['career'] . '" selected>' . $row['name'] . '</option>
									';
															$i++;
														} else {
															echo
																'
										<option value="' . $row['career'] . '">' . $row['name'] . '</option>
									';
														}
													}
												}
												?>
											</select>
										</div>
									</div>
								</form>




						<?php } else if ($_SESSION['user_rol'] === 'empre') { ?>
									<form name="form-update-emprendedor" action="update.php" method="POST" autocomplete="off"
										autocapitalize="on">
										<div class="wrap">
											<div class="section-user-info">
												<h1 class="titulo">Perfil</h1>
											</div>
											<div class="first">
												<label class="label">Usuario</label>
												<input id="txtuserid" style="display: none;" type="text" name="txtuserid"
													value="<?php echo $_SESSION['user_id']; ?>" maxlength="50">
												<input class="text" type="text" name="txt"
													value="<?php echo $_SESSION['user_id']; ?>" disabled />
												<label for="txtuserpass" class="label">Contraseña</label>
												<input id="txtuserpass" class="text" type="text" name="txtpass"
													value="<?php echo $_SESSION['empre_pass']; ?>" placeholder="XXXXXXXXX"
													pattern="[A-Za-z0-9]{8}" maxlength="8" required />
												<label for="txtusername" class="label">Nombre</label>
												<input id="txtusername" class="text" type="text" name="txtname"
													value="<?php echo $_SESSION['empre_name']; ?>" placeholder="Nombre" autofocus
													maxlength="30" required />
												<label for="txtusersurnames" class="label">Apellidos</label>
												<input id="txtusersurnames" class="text" type="text" name="txtsurnames"
													value="<?php echo $_SESSION['empre_surnames']; ?>" placeholder="Apellidos"
													maxlength="60" required />

												<label for="dateofbirth" class="label">Fecha de nacimiento</label>
												<input id="dateofbirth" class="date" type="text" name="dateofbirth"
													value="<?php echo $_SESSION['empre_date_of_birth']; ?>"
													pattern="\d{4}-\d{2}-\d{2}" placeholder="aaaa-mm-dd" maxlength="10" required />
												<label for="txtusercity" class="label">Ciudad</label>
												<input id="txtusercity" class="text" type="text" name="txtcity"
													value="<?php echo $_SESSION['empre_city']; ?>" placeholder="ciudad"
													maxlength="50" required />

												<div class="descri">
													<label for="txtuserworkinghours_start" class="text">Abierto desde:</label>
													<input id="txtuserworkinghours_start" class="hour-input" type="time"
														name="txtworkinghours_start">
													<label for="txtuserworkinghours_start" class="text">Hora de salida:</label>
													<input id="txtuserworkinghours_start" class="hour-input" type="time"
														name="txtuserhours_end">
												</div>
												<div class="three">
													<label for="selectusereducation" class="label">Nivel de educación</label>
													<select id="selectusereducation" class="select" name="selecteducation" required>
													<?php
													if ($_SESSION['empre_education'] == '') {
														echo '
								<option value="">Seleccione</option>
								<option value="Sin nivel de educacion">Sin Formación</option>
								<option value="Escuela">Escuela</option>
								<option value="Colegio">Colegio</option>	
								<option value="Tecnología">Tecnología</option>
								<option value="Universidad">Universidad</option>		
							';
													} elseif ($_SESSION['empre_education'] == 'Sin nivel academico') {
														echo '
								<option value="Sin nivel de educacion">Sin Formación</option>
								<option value="Escuela">Escuela</option>
								<option value="Colegio">Colegio</option>	
								<option value="Tecnología">Tecnología</option>
								<option value="Universidad">Universidad</option>								
							';
													} elseif ($_SESSION['empre_education'] == 'Escuela') {
														echo '
								<option value="Escuela">Escuela</option>
								<option value="Sin nivel de educacion">Sin Formación</option>
								<option value="Colegio">Colegio</option>	
								<option value="Tecnología">Tecnología</option>
								<option value="Universidad">Universidad</option>							
							';
													} elseif ($_SESSION['empre_education'] == 'Colegio') {
														echo '
							<option value="Colegio">Colegio</option>
							<option value="Escuela">Escuela</option>
							<option value="Sin nivel de educacion">Sin Formación</option>
							<option value="Tecnología">Tecnología</option>
							<option value="Universidad">Universidad</option>								
							';
													} elseif ($_SESSION['empre_education'] == 'Tecnología') {
														echo '
							<option value="Tecnología">Tecnología</option>
							<option value="Colegio">Colegio</option>
							<option value="Escuela">Escuela</option>
							<option value="Sin nivel de educacion">Sin Formación</option>
							<option value="Universidad">Universidad</option>								
							';
													} elseif ($_SESSION['empre_education'] == 'Universidad') {
														echo '							
							<option value="Universidad">Universidad</option>
							<option value="Tecnología">Tecnología</option>
							<option value="Colegio">Colegio</option>
							<option value="Escuela">Escuela</option>
							<option value="Sin nivel de educacion">Sin Formación</option>									
							';
													}
													?>
													</select>
													<div class="four">
														<label for="selectusersocialnetworks" class="label">Utiliza redes
															sociales</label>
														<select id="selectusersocialnetworks" class="select"
															name="selectsocialnetworks" required>
														<?php
														if ($_SESSION['empre_socialnetworks'] == '') {
															echo '
								<option value="">Seleccione</option>
								<option value="Si">Si</option>
								<option value="No">No</option>								
							';
														} elseif ($_SESSION['empre_socialnetworks'] == 'Si') {
															echo '
								<option value="Si">Si</option>
								<option value="No">No</option>									
							';
														} elseif ($_SESSION['empre_socialnetworks'] == 'No') {
															echo '
								<option value="No">No</option>
								<option value="Si">Si</option>								
							';
														}
														?>
														</select>
													</div>
													<div class="total-salesyear">
														<label for="usersalesyear" class="label">Ventas de año 2019</label>
														<input id="txtusersalesyear" class="text" type="text" name="txtsalesyear"
															value="<?php echo $_SESSION['empre_salesyear']; ?>"
															placeholder="Ventas del año 2019" maxlength="50" required />


														<label for="usersalesyear1" class="label">Ventas de año 2020</label>
														<input id="txtusersalesyear1" class="text" type="text" name="txtsalesyear1"
															value="<?php echo $_SESSION['empre_salesyear1']; ?>"
															placeholder="Ventas del año 2020" maxlength="50" required />


														<label for="usersalesyear2" class="label">Ventas de año 2021</label>
														<input id="txtusersalesyear2" class="text" type="text" name="txtsalesyear2"
															value="<?php echo $_SESSION['empre_salesyear2']; ?>"
															placeholder="Ventas del año 2021" maxlength="50" required />


														<label for="usersalesyear3" class="label">Ventas de año 2022</label>
														<input id="txtusersalesyear3" class="text" type="text" name="txtsalesyear3"
															value="<?php echo $_SESSION['empre_salesyear3']; ?>"
															placeholder="Ventas del año 2022" maxlength="50" required />


														<label for="usersalesyear4" class="label">Ventas de año 2023</label>
														<input id="txtusersalesyear4" class="text" type="text" name="txtsalesyear4"
															value="<?php echo $_SESSION['empre_salesyear4']; ?>"
															placeholder="Ventas del año 2023" maxlength="50" required />

													</div>
												</div>
											</div>
											<div class="first">
												<label for="selectgender" class="label">Género</label>
												<select id="selectgender" class="select" name="selectGender" required>
												<?php
												if ($_SESSION['empre_gender'] == '') {
													echo '
								<option value="">Seleccione</option>
								<option value="mujer">Femenino</option>
								<option value="hombre">Masculino</option>
								<option value="otro">Otro</option>								
							';
												} elseif ($_SESSION['empre_gender'] == 'mujer') {
													echo '
								<option value="mujer">Femenino</option>
								<option value="hombre">Masculino</option>
								<option value="otro">Otro</option>								
							';
												} elseif ($_SESSION['empre_gender'] == 'hombre') {
													echo '
								<option value="hombre">Masculino</option>
								<option value="mujer">Femenino</option>
								<option value="otro">Otro</option>								
							';
												} elseif ($_SESSION['empre_gender'] == 'otro') {
													echo '
								<option value="otro">Otro</option>
								<option value="mujer">Femenino</option>
								<option value="hombre">Masculino</option>								
							';
												}
												?>
												</select>
												<label for="txtusercedula" class="label">Cédula</label>
												<input id="txtusercedula" class="text" type="text" name="txtcedula"
													value="<?php echo $_SESSION['empre_cedula']; ?>"
													placeholder="Cédula de Identidad" pattern="[0-9]{10}" maxlength="10" required />
												<label for="txtuserrfc" class="label">Nacionalidad</label>
												<input id="txtuserrfc" class="text" type="text" name="txtrfc"
													value="<?php echo $_SESSION['empre_rfc']; ?>" placeholder="Nacionalidad"
													required />
												<label for="txtuserphone" class="label">Número de teléfono</label>
												<input id="txtuserphone" class="text" type="text" name="txtphone"
													value="<?php echo $_SESSION['empre_phone']; ?>" pattern="[0-9]{10}"
													title="Ingresa un número de teléfono válido." placeholder="9998887766"
													maxlength="10" required />

												<label for="dateuseradmission" class="label">Correo Electrónico</label>
												<input id="txtuseremail" class="text" type="text" name="txtuseremail"
													value="<?php echo $_SESSION['empre_email']; ?>" placeholder="Correo"
													maxlength="200" required />
												<div class="eight">
													<label for="selectuserorganization" class="label">Organización</label>
													<select id="selectuserorganization" class="select" name="selectorganization"
														required>
													<?php
													if ($_SESSION['empre_organization'] == '') {
														echo '
								<option value="">Seleccione</option>
								<option value="no">no pertenezco</option>
								<option value="UDELA">UDELA</option>
								<option value="cooprede>cooprede</option>	
								<option value="otro>Otro</option>								
							';
													} elseif ($_SESSION['empre_organization'] == 'no pertenezco') {
														echo '
								<option value="no">no pertenezco</option>
								<option value="udela">udela</option>
								<option value="COOPREDE>COOPREDE</option>	
								<option value="otro>Otro</option>								
							';
													} elseif ($_SESSION['empre_organization'] == 'udela') {
														echo '
								<option value="udela">udela</option>
								<option value="no">no pertenezco</option>
								<option value="Cooprede>Cooprede</option>	
								<option value="otro>otro</option>								
							';
													} elseif ($_SESSION['empre_organization'] == 'cooprede') {
														echo '
							    <option value="cooprede>cooprede</option>	
								<option value="udela">udela</option>
								<option value="no">no pertenezco</option>
								<option value="otro>otro</option>							
							';
													} elseif ($_SESSION['empre_organization'] == 'otro') {
														echo '
								<option value="otro>Otro</option>	
								<option value="cooprede>cooprede</option>	
								<option value="udela">udela</option>
								<option value="no">no pertenezco</option>							
							';
													}
													?>
													</select>
													<label for="txtusernameorganization" class="label">Nombre de
														empredimiento</label>
													<input id="txtusernameorganization" class="text" type="text"
														name="txtnameorganization"
														value="<?php echo $_SESSION['empre_nameorganization']; ?>"
														placeholder="Nombre de empredimiento" autofocus maxlength="50" required />
													<div class="second">
														<label for="seleuserctstate" class="label">Estado</label>
														<select id="seleuserctstate" class="select" name="selectstate" required>
														<?php
														if ($_SESSION['empre_state'] == '') {
															echo '
								<option value="">Seleccione</option>
								<option value="Activo">Activo</option>
								<option value="Inactivo">Inactivo</option>								
							';
														} elseif ($_SESSION['empre_state'] == 'Activo') {
															echo '
								<option value="Activo">Activo</option>
								<option value="Inactivo">Inactivo</option>									
							';
														} elseif ($_SESSION['empre_state'] == 'Inactivo') {
															echo '
								<option value="Inactivo">Inactivo</option>
								<option value="Activo">Activo</option>								
							';
														}
														?>
														</select>
														<label for="userstartdate" class="label">Fecha de incio</label>
														<input id="userstartdate" class="date" type="date" name="startdate"
															value="<?php echo $_SESSION['empre_startdate']; ?>"
															pattern="\d{4}-\d{2}-\d{2}" placeholder="aaaa-mm-dd" maxlength="10"
															required />
														<div class="five">
															<label for="selectusersocialsales" class="label">Realiza ventas por
																redes sociales</label>
															<select id="selectusersocialsales" class="select"
																name="selectsocialsales" required>
															<?php
															if ($_SESSION['empre_socialsales'] == '') {
																echo '
								<option value="">Seleccione</option>
								<option value="Si">Si</option>
								<option value="No">No</option>								
							';
															} elseif ($_SESSION['empre_socialsales'] == 'Si') {
																echo '
								<option value="Si">Si</option>
								<option value="No">No</option>									
							';
															} elseif ($_SESSION['empre_socialsales'] == 'No') {
																echo '
								<option value="No">No</option>
								<option value="Si">Si</option>										
							';
															}
															?>
															</select>
														</div>
														<div class="total-heritage">
															<label for="userheritage" class="label">Patrimonio del año 2019</label>
															<input id="txtuserheritage" class="text" type="text" name="txtheritage"
																value="<?php echo $_SESSION['empre_heritage']; ?>"
																placeholder="Patrimonio del año 2019" maxlength="50" required />


															<label for="userheritage1" class="label">Patrimonio del año 2020</label>
															<input id="txtuserheritage1" class="text" type="text"
																name="txtheritage1"
																value="<?php echo $_SESSION['empre_heritage1']; ?>"
																placeholder="Patrimonio del año 2020" maxlength="50" required />


															<label for="userheritage2" class="label">Patrimonio del año 2021</label>
															<input id="txtuserheritage2" class="text" type="text"
																name="txtheritage2"
																value="<?php echo $_SESSION['empre_heritage2']; ?>"
																placeholder="Patrimonio del año 2021" maxlength="50" required />


															<label for="userheritage3" class="label">Patrimonio del año 2022</label>
															<input id="txtuserheritage3" class="text" type="text"
																name="txtheritage3"
																value="<?php echo $_SESSION['empre_heritage3']; ?>"
																placeholder="Patrimonio del año 2022" maxlength="50" required />


															<label for="userheritage4" class="label">Patrimonio del año 2023</label>
															<input id="txtuserheritage4" class="text" type="text"
																name="txtheritage4"
																value="<?php echo $_SESSION['empre_heritage4']; ?>"
																placeholder="Patrimonio del año 2023" maxlength="50" required />
														</div>

													</div>
												</div>
									</form>

						<?php } else if ($_SESSION['user_rol'] === 'admin') { ?>
										<form name="form-update-administratives" action="update.php" method="POST" autocomplete="off"
											autocapitalize="on">
											<div class="wrap">
												<div class="section-user-info">
													<h1 class="titulo">Perfil</h1>
												</div>
												<div class="first">
													<label for="txtuserid" class="label">Usuario</label>
													<input id="txtuserid" style="display: none;" type="text" name="txtuserid"
														value="<?php echo $_SESSION['user_id']; ?>" maxlength="50">
													<input class="text" type="text" name="txt"
														value="<?php echo $_SESSION['user_id']; ?>" maxlength="50" disabled />
													<label for="txtusername" class="label">Nombre</label>
													<input id="txtusername" class="text" type="text" name="txtname"
														value="<?php echo $_SESSION['administratives_name']; ?>" placeholder="Nombre"
														maxlength="30" required autofocus />
													<label for="txtusersurnames" class="label">Apellidos</label>
													<input id="txtusersurnames" class="text" type="text" name="txtsurnames"
														placeholder="Apellidos"
														value="<?php echo $_SESSION['administratives_surnames']; ?>" maxlength="60"
														required />
													<label for="txtid" class="label">ID</label>
													<input id="txtid" class="text" type="text" name="txtid"
														value="<?php echo $_SESSION['administratives_id']; ?>" placeholder="L00124281"
														maxlength="16" required />
													<label for="selectsede" class="label">Sede</label>
													<select id="selectsede" class="select" name="selectSede" required>
												<?php
												if ($_SESSION['administratives_sede'] == '') {
													echo '
								<option value="">Seleccione</option>
								<option value="matriz">Matriz</option>
								<option value="latacunga">Latacunga</option>
								
								<option value="stodomingo">Sto. Domingo</option>
							';
												} elseif ($_SESSION['administratives_sede'] == 'matriz') {
													echo '
								<option value="matriz">Matriz</option>
								<option value="latacunga">Latacunga</option>
								
								<option value="stodomingo">Sto. Domingo</option>
							';
												} elseif ($_SESSION['administratives_sede'] == 'latacunga') {
													echo '
								<option value="latacunga">Latacunga</option>
								<option value="matriz">Matriz</option>
								
								<option value="stodomingo">Sto. Domingo</option>
							';
												} elseif ($_SESSION['administratives_sede'] == 'stodomingo') {
													echo '
								<option value="stodomingo">Sto. Domingo</option>								
								<option value="matriz">Matriz</option>
								<option value="latacunga">Latacunga</option>
							';
												}
												?>
													</select>
												</div>
												<div class="first">
													<label for="txtcedula" class="label">Cédula</label>
													<input id="txtcedula" class="text" type="text" name="txtcedula"
														value="<?php echo $_SESSION['administratives_cedula']; ?>"
														placeholder="1600894560" pattern="[0-9]{10}" maxlength="10"
														onkeyup="this.value = this.value.toUpperCase()" required />
													<label for="txtcelular" class="label">Celular</label>
													<input id="txtcelular" class="text" type="text" name="txtcelular"
														value="<?php echo $_SESSION['administratives_celular']; ?>"
														placeholder="0979304658" pattern="[0-9]{10}"
														title="Ingresa un número de teléfono válido." maxlength="10" required />
													<label for="txtuserpass" class="label">Contraseña</label>
													<input id="txtuserpass" class="text" type="text" name="txtpass"
														value="<?php echo $_SESSION['administratives_pass']; ?>" placeholder="XXXXXXXXX"
														pattern="[A-Za-z0-9]{8}" maxlength="8" required />
													<label for="dateofbirth" class="label">Fecha de nacimiento</label>
													<input id="dateofbirth" class="date" type="text" name="dateofbirth"
														value="<?php echo $_SESSION['administratives_date_of_birth']; ?>"
														placeholder="aaaa-mm-dd" pattern="\d{4}-\d{2}-\d{2}" maxlength="10" required />
													<label for="selectusercareers" class="label">Carrera</label>
													<select id="selectusercareers" class="select" name="selectCareer" required>
												<?php
												$career = $_SESSION['administratives_carrera'];

												if ($career == '') {
													echo
														'
								<option value="">Seleccione</option>
							';
												}

												$sql = "SELECT career, name FROM careers";

												if ($result = $conexion->query($sql)) {
													while ($row = mysqli_fetch_array($result)) {
														if ($row['career'] == $career) {
															echo
																'
										<option value="' . $row['career'] . '" selected>' . $row['name'] . '</option>
									';
														} else {
															echo
																'
										<option value="' . $row['career'] . '">' . $row['name'] . '</option>
									';
														}
													}
												}
												?>
													</select>
												</div>
												<div class="first">
													<label for="txtemail" class="label">Email</label>
													<input id="txtemail" class="text" type="text" name="txtemail"
														value="<?php echo $_SESSION['administratives_email']; ?>"
														placeholder="Correo electrónico" maxlength="60" required />
												</div>
											</div>
										</form>

						<?php } else if ($_SESSION['user_rol'] === 'editor') { ?>
											<form name="form-update-users" action="update.php" method="POST" autocomplete="off"
												autocapitalize="on">
												<div class="wrap">
													<div class="section-user-info">
														<h1 class="titulo">Perfil</h1>
													</div>
													<div class="first">
														<label for="txtuserid" class="label">Usuario</label>
														<input id="txtuserid" style="display: none;" type="text" name="txtuserid"
															value="<?php echo $_SESSION['user_id']; ?>" maxlength="50">
														<input class="text" type="text" name="txt"
															value="<?php echo $_SESSION['user_id']; ?>" maxlength="50" disabled />
														<label for="txtusername" class="label">Nombre</label>
														<input id="txtusername" class="text" type="text" name="txtname"
															value="<?php echo $_SESSION['user_name']; ?>" placeholder="Nombre"
															maxlength="30" required autofocus />
													</div>
													<div class="first">
														<label for="txtuserpass" class="label">Contraseña</label>
														<input id="txtuserpass" class="text" type="text" name="txtpass"
															value="<?php echo $_SESSION['user_pass']; ?>" placeholder="XXXXXXXXX"
															pattern="[A-Za-z0-9]{8}" maxlength="8" required />
														<label for="txtusersurnames" class="label">Apellidos</label>
														<input id="txtusersurnames" class="text" type="text" name="txtsurnames"
															placeholder="Apellidos" value="<?php echo $_SESSION['user_surnames']; ?>"
															maxlength="60" required />
													</div>
													<div class="first">
														<label for="txtemail" class="label">Email</label>
														<input id="txtemail" class="text" type="text" name="txtemail"
															value="<?php echo $_SESSION['user_email']; ?>" placeholder="Correo electrónico"
															maxlength="60" required />
													</div>
												</div>
											</form>

						<?php } ?>

						<button id="btnSave" class="btn icon" type="submit">save</button>

					</div>

				</div>



				<label class="label">Debes volver a iniciar sesión para ver los cambios reflejados</label>
				<div class="footer">

					<span class="user-permissions">
						<?php
						if ($_SESSION['user_rol'] == "student") {
							echo "Estudiante";
						} else if ($_SESSION['user_rol'] == "admin") {
							echo "Administrador";
						} else {
							echo $_SESSION['user_rol'];
						}
						?>
					</span>
				</div>
			</div>
		</form>
	</div>
</div>
<script>
	$(document).ready(function () {
		function calcularFechaEstimada() {
			var admissionDate = new Date($("#dateuseradmission").val());
			var horasRequeridas = parseInt($("#txttotalhours_hidden").val());
			var diasLaborablesPorSemana = 5; // Supongamos que se trabaja de lunes a viernes
			var horasPorDia = 3; // Supongamos que se trabaja 3 horas diarias

			// Calcula el número total de horas necesarias
			var horasTotales = horasRequeridas / horasPorDia;

			// Calcula el número total de días necesarios, redondeando hacia arriba
			var diasTotales = Math.ceil(horasTotales / diasLaborablesPorSemana) * 7;

			// Calcula la fecha estimada de salida sumando los días necesarios a la fecha de admisión
			var fechaEstimada = new Date(admissionDate);
			fechaEstimada.setDate(fechaEstimada.getDate() + diasTotales);

			// Ajusta la fecha estimada para que sea un día hábil si es necesario
			while (fechaEstimada.getDay() === 0 || fechaEstimada.getDay() === 6) {
				fechaEstimada.setDate(fechaEstimada.getDate() + 1);
			}

			var dia = fechaEstimada.getDate();
			var mes = fechaEstimada.getMonth() + 1;
			var año = fechaEstimada.getFullYear();

			// Formatea la fecha como 'yyyy-mm-dd' para establecerla en el campo de fecha de salida
			$("#dateuserfinish").val(año + "-" + (mes < 10 ? "0" : "") + mes + "-" + (dia < 10 ? "0" : "") + dia);
		}

		// Calcula la fecha estimada al cargar la página
		calcularFechaEstimada();

		// Actualiza la fecha estimada cuando cambia la fecha de admisión o las horas requeridas
		$("#dateuseradmission, #txttotalhours_hidden").change(function () {
			calcularFechaEstimada();
		});
	});
</script>
<?php
include_once '../modules/notif_info.php';
?>