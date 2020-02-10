$(document).ready(() => {

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

        if($("#background_image").val() == ''){
            alert('Nenhum arquivo selecionado!');
            return;
        }

        uploadImage();

        let dados = $("#configuracoes").serialize();

        $.post("../wp-content/plugins/congresso/back-end/storeConfig.php", dados, response => {
            console.log(response);
        });

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

});

// faz o upload da imagem de fundo do certificado
function uploadImage()
{
    let fd = new FormData();
    let files = $('#background_image')[0].files[0];
    fd.append('file',files);

    $.ajax({
        url: '../wp-content/plugins/congresso/back-end/storeConfig.php',
        type: 'post',
        data: fd,
        contentType: false,
        processData: false,
        success: function(response){
            if(response == 0){
                alert('Ocorreu um erro ao enviar a imagem');
            }
        },
    })
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