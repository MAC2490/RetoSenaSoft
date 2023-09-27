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
					<button class="btn btn-primary" id="botonCalcular" data-bs-target="#modalCalcular" data-bs-toggle="modal" @click="calcularDistancias(grafoJSON, puntoInicio)">CALCULAR</button>
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
				puntoInicio: this.ruta_selected,
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
			calcularDistancias(grafoJSON, nodoInicio){
				console.log("test");
				const ubicaciones = this.grafoJSON.ubicaciones;
				const conexiones = this.grafoJSON.conexiones;

				const distanciasMinimas = {};



				ubicaciones.forEach(ubicacion => {
					distanciasMinimas[ubicacion] = Infinity;
				});

				distanciasMinimas[nodoInicio];

				const previos = {};

				ubicaciones.forEach( ubicacion => {
					previos[ubicacion] = null;
				});

				function encontrarUbicacionMinima(noVisitados){
					let nodoMinimo = null;
					noVisitados.forEach(ubicacion => {
						if(nodoMinimo == null || distanciasMinimas[ubicacion] < distanciasMinimas[nodoMinimo]){
							nodoMinimo = ubicacion;
						}
					});
					return nodoMinimo;
				}

				const nodosNoVisitados = [...ubicaciones];

				while (nodosNoVisitados.length > 0) {
				    // Encuentra el nodo con la distancia mínima no visitada
				    const nodoActual = encontrarUbicacionMinima(nodosNoVisitados);

				    // Elimina el nodo actual de la lista de nodos no visitados
				    nodosNoVisitados.splice(nodosNoVisitados.indexOf(nodoActual), 1);

				    // Encuentra las conexiones del nodo actual
				    const conexionesNodoActual = conexiones.filter(conexion => conexion.origen === nodoActual);

				    conexionesNodoActual.forEach(conexion => {
				      const distanciaTotal = distanciasMinimas[nodoActual] + parseInt(conexion.peso);

				      if (distanciaTotal < distanciasMinimas[conexion.destino]) {
				        distanciasMinimas[conexion.destino] = distanciaTotal;
				        previos[conexion.destino] = nodoActual;
      					}	
    				});
  				}

  				const resultados = {
				    distanciasMinimas: distanciasMinimas,
				    rutas: {}
			  	};

			  	ubicaciones.forEach(ubicacion => {
				    if (ubicacion !== nodoInicio) {
				      const ruta = [];
				      let nodoActual = ubicacion;

				      while (nodoActual !== null) {
				        ruta.unshift(nodoActual);
				        nodoActual = previos[nodoActual];
				      }

				      resultados.rutas[ubicacion] = ruta;
				    }
				  });

				  return resultados;

				  console.log("Distancias minimas: ", resultados.distanciasMinimas);
				  console.log("Rutas: ", resultados.rutas );
			}
			
		}
	}
</script>
