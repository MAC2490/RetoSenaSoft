<template>
  <div class="p-3">
    <h4 class="text-primary m-0">{{ ruta }}</h4>
    <p><b>Ubicación de inicio:</b> {{ inicio }}</p>
    <hr>
    <table class="table table-bordered">
      <thead>
        <tr class="bg-primary text-light">
          <th class="text-center col-2">DESTINO</th>
          <th class="text-center col-8">RECORRIDO</th>
          <th class="text-center col-2">PESO</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="ubicacion in ubicaciones">
          <td class="text-center">{{ ubicacion.nombre }}</td>
          <td>{{ rutaConMenorPeso[ubicacion.nombre] }}</td>
          <td class="text-center">{{ pesoAcumulado[ubicacion.nombre] }}</td>
        </tr>
      </tbody>
    </table>

  </div>
</template>

<script>
export default {
  props: [ 'ruta_selected' ],
  data() {
    return {
      data: {
        ubicaciones: [
          {
            nombre: "A",
            posX: 20,
            posY: 20
          },
          {
            nombre: "B",
            posX: 45,
            posY: 60
          },
          {
            nombre: "C",
            posX: 79,
            posY: 90
          },
          {
            nombre: "D",
            posX: 56,
            posY: 79
          }
        ],
        conexiones: [
          {
            ubicacion1: "A",
            ubicacion2: "B",
            peso: 20
          },
          {
            ubicacion1: "B",
            ubicacion2: "C",
            peso: 20
          },
          {
            ubicacion1: "C",
            ubicacion2: "D",
            peso: 50
          },
          {
            ubicacion1: "D",
            ubicacion2: "A",
            peso: 50
          },
        ],
        inicio: "D",
        ruta: "RUTA PRUEBA",
      },
      ubicaciones: [],
      conexiones: [],
      inicio: "",
      ruta: "",
      pesoAcumulado: {},
      rutaConMenorPeso: {},
    };
  },
  created(){
    this.ubicaciones = (this.ruta_selected!=undefined)? this.ruta_selected.ubicaciones : this.data.ubicaciones;
    this.conexiones = (this.ruta_selected!=undefined)? this.ruta_selected.conexiones : this.data.conexiones;
    this.inicio = (this.ruta_selected!=undefined)? this.ruta_selected.inicio : this.data.inicio;
    this.ruta = (this.ruta_selected!=undefined)? this.ruta_selected.ruta : this.data.ruta;

    this.calcularRutas();
  },
  methods: {
    calcularRutas() {
      for (const ubicacion of this.ubicaciones) {
        this.pesoAcumulado[ubicacion.nombre] = ubicacion.nombre === this.inicio ? 0 : Infinity;
        this.rutaConMenorPeso[ubicacion.nombre] = [];
      }

      const ubicacionesNoVisitadas = new Set(Object.keys(this.pesoAcumulado));

      while (ubicacionesNoVisitadas.size > 0) {
        const ubicacionActual = this.obtenerUbicacionConMenorPeso(ubicacionesNoVisitadas, this.pesoAcumulado);
        ubicacionesNoVisitadas.delete(ubicacionActual);

        for (const conexion of this.obtenerConexiones(ubicacionActual)) {
          const ubicacionVecina = this.obtenerUbicacionVecina(conexion, ubicacionActual);
          const pesoTotal = this.pesoAcumulado[ubicacionActual] + conexion.peso;

          if (pesoTotal < this.pesoAcumulado[ubicacionVecina]) {
            this.pesoAcumulado[ubicacionVecina] = pesoTotal;
            this.rutaConMenorPeso[ubicacionVecina] = [...this.rutaConMenorPeso[ubicacionActual], ubicacionVecina];
          }
        }
      }


      /*console.log("this.pesoAcumulado: ");
      console.log(this.pesoAcumulado);
      console.log("this.rutaConMenorPeso: ");
      console.log(this.rutaConMenorPeso);*/
    },
    obtenerUbicacionConMenorPeso(ubicacionesNoVisitadas, pesoAcumulado) {
      let ubicacionMenorPeso = null;

      for (const ubicacion of ubicacionesNoVisitadas) {
        if (ubicacionMenorPeso === null || pesoAcumulado[ubicacion] < pesoAcumulado[ubicacionMenorPeso]) {
          ubicacionMenorPeso = ubicacion;
        }
      }

      return ubicacionMenorPeso;
    },
    obtenerConexiones(ubicacion) {
      return this.conexiones.filter(conexion => conexion.ubicacion1 === ubicacion/* || conexion.ubicacion2 === ubicacion*/);
    },
    obtenerUbicacionVecina(conexion, ubicacionActual) {
      return conexion.ubicacion1 === ubicacionActual ? conexion.ubicacion2 : conexion.ubicacion1;
    }
  }
};
</script>
