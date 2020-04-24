var app = new Vue({

    el: "#app",
    router: new VueRouter(),
    vuetify: new Vuetify({
        icons: {
            iconfont: 'mdi'
        }
    }),
    props: {
      source: String,
    },
    data: {
  
          dialog: false,
          
        dialogBusquedaArticulos: false,
        dialogIntegrantesCategorias: false,
         modalfecha: false,
         dense: false,
          items2: [],
          drawer: null,
          tabcategoria: 1,
          headers: [
            {
              text: 'Categorias',
              align: 'left',
              sortable: true,
              value: 'nombre_categoria',
            },
            
            { text: 'Actions', align: 'right', value: 'action', sortable: false },
          ],

          hIntegrantes: [
              
            {
              text: 'Articulos',
              align: 'left',
              sortable: true,
              value: 'nombre_articulo',
            },
       
           { text: 'Actions', value: 'action',  align: 'right', sortable: false },
  
          ],    
        
        hArticulos: [
            {
              text: 'Nombre',
              align: 'left',
              sortable: true,
              value: 'nombre_articulo',
            },
           
           
          ],
        
        
       
        integrantes: [],
        articulos: [],
        articulosSeleccionados:[],
  
          categorias: [],
      
          editedIndex: -1,

          ligaItem: {
            id_categoria: '',
  
              id_articulo:'',
      
          },
          editedItem: {
                id_categoria:'',
                id_tienda:'',
                icono:'',
                orden:'',               
                nombre_categoria:'',  
                status:'',    		 
                  		  
          },
          defaultItem: {
            id_categoria:'',
            id_tienda:'',
            icono:'',
            orden:'',               
            nombre_categoria:'',  
            status:'',  
          },
        },
  
        computed: {
          formTitle () {
            return this.editedIndex === -1 ? 'Registrar categoría' : 'Editar categoría'
          },
        },
  
        watch: {
          dialog (val) {
            val || this.close()
          },
        },
  
        created () {
          this.$vuetify.theme.dark = true;
        },
  
        mounted: function () {
          this.getCategorias();
        },
  
        methods: {
  
          getCategorias: function () {
                axios.get('api/api_categorias.php')
                .then(function (response) {
                    console.log(response);
  
                    if (response.data.error) {
                        app.errorMessage = response.data.message;
                    } else {
                        app.categorias = response.data.categorias;
                    }
                })
            },

            getIntegrantes: function () {
              var formData = app.toFormData(app.editedItem);
            axios.post('api/api_categorias.php?action=list',formData)
            .then(function (response) {
          
  
              if (response.data.error) {
                app.errorMessage = response.data.message;
              } else {
                app.integrantes = response.data.integrantes;
                      app.dialogIntegrantesCategorias = true
              }
            })
          },
                    
            addIntegrantes: function (item) {
  
              var formData = app.toFormData(item);
            axios.post('api/api_categorias.php?action=add',formData)
            .then(function (response) {
              console.log(response);
  
              if (response.data.error) {
                app.errorMessage = response.data.message;
              } else {
                app.successMessage = response.data.message;
                      
              }
            })
          },
            
             delIntegrantes: function (item) {
  
              var formData = app.toFormData(item);
                 console.log(item);
            axios.post('api/api_categorias.php?action=del',formData)
            .then(function (response) {
              console.log(response);
  
              if (response.data.error) {
                app.errorMessage = response.data.message;
              } else {
                app.successMessage = response.data.message;
                      
              }
            })
          },
                    
            
            getArticulos: function () {
                var formData = app.toFormData(app.editedItem);
            axios.post('api/api_categorias.php?action=disponibles',formData)
            .then(function (response) {
            
                  console.log(response);
              if (response.data.error) {
                app.errorMessage = response.data.message;
              } else {
                app.articulos = response.data.articulos;
                      app.dialogBusquedaArticulos = true;
              }
            })
          },
  
  
          editItem (item) {
            this.editedIndex = this.categorias.indexOf(item)
            this.editedItem = Object.assign({}, item)
            this.dialog = true
          },

          plusItem (item) {
            this.editedIndex = this.categorias.indexOf(item)
            this.editedItem = Object.assign({}, item)
            this.getIntegrantes()
            
          },       
              
          inicioBusqueda: function (item)  {
  
            this.getArticulos();
            
          },          
  
  
              
          plusItem (item) {
            this.editedIndex = this.categorias.indexOf(item)
            this.editedItem = Object.assign({}, item)
            this.getIntegrantes()
            
          }, 

          

  
          deleteItem (item) {
            const index = this.categorias.indexOf(item)
             if (confirm('¿Estas seguro de dar de baja a este artículo?')) {
               this.editedIndex = this.categorias.indexOf(item)
               this.editedItem = Object.assign({}, item)
               var formData = app.toFormData(app.editedItem);
               this.categorias.splice(index, 1);
               axios.post('api/api_categorias.php?action=delete',formData)
               .then(function (response) {
                 console.log(response);
                 this.editedItem = Object.assign({}, this.defaultItem)
                 this.editedIndex = -1
               })
             }
           },
  
           close () {
               this.dialog = false
               setTimeout(() => {
                 this.editedItem = Object.assign({}, this.defaultItem)
                 this.editedIndex = -1
               }, 300)
             },

             closeIntegrantes () {
              this.dialogIntegrantesCategorias = false
               app.getCategorias();
              setTimeout(() => {
                this.editedItem = Object.assign({}, this.defaultItem)
                this.editedIndex = -1
              }, 300)
            },
           
           cancelarIntegrantes () {
              this.dialogBusquedaArticulos = false
 
            },
           
           
           
           agregarIntegrantes () {
              this.dialogBusquedaArticulos = false
               
              app.articulosSeleccionados.forEach(function (item, index) {
                  app.ligaItem.id_articulo = item.id_articulo;
                  app.ligaItem.id_categoria = app.editedItem.id_categoria;
                  app.addIntegrantes(app.ligaItem);
             
              });  
               setTimeout(() => {
               app.getIntegrantes(); 
              }, 300)
               
 
            },
           
           
           eliminarIntegrantes (item) {
              this.dialogIntegrantesCategorias = false
             app.ligaItem.id_articulo = item.id_articulo;
                  app.ligaItem.id_categoria = app.editedItem.id_categoria;
                  app.delIntegrantes(app.ligaItem);
             
               app.getIntegrantes();
 
            },
  
  
          save () {
            var formData = app.toFormData(app.editedItem);
               //console.log(formData);
               if (this.editedIndex > -1) {
                 Object.assign(this.categorias[this.editedIndex], this.editedItem);
                 axios.post('api/api_categorias.php?action=update',formData)
                     .then(function (response) {
                   console.log(response);
                   this.editedItem = Object.assign({}, this.defaultItem)
                   this.editedIndex = -1
                         if (response.data.error) {
                             app.errorMessage = response.data.message;
                         } else {
                             app.successMessage = response.data.message;
                             app.getCategorias();
                         }
                 } )
               } else {
                 app.categorias.push(this.editedItem);
                 axios.post('api/api_categorias.php?action=create',formData)
                     .then(function (response) {
                   console.log(response);
                   this.editedItem = Object.assign({}, this.defaultItem)
                   this.editedIndex = -1
                         if (response.data.error) {
                             app.errorMessage = response.data.message;
                         } else {
                             app.successMessage = response.data.message;
                             app.getCategorias();
                         }
                 } )
               }
               this.close()
         },
      cancelafecha() {
        this.fecha = null;
        this.modalfecha = false;
      },
  
      okfecha() {
        this.modalfecha = false;
      },
  
  
          toFormData: function (obj) {
                var form_data = new FormData();
                for (var key in obj) {
                    form_data.append(key, obj[key]);
                }
                return form_data;
            },
  
        },
  
  
  
  });