<template>
    <div id="login">
        <v-container fluid fill-height>
        <v-layout align-center justify-center>
          <v-flex xs12 sm8 md4>
            <v-card class="elevation-12">
              <v-toolbar dark color="primary">
                <v-toolbar-title>Login form</v-toolbar-title>
                <v-spacer></v-spacer>     
              </v-toolbar>
              <v-card-text>
                <v-form>
                  <v-text-field v-model="localusuario" prepend-icon="mdi-account" label="Login" type="text"></v-text-field>
                  <v-text-field v-model="localpassword" prepend-icon="mdi-lock" label="Password" type="password"></v-text-field>
                </v-form>
              </v-card-text>
              <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn color="primary" @click="eventoClick">Iniciar sesión</v-btn>
              </v-card-actions>
            </v-card>
          </v-flex>
        </v-layout>
      </v-container>
    </div>
</template>

<script>

  export default {
    name: 'login',

    props: {
      usuario: String,
      password: String,
    },
    data: () => ({
        
      localusuario : '',
      localpassword: '',
    }),
    methods:{
        eventoClick(){
            console.log('eventoClick')
            let vmlogin = this;
            vmlogin.$emit('eventoClick');
        }
    },
    mounted() {
        window.vmlogin = this;
    },
    watch:{
        
    }
  }
</script>
