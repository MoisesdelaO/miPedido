<v-dialog v-model="dialogIniciar" max-width="700px">
<v-card>
                          
                          <v-card-text>
                            <v-container>
                              <v-row>
                                

                              <v-card>
                          <v-card-title>
                            <span class="headline">{{ formTitle }}</span>
                          </v-card-title>

                          <v-card-text>
                            <v-container>
                              <v-row>
                                <v-col cols="8">
                                  <v-text-field prepend-icon="mdi-clipboard-account" v-model="editedItem.nombre_comercial" label="Nombre de la Tienda"></v-text-field>
                                </v-col>
                                <v-col cols="8">
                                  <v-text-field prepend-icon="mdi-at" v-model="editedItem.correo" label="Correo Electrónico"></v-text-field>
                                </v-col>
                                <v-col cols="8">
                                  <v-text-field prepend-icon="mdi-lock" v-model="editedItem.contrasena" label="Contraseña"></v-text-field>
                                </v-col>
                               
                               
                                      <v-row>
                                      
                                      <v-row>
                                              <v-col cols="6">
                                                <v-text-field prepend-icon="home" v-model="editedItem.razon_social" label="Razon Social"></v-text-field>
                                              </v-col> 
                                              <v-col cols="6">
                                                <v-text-field prepend-icon="home" v-model="editedItem.rfc" label="RFC"></v-text-field>
                                              </v-col>
                                            </v-row>

                                            <v-row>
                                                      <v-col cols="6">
                                                      <v-checkbox v-model="editedItem.envio_domicilio" label="Envio a Domicilio" ></v-checkbox>
                                                      </v-col>
                                                      
                                                      <v-col cols="6">
                                                      <v-checkbox v-model="editedItem.recoge" label="Recoge"></v-checkbox>
                                                      </v-col>  
                                                      
                                                  </v-row>
                                            <v-row>

                                              <v-col cols="6">
                                                <v-text-field prepend-icon="home" v-model="editedItem.pedido_min" label="Pedido Mínimo"></v-text-field>
                                              </v-col> 
                                              <v-col cols="6">
                                                <v-text-field prepend-icon="home" v-model="editedItem.costo_envio" label="Costo Envio"></v-text-field>
                                              </v-col>
                                            </v-row>

                                            
                                    </v-row>
                                    </v-tab-item>
                                    <v-card-actions>
                                                      <v-spacer></v-spacer>
                                                      <v-btn color="blue darken-1" text @click="close">Cancelar</v-btn>
                                                      <v-btn color="blue darken-1" text @click="save">Guardar</v-btn>
                                                    </v-card-actions>
                                                  </v-card>
                                </v-tabs-items>
                              </v-col>
                              </v-row>
                                                               
                                    </v-col>
                              </v-row> 
                              
                            
                            
                            </v-container>
                          </v-card-text>
                              
</v-dialog>
