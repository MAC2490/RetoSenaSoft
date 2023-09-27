<template>
	<div>
		<div class="col-12 m-0 p-0 mt-2 row justify-content-center">
			
			<div class="col-6 m-0 p-0 row justify-content-center">
				<div class="col-3 mb-2">
					<label class="form-label" for="campoNombreRuta"><b>Nombre Ruta:</b></label>
					<input id="campoNombreRuta" v-model="nombreRuta" class="form-control text-uppercase" type="text">
				</div>
				<div class="col-3 pt-12" style="margin-top: 32px;">
					<button class="col-12 btn btn-primary" type="button" @click="cargarRuta()">CARGAR</button>
				</div>
			</div>

		<div class="col-12 m-0 p-2 mt-3 border  row justify-content-center">
			<rutas-component v-if="verRutas" :rutas="ruta"></rutas-component>
		</div>
			
	</div>
		
	</div>
</template>
<script>
	import RutasComponent from "./Rutas.vue";
	export default{
		components: {
			'rutas-component': RutasComponent,
			verRutas: true,
			ruta: '',
		},
		data(){
			return{
				nombreRuta: "",
				rutasCargadas: [
					{"ubicaciones": [{"nombre": "A","posX": 20,"posY": 20},{"nombre": "B","posX": 45,"posY": 60},{"nombre": "C","posX": 79,"posY": 90},{"nombre": "D","posX": 56,"posY": 79},{"nombre": "E","posX": 156,"posY": 79}],"conexiones": [{"ubicacion1": "A","ubicacion2": "B","peso": 20},{"ubicacion1": "C","ubicacion2": "D","peso": 50},{"ubicacion1": "B","ubicacion2": "E","peso": 150}],"inicio": "D","ruta": "RUTA 01",}
				],
				datosDePrueba: null,
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
				const rutas = this.nombreRuta;
				if (rutas!=null) {
					axios.post('/guardar_ruta',{rutas}).then(res => {
						console.log("Respuesta del servidor");
						console.log(res.data);
						this.verRutas = false;
						this.ruta = res.data;
					}).catch(error => {
						console.log("Erro en axios");
						console.log(error);
						console.log(error.response);
					});	
				}else{
					
				}
			}
		}
	}
</script>
