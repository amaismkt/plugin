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
        $nome_escudo_verso = $_FILES['backImg']['name'];
            
        // Essa função move_uploaded_file() copia e verifica se o arquivo enviado foi copiado com sucesso para o destino  
        if (!move_uploaded_file($_FILES['file']['tmp_name'], 'img/'. $nome_escudo)) {
            $retorno = array('status' => 0, 'mensagem' => 'Houve um erro ao gravar arquivo na pasta de destino!'.$_FILES["file"]["error"]); 
            echo json_encode($retorno);
            exit();  
        } else {
            if ($nome_escudo_verso) {
                move_uploaded_file($_FILES['backImg']['tmp_name'], 'img/'. $nome_escudo_verso);
            }

            global $wpdb;

            if(!isset($wpdb)) {
                //the '../' is the number of folders to go up from the current file to the root-map.
                require_once('../../../../wp-config.php');
                require_once('../../../../wp-includes/wp-db.php');
            }

            $info_table_name = $wpdb->prefix."congresso_info";
            $images_table_name = $wpdb->prefix."congresso_images";

            $results = $wpdb->get_row("SELECT * FROM $info_table_name WHERE event_id = ".$_REQUEST['event_id']);

            $dados = array(
                'titulo' => $_REQUEST['titulo'],
                'event_id' => $_REQUEST['event_id'],
                'localidade' => $_REQUEST['localidade'],
                'data_evento' =>$_REQUEST['data_evento'],
                'qrcode_text' => $_REQUEST['qrcode_text']
            );

            $dadosImagens = array(
                'event_id' => $_REQUEST['event_id'],
                'nome_arquivo' => $nome_escudo
            );

            if ($results) {
                $wpdb->update($info_table_name, $dados, array('event_id' => $results->event_id));
            } else {
                $wpdb->insert($info_table_name, $dados);
                $wpdb->insert($images_table_name, $dadosImagens);
                if ($nome_escudo_verso) {
                    $wpdb->insert($images_table_name, array(
                        'event_id' => $_REQUEST['event_id'],
                        'nome_arquivo' => $nome_escudo_verso,
                        'verso' => 1
                    ));
                }
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
} else {
    die("Problema no upload no arquivo.");
}