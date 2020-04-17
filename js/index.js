$(document).ready(() => {
    let events = []

    $("#add-event-form").submit(() => {
        event.preventDefault()
        const data = $("#add-event-form").serialize()

        $.post("../wp-content/plugins/congresso/back-end/storeNewEvent.php", data)
            .done(data => getEvents())
            .fail(error => $('#alert').show())
    })

    getEvents = () => {
        $.get("../wp-content/plugins/congresso/back-end/listEvents.php")
        .done( data => {
            events = JSON.parse(data)
            setAddCard()
            events.forEach(element => makeCard(element.nome, element.id))
        })
        .fail( error => $('#alert').show())
    }

    setAddCard = () => {
        $("#cards-row").html(`
            <div class="col-md-3" style="margin-bottom: 16px;">
                <div data-toggle="modal" data-target="#myModal" class="event-card">
                    <h4>Adicionar Evento</h4>
                    <i style="font-size: 100px; color: rgba(0, 255, 0, 0.5); padding: 30px 0 20px 0;" class="fa fa-plus"></i>
                </div>
            </div>
        `)
    }

    makeCard = (name, id) => {
        $("#cards-row").append(`
            <div class="col-md-3" id="${id}-card" style="margin-bottom: 16px;">
                <div class="event-card" onclick="editEvent(this.id)" id="${id}">
                    <div class="event-card-header">
                        <h4>${name}</h4>
                        <i id="${id}" onclick="deleteEvent(this.id)" class="fa fa-trash delete-event-icon"></i>
                    </div>
                    <i style="font-size: 100px; color: #d1d1d1; padding: 30px 0 20px 0;" class="fa fa-calendar"></i>
                </div>
            </div>
        `)
    }

    editEvent = id => {
        alert("AIAIAI FUI ACIONADO")
    }
    
    deleteEvent = id => {
        $(`#${id}-card`).fadeOut(400)
        let flag = true;
        return
    }

    getEvents()

})