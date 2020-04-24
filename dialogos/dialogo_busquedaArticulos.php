<v-dialog v-model="dialogBusquedaArticulos" max-width="700px">
<v-card>
  <v-card-title>
    <span class="headline">Seleccionar Artículos</span>
  </v-card-title>

  <v-card-text>
    <v-container>
      <v-row>
      </v-row>

    <v-data-table
              v-model="articulosSeleccionados"
              :headers="hArticulos"
              :items="articulos"
              sort-by="id_articulo"
              class="elevation-1"
              item-key="id_articulo"
              show-select
            >
       </v-data-table>
    </v-container>
  </v-card-text>

  <v-card-actions>
    <v-spacer></v-spacer>
    <v-btn color="blue darken-1" text @click="agregarIntegrantes">Agregar</v-btn>
    <v-btn color="blue darken-1" text @click="cancelarIntegrantes">Cancelar</v-btn>
  </v-card-actions>
</v-card>
</v-dialog>
