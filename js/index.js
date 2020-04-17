$(document).ready(() => {
    let events = [];

    $("#add-event-form").submit(() => {
        event.preventDefault()
        const data = $("#add-event-form").serialize();

        $.post("../wp-content/plugins/congresso/back-end/storeNewEvent.php", data)
            .done(data => getEvents())
            .fail(error => $('#alert').show());
    })

    getEvents = () => {
        deleteChild();
        $.get("../wp-content/plugins/congresso/back-end/listEvents.php")
        .done( data => {
            events = JSON.parse(data);
            events.forEach(element => makeCard(element.nome));
        })
        .fail( error => $('#alert').show());
    }
    

    makeCard = (name) => {
        const row = document.getElementById("cards-row");

        const card = document.createElement('div');
        card.className = "card bg-light mb-3 col-4";


        const cardBody = document.createElement("div");
        cardBody.className = "card-body";

        const cardTitle = document.createElement("h4");
        cardTitle.className = "card-title";

        const text = document.createTextNode(name);
        
        cardTitle.appendChild(text);
        cardBody.appendChild(cardTitle);
        card.appendChild(cardBody);
        row.appendChild(card);
    }

    deleteChild = () => { 
        let e = document.querySelector("div#cards-row"); 
        const child = e.lastElementChild;
        while (child) { 
            e.removeChild(child); 
            child = e.lastElementChild; 
        } 
    } 
    

    getEvents();

})