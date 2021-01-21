<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title><?php echo $_SESSION['page']; ?></title>

        <!-- Fonts -->
        <!-- <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet"> -->


        <!-- Bootstrap -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.0/axios.min.js" integrity="sha512-DZqqY3PiOvTP9HkjIWgjO6ouCbq+dxqWoJZ/Q+zPYNHmlnI2dQnbJ5bxAHpAMw+LXRm4D72EIRXzvcHQtE8/VQ==" crossorigin="anonymous"></script>
        <!-- Styles -->
        <style>
            html, body {
                height: 100%;
            }   
            .container-fluid {
                height: 100%;
                overflow-y: hidden; /* don't show content that exceeds my height */
            }
        </style>
    </head>
    <body>
        <div id="app" class="container-fluid">
        <input type="hidden" value="<?php echo $_SESSION['page']?>">
        <h5 v-if="page != 'home'" class="card-title text-center">{{page}}</h5>
        <h5 v-else class="card-title text-center">Ebsys</h5>
        <div v-if="page == 'home' || page == 'pages'">
            <a :href="i.url" v-for="(i, index) in items" class="btn btn-primary col-12 mt-2 p-4">{{i.name}}</a>
        </div>
        <div v-else>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Nome</th>
                        <th v-if="page == 'products'" scope="col">Preço</th>
                        <th v-if="page == 'products'" scope="col">Seção</th>
                        <th v-if="page == 'users'" scope="col">Telefone</th>                
                        <th v-if="page == 'users'" scope="col" class="text-nowrap">Email</th>                
                        <th v-if="editIsPermited" scope="col" style="text-align:right">
                            <button class="btn btn-primary" @click="post">Novo</button>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(i, index) in items" :key="index">
                        <td>{{i.name}}</td>
                        <td v-if="page == 'products'">{{i.price}}</td>
                        <td v-if="page == 'products'">{{i.section}}</td>
                        <td v-if="page == 'users'">{{i.phone}}</td>
                        <td v-if="page == 'users'">{{i.email}}</td>
                        <td v-if="editIsPermited" align="right">
                            <button class="btn btn-primary" @click="put(i)">Editar</button>
                            <button class="btn btn-danger" @click="destroy(i.id)">Excluir</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <!-- <button style="margin-top:130%">Teste</button> -->
        </div>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
        <script>
        var app = new Vue({
            el: '#app',
            data: {
                isProduction: false,
                url: 'http://localhost:8080/ebsys/public_html/api/',
                // items returned by api
                items:[],
                sections:[],
                item:{

                },
                page: document.title,
                message: 'Hello Vue!',
                modalTitle:"Teste",
                modalType: "",
            },

            async mounted() {
                if(window.location.hostname != 'localhost'){
                    this.isProduction = true;
                    this.url = 'https://ebsysautomacao.000webhostapp.com/api/';
                }
                this.get();
                this.item={}
                this.loadSections()
            },

            computed: {
                editIsPermited(){
                    return this.page == 'sections' || this.page == 'users' || this.page == 'products'
                }
            },

            methods: {
                async loadSections(){
                    await axios.get(this.url+'sections/get').then((response)=>{
                        this.sections = response.data
                    })
                },

                async get(){
                    if(this.page == 'home'){
                        this.page = 'pages'
                    }
                    await axios.get(this.url+this.page+'/get').then((response)=>{
                        this.items = response.data
                    })
                },

                async post(){
                    const { value: formValues } = await Swal.fire({
                        title: 'Novo',
                        html: this.inputs(),
                        focusConfirm: false,
                        showCancelButton:true,
                        didOpen: () => {
                            // if(this.page == 'sections'){
                            //     document.getElementById('swal-input1').value = this.item.name
                            // }else if(this.page == 'users'){
                            //     document.getElementById('swal-input1').value = this.item.name
                            //     document.getElementById('swal-input2').value = this.item.phone
                            //     document.getElementById('swal-input3').value = this.item.email
                            // }
                        },
                        preConfirm: () => {
                            if(this.page == 'sections'){
                                return [
                                    document.getElementById('swal-input1').value
                                ]
                            }else if(this.page == 'users'){
                                return [
                                    document.getElementById('swal-input1').value,
                                    document.getElementById('swal-input2').value,
                                    document.getElementById('swal-input3').value
                                ]
                            }else if(this.page == 'products'){
                                return [
                                    document.getElementById('swal-input1').value,
                                    document.getElementById('swal-input2').value,
                                    document.getElementById('swal2-select').value,
                                ]
                            }
                        }
                    })

                    if (formValues) {
                        let request = [];
                        if(this.page == 'sections'){
                            request = [
                                {name: formValues[0]}
                            ]
                        }else if(this.page == 'users'){
                            request = [
                                {   
                                    name: formValues[0],
                                    phone: formValues[1],
                                    email: formValues[2]
                                }
                            ]
                        }else if(this.page == 'products'){
                            request = [
                                {   
                                    name: formValues[0],
                                    price: formValues[1],
                                    section_id: formValues[2],
                                }
                            ]
                        }
                        axios.post(this.url + this.page+'/post/', request).then((response)=>{
                            if(response.data.message){
                                Swal.fire({
                                    title:"Ops!",
                                    text: response.data.message,
                                    icon:"info"
                                })
                            }else{
                                this.get();
                            }
                        })
                    }
                },

                async put(item){
                    const { value: formValues } = await Swal.fire({
                        title: 'Editar',
                        html: this.inputs(),
                        focusConfirm: false,
                        showCancelButton:true,
                        didOpen: () => {
                            if(this.page == 'sections'){
                                document.getElementById('swal-input1').value = item.name
                            }else if(this.page == 'users'){
                                document.getElementById('swal-input1').value = item.name
                                document.getElementById('swal-input2').value = item.phone
                                document.getElementById('swal-input3').value = item.email
                            }else if(this.page == 'products'){
                                document.getElementById('swal-input1').value = item.name
                                document.getElementById('swal-input2').value = item.price
                                document.getElementById('swal2-select').value = item.section_id
                            }
                        },
                        preConfirm: () => {
                            if(this.page == 'sections'){
                                return [
                                    document.getElementById('swal-input1').value
                                ]
                            }else if(this.page == 'users'){
                                return [
                                    document.getElementById('swal-input1').value,
                                    document.getElementById('swal-input2').value,
                                    document.getElementById('swal-input3').value
                                ]
                            }else if(this.page == 'products'){
                                return [
                                    document.getElementById('swal-input1').value,
                                    document.getElementById('swal-input2').value,
                                    document.getElementById('swal2-select').value,
                                ]
                            }
                        }
                    })

                    if (formValues) {
                        let request = [];
                        if(this.page == 'sections'){
                            request = [
                                {name: formValues[0]}
                            ]
                        }else if(this.page == 'users'){
                            request = [
                                {   
                                    name: formValues[0],
                                    phone: formValues[1],
                                    email: formValues[2]
                                }
                            ]
                        }else if(this.page == 'products'){
                            request = [
                                {   
                                    name: formValues[0],
                                    price: formValues[1],
                                    section_id: formValues[2],
                                }
                            ]
                        }
                        axios.post(this.url +this.page+'/put/'+item.id,request).then((response)=>{
                            if(response.data.message){
                                Swal.fire({
                                    title:"Ops!",
                                    text: response.data.message,
                                    icon:"info"
                                })
                            }else{
                                this.get();
                            }
                        })
                    }
                },

                destroy(id){
                    Swal.fire({
                        title:"Excluir?",
                        icon:"warning",
                        showCancelButton:true
                    }).then((e)=>{
                        if(e.value){
                            axios.post(this.url+this.page+'/delete/'+id).then((response)=>{
                                Swal.fire({
                                    title:"Excluido",
                                    icon:"success"
                                }).then(()=>{
                                    this.get();
                                })
                            })
                        }
                    })
                },

                inputs(){
                    let html = "";
                    if(this.page == 'sections'){
                        html = '<input id="swal-input1" class="swal2-input">';
                    }else if(this.page == 'users'){
                        html = '<input id="swal-input1" placeholder="Nome" class="swal2-input">';
                        html += '<input id="swal-input2" placeholder="Telefone" class="swal2-input">';
                        html += '<input id="swal-input3" placeholder="Email" class="swal2-input">';
                    }else if(this.page == 'products'){
                        html = '<input id="swal-input1" placeholder="Nome" class="swal2-input">';
                        html += '<input id="swal-input2" placeholder="Valor" class="swal2-input">';
                        html += '<select id="swal2-select" class="swal2-select" name=""><option selected value disabled>Selecione</option>';
                        this.sections.forEach(element => {
                            html += '<option value="'+element.id+'">'+element.name+'</option>';
                        });
                        html += '</select>';
                    }

                    return html;
                }
            },
        })
        </script>
    </body>
</html>