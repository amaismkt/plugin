<?php require 'partials/header.php'; ?>
<script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

<div class="col-md-10 offset-md-1">
    <div class="alert alert-danger" role="alert" style="display:none" id="alert">
        <h4 class="alert-heading">Ops!</h4>
        <p>Tivemos algum erro na hora de realizar esta operação por favor contate nossos especialistas.</p>        
    </div>

    <h3 style="text-align: center;"><i class="fa fa-calendar"></i> Seus eventos: </h3>

    <div class="row" id="cards-row">
        
    </div>

</div>

<!-- Modal -->
<div style="margin-top: 100px" class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Cadastrar novo evento:</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
            <form id="add-event-form">
                <input type="text" class="form-control" placeholder="Nome do evento..." name="nome" required>
                <button type="submit" id="add-event" style="margin-top: 16px;" class="btn btn-primary">Adicionar</button>
            </form>
        </div>
        <div class="modal-footer">
          <button data-dismiss="modal" type="button" class="btn btn-default">Fechar</button>
        </div>
      </div>
      
    </div>
</div>

<?php require 'partials/footer.php'; ?>