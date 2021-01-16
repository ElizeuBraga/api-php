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
            <!-- card sales -->
            <b-card
                title="Vendas"
                img-src="https://inforchannel.com.br/wp-content/uploads/2018/06/vendas.jpg"
                img-alt="Minhas vendas"
                img-top
                tag="article"
                style="max-width: 100rem;"
                class="mb-2"
            >
                <b-card-text>
                Novas seções
                </b-card-text>

                <!-- <b-button @click="openModal('products')" variant="primary">Novo produto</b-button> -->
                <!-- <b-button @click="openModal('products')" variant="primary">Listar todos</b-button> -->
                </b-row>
            </b-card>
            <!-- card sales -->

            <!-- card products -->
            <b-card
                title="Produtos"
                img-src="https://image.freepik.com/vetores-gratis/estilo-de-pop-art-de-hamburguer-fast-food_24908-61700.jpg"
                img-alt="Produtos"
                img-top
                tag="article"
                style="max-width: 100rem;"
                class="mb-2"
            >
                <b-card-text>
                Aqui você poderá cadastrar os seus produtos
                </b-card-text>

                <b-button @click="openModal('sections')" variant="primary">Nova Seção</b-button>
                <b-button @click="openModal('products')" variant="primary">Novo produto</b-button>
                <b-button @click="openModal('allProducts')" variant="primary">Listar todos</b-button>
                </b-row>
            </b-card>
            <!-- card products -->
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
                name:"TEste",
                message: 'Hello Vue!',
                modalTitle:"Teste",
                modalType: "",
                products:[],
                sections:[]
            },

            async mounted() {
                this.loadFromServer('sections');
                this.loadFromServer('products');
            },

            methods: {
                async openModal(modal){
                    if(modal == 'products'){
                        if(this.sections.length == 0){
                            Swal.fire({
                                title:"Atenção",
                                text:"Cadastre pelo menos uma sessão para continuar",
                                icon:"warning"
                            })
                            return;
                        }
                        let section = []
                        this.sections.forEach(element => {
                            section.push(element.name)
                        });
                        Swal.mixin({
                            input: 'text',
                            confirmButtonText: 'Next &rarr;',
                            showCancelButton: true,
                            progressSteps: ['1', '2', '3']
                        }).queue([
                            {
                                input:'text',
                                title: 'Nome do produto',
                            },
                            {
                                title: 'Preço',
                            },
                            {
                                input: 'select',
                                title: 'Nome',
                                inputOptions: section,
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
                    }else if(modal == 'sections'){
                        Swal.mixin({
                            input: 'text',
                            confirmButtonText: 'Next &rarr;',
                            showCancelButton: true,
                            progressSteps: ['1']
                        }).queue([
                            {
                                input:'text',
                                title: 'Nome da sessão',
                            }
                        ]).then((result) => {
                            if (result.value) {
                                axios.get('http://localhost:8080/www/ebsys-web/', {params: {
                                        request: 'sections_save',
                                        name: result.value[0]
                                    }
                                }).then((response)=>{
                                    this.loadFromServer('sections');
                                    Swal.fire({
                                        text:"Salvo!",
                                        icon:"success"
                                    })
                                })
                            }
                        })
                    }else if('allProducts'){
                        window.location = "products.php"
                    }
                },

                teste(){
                    alert('Oi')
                },

                async loadFromServer(table){
                    if(this.products.length == 0){
                        await axios.get('http://localhost:8080/ebsys/api/products').then((response)=>{
                            if(table == 'products'){
                                this.products = response.data
                            }else{
                                this.sections = response.data
                            }

                            console.log(response.data)
                        })
                    }
                }
            },
        })
        </script>
    </body>
</html>