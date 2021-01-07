<?php
$link = mysqli_connect("127.0.0.1", "root", "@Ae12345678", "ebsys");

if (!$link) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}

// echo "Success: A proper connection to MySQL was made! The my_db database is great." . PHP_EOL;
// echo "Host information: " . mysqli_get_host_info($link) . PHP_EOL;

mysqli_close($link);

function ver(){

    $parar = false;

    $caminho = array_shift(debug_backtrace());
    echo '
                               <div style="background-color: #ddd; color: #000; font-size: 14px;">
                               <div>
                                               <label>
                                                               Linha   --> <label class="valorCaminho">'.$caminho['line'].'</label><br />
                                                               Caminho --> <label class="valorCaminho"><a href="netbeans://' . $caminho['file'] . '?' . $caminho['line'] . '">'.$caminho['file'].'</a></label><br />
                                               </label>
                               </div>';

    echo '<div><pre>';


    foreach( $caminho['args'] as $indice => $valor ){

        if(  $valor == 'die' ) $parar = true;
        echo '<label style="color:red; font-weight: bold;">Argumento '.( $indice + 1 ).'</label><br />';
        print_r( $valor );
        echo '<br /><br />';

    }

    echo '</div></pre></div>';


    // Verifica se é para dar o die no final
    if( $parar ){ die; }
}
?>