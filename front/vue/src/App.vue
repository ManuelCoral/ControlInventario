<template>
  <v-app id="inspire">
    <v-snackbar
      v-model="snackbar"
      :vertical="true"
      color="red darken-4"
    >
      {{ text }}

      <template v-slot:action="{ attrs }">
        <v-btn
          dark
          text
          v-bind="attrs"
          @click="snackbar = false"
        >
          Close
        </v-btn>
      </template>
    </v-snackbar>

    <v-row>
      <v-col cols="12" v-if="!usuarioValido">
        <login :usuario="user" :password="pass" @eventoClick="validaUsuario"></login>
      </v-col>
      <v-col cols="12" v-else>
        <home></home>
      </v-col>
    </v-row>    
  </v-app>
</template>

<script>
import login from "./components/Login.vue"
import home from "./views/Home.vue"
import axios from 'axios'

  

  export default {
    
    components: {
      login,
      home,
    },

    data: () => ({
      user : "",
      pass: "",
      snackbar: false,
      text: "",
      usuarioValido: false,
    }),
    
    methods: {
      validaUsuario(){
        console.log("validaUsu")
        let vm = this;
        let url = "/api/login"
        let post = {
          usuario: vmlogin.localusuario,
          pass: vmlogin.localpassword,
        };

        axios.post(url, 
          post
        ).then((result) => {
          console.log(result);
          if (result.data.success) {
            vm.usuarioValido = true;
          }
          else{
            vm.text = result.data.msjError;
            vm.snackbar = true;
          }
        })
        .catch(error => {
          console.log(error);
        });
      }
    },
    
    mounted() {
        window.vm = this;
    },
  }
</script>