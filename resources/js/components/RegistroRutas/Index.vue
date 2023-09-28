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
		<rutas-component :rutas="ruta"></rutas-component>
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
				verGuardarRuta:true,

			};
		},
		created(){
			
		},
		methods:{
			guardar_ruta(){
				const rutas = this.nombreRuta;
				if (rutas!=null) {
					axios.post('/guardar_ruta',{rutas}).then(res => {
						console.log("Respuesta del servidor");
						console.log(res.data);
						this.ruta = res.data;
						this.nombreRuta = "";
					}).catch(error => {
						console.log("Error en axios");
						console.log(error);
						console.log(error.response);
					});	
				}else{
					
				}
			},
		}
	}
</script>
