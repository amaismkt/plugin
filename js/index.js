$(document).ready(() => {

    // verfica o campo "Desabilitar download de certificados"
    $.get("../wp-content/plugins/congresso/back-end/verifyBlock.php", data => {
        if(JSON.parse(data).bloqueio == 1){
            $("#desabilitar").attr("checked", true);
        }
    });

    // importa arquivo csv
    $("#botao-importar").click(() => {

        if($("#input_file").val() == ''){
            alert('Nenhum arquivo selecionado!');
            return;
        }

        $("#loading").css('opacity', '1');
        arquivo = $("#input_file")[0].files[0];
        lerCsv(arquivo);

    });

    // salva configurações personalizadas do certificado
    $("#salvar-configuracoes").click(() => {

        $("#config-loader").show();

        if($("#background_image").val() == ''){
            alert('Nenhum arquivo selecionado!');
            return;
        }

        let dados = uploadImage();

        $.ajax({
        url: '../wp-content/plugins/congresso/back-end/storeConfig.php',
        type: 'post',
        data: dados,
        dataType: 'json',
        contentType: false,
        processData: false,
        success: function(response){
            $("#config-loader").hide();
            if(response == 0){
                alert('Ocorreu um erro ao enviar a imagem');
            }else{
                alert('Configurações salvas com sucesso!');
            }
        },
    })

    });
    
    // verifica se o formato do arquivo é CSV
    $('#input_file').change(() => {
    
        var val = $('#input_file').val().toLowerCase(), regex = new RegExp("(.*?)\.(csv)$");
    
        if (!(regex.test(val))) {
            $('#input_file').val('');
            alert('O arquivo selecionado não possui o formato ".csv".');
        }
        
    });

    // toggle entre seções (participantes, certificado)
    $("#botao-participantes").click(() => {
        $("#botao-participantes").prop('disabled', true);
        $("#botao-certificado").prop('disabled', false);
        $("#campo-certificado").hide();
        $("#campo-participantes").fadeIn(300);
    });
    
    $("#botao-certificado").click(() => {
        $("#botao-certificado").prop('disabled', true);
        $("#botao-participantes").prop('disabled', false);
        $("#campo-participantes").hide();
        $("#campo-certificado").fadeIn(300);
    });

    // mostra campo para desabilitar downloads
    $("#desabilitar").change(() => {
        if($("#desabilitar").prop("checked")){
            $("#frase-personalizada").fadeIn(300);
        }else{
            $("#frase-personalizada").fadeOut(300);
            let dados = {frase: "nenhuma", bloqueio:0};

            $.post("../wp-content/plugins/congresso/back-end/blockDownloads.php", dados, response => {
                console.log(response);
            })
            .done(() => { alert("Download de certificados liberado!"); });
        }
    });

    // desabilita downloads e salva frase
    $("#salvar-frase").click(() => {
        let dados = {frase: $("#frase-bloqueio").val()};

        $.post("../wp-content/plugins/congresso/back-end/blockDownloads.php", dados, response => {
            console.log(response);
        })
        .done(() => { alert("Download de certificados bloqueado!"); });
    });
    

});

// faz o upload da imagem de fundo do certificado
function uploadImage()
{
    let fd = new FormData();
    let files = $('#background_image')[0].files[0];
    fd.append('file',files);
    fd.append('titulo', $("#title").val());
    return fd;
}

// LEITURA CSV
function lerCsv(arquivo) 
{

    var reader = new FileReader();
    reader.readAsText(arquivo);
    reader.onload = loadHandler;
    reader.onerror = errorHandler;

}

function loadHandler(event) 
{
    var csv = event.target.result;
    processData(csv);
}

function processData(csv) 
{
    var allTextLines = csv.split(/\r\n|\n/);
    var lines = [];
    for (var i=0; i<allTextLines.length; i++) {
        var data = allTextLines[i].split(';');
            var tarr = [];
            for (var j=0; j<data.length; j++) {
                tarr.push(data[j]);
            }
            lines.push(tarr);
    }
    dados = {data: lines, action: true};
    console.log(dados);
    $.post('../wp-content/plugins/congresso/back-end/store.php', dados,  response => {
    })
    .always(() => {
        $("#loading").css('opacity', '0');
    })
    .fail(() => {
        alert("Algo deu errado durante a importação.");
    })
    .done(() => {
        alert("Importação realizada com sucesso!");
    });
}

function errorHandler(evt) 
{
    if(evt.target.error.name == "NotReadableError") {
        alert("Impossível ler o arquivo.");
    }
}
// FIM LEITURA CSV

// BLOQUEIO DO DOWNLOAD DE CERTIFICADOS

$("#desabilitar").click(() => {

    

});

//