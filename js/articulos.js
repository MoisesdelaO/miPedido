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
         modalfecha: false,
         dense: false,
          items2: [],
          drawer: null,
          tabarticulo: 1,
          headers: [
            {
              text: 'Artículo',
              align: 'left',
              sortable: true,
              value: 'nombre_articulo',
            },
            { text: 'Tienda', align: 'right', value: 'agre', sortable: false },

            { text: 'Actions', align: 'right', value: 'action', sortable: false },
          ],
  
          articulos: [],
      
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
            return this.editedIndex === -1 ? 'Registrar artículo' : 'Editar artículo'
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
          this.getArticulos();
        },
  
        methods: {
  
          getArticulos: function () {
                axios.get('api/api_articulos.php')
                .then(function (response) {
                    console.log(response);
  
                    if (response.data.error) {
                        app.errorMessage = response.data.message;
                    } else {
                        app.articulos = response.data.articulos;
                    }
                })
            },
  
  
          editItem (item) {
            this.editedIndex = this.articulos.indexOf(item)
            this.editedItem = Object.assign({}, item)
            this.dialog = true
          },
  
          deleteItem (item) {
            const index = this.articulos.indexOf(item)
             if (confirm('¿Estas seguro de dar de baja a este artículo?')) {
               this.editedIndex = this.articulos.indexOf(item)
               this.editedItem = Object.assign({}, item)
               var formData = app.toFormData(app.editedItem);
               this.articulos.splice(index, 1);
               axios.post('api/api_articulos.php?action=delete',formData)
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
  
  
          save () {
            var formData = app.toFormData(app.editedItem);
               //console.log(formData);
               if (this.editedIndex > -1) {
                 Object.assign(this.articulos[this.editedIndex], this.editedItem);
                 axios.post('api/api_articulos.php?action=update',formData)
                     .then(function (response) {
                   console.log(response);
                   this.editedItem = Object.assign({}, this.defaultItem)
                   this.editedIndex = -1
                         if (response.data.error) {
                             app.errorMessage = response.data.message;
                         } else {
                             app.successMessage = response.data.message;
                             app.getArticulos();
                         }
                 } )
               } else {
                 app.articulos.push(this.editedItem);
                 axios.post('api/api_articulos.php?action=create',formData)
                     .then(function (response) {
                   console.log(response);
                   this.editedItem = Object.assign({}, this.defaultItem)
                   this.editedIndex = -1
                         if (response.data.error) {
                             app.errorMessage = response.data.message;
                         } else {
                             app.successMessage = response.data.message;
                             app.getArticulos();
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