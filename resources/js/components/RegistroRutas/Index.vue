<template>

	<div class="col-12 m-0 p-0 mt-2 row justify-content-center">
		<div class="col-6 m-0 p-0 row justify-content-center">
			<div class="col-3 mb-0">
				<input id="campoNombreRuta" v-model="nombreRuta" class="form-control text-uppercase" type="text" style="margin-top: 33px;">
			</div>
			<div class="col-3 mt-6" style="margin-top: 32px;">
				<button class="btn btn-outline-primary" @click="guardar_ruta()"> Guardar Ruta </button>
			</div>
			<div id="emailHelp" class="text-center form-text">Ingrese el nombre de la ruta que quiere guardar</div>
		</div>
		<rutas-component v-if="verTablaRutas" :rutas="listaRutas"></rutas-component>
	</div>
</template>
<script>
	import RutasComponent from "./Rutas.vue";
	export default{
		components: {
			'rutas-component': RutasComponent,
		},
		data(){
			return{
				nombreRuta: "",
				ruta: '',
				listaRutas: [],
				verGuardarRuta:true,
				verTablaRutas:false,
			};
		},
		created(){
			this.cargarRutas();	
		},
		methods:{
			guardar_ruta(){
				let rutas = this.nombreRuta;
				if (rutas!=null) {
					rutas = rutas.toUpperCase();
					axios.post('/guardar_ruta',{rutas}).then(res => {
						console.log("Respuesta del servidor");
						console.log(res.data);
						this.listaRutas = res.data.listaRutas;
						this.nombreRuta = "";
						
						this.verTablaRutas = false;
						setTimeout(() => {
		                    this.verTablaRutas = true;
		                }, 200);
					}).catch(error => {
						console.log("Error en axios");
						console.log(error);
						console.log(error.response);
					});	
				}else{
					
				}
			},
			cargarRutas(){
				this.verTablaRutas = false;
				axios.get('/cargarRutas').then(resp =>{
					console.log('Datos cargados');
					console.log(resp.data);
					this.listaRutas = resp.data.listaRutas;
					this.verTablaRutas = true;
				}).catch(error =>{
					console.log("No se cargaron los datos");
					console.log(error);
					console.log(error.response);
				})
			},
		}
	}
</script>
