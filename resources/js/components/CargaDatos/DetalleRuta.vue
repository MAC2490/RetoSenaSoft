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
							<button v-if="false" class="btn btn-primary py-1">CREAR</button>

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
									<th v-if="false"></th>
								</tr>
							</thead>
							<tbody>
								<tr v-for="(ubicacion, index) in ruta_selected.ubicaciones">
									<td>{{ (index+1) }}</td>
									<td>{{ ubicacion.nombre }}</td>
									<td>{{ ubicacion.posX }}</td>
									<td>{{ ubicacion.posY }}</td>
									<td v-if="false">
										<button class="btn btn-primary">EDIT.</button>
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
							<button v-if="false" class="btn btn-primary py-1">CREAR</button>
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
									<th v-if="false"></th>
								</tr>
							</thead>
							<tbody>
								<tr v-for="(conexion, index) in ruta_selected.conexiones">
									<td>{{ (index+1) }}</td>
									<td>{{ conexion.ubicacion1 }}</td>
									<td>{{ conexion.ubicacion2 }}</td>
									<td>{{ conexion.peso }}</td>
									<td v-if="false">
										<button class="btn btn-primary">EDIT.</button>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>





		<!-- Modal -->
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
				nodoInicio: null,
				modalCalcular: null,
				componenteDijkstra: false,
			};
		},
		created(){
			this.ruta_selected = this.ruta;
		},
		methods:{
			abrirModalCalcular(){
				if (this.ruta_selected.inicio!=""){
					this.modalCalcular = new bootstrap.Modal(document.getElementById('modalCalcular'), {keyboard: false, backdrop:'static'});
					this.modalCalcular.show();
					this.componenteDijkstra = true;
				}else{
					alert("Se debe seleccionar un punto de inicio.");
				}
			},
			cerrarModalCalcular(){
				if (this.modalCalcular!=null){
					this.modalCalcular.hide();
					this.componenteDijkstra = false;
				}
			},
			
		}
	}
</script>
