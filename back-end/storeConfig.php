<?php
  
$nome_escudo = 'padrao.jpg';
if(isset($_FILES['file']) && $_FILES['file']['size'] > 0){
    $extensoes_aceitas = array('bmp' ,'png', 'svg', 'jpeg', 'jpg');
    $array_extensoes   = explode('.', $_FILES['file']['name']);
    $extensao = strtolower(end($array_extensoes));

     // Validamos se a extensão do arquivo é aceita
     if (array_search($extensao, $extensoes_aceitas) === false) {
        $retorno = array('status' => 0, 'mensagem' => 'Extensão Inválida!');
        echo json_encode($retorno);
        exit();
    }
    
     // Verifica se o upload foi enviado via POST   
    if(is_uploaded_file($_FILES['file']['tmp_name']))  {
        // Verifica se o diretório de destino existe, senão existir cria o diretório  
        if(!file_exists("img")){
            mkdir("img");
        }
    
        // Monta o caminho de destino com o nome do arquivo  
        $nome_escudo = $_FILES['file']['name'];  
            
        // Essa função move_uploaded_file() copia e verifica se o arquivo enviado foi copiado com sucesso para o destino  
        if (!move_uploaded_file($_FILES['file']['tmp_name'], 'img/'. $nome_escudo)) {
            $retorno = array('status' => 0, 'mensagem' => 'Houve um erro ao gravar arquivo na pasta de destino!'.$_FILES["file"]["error"]); 
            echo json_encode($retorno);
            exit();  
        } else {
            global $wpdb;

            if(!isset($wpdb)) {
                //the '../' is the number of folders to go up from the current file to the root-map.
                require_once('../../../../wp-config.php');
                require_once('../../../../wp-includes/wp-db.php');
            }

            $table_name = $wpdb->prefix."congresso_images";

            $results = $wpdb->get_row("SELECT * FROM $table_name WHERE event_id = ".$_REQUEST['event_id']);

            $dados = array(
                'nome' => $nome_escudo,
                'titulo' => $_REQUEST['titulo'],
                'event_id' => $_REQUEST['event_id'],
                'localidade' => $_REQUEST['localidade'],
                'data_evento' =>$_REQUEST['data_evento'],
                'qrcode_text' => $_REQUEST['qrcode_text']
            );

            if ($results) {
                // Upadate data
                $wpdb->update($table_name, $dados, array('event_id' => $results->event_id));
            } else {
                $wpdb->insert($table_name, $dados);
            }

            if($wpdb->last_error !== '') {
                http_response_code(500);
                $return =  array("error" => $wpdb->last_error);
                echo json_encode($return);
            }

            $retorno = array('status' => 200, 'mensagem' => 'Upload realizado com sucesso', 'path' => '/wp-content/plugins/congresso/back-end/img/'.$nome_escudo); 
            echo json_encode($retorno);
        }
    }
}