<v-dialog v-model="dialogIntegrantesCategorias" max-width="700px">
                          
                      
                          <v-card>
                            <v-card-title>
                              <span class="headline">{{ editedItem.nombre_articulo}}</span>
                              <v-spacer> </v-spacer> 
                                <div class="my-2">
                                      <v-btn small color="primary" @click="inicioBusqueda();" >Agregar Artículos</v-btn>
                              </div>
                            </v-card-title>
                              
                             
                           
                            <v-card-text>
                              <v-container>
                                <v-row>
                                  
                                </v-row>
                                 
                              <v-data-table
                    :headers="hIntegrantes"
                    :items="integrantes"
                    sort-by="id_articulo"
                    class="elevation-1"
                  >                                 
                  <template v-slot:item.action="{ item }">
                
                      <v-icon small @click="eliminarInventarios(item);" >
                        delete
                      </v-icon>
           
                    </template>
                                 </v-data-table>  
                              </v-container>
                            </v-card-text>
  
                            <v-card-actions>
                            
                          
                              <v-spacer></v-spacer>
                                
                              <v-btn color="blue darken-1" text @click="closeIntegrantes">Cerrar</v-btn>
                          
                            </v-card-actions>
                          </v-card>