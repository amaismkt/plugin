$(document).ready(() => {

    $.get("../wp-content/plugins/congresso/back-end/listEvents.php", events => {
        console.log(events)
    })

    $("#add-event-form").submit(() => {
        event.preventDefault()
        let data = $("#add-event-form").serialize()
        console.log(data)

        $.post("../wp-content/plugins/congresso/back-end/storeNewEvent.php", data, response => {
            console.log(response)
        })
    })
    
})