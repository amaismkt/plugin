$('#pesquisar').keyup(() => {

    // Declare variables
    var input, filter, table, tr, td, i, txtValue;
    input = document.getElementById("pesquisar");
    filter = input.value.toUpperCase();
    table = document.getElementById("participantes");
    tr = table.getElementsByTagName("tr");

    // Loop through all table rows, and hide those who don't match the search query
    for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[0];
        if (td) {
        txtValue = td.textContent || td.innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
            tr[i].style.display = "";
        } else {
            tr[i].style.display = "none";
        }
        }
    }
});

function deletar(e)
{
    let r = confirm("Você tem certeza de que deseja excluir os registros deste participante?");
    if(r){
        let id = e.id;
        let dados = {id: id};
    
        $.post('../wp-content/plugins/congresso/back-end/delete.php', dados, response => {
            console.log(response);
        })
        .done(() => {
            $(`#participante-${id}`).fadeOut(300);
        })
        .fail(() => {
            alert("Ocorreu um erro ao deletar!")
        });
    }else{
        return;
    }
}