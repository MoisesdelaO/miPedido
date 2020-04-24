<!DOCTYPE html>
<html>
  <?php include("head.php");?>
<body>
  <div id="app">
    <v-app>
      <?php include("barra.php");?>
      <?php include("titulo.php");?>
          <v-content>
            <v-container>

              <template>
                <v-data-table
                  :headers="headers"
                  :items="categorias"
                  sort-by="id_categoria"
                  class="elevation-1"
                >
                  <template v-slot:top>
                    <v-toolbar flat>
                      <v-toolbar-title>Categorías</v-toolbar-title>
                      <v-divider
                        class="mx-4"
                        inset
                        vertical
                      ></v-divider>
                      <v-spacer></v-spacer>

                      <v-dialog v-model="dialog" max-width="700px">
                        <template v-slot:activator="{ on }">
                          <v-btn color="primary" dark class="mb-2" v-on="on">Agregar Categorías</v-btn>
                        </template>
                        <v-card>
                          <v-card-title>
                            <span class="headline">{{ formTitle }}</span>
                          </v-card-title>

                          <v-card-text>
                            <v-container>
                              <v-row>
                                <v-col cols="8">
                                  <v-text-field prepend-icon="mdi-clipboard-account" v-model="editedItem.nombre_categoria" label="Nombre de la Categoría"></v-text-field>
                                </v-col>
                                
                                
                          
                              </v-row>
                            </v-container>
                          </v-card-text>

                          <v-card-actions>
                            <v-spacer></v-spacer>
                            <v-btn color="blue darken-1" text @click="close">Cancelar</v-btn>
                            <v-btn color="blue darken-1" text @click="save">Guardar</v-btn>
                          </v-card-actions>
                        </v-card>
                      </v-dialog>

                    </v-toolbar>

                  </template>
                  <template v-slot:item.action="{ item }">
                    <v-icon
                      small
                      @click="editItem(item)"
                    >
                      edit
                    </v-icon>
                    <v-icon
                      small
                      @click="deleteItem(item)"
                    >
                      delete
                    </v-icon>
                  </template>


                  <template v-slot:item.cat="{ item }">
                    <v-icon
                      small
                      @click="plusItem(item)"
                    >
                      mdi-pluss
                    </v-icon>
                    <v-icon
                      small
                      @click="editItemCat(item)"
                    >
                      edit
                    </v-icon>
                    </v-icon>
                      <v-icon small @click="plusItem(item)" >
                      mdi-account-plus
                    </v-icon>
                 
                  <template v-slot:no-data>
                    <p>No hay categorías registrados...</p>
                  </template>
                </v-data-table>
              </template>

              <?php include("dialogos/dialogo_categorias.php");?>
              <?php include("dialogos/dialogo_busquedaArticulos.php");?>
            </v-container>
          </v-content>
    </v-app>
  </div>

  <?php include("footer.php");?>
  <script src="js/categorias.js"></script>
</body>
</html>