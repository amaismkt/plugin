$(document).ready(() => {
  let events = [];

  $("#add-event-form").submit(() => {
    event.preventDefault();
    const data = $("#add-event-form").serialize();

    $.post("../wp-content/plugins/congresso/back-end/storeNewEvent.php", data)
      .done((data) => {
        getEvents();
        alert("Evento cadastrado com sucesso!");
      })
      .fail((error) => $("#alert").show());
  });

  getEvents = () => {
    $.get("../wp-content/plugins/congresso/back-end/listEvents.php")
      .done((data) => {
        events = data;
        setAddCard();
        events.forEach((element) => makeCard(element.nome, element.id));
      })
      .fail((error) => $("#alert").show());
  };

  setAddCard = () => {
    $("#cards-row").html(`
            <div class="col-md-3" style="margin-bottom: 16px;">
                <div data-toggle="modal" data-target="#myModal" class="event-card">
                    <h4>Adicionar Evento</h4>
                    <i style="font-size: 100px; color: rgba(0, 255, 0, 0.5); padding: 30px 0 20px 0;" class="fa fa-plus"></i>
                </div>
            </div>
        `);
  };

  makeCard = (name, id) => {
    $("#cards-row").append(`
            <div class="col-md-3" id="${id}-card" style="margin-bottom: 16px;">
                <div class="event-card">
                    <div class="event-card-header">
                        <h4>${name}</h4>
                        <i id="${id}" onclick="deleteEvent(this.id)" class="fa fa-trash delete-event-icon"></i>
                    </div>
                    <i style=" font-size: 100px; color: #d1d1d1; padding: 30px 0 20px 0;" class="fa fa-calendar" onclick="editEvent(this.id)" id="${id}"></i>
                </div>
            </div>
        `);
  };

  editEvent = (id) => {
    window.localStorage.setItem("id", id);
    window.location.assign(`?page=evento&evento=${id}`);
  };

  deleteEvent = (id) => {
    let r = confirm("Tem certeza de que deseja excluir este evento?");
    if (!r) return;
    const data = { id: id };
    $.post("../wp-content/plugins/congresso/back-end/deleteEvent.php", data)
      .done((response) => $(`#${id}-card`).fadeOut(400))
      .fail((e) => console.log(e));

    return;
  };

  getEvents();
});
