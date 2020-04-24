<v-app-bar app clipped-left color="green" dense dark>
  <v-app-bar-nav-icon class="hidden-md-and-up"></v-app-bar-nav-icon>
    <v-toolbar-title><a class="navbar-brand" href="#"><img src="img/logo.png" height="30" class="d-inline-block align-top"  alt=""><span class="white--text">NOMBRE APLICACION</span></a></v-toolbar-title>
    <div class="flex-grow-1"></div>

    <template v-if="$vuetify.breakpoint.smAndUp" style="color:$fff;">
      <v-btn icon>
        <v-icon>info</v-icon>
      </v-btn>
     
    </template>
  </v-app-bar>