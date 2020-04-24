<!DOCTYPE html>
<html>
  <?php include("head.php");?>
<body>
  <div id="app">
   
            <v-app id="inspire">
            <v-img
      src="https://wallpapercave.com/wp/wp45992.jpg"
    >


         
   
    <v-dialog v-model="dialog" max-width="700px">
                      <template v-slot:activator="{ on }">
                                                    <v-col class="text-center" cols="12">
                                                      
                                                        <div class="my-2">
                                                        <v-btn rounded
                                                          color="primary"
                                                          dark
                                                          v-on="on"
                                                        >
                                                        Iniciar Sesión
                                                        </v-btn>
                                                        </div>
                                                        </v-col>
                                                       
                                                       
                                                       
   
    <v-dialog v-model="dialogIniciar" max-width="700px">
                                                        <template v-slot:activator="{ item }">
                                                    <v-col class="text-center" cols="12">
                                                      
                                                        <div class="my-2">
                                                        <v-btn rounded
                                                          color="red"
                                                          dark
                                                       
                                                        >
                                                        Registrarse
                                                        </v-btn>
                                                        </div>
                                                        </v-col>
                                                        
                      </v-dialog>
      
      </template>    
      </template>    
                      
                                                   
      

      
                        <v-card>
                          <v-card-title>
                            <span class="headline">Iniciar Sesión</span>
                          </v-card-title>

                          <v-card-text>
                            <v-container>
                              <v-row>
                              <v-col cols="8">
                                  <v-text-field prepend-icon="mdi-at" v-model="editedItem.correo" label="Correo Electrónico"></v-text-field>
                                </v-col>
                                <v-col cols="8">
                                  <v-text-field prepend-icon="mdi-lock" v-model="editedItem.contrasena" label="Contraseña"></v-text-field>
                                </v-col>
                                
                            
                                                               
                                    
                            
                            </v-container>
                          </v-card-text>
                           </v-tabs-items>
                              </v-col>
                              </v-row>
                                
                               
                          
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

                              


  
      
      
      

    </v-img>
             
<v-footer>
    <v-spacer></v-spacer>
    <div>&copy; {{ new Date().getFullYear() }}</div>
  </v-footer>
             


            
    </v-app>
  </div>

  <?php include("footer.php");?>
  <script src="js/index.js"></script>
</body>
</html>