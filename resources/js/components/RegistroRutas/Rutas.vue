<template>
	<div class="col-12 col-lg-8 m-0 p-0 mt-2">

		<div v-if="verTablaRutas" class="col-12 m-0 p-0">
			<div class="col-12 m-0 mb-2 p-0 row justify-content-end">
				<div class="col">
					<h4>RUTAS:</h4>
				</div>
				<div class="col-auto p-0">
					<button v-if="false" class="btn btn-primary">CREAR</button>
				</div>
			</div>
			<table class="table table-bordered">
				<thead>
					<tr class="bg-primary text-light">
						<th class="text-center py-1">ID</th>
						<th class="text-center py-1">NOMBRE</th>
						<th class="text-center py-1">CANT. UBICACIONES</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					<tr v-for="ruta in listaRutas">
						<td>{{ ruta.id }}</td>
						<td>{{ ruta.nombre_ruta }}</td>
						<td class="text-center"> <span v-for="(ubicacion, ind) in ruta.ubicaciones">{{ ((ind!=0)? ' - ':'')+ubicacion.nombre }}</span> </td>
						<td class="text-center">
							<button class="btn btn-primary" @click="verDetalleRuta(ruta)">DETALLE</button>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
		
		<detalle-ruta v-if="!verTablaRutas" :ruta="ruta_selected"></detalle-ruta>

	</div>
</template>
<script>
	import DetalleRuta from "./DetalleRuta.vue";
	export default{
		props: [ 'rutas' ],
		components: {
			'detalle-ruta': DetalleRuta,
		},
		data(){
			return{
				listaRutas: [],
				ruta_selected: {},
				verTablaRutas: true,
			};
		},
		created(){
			this.listaRutas = this.rutas;
			this.cargarRutas();
		},
		methods:{
			regresar(){
				this.verTablaRutas = true;
				this.ruta_selected = {};
			},
			verDetalleRuta(ruta){
				this.verTablaRutas = false;
				this.ruta_selected = ruta;
			},
			cargarRutas(){
				axios.get('/cargarRutas').then(resp =>{
					console.log('Datos cargados');
					console.log(resp.data);
					this.listaRutas = resp.data.ruta;

				}).catch(error =>{
					console.log("No se cargaron los datos");
					console.log(error);
					console.log(error.response);
				})
			}

		}
	}
</script>
