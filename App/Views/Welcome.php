<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title><?echo $_SESSION['page']?></title>

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
        <h5 v-if="page != 'homes'" class="card-title text-center">{{page}}</h5>
        <h5 v-else class="card-title text-center">Ebsys</h5>
        <table v-if="page != 'home' && page != 'homes'" class="table">
            <thead>
                <tr>
                <th scope="col">Nome</th>
                <th v-if="page == 'products'" scope="col">Preço</th>
                <th v-if="page == 'users'" scope="col">Telefone</th>                
                <th v-if="editIsPermited" scope="col" style="text-align:right">
                    <button class="btn btn-primary" @click="post">Novo</button>
                </th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(i, index) in items" :key="index">
                    <td>{{i.name}}</td>
                    <td v-if="page == 'products'">{{i.price}}</td>
                    <td v-if="page == 'users'">{{i.phone}}</td>
                    <td v-if="editIsPermited" align="right">
                        <button class="btn btn-primary" @click="put(i)">Editar</button>
                        <button class="btn btn-danger" @click="destroy(i.id)">Excluir</button>
                    </td>
                </tr>
            </tbody>
        </table>
        <div v-else>
            <a :href="i.url" v-for="(i, index) in items" class="btn btn-primary col-12 mt-2 p-4">{{i.name}}</a>
        </div>
        <!-- <button style="margin-top:130%">Teste</button> -->
        </div>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
        <script>
        var app = new Vue({
            el: '#app',
            data: {
                // items returned by api
                items:[],
                item:{

                },
                page: document.title,
                message: 'Hello Vue!',
                modalTitle:"Teste",
                modalType: "",
            },

            async mounted() {
                if(this.page == 'home'){
                    this.page += 's'
                }
                this.get()
            },

            computed: {
                editIsPermited(){
                    return this.page == 'sections' || this.page == 'users' || this.page == 'products'
                }
            },

            methods: {
                async get(){
                    await axios.get('http://localhost:8080/ebsys/api/'+this.page).then((response)=>{
                        this.items = response.data
                    })
                },

                post(table){
                    axios.post('http://localhost:8080/ebsys/api/'+table, [{name:this.name}]).then((response)=>{
                        // console.log(response.data)
                    })
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
                        }
                        
                        console.log(request);
                        axios.put('http://localhost:8080/ebsys/api/'+this.page+'/'+item.id,request).then((response)=>{
                            this.get();
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
                            axios.delete('http://localhost:8080/ebsys/api/'+this.page+'/'+id).then((response)=>{
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
                        html = '<input id="swal-input1" class="swal2-input">';
                        html += '<input id="swal-input2" class="swal2-input">';
                        html += '<input id="swal-input3" class="swal2-input">';
                    }

                    return html;
                }
            },
        })
        </script>
    </body>
</html>