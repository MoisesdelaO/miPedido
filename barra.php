<v-navigation-drawer
  v-model="drawer"
  app
  clipped
>
  <v-list dense>
    <v-list-item link href="tienda.php">
      <v-list-item-action>
        <v-icon>work</v-icon>
      </v-list-item-action>
      <v-list-item-content>
        <v-list-item-title>
          Tiendas
        </v-list-item-title>
      </v-list-item-content>
    </v-list-item>

    <v-list-item link href="articulos.php">
      <v-list-item-action>
        <v-icon>shopping_cart</v-icon>
      </v-list-item-action>
      <v-list-item-content>
        <v-list-item-title>
          Artículos
        </v-list-item-title>
      </v-list-item-content>
    </v-list-item>

    <v-list-item link href="categorias.php">
      <v-list-item-action>
        <v-icon>mdi-plus</v-icon>
      </v-list-item-action>
      <v-list-item-content>
        <v-list-item-title>
          Categorias
        </v-list-item-title>
      </v-list-item-content>
    </v-list-item>

    
    
    

    

  </v-list>
</v-navigation-drawer>
