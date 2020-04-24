<v-dialog v-model="dialogBusqueda" max-width="700px">
<v-card>
  <v-card-title>
    <span class="headline">Seleccionar Categorias</span>
  </v-card-title>

  <v-card-text>
    <v-container>
      <v-row>
      </v-row>

    <v-data-table
              v-model="categoriasSeleccionados"
              :headers="hCategorias"
              :items="categorias"
              sort-by="id_categoria"
              class="elevation-1"
              item-key="id_categoria"
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
