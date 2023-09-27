<template>
	<div class="col-12 m-0 p-0">
		
		<div class="col-12 m-0 p-0 row justify-content-end">
			<div class="col-auto">
				<button class="btn btn-secondary" @click="$parent.regresar()">REGRESAR</button>
			</div>
		</div>

		<div class="col-12 m-0 p-0">
			
			<div class="col-12 row m-0 p-0">
				<div class="col-auto">
					<h4>UBICACION DE INICIO: </h4>
				</div>
				<div class="col-auto">
					<select class="form-control" v-model="ruta_selected.inicio">
						<option :value="ubicacion.nombre" v-for="ubicacion in ruta_selected.ubicaciones">{{ ubicacion.nombre }}</option>
					</select>
				</div>
				<div class="col-auto">
					<button class="btn btn-primary">CALCULAR</button>
				</div>
			</div>

			<div class="col-12 m-0 mt-2 p-0 row">
				<div class="col border me-1">
					<div class="col-12 m-0 p-0 pt-2 row">
						<div class="col-auto">
							<h6 class="mt-3">UBICACIONES DE LA RUTA:</h6>
						</div>
						<div class="col text-end">
							<button class="btn btn-primary py-1" data-bs-toggle="modal" data-bs-target="#crear">CREAR</button>
						</div>
					</div>
					<div class="col-12 m-0 p-0">
						<table class="table table-bordered">
							<thead>
								<tr class="bg-primary text-light">
									<th>ID</th>
									<th>NOMBRE</th>
									<th>POSX</th>
									<th>POSY</th>
									<th></th>
								</tr>
							</thead>
							<tbody>
								<tr v-for="(ubicacion, index) in ruta_selected.ubicaciones">
									<td>{{ (index+1) }}</td>
									<td>{{ ubicacion.nombre }}</td>
									<td>{{ ubicacion.posX }}</td>
									<td>{{ ubicacion.posY }}</td>
									<td>
										<button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editar" @click="enviarDatos(ubicacion)">EDIT.</button>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
				<div class="col border ms-1">
					<div class="col-12 m-0 p-0 pt-2 row">
						<div class="col-auto">
							<h6 class="mt-3">CONEXIONES DE LA RUTA:</h6>
						</div>
						<div class="col text-end">
							<button class="btn btn-primary py-1">CREAR</button>
						</div>
					</div>
					<div class="col-12 m-0 p-0">
						<table class="table table-bordered">
							<thead>
								<tr class="bg-primary text-light">
									<th>ID</th>
									<th>UBI 1</th>
									<th>UBI 2</th>
									<th>PESO</th>
									<th></th>
								</tr>
							</thead>
							<tbody>
								<tr v-for="(conexion, index) in ruta_selected.conexiones">
									<td>{{ (index+1) }}</td>
									<td>{{ conexion.ubicacion1 }}</td>
									<td>{{ conexion.ubicacion2 }}</td>
									<td>{{ conexion.peso }}</td>
									<td>
										<button class="btn btn-primary">EDIT.</button>
									</td>
								</tr>
							</tbody>
						</table>


						<!-- Modal crear -->
						<div class="modal fade" id="crear" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
						<div class="modal-dialog">
							<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
								<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
							</div>
							<div class="modal-body">
								<div>
									<div class="mb-3">
										<label for="nombre_ruta" class="form-label">Nombre de la ruta</label>
										<input v-model="nombre_ruta" type="email" class="form-control" id="nombre_ruta">
									</div>
									<div class="mb-3">
										<label for="posX" class="form-label">Pos X</label>
										<input v-model="posX" type="email" class="form-control" id="posX">
									</div>
									<div class="mb-3">
										<label for="posY" class="form-label">Pos Y</label>
										<input v-model="posY" type="email" class="form-control" id="posY">
									</div>
								</div>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
								<button type="button" class="btn btn-primary" @click="registrar()">Aceptar</button>
							</div>
							</div>
						</div>
						</div>

						<!-- Modal editar -->
						<div class="modal fade" id="editar" tabindex="-1" aria-labelledby="modalEditar" aria-hidden="true">
						<div class="modal-dialog">
							<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
								<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
							</div>
							<div class="modal-body">
								<div>
									<div class="mb-3">
										<label for="nombreUbicacion" class="form-label">Nombre de la ruta</label>
										<input v-model="nombreUbicacion" type="email" class="form-control" id="nombreUbicacion">
									</div>
									<div class="mb-3">
										<label for="posX" class="form-label">Pos X</label>
										<input v-model="posXModificar" type="email" class="form-control" id="posXModificar">
									</div>
									<div class="mb-3">
										<label for="posY" class="form-label">Pos Y</label>
										<input v-model="posYModificar" type="email" class="form-control" id="posYModificar">
									</div>
								</div>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
								<button type="button" class="btn btn-primary" @click="registrar()">Aceptar</button>
							</div>
							</div>
						</div>
						</div>

					</div>
				</div>
			</div>
		</div>
	</div>
</template>
<script>
	export default{
		props: [ 'ruta' ],
		components: {
			
		},
		data(){
			return{
				ruta_selected: {},
				nombre_ruta: '',
				posX: '',
				posY: '',
			};
		},
		created(){
			this.ruta_selected = this.ruta;
		},
		methods:{
			registrar(){
				
			},
			enviarDatos(ruta){

			}
		}
	}
</script>
