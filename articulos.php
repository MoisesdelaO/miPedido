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
                  :items="articulos"
                  sort-by="id_articulo"
                  class="elevation-1"
                >
                  <template v-slot:top>
                    <v-toolbar flat>
                      <v-toolbar-title>Artículos</v-toolbar-title>
                      <v-divider
                        class="mx-4"
                        inset
                        vertical
                      ></v-divider>
                      <v-spacer></v-spacer>

                      <v-dialog v-model="dialog" max-width="700px">
                        <template v-slot:activator="{ on }">
                          <v-btn color="primary" dark class="mb-2" v-on="on">Agregar Artículos</v-btn>
                        </template>
                        <v-card>
                          <v-card-title>
                            <span class="headline">{{ formTitle }}</span>
                          </v-card-title>

                          <v-card-text>
                            <v-container>
                              <v-row>
                                <v-col cols="8">
                                  <v-text-field prepend-icon="mdi-clipboard-account" v-model="editedItem.nombre_articulo" label="Nombre del Articulo"></v-text-field>
                                </v-col>
                                
                                <v-row>
                                <v-col cols="6">
                                  <v-text-field prepend-icon="home" v-model="editedItem.razon_social" label="Precio"></v-text-field>
                                </v-col> 
                                <v-col cols="6">
                                  <v-text-field prepend-icon="home" v-model="editedItem.rfc" label="Costo"></v-text-field>
                                </v-col>
                              </v-row>

                             
                                        <v-col cols="6">
                                        <v-checkbox v-model="editedItem.envio_domicilio" label="Existencia" ></v-checkbox>
                                        </v-col>
                                
                                
                                <v-col cols="6">

                                <v-file-input
                                label="Foto del Artículo"
                                filled
                                prepend-icon="camera"
                                ></v-file-input>
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
                  <template v-slot:item.agre="{ item }">
                    <v-icon
                      small
                      @click="editItem(item)"
                    >
                      mdi-plus
                    </v-icon>
                    
                  </template>
                  <template v-slot:no-data>
                    <p>No hay artículos registrados...</p>
                  </template>
                </v-data-table>
              </template>


            </v-container>
          </v-content>
    </v-app>
  </div>

  <?php include("footer.php");?>
  <script src="js/articulos.js"></script>
</body>
</html>