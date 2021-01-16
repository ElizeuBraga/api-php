<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title><?echo $_SESSION['page']?></title>

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
            <?php
            include "App/Views/".$_SESSION['page'].".php";?>
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
                page: document.title,
                message: 'Hello Vue!',
                modalTitle:"Teste",
                modalType: "",
                products:[],
                sections:[],
                name:""
            },

            async mounted() {
                
            },

            methods: {
                save(table){
                    axios.post('http://localhost:8080/ebsys/api/'+table, [{name:this.name}]).then((response)=>{
                        console.log(response)
                    })
                }
            },
        })
        </script>
    </body>
</html>