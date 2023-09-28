<template>
	<section>
		<div>
			<form>
				<svg id="grafo" width="400" height="400"></svg>
				<button type="button"></button>
			</form>
		</div>
	</section>
</template>
<script>
	import * as d3 from 'd3';
	
	export default{
		props: ['ruta_selected'],
		components: {
			

		},
		data(){
			return{
				lista_datos: '',
				datosDePrueba: null,

			};
		},
		created(){
			this.lista_datos = this.ruta_selected;
			this.mostrarGrafo(this.lista_datos);
			console.log(this.ruta_selected)
			// this.cargarDatosDesdeJson();
		},
		methods:{
			mostrarGrafo(lista_datos){
				console.log("Texto prueba: ",lista_datos);

				if(lista_datos){
					console.log('Entro en mostrar grafo', lista_datos);
					// console.log('Datos antes de la creación del gráfico:', lista_datos.conexiones);
					const svg = d3.select('#grafo');

					
					const simulation = d3.forceSimulation(lista_datos.ubicaciones)
					  .force('charge', d3.forceManyBody().strength(-100))
					  .force('link', d3.forceLink(lista_datos.conexiones).id(d => d.id).distance(100))
					  .force('center', d3.forceCenter(250, 150));


					// Crea los enlaces
					const enlaces = svg.selectAll('line')
					  .data(lista_datos.conexiones)
					  .enter()
					  .append('line')
					  .attr('stroke', 'gray');



					// Crea los nodos
					const nodos = svg.selectAll('circle')
					  .data(lista_datos.ubicaciones)
					  .enter()
					  .append('circle')
					  .attr('r', 20)
					  .attr('fill', 'red');
					
					// // Agrega eventos de arrastre a los nodos
					// nodos.call(d3.drag()
					//   .on('start', dragStarted)
					//   .on('drag', dragged)
					//   .on('end', dragEnded)
					// );
					

					//Actualiza la posición de los elementos en cada iteración de la simulación
					simulation.on('tick', () => {
					  enlaces
					    .attr('x1', d => d.source.x)
					    .attr('y1', d => d.source.y)
					    .attr('x2', d => d.target.x)
					    .attr('y2', d => d.target.y);
					
					  nodos
					    .attr('cx', d => Math.max(20, Math.min(480, d.x))) // Limita las coordenadas X dentro del SVG
        					.attr('cy', d => Math.max(20, Math.min(280, d.y))); // Limita las coordenadas Y dentro del SVG
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
			}
			
		}
	}

</script>
