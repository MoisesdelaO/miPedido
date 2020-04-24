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
    dialogIniciar: false,
    dialog: false,
       modalfecha: false,
       dense: false,
        items2: [],
        drawer: null,
        tabtienda: 1,
        
        tiendas: [],
        
        editedIndex: -1,
        
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
              correo:'', 	  
              contrasena:'', 
              
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
              correo:'', 	  
              contrasena:'', 
              
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
        this.$vuetify.theme.dark = false;
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

        
        
      
     close () {
               this.dialog = false
               setTimeout(() => {
                 this.editedItem = Object.assign({}, this.defaultItem)
                 this.editedIndex = -1
               }, 300)
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

         
         toFormData: function (obj) {
          var form_data = new FormData();
          for (var key in obj) {
              form_data.append(key, obj[key]);
          }
          return form_data;
      },
    
    }

  })