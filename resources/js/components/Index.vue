<template>
	<section>
		<div>
			<form>
				
				<input type="file" @change="CapturarInformacion">
				<button type="button" @click="mostrarGrafo()">Mostrar</button>
				<svg ref="graphContainer" width="400" height="400"></svg>
			</form>
		</div>
	</section>
</template>
<script>
	import * as d3 from 'd3';


	export default{
		components: {
		},
		data(){
			return{
				jsonData: null,
			};
		},
		methods:{
			CapturarInformacion(event){
				const file = event.target.files[0];
				if(file){
					const reader = new FileReader();

					reader.onload = () => {
						try{
							this.jsonData = JSON.parse(reader.result);
							console.log("Datos del archivo JSON: ", this.jsonData);
						}catch(error){
							console.error('Error en JSON', error);
						}
					}

					reader.readAsText(file);
				}
			},
			mostrarGrafo(){
				const data = this.jsonData;

			    for (const key in this.jsonData) {
			      if (this.jsonData.hasOwnProperty(key)) {
			        dataArray.push({
			          key: key,
			          value: this.jsonData[key]
			        });
			      }
			    }

				const margin = { top: 20, right: 30, bottom: 40, left: 40 };
    			const width = 400 - margin.left - margin.right;
    			const height = 300 - margin.top - margin.bottom;

    			const svg = d3
      			.select('#chart-container')
      			.append('svg')
      			.attr('width', width + margin.left + margin.right)
      			.attr('height', height + margin.top + margin.bottom)
      			.append('g')
      			.attr('transform', `translate(${margin.left},${margin.top})`);

      			
      			const x = d3.scaleBand().range([0, width]).domain(dataArray.map((d, i) => i));
    			const y = d3.scaleLinear().range([height, 0]).domain([0, d3.max(dataArray)]);
      			

      			

    			svg
      			.selectAll('.bar')
      			.data(dataArray)
      			.enter()
      			.append('rect')
      			.attr('class', 'bar')
      			.attr('x', (d, i) => x(i))
      			.attr('y', (d) => y(d))
      			.attr('width', x.bandwidth())
      			.attr('height', (d) => height - y(d));

			}
		}
	}

</script>
