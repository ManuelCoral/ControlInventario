<template>

  <div id="Home">
    <v-snackbar
      v-model="snackbar"
      :vertical="true"
      :color="colortoast"
    >
      {{ toastMsj }}

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
    <v-toolbar
      dark
      prominent
      src="https://cdn.vuetifyjs.com/images/backgrounds/vbanner.jpg"
    >

      <v-toolbar-title>CONTROL INVENTARIO VEHICULOS</v-toolbar-title>

      <v-spacer></v-spacer>

      

    </v-toolbar>
    <br>
    <v-row>
      <v-col cols="12">
          <v-autocomplete
            v-model="tipovehiculo"
            :items="tiposVehiculo"
            dense
            chips
            label="TIPO VEHICULO"
            item-text="TIPOVEHICULO"
            item-value="ID"            
            solo
            @change="initialize"
          ></v-autocomplete>
      </v-col>
    </v-row>
    <v-row>
      <v-col cols="12">
        <v-data-table
      :headers="headers"
      :items="vehiculos"
      class="elevation-1"
    >
      <template v-slot:top>
        <v-toolbar
          flat
        >
          <v-toolbar-title>VEHICULOS</v-toolbar-title>
          <v-divider
            class="mx-4"
            inset
            vertical
          ></v-divider>    
          <v-spacer></v-spacer>
          <v-dialog
            v-model="dialog"
            max-width="700px"
          >
            <template v-slot:activator="{ on, attrs }">
              <v-btn
                color="primary"
                dark
                class="mb-2"
                @click="initialize"
              >
                Refrescar
              </v-btn>
              <v-divider
                class="mx-4"
                inset
                vertical
              ></v-divider>
              <v-btn
                color="primary"
                dark
                class="mb-2"
                v-bind="attrs"
                v-on="on"
              >
                Agregar
              </v-btn>
            </template>
            <v-card>
              <v-card-title>
                <span class="text-h5">{{ formTitle }}</span>
              </v-card-title>

              <v-card-text>
                <v-container>
                  <v-row>
                    <v-col
                      cols="12"
                      sm="6"
                      md="4"
                    >
                      <v-text-field
                        v-model="editedItem.ID"
                        label="ID"
                        disabled
                      ></v-text-field>
                    </v-col>
                    <v-col
                      cols="12"
                      sm="6"
                      md="4"
                    >
                      <v-autocomplete
                        v-model="editedItem.TIPOVEHICULO"
                        :items="tiposVehiculoDialog"
                        dense
                        chips
                        label="TIPO VEHICULO"
                        item-text="TIPOVEHICULO"
                        item-value="ID"            
                        solo
                      ></v-autocomplete>
                    </v-col>
                    <v-col
                      cols="12"
                      sm="6"
                      md="4"
                    >
                      <v-text-field
                        v-model="editedItem.POTENCIA"
                        label="Potencia"
                      ></v-text-field>
                    </v-col>
                    <v-col
                      cols="12"
                      sm="6"
                      md="4"
                    >
                      <v-text-field
                        v-model="editedItem.NUMPUERTAS"
                        label="# Puertas"
                      ></v-text-field>
                    </v-col>
                    <v-col
                      cols="12"
                      sm="6"
                      md="4"
                    >
                      <v-text-field
                        v-model="editedItem.MATRICULA"
                        label="Matricula"
                      ></v-text-field>
                    </v-col>
                  </v-row>
                </v-container>
              </v-card-text>

              <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn
                  color="blue darken-1"
                  text
                  @click="close"
                >
                  Cancelar
                </v-btn>
                <v-btn
                  color="blue darken-1"
                  text
                  @click="save"
                >
                  Guardar
                </v-btn>
              </v-card-actions>
            </v-card>
          </v-dialog>
          <v-dialog v-model="dialogDelete" max-width="500px">
            <v-card>
              <v-card-title class="text-h5">¿Seguro que quieres eliminar el registro?</v-card-title>
              <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn color="blue darken-1" text @click="closeDelete">Cancelar</v-btn>
                <v-btn color="blue darken-1" text @click="deleteItemConfirm">Eliminar</v-btn>
                <v-spacer></v-spacer>
              </v-card-actions>
            </v-card>
          </v-dialog>
        </v-toolbar>
      </template>
      <template v-slot:item.actions="{ item }">
        <v-icon
          small
          class="mr-2"
          @click="editItem(item)"
        >
          mdi-pencil
        </v-icon>
        <v-icon
          small
          @click="deleteItem(item)"
        >
          mdi-delete
        </v-icon>
      </template>
      <template v-slot:no-data>
        <v-btn
          color="primary"
          @click="initialize"
        >
          RECARGAR
        </v-btn>
      </template>
    </v-data-table>
      </v-col>
    </v-row>
    
    
  </div>
</template>

<script>

import axios from 'axios'

  export default {
    data: () => ({
      snackbar: false,
      toastMsj: '',
      colortoast:'',
      esLectura: false,
      tipovehiculo:'TODO',
      tiposVehiculo:['TODO', 'AUTOMOVIL', 'MOTOCICLETA'],
      tiposVehiculoDialog:['AUTOMOVIL', 'MOTOCICLETA'],
      dialog: false,
      dialogDelete: false,
      headers: [
        { text: 'ID', value: 'ID' },
        { text: 'Tipo vehiculo', value: 'TIPOVEHICULO' },
        { text: 'Potencia', value: 'POTENCIA'  },
        { text: 'Num. Puertas', value: 'NUMPUERTAS'   },
        { text: 'Matricula', value: 'MATRICULA'    },
        { text: 'Acciones', value: 'actions', sortable: false },
      ],
      vehiculos: [],
      editedIndex: -1,
      editedItem: {
        ID : 0,
        TIPOVEHICULO: '',
        POTENCIA: 0,
        NUMPUERTAS: 0,
        MATRICULA: 0
      },
      defaultItem: {
        ID : 0,
        TIPOVEHICULO: '',
        POTENCIA: 0,
        NUMPUERTAS: 0,
        MATRICULA: 0
      },
    }),   

    methods: {
      notificacion(op, msj, color){ 
        let vmHome = this;
        vmHome.vmsnackbar = op
        vmHome.toastMsj =  msj
        vmHome.colortoast = color
      },
      initialize () {
        let vmHome = this;
        var url = '/api/getMotocicletas'

        let post = {
          tipoVehiculo: vmHome.tipovehiculo
        };

        axios.post(url, 
          post
        ).then((result) => {
          console.log(result);
          if (result.data.success) {
            vmHome.vehiculos = result.data.datos;
          }
          else{
            vm.text = result.data.msjError;
            vm.snackbar = true;
          }
        })
        .catch(error => {
          console.log(error);
        });      
      },

      editItem (item) {
        let vmHome = this;
        vmHome.editedIndex = vmHome.vehiculos.indexOf(item)
        vmHome.editedItem = Object.assign({}, item)
        vmHome.dialog = true
      },

      deleteItem (item) {
        let vmHome = this;
        vmHome.editedIndex = vmHome.vehiculos.indexOf(item)
        vmHome.editedItem = Object.assign({}, item)
        vmHome.idItem = item.ID
        vmHome.dialogDelete = true
      },

      deleteItemConfirm () {
        let vmHome = this;
        //this.vehiculos.splice(this.editedIndex, 1)
        

        let url = "/api/deleteMotocicleta" 
        let post = {
          id: vmHome.idItem
        };

        axios.post(url, 
          post
        ).then((result) => {
          console.log(result);
          vmHome.closeDelete()
          vmHome.initialize();
        })
        .catch(error => {
          console.log(error);
        });  
      },

      close () {
        let vmHome = this;
        vmHome.dialog = false
        vmHome.$nextTick(() => {
          vmHome.editedItem = Object.assign({}, vmHome.defaultItem)
          vmHome.editedIndex = -1
        })
      },

      closeDelete () {
        let vmHome = this;
        vmHome.dialogDelete = false
        vmHome.$nextTick(() => {
          vmHome.editedItem = Object.assign({}, vmHome.defaultItem)
          vmHome.editedIndex = -1
        })
      },

      save () {
        let vmHome = this;
        if (vmHome.editedIndex > -1) {
          vmHome.modificaRegistro(vmHome.editedItem)
        } else {
          vmHome.guardarRegistro(vmHome.editedItem)
          //vmHome.vehiculos.push()
        }
        this.close()
      },
      guardarRegistro(item){
        let vmHome = this

        let url = (item.TIPOVEHICULO == "MOTOCICLETA" ? "/api/setMotocicleta" : "/api/setAutomovil")
        let post = {
          tipoVehiculo: item.TIPOVEHICULO,
          potencia: item.POTENCIA,
          numPuerta: item.NUMPUERTAS,
          matricula: item.MATRICULA,
        };

        axios.post(url, 
          post
        ).then((result) => {
          console.log(result);
          vmHome.initialize();
        })
        .catch(error => {
          console.log(error);
        });  
      },
      modificaRegistro(item){
        let vmHome = this

        let url = (item.TIPOVEHICULO == "MOTOCICLETA" ? "/api/editMotocicleta" : "/api/editAutomovil")
        let post = {
          id : item.ID,
          tipoVehiculo: item.TIPOVEHICULO,
          potencia: item.POTENCIA,
          numPuerta: item.NUMPUERTAS,
          matricula: item.MATRICULA,
        };

        axios.post(url, 
          post
        ).then((result) => {
          console.log(result);
          vmHome.initialize();
        })
        .catch(error => {
          console.log(error);
        });  
      },
    },
    mounted() {
        window.vmHome = this;
    },
    computed: {
      formTitle () {
        let vmHome = this
        return vmHome.editedIndex === -1 ? 'AGREGAR' : 'EDITAR'
      },
    },

    watch: {
      dialog (val) {
        let vmHome = this
        val || vmHome.close()
      },
      dialogDelete (val) {
        let vmHome = this
        val || vmHome.closeDelete()
      },
    },

    created () {
      let vmHome = this
      vmHome.initialize()
    },
  }
</script>
