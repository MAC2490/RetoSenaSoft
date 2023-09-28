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
					<button class="btn btn-primary" id="botonCalcular" data-bs-target="#modalCalcular" data-bs-toggle="modal" @click="calcularDistancias(grafoJSON)">CALCULAR</button>
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
		<div class="modal-dialog">
		    <div class="modal-content">
			    <div class="modal-header">
			        <h1 class="modal-title fs-5" id="exampleModalLabel">Calculo de conexión más corta</h1>
			        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			    </div>
			    <div class="modal-body">
		        	
		      	</div>
		      	<div class="modal-footer">
			        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
			        <button type="button" class="btn btn-primary">Save changes</button>
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
				nodoInicio: null,
				grafoJSON : {
  					"ubicaciones": ["A", "B", "C", "D", "E"],
  					"conexiones": [
    					{ "origen": "A", "destino": "C", "peso": "3"},
    					{ "origen": "B", "destino": "C", "peso": "4"},
    					{ "origen": "B", "destino": "D" , "peso": "5"},
    					{ "origen": "A", "destino": "B", "peso": "1"},
    					{ "origen": "C", "destino": "D", "peso": "7"},
    					{ "origen": "C", "destino": "E", "peso": "9"},
    					{ "origen": "E", "destino": "D", "peso": "2"}
					  ]
					},
			};
		},
		created(){
			this.ruta_selected = this.ruta;
		},
		methods:{
			
			
			
		}
	}
</script>
