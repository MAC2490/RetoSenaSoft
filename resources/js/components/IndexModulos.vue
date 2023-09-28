<template>
	<div class="col-12 mt-5">
		<div class="col-12 m-0 p-0 row justify-content-center">
			<div class="col-7">
				<a class="col-12 btn btn-outline-primary" href="cargarDatos">MODULO CARGA DE DATOS</a>
			</div>
			<div class="col-7 mt-3">
				<a class="col-12 btn btn-outline-primary" href="RegistroRutas">MODULO REGISTRO DE RUTAS</a>
			</div>
			<div class="col-7 mt-3">
				<vista-grafo></vista-grafo>
			 </div>
		</div>
	</div>
</template>
<script>

	import Index from './Index.vue';

	export default{
		components: {
			'vista-grafo': Index,
		},
		data(){
			return{

			};
		},
		created(){
			
		},
		methods:{
			
		}
	}
</script>
