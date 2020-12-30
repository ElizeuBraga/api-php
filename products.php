<?php
    require_once('./models/Ws.php');
    require_once('./models/Db.php');
    // require_once('./config/config.php');
    $db = new Db();
    $teste = (isset($_REQUEST['request'])) ? $_REQUEST['request'] : '';
    switch ($teste) {
        case 'products':
            # code...
            $sql = "SELECT * FROM products";
            $name = $_REQUEST['name'];
            if($name != ''){
                $sql = "SELECT * FROM products WHERE name like '%{$name}%'";
            }
            echo $db->get($sql);
            die();
            break;
        case 'sections':
            # code...
            $sql = "SELECT id, name FROM sections";
            echo $db->get($sql);
            die();
            break;
        case 'products_save':
            $name = $_REQUEST['name'];
            $price = (float)$_REQUEST['price'];
            $section_id = (int)$_REQUEST['section_id'];
            $sql = "INSERT INTO products(name, price, section_id)VALUES('{$name}', {$price}, {$section_id})";
            echo $db->insert($sql);
            die();
            # code...
            break;
        case 'sections_save':
            $name = $_REQUEST['name'];
            $sql = "INSERT INTO sections(name)VALUES('{$name}')";
            echo $db->insert($sql);
            die();
            # code...
            break;
    }
?>
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <!-- <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet"> -->


        <!-- Bootstrap -->
        <link type="text/css" rel="stylesheet" href="//unpkg.com/bootstrap/dist/css/bootstrap.min.css" />
        <link type="text/css" rel="stylesheet" href="//unpkg.com/bootstrap-vue@latest/dist/bootstrap-vue.min.css" />

        <script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
        <script src="//unpkg.com/bootstrap-vue@latest/dist/bootstrap-vue.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.0/axios.min.js" integrity="sha512-DZqqY3PiOvTP9HkjIWgjO6ouCbq+dxqWoJZ/Q+zPYNHmlnI2dQnbJ5bxAHpAMw+LXRm4D72EIRXzvcHQtE8/VQ==" crossorigin="anonymous"></script>
        <!-- Styles -->
        <style>
            
        </style>
    </head>
    <body>
        <div id="app" class="container-fluid">  
        <b-list-group class="mt-3">
            <div>
                <b-input-group
                    class="mb-3"
                    prepend="Pesquisar"
                >
                    <b-form-input v-model="name"></b-form-input>
                    <b-input-group-append>
                    <b-button size="sm" text="Button" variant="success" @click="loadFromServer('products')">Buscar</b-button>
                    </b-input-group-append>
                </b-input-group>
            </div>
            <b-list-group-item @click="edit(p)" v-for="(p, i) in products" :key="i" class="d-flex justify-content-between align-items-center">
                <b-col>{{p.name}}</b-col>
                <b-col class="text-right">{{parseFloat(p.price).toFixed(2).replace('.', ',')}}</b-col>
                <!-- <b-badge variant="primary" pill>{{p.price}}</b-badge> -->
            </b-list-group-item>
        </b-list-group>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
        <script>
        function teste(name){
            Swal.fire({
                text:name
            })
        }
        var app = new Vue({
            el: '#app',
            data: {
                message: 'Hello Vue!',
                modalTitle:"Teste",
                modalType: "",
                products:[],
                sections:[],
                name:''
            },

            async mounted() {
                this.loadFromServer('sections');
                this.loadFromServer('products');
            },

            methods: {
                edit(p){
                    let section = []
                        this.sections.forEach(element => {
                            section.push(element.name)
                        });
                        Swal.mixin({
                            input: 'text',
                            confirmButtonText: 'Next &rarr;',
                            showCancelButton: true,
                            progressSteps: ['1', '2', '3'],
                            inputValidator: function (value) {
                                    return new Promise(function (resolve, reject) {
                                    if (value !== '') {
                                        resolve();
                                    } else {
                                        resolve('Campo obrigatório');
                                    }
                                    });
                                }
                        }).queue([
                            {
                                input:'text',
                                title: 'Nome do produto',
                                inputValue: p.name
                            },
                            {
                                title: 'Preço',
                                inputValue: p.price
                            },
                            {
                                input: 'select',
                                title: 'Nome',
                                inputOptions: section,
                                inputValue: section[0]
                            },
                        ]).then((result) => {
                            if (result.value) {
                                axios.get('http://localhost:8080/www/ebsys-web/', {params: {
                                        request: 'products_save',
                                        name: result.value[0],
                                        price: result.value[1],
                                        section_id: this.sections[result.value[2]].id,
                                    }
                                }).then((response)=>{
                                    Swal.fire({
                                        text:"Salvo!",
                                        icon:"success"
                                    })
                                })
                            }
                        })
                },

                async loadFromServer(table){
                    if(this.products.length == 0 || this.name != ''){
                        await axios.get('http://localhost:8080/www/ebsys-web/products.php', {params: {request: table, name:this.name}}).then((response)=>{
                            if(table == 'products'){
                                this.products = response.data
                            }else{
                                this.sections = response.data
                            }
                        })
                    }
                }
            },
        })
        </script>
    </body>
</html>