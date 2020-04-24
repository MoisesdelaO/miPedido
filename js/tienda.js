
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
        dialogBusqueda: false,
      dialogIntegrantes: false,
       modalfecha: false,
       dense: false,
        items2: [],
        drawer: null,
        tabtienda: 1,
        headers: [
          {
            text: 'Nombre',
            align: 'left',
            sortable: true,
            value: 'nombre_comercial',
          },
          { text: 'Agregar categorias', value: 'cat', sortable: false },
          { text: 'Actions', align: 'right', value: 'action', sortable: false },
        ],
        
          hIntegrantes: [
                        
            {
              text: 'Categorias',
              align: 'left',
              sortable: true,
              value: 'nombre_categoria',
            },

          { text: 'Actions', value: 'action',  align: 'right', sortable: false },

          ],    

          hCategorias: [
            {
              text: 'Nombre',
              align: 'left',
              sortable: true,
              value: 'nombre_categoria',
            },
          
          ],


         
         
 
       integrantes: [],   
       categoriasSeleccionados:[],
        tiendas: [],
        categorias:[],
        editedIndex: -1,
        
        ligaItem: { 
          id_tienda:'', 
          id_categoria:'', 
        },
        editedItem: {
              id_tienda:'',       		 
              nombre_comercial:'',   	 
              razon_social: '',   		
              rfc: '',             	
              status: 0,     			 
              envio_domicilio: 0,        
              recoge: 0,  			     
              pedido_min:'',      	   
              costo_envio:'',   	        
              logotipo:'',   		  
        },
        defaultItem: {
              id_tienda:'',       		 
              nombre_comercial:'',   	 
              razon_social: '',   		
              rfc: '',             	
              status: 0,     			 
              envio_domicilio: 0,        
              recoge:0,  			     
              pedido_min:'',      	   
              costo_envio:'',   	        
              logotipo:'', 
        },
      },

      computed: {
        formTitle () {
          return this.editedIndex === -1 ? 'Registrar Tienda' : 'Editar Tienda'
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
        this.getTiendas();
      },

      methods: {

        getTiendas: function () {
      		axios.get('api/api_tiendas.php')
      		.then(function (response) {
      			console.log(response);

      			if (response.data.error) {
      				app.errorMessage = response.data.message;
      			} else {
      				app.tiendas = response.data.tiendas;
      			}
      		})
        },
        

        getIntegrantes: function () {
            var formData = app.toFormData(app.editedItem);
      		axios.post('api/api_tiendas.php?action=list',formData)
      		.then(function (response) {
      	

      			if (response.data.error) {
      				app.errorMessage = response.data.message;
      			} else {
      				app.integrantes = response.data.integrantes;
                    app.dialogIntegrantes = true
      			}
      		})
      	},
                  
          addIntegrantes: function (item) {

            var formData = app.toFormData(item);
      		axios.post('api/api_tiendas.php?action=add',formData)
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
      		axios.post('api/api_tiendas.php?action=del',formData)
      		.then(function (response) {
      			console.log(response);

      			if (response.data.error) {
      				app.errorMessage = response.data.message;
      			} else {
      				app.successMessage = response.data.message;
                    
      			}
      		})
      	},
                  
          
          getCategorias: function () {
              var formData = app.toFormData(app.editedItem);
      		axios.post('api/api_tiendas.php?action=disponibles',formData)
      		.then(function (response) {
      		
                console.log(response);
      			if (response.data.error) {
      				app.errorMessage = response.data.message;
      			} else {
      				app.categorias = response.data.categorias;
                    app.dialogBusqueda = true;
      			}
      		})
      	},


        editItem (item) {
          this.editedIndex = this.tiendas.indexOf(item)
          this.editedItem = Object.assign({}, item)
          this.dialog = true
        },

        plusItem (item) {
          this.editedIndex = this.categorias.indexOf(item)
          this.editedItem = Object.assign({}, item)
          this.getCategorias()
          
        },


        inicioBusqueda: function (item)  {

          this.getCategorias();
          
        },  

        plusItem (item) {
          this.editedIndex = this.tiendas.indexOf(item)
          this.editedItem = Object.assign({}, item)
          this.getIntegrantes()
          
        },  

        deleteItem (item) {
          const index = this.tiendas.indexOf(item)
           if (confirm('¿Estas seguro de dar de baja a esta tienda?')) {
             this.editedIndex = this.tiendas.indexOf(item)
             this.editedItem = Object.assign({}, item)
             var formData = app.toFormData(app.editedItem);
             this.tiendas.splice(index, 1);
             axios.post('api/api_tiendas.php?action=delete',formData)
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
            this.dialogIntegrantes = false
             app.getTiendas();
            setTimeout(() => {
              this.editedItem = Object.assign({}, this.defaultItem)
              this.editedIndex = -1
            }, 300)
          },
         
         cancelarIntegrantes () {
            this.dialogBusqueda = false

          },
         
         
         
         agregarIntegrantes () {
            this.dialogBusqueda = false
             
            app.categoriasSeleccionados.forEach(function (item, index) {
                app.ligaItem.id_categoria = item.id_categoria;
                app.ligaItem.id_tienda = app.editedItem.id_tienda;
                app.addIntegrantes(app.ligaItem);
           
            });  
             setTimeout(() => {
             app.getIntegrantes(); 
            }, 300)
             

          },
         
         
         eliminarIntegrantes (item) {
            this.dialogIntegrantes = false
             
   
           app.ligaItem.id_categoria = item.id_categoria;
                app.ligaItem.id_tienda = app.editedItem.id_tienda;
                app.delIntegrantes(app.ligaItem);
           
             app.getIntegrantes();

          },
           

           
        save () {
          var formData = app.toFormData(app.editedItem);
             //console.log(formData);
             if (this.editedIndex > -1) {
               Object.assign(this.tiendas[this.editedIndex], this.editedItem);
               axios.post('api/api_tiendas.php?action=update',formData)
           		.then(function (response) {
                 console.log(response);
                 this.editedItem = Object.assign({}, this.defaultItem)
                 this.editedIndex = -1
           			if (response.data.error) {
           				app.errorMessage = response.data.message;
           			} else {
           				app.successMessage = response.data.message;
           				app.getTiendas();
           			}
               } )
             } else {
               app.tiendas.push(this.editedItem);
               axios.post('api/api_tiendas.php?action=create',formData)
           		.then(function (response) {
                 console.log(response);
                 this.editedItem = Object.assign({}, this.defaultItem)
                 this.editedIndex = -1
           			if (response.data.error) {
           				app.errorMessage = response.data.message;
           			} else {
           				app.successMessage = response.data.message;
           				app.getTiendas();
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