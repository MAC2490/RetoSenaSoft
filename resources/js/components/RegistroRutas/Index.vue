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
			};
		},
		created(){
			
		},
		methods:{
			CapturarInformacion(event){
				const file = event.target.files[0];
				if(file){
					const reader = new FileReader();
					reader.onload = () => {
						try{
							this.datosDePrueba = JSON.parse(reader.result);
							console.log("Datos del archivo JSON: ", this.datosDePrueba);
						}catch(error){
							console.error('Error en JSON', error);
						}
					}
					reader.readAsText(file);
				}
			},
			cargarRuta(){
				let validacion = true;
				for (var i = 0; i < this.rutasCargadas.length; i++) {
					if (this.rutasCargadas[i].ruta==this.nombreRuta || (this.rutasCargadas[i].conexiones == this.datosDePrueba.conexiones && this.rutasCargadas[i].ubicaciones == this.datosDePrueba.ubicaciones && this.rutasCargadas[i].inicio == this.datosDePrueba.inicio)) {
						validacion = false;
						break;
					}
				}

				if (validacion && this.nombreRuta!=""){
					let temporal = {
						'ruta': this.nombreRuta.toUpperCase(),
						'conexiones': this.datosDePrueba.conexiones,
						'ubicaciones': this.datosDePrueba.ubicaciones,
						'inicio': this.datosDePrueba.inicio,
					}
					this.rutasCargadas.push( temporal );
					this.registrarRuta();
					
					this.nombreRuta = "";
				}else{
					if (this.nombreRuta==""){
						alert("Se debe ingresar un nombre de Ruta.");
					}else{
						alert("La informacion del JSON ya se encuentra cargada");
					}
				}
			},
			guardar_ruta(){
				// axios.post('/guardar_ruta')

			}
		}
	}
</script>
