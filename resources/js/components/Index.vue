<template>
	<section>
		<div>
			<form>
				<input type="file" @change="CapturarInformacion">
				<button type="button" @click="mostrarGrafo(lista_datos)">Mostrar</button>
				<svg id="grafo" width="1000" height="1000"></svg>
			</form>
		</div>
	</section>
</template>
<script>
	import * as d3 from 'd3';


	export default{
		components: {
			lista_datos: '',
		},
		data(){
			return{
				datosDePrueba: null,

			};
		},
		mounted(){
			// this.cargarDatosDesdeJson();
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
							this.lista_datos = this.datosDePrueba;
							// console.log("Datos del archivo JSON: ", this.lista_datos);
						}catch(error){
							console.error('Error en JSON', error);
						}
					}

					reader.readAsText(file);
				}
			},
			mostrarGrafo(lista_datos){
				console.log(this.datosDePrueba);
				console.log("joker");
				if(this.datosDePrueba){

					console.log('Entro en mostrar grafo');
					console.log('Datos antes de la creación del gráfico:', lista_datos);
					const svg = d3.select('#grafo');

					
					const simulation = d3.forceSimulation(lista_datos.data.nodos)
					  .force('charge', d3.forceManyBody().strength(-100))
					  .force('link', d3.forceLink(lista_datos.data.enlaces).id(d => d.id).distance(100))
					  .force('center', d3.forceCenter(250, 150));
					// Crea los enlaces
					const enlaces = svg.selectAll('line')
					  .data(lista_datos.data.enlaces)
					  .enter()
					  .append('line')
					  .attr('stroke', 'gray');
					console.log(lista_datos)
					// Crea los nodos
					const nodos = svg.selectAll('circle')
					  .data(lista_datos.data.nodos)
					  .enter()
					  .append('circle')
					  .attr('r', 20)
					  .attr('fill', 'blue');
					
					// Agrega eventos de arrastre a los nodos
					nodos.call(d3.drag()
					  .on('start', dragStarted)
					  .on('drag', dragged)
					  .on('end', dragEnded)
					);
					

					// Actualiza la posición de los elementos en cada iteración de la simulación
					simulation.on('tick', () => {
					  enlaces
					    .attr('x1', d => d.source.x)
					    .attr('y1', d => d.source.y)
					    .attr('x2', d => d.target.x)
					    .attr('y2', d => d.target.y);
					
					  nodos
					    .attr('cx', d => d.x)
					    .attr('cy', d => d.y);
					});
					
					// Funciones para el arrastre de nodos
					function dragStarted(event, d) {
					  if (!event.active) simulation.alphaTarget(0.3).restart();
					  d.fx = d.x;
					  d.fy = d.y;
					}
					
					function dragged(event, d) {
					  d.fx = event.x;
					  d.fy = event.y;
					}
					
					function dragEnded(event, d) {
					  if (!event.active) simulation.alphaTarget(0);
					  d.fx = null;
					  d.fy = null;
					}
				}else{
					console.warn('Los datos desde JSON no han sido cargados');
				}

			},
			// cargarDatosDesdeJson(){
			// 	fetch('ubicaciones.json')
			// 		.then(response => response.json())
			// 		.then(data => {
			// 			this.datosDesdeJson = data;
			// 		});
			// }
		}
	}

</script>
