var $ = jQuery;

var data = {
    "name": "",
    "index": {},
    "channels": {},
    "event_type": "cricket-match",
    "events": { "balls": [] },
    "time": ""
};




$('.form-details').hide();

$('#event-btn').click(function(event) {

    event.preventDefault();

    $('#event').hide();
    var nameOfEvent = $('#nameOfEvent').val();
    data.name = nameOfEvent;
    $("#preview").val(prettyPrint(data));
    $('#event-btn').hide();
    $('.form-details').show();


});

$('#type').on('change', function() {

    if (this.value == "team") {
        $('#team-container').hide();

    } else {
        $('#team-container').show();
    }
});

$('#submit').click(function(event) {
    var type = $('#type').val(),
        name = $('#name').val(),
        key = name.toLowerCase().replace(" ", "_"),
        team = $('#team').val().toLowerCase().replace(" ", "_"),
        keywords = $('#keywords').val().split(","),
        url = $('#url').val();

    data.channels[key] = getObject(name, type, url, keywords, team);

    $("#details-submit").html(name + " details stored");

    $.each($('.data'), function(index, element) {
        $(element).val('');
    });

    $('#nameOfEvent').hide();

    $("#preview").val(prettyPrint(data));

});


$('#add-to-db').click(function(event) {

    event.preventDefault();

    $.ajax(customSettings(urlGenerator('add-match-details'), data))
        .done(function() {
            console.log("POSTED");
        })
        .fail(function(jqXHR, textStatus, errorThrown) {

            console.log("ERROR");
            console.log(jqXHR);
            console.log(textStatus);
            console.log(errorThrown);
        });
});

function getObject(name, type, url, keywords, team) {

    team = team || null;

    return {
        "name": name,
        "team": team,
        "type": type,
        "img_url": url,
        "keywords": keywords
    };

}


function prettyPrint(object) {

    var pretty = JSON.stringify(object, undefined, 4);
    return pretty;
}


function customSettings(url, object) {

    object.time = Math.round(Date.now() / 1000);

    console.log("Time Posted " + object.time);

    return {
        "async": true,
        "crossDomain": true,
        "url": url,
        "type": "POST",
        "method": "POST",
        "headers": {
            "content-type": "application/json",
            "cache-control": "no-cache",
        },
        "processData": false,
        "data": JSON.stringify(object)
    };
}

function urlGenerator(url) {
    return "http://ec2-54-186-88-186.us-west-2.compute.amazonaws.com:5000/" + url;
}