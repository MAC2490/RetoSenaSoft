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
			};
		},
		created(){
			this.ruta_selected = this.ruta;
		},
		methods:{
			
		}
	}
</script>
