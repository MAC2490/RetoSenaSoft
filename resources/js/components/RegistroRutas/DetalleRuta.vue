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
					<button class="btn btn-primary" @click="abrirModalCalcular()">CALCULAR</button>
				</div>
			</div>

			<div class="col-12 m-0 mt-2 p-0 row">
				<div class="col border me-1">
					<div class="col-12 m-0 p-0 pt-2 row">
						<div class="col-auto">
							<h6 class="mt-3">UBICACIONES DE LA RUTA:</h6>
						</div>
						<div class="col text-end">
							<button class="btn btn-primary py-1" @click="abrirModalCrearUbicacion()">CREAR</button>
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
								<tr v-for="ubicacion in ruta_selected.ubicaciones">
									<td>{{ ubicacion.id }}</td>
									<td>{{ ubicacion.nombre }}</td>
									<td>{{ ubicacion.posX }}</td>
									<td>{{ ubicacion.posY }}</td>
									<td class="text-center">
										<button class="btn btn-primary" @click="abrirModalEditarUbicacion(ubicacion)">EDIT.</button>
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
							<button class="btn btn-primary py-1" data-bs-toggle="modal" data-bs-target="#crear_ruta">CREAR</button>
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
								<tr v-for="conexion in ruta_selected.conexiones">
									<td>{{ conexion.id }}</td>
									<td>{{ conexion.ubicacion1 }}</td>
									<td>{{ conexion.ubicacion2 }}</td>
									<td>{{ conexion.peso }}</td>
									<td>
										<button class="btn btn-primary">EDIT.</button>
									</td>
								</tr>
							</tbody>
						</table>


						<!-- Modal crear ubicacion -->
						<div class="modal fade" id="crear_ubicacion" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
										<button type="button" class="btn-close" @click="cerrarModalCrearUbicacion()"></button>
									</div>
									<div class="modal-body">
										<div>
											<div class="mb-3">
												<label for="nombre_ruta" class="form-label">Nombre de la ubicacion</label>
												<input v-model="nombre_ruta" type="text" class="form-control text-uppercase" id="nombre_ruta">
											</div>
											<div class="mb-3">
												<label for="posX" class="form-label">Pos X</label>
												<input v-model="posX" type="number" class="form-control" id="posX">
											</div>
											<div class="mb-3">
												<label for="posY" class="form-label">Pos Y</label>
												<input v-model="posY" type="number" class="form-control" id="posY">
											</div>
										</div>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-secondary" @click="cerrarModalCrearUbicacion()">Cancelar</button>
										<button type="button" class="btn btn-primary" @click="registrarUbicacion()">Aceptar</button>
									</div>
								</div>
							</div>
						</div>

						<div class="modal fade" id="modificar_ubicacion" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
										<button type="button" class="btn-close" @click="cerrarModalEditarUbicacion()"></button>
									</div>
									<div class="modal-body">
										<div>
											<div class="mb-3">
												<label for="nombre_ruta" class="form-label">Nombre de la ubicacion</label>
												<input v-model="ubicacionModificar" type="text" class="form-control text-uppercase" id="nombre_ruta">
											</div>
											<div class="mb-3">
												<label for="posX" class="form-label">Pos X</label>
												<input v-model="posXModificar" type="number" class="form-control" id="posX">
											</div>
											<div class="mb-3">
												<label for="posY" class="form-label">Pos Y</label>
												<input v-model="posYModificar" type="number" class="form-control" id="posY">
											</div>
										</div>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-secondary" @click="cerrarModalEditarUbicacion()">Cancelar</button>
										<button type="button" class="btn btn-primary" @click="editarUbicacion()">Aceptar</button>
									</div>
								</div>
							</div>
						</div>

						<!-- Modal crear ruta -->
						<div class="modal fade" id="crear_ruta" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
										<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
									</div>
									<div class="modal-body">
										<div>
											<div class="mb-3">
												<label for="ubicacion1" class="form-label">ubicacion 1</label>
												<input v-model="ubicacion1" type="email" class="form-control" id="ubicacion1">
											</div>
											<div class="mb-3">
												<label for="ubicacion2" class="form-label">ubicacion 2</label>
												<input v-model="ubicacion2" type="email" class="form-control" id="ubicacion2">
											</div>
											<div class="mb-3">
												<label for="peso" class="form-label">Peso</label>
												<input v-model="peso" type="email" class="form-control" id="peso">
											</div>
										</div>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
										<button type="button" class="btn btn-primary" @click="registrar_conexiones()">Aceptar</button>
									</div>
								</div>
							</div>
						</div>

						<!-- Modal editar -->
						<!-- <div class="modal fade" id="editar" tabindex="-1" aria-labelledby="modalEditar" aria-hidden="true">
						<div class="modal-dialog">
							<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
								<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
							</div>
							<div class="modal-body">
								<div>
									<div class="mb-3">
										<label for="nombreUbicacion" class="form-label">Nombre de la ubicación</label>
										<input v-model="ubicacionModificar.nombre" type="text" class="form-control" id="nombreUbicacion">
									</div>
									<div class="mb-3">
										<label for="posX" class="form-label">Pos X</label>
										<input v-model="ubicacionModificar.posX" type="number" class="form-control" id="posXModificar">
									</div>
									<div class="mb-3">
										<label for="posY" class="form-label">Pos Y</label>
										<input v-model="ubicacionModificar.posY" type="number" class="form-control" id="posYModificar">
									</div>
								</div>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
								<button type="button" class="btn btn-primary" @click="registrar()">Aceptar</button>
							</div>
							</div>
						</div>
						</div> -->

					</div>
				</div>
			</div>
		</div>

		<div class="modal fade" id="modalCalcular" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-xl">
			    <div class="modal-content">
				    <div class="modal-header">
				        <h1 class="modal-title fs-5 text-uppercase" id="exampleModalLabel">Calculo de conexión más corta - Menos Peso</h1>
				        <button type="button" class="btn-close" @click="cerrarModalCalcular()"></button>
				    </div>
				    <div class="modal-body">
				    	<div class="col-12 m-0 p-0 row h-100">
				    		<div class="col-5 m-0 p-0 h-100">
			        			<dijkstra-component v-if="componenteDijkstra" :ruta_selected="ruta_selected" ></dijkstra-component>
				    		</div>
				    		<div class="col m-0 p-0 h-100">
			        			DIBUJO GRAFO
				    		</div>
				    	</div>

			      	</div>
			      	<div class="modal-footer">
				        <button type="button" class="btn btn-secondary" @click="cerrarModalCalcular()">CERRAR</button>
			      	</div>
			    </div>
			</div>
		</div>

	</div>
</template>
<script>
	import Dijkstra from "../Dijkstra.vue";
	export default{
		props: [ 'ruta' ],
		components: {
			'dijkstra-component': Dijkstra,
		},
		data(){
			return{
				ruta_selected: {},
				listaUbicaciones: [],
				listaConexiones: [],
				modalCrearUbicacion: null,
				modalEditarUbicacion: null,

				// Modal de Calculo de Peso Minimo
				modalCalcular: null,
				componenteDijkstra: false,

				// data de se la ubicacion
				nombre_ruta: '',
				posX: '',
				posY: '',
				// data de las conexiones
				ubicacion1: '',
				ubicacion2: '',
				peso: '',

				//data de modificar ubicaciones
				ubicacionId : '',
				ubicacionModificar : '',
				posXModificar : '',
				posYModificar : '',

			};
		},
		created(){
			this.ruta_selected = this.ruta;
		},
		methods:{
			abrirModalCrearUbicacion(){
				this.nombre_ruta = "";
				this.posX = "";
				this.posY = "";

				this.modalCrearUbicacion = new bootstrap.Modal(document.getElementById('crear_ubicacion'), {keyboard: false, backdrop:'static'});
				this.modalCrearUbicacion.show();
			},
			cerrarModalCrearUbicacion(){
				if (this.modalCrearUbicacion != null){
					this.modalCrearUbicacion.hide();
				}
			},
			abrirModalEditarUbicacion(ubicacion){
				this.ubicacionId = ubicacion.id;
				this.ubicacionModificar = ubicacion.nombre;
				this.posXModificar = ubicacion.posX;
				this.posYModificar = ubicacion.posY;

				this.modalEditarUbicacion = new bootstrap.Modal(document.getElementById('modificar_ubicacion'), {keyboard: false, backdrop:'static'});
				this.modalEditarUbicacion.show();
			},
			cerrarModalEditarUbicacion(){
				if (this.modalEditarUbicacion != null){
					this.modalEditarUbicacion.hide();
				}
			},
			abrirModalCalcular(){
				if (this.ruta_selected.inicio!=""){
					this.modalCalcular = new bootstrap.Modal(document.getElementById('modalCalcular'), {keyboard: false, backdrop:'static'});
					this.modalCalcular.show();
					this.componenteDijkstra = true;
					this.componenteGrafo = true;
				}else{
					alert("Se debe seleccionar un punto de inicio.");
				}
			},
			cerrarModalCalcular(){
				if (this.modalCalcular!=null){
					this.modalCalcular.hide();
					this.componenteDijkstra = false;
					this.componenteGrafo = false;
				}
			},
			registrarUbicacion(){
				const nombre_ruta = this.nombre_ruta.toUpperCase();
				const posX = this.posX;
				const posY = this.posY;
				const id_ruta = this.ruta_selected.id; 

				axios.post('/Registrar_ubicaciones', {nombre_ruta, posX, posY, id_ruta}).then(res => {
					console.log('Respuesta del servidor');
					console.log(res.data);
					
					if (res.data.status){
						this.ruta_selected.ubicaciones.push(res.data.ubicacion);
						this.cerrarModalCrearUbicacion();
					}else{
						alert("No se puede registrar la Ubicacion, es posible que este repetido el nombre.");
					}

				}).catch(error => {
					console.log('Error en axios');
					console.log(error);
					console.log(error.response);
				});
			},
			editarUbicacion(){
				const ubicacion_id = this.ubicacionId;
				const nombre_ubicacion = this.ubicacionModificar.toUpperCase();
				const posX = this.posXModificar;
				const posY = this.posYModificar;

				axios.post('/Editar_ubicacion', {nombre_ubicacion, posX, posY, ubicacion_id}).then(res => {
					console.log('Respuesta del servidor - Edicion ubicacion');
					console.log(res.data);
					
					for (var i = 0; i < this.ruta_selected.ubicaciones.length; i++) {
						if (this.ruta_selected.ubicaciones[i].id == ubicacion_id){
							this.ruta_selected.ubicaciones[i] = res.data.ubicacion;
							break;
						}
					}

					this.cerrarModalEditarUbicacion();
				}).catch(error => {
					console.log('Error en axios');
					console.log(error);
					console.log(error.response);
				});
			},
			registrar_conexiones(){
				const ubicacion1 = this.ubicacion1;
				const ubicacion2 = this.ubicacion2;
				const peso = this.peso;
				axios.post('/Registrar_conexiones', { ubicacion1, ubicacion2, peso }).then(res => {
					console.log("Respuesta del servidor");
					console.log(res.data);
				}).catch(error => {
					console.log("Error en axios");
					console.log( error );
					console.log( error.response );
				});
			},
			mostrarDatosUbicacion(ubicacion){
				this.ubicacionModificar = ubicacion;
			},
		}
	}
</script>
