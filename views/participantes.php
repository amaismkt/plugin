
<div class="row">
    <div class="col-md-8 offset-md-2" style="margin-top:5%;">
        <div class="row">
            <div class="col-md-12">
                <input type="text" id="pesquisar" placeholder="Pesquisar... " class="form-control">
            </div>
        </div>
        <table id="participantes" class="table table-striped">
            <tr>
                <th>Nome: </th>
                <th>CPF: </th>
                <th>Categoria: </th>
                <th>Carga Horária: </th>
                <th>Mesa Redonda: </th>
                <th>Palestra: </th>
                <th>Excluir </th>
            </tr>
            <?php foreach($participantes as $participante): ?>
            <tr id="participante-<?=$participante->id;?>">
                <td><?=$participante->nome;?></td>
                <td><?=$participante->cpf;?></td>
                <td><?=$participante->categoria;?></td>
                <td><?=$participante->carga_horaria;?></td>
                <td><?=$participante->mesa_redonda;?></td>
                <td><?=$participante->palestra;?></td>
                <td id="<?=$participante->id;?>" onclick="deletar(this);" class="botao-deletar"><i class="fa fa-trash"></i></td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>
</div>

<script src="<?= esc_url( plugins_url( '../js/participantes.js', __FILE__ ) ) ?>"></script>