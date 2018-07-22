var $ = jQuery;

var dataArrayGenerator = function(length) {
    var i, array = [];
    for (i = 0; i < length; i++) {
        array.push([]);
    }

    return array;
};


var teamData = dataArrayGenerator(8);
var barData = {};
var channels = [];


var gEvents = [];
var instance_id;

$.getJSON(urlGenerator('matches')).then(function(data) {
    instance_id = data[0].instance_id;
    channels = data[0].channels;

    $.when(
            $.ajax(customSettings(urlGenerator('get-index-data'), instance_id, channels[0])),
            $.ajax(customSettings(urlGenerator('get-index-data'), instance_id, channels[1])),
            $.ajax(customSettings(urlGenerator('events'), instance_id, ""))
        )
        .done(function(team1, team2, events) {
            console.log("HEllo");
            pushData(team1, 0);
            pushData(team2, 2);
            pushEventData(events);
            lineGraph();
            bargraph();

            // console.log(event);
            console.log(gEvents);


            // updateData();
            // console.log(channels);
            // console.log(barData);

        });
});


$(".ui-data-element").click(function(event) {

    var clicked = $(this).attr('id');
    var element = clicked.split('-')[0];
    var clickedIndex = clicked.split('-')[1];
    // console.log(element);

    $("#pointing-" + element).css({
        "padding-bottom": "0"
    });

    $.each($('.ui-data-element'), function() {
        $(this).fadeTo(0, 1);
    });


    var playerOrTeam = element == "player" ? "player" : "team";
    var notClicked = clickedIndex == "1" ? "2" : "1";

    $("#" + clicked).fadeTo(0, 1);
    $("#" + element + "-" + notClicked).fadeTo("slow", 0.5);
    $(".up-arrow").hide();
    $("#" + clicked + "-arrow").show();

    if (playerOrTeam == "player") {

        // console.log("player");


    } else {
        clickedIndex == "1" ? generateGraphs(0, 2) : generateGraphs(2, 4)
    }


    function generateGraphs(start, end) {
        clearGraph();
        clearIntervals();
        scatterGraph(start, end);
        lineGraph(start, end);

    }

    var timelineTop = $("#timeline-container").offset().top;
    $('html, body').animate({
        scrollTop: timelineTop
    }, 500);

});




function updateData() {
    var x = 1496570109000;
    setInterval(
        function() {

            barData[channels[0]] = [Math.random(), Math.random()];
            barData[channels[1]] = [Math.random(), Math.random()];

            bargraph();

            for (var i = 0; i < 4; i++) {

                teamData[i].shift();
            }
            teamData[0].push({ 'x': x + 1000, 'y': Math.random() * 10, 'channel': "ind" });
            teamData[1].push({ 'x': x + 1000, 'y': Math.random(), 'channel': "ind" });
            teamData[2].push({ 'x': x + 1000, 'y': Math.random(), 'channel': "pak" });
            teamData[3].push({ 'x': x + 1000, 'y': Math.random(), 'channel': "pak" });

            x = x + 1000;

            console.log("PD");
        },
        1000);



    // d3.csv("data-alt.csv", function(error, data) {
    //     data.forEach(function(d) {
    //         d.date = parseDate(d.date);
    //         d.close = +d.close;
    //     });

    //     // Scale the range of the data again 
    //     x.domain(d3.extent(data, function(d) { return d.date; }));
    //     y.domain([0, d3.max(data, function(d) { return d.close; })]);

    //     // Select the section we want to apply our changes to
    //     var svg = d3.select("body").transition();

    //     svg.select(".line") // change the line
    //         .duration(750)
    //         .attr("d", valueline(data));
    //     svg.select(".x.axis") // change the x axis
    //         .duration(750)
    //         .call(xAxis);
    //     svg.select(".y.axis") // change the y axis
    //         .duration(750)
    //         .call(yAxis);

    // });
}

function bargraph() {
    //Width and height
    var w = 110;
    var h = 50;
    var barPadding = 5;

    $.each($('.bar'), function(index, element) {
        var key = channels[index];

        var dataset = barData[key];
        // console.log(dataset);

        if (dataset) {

            var sum = dataset.reduce((a, b) => a + b, 0);

            var tip = d3.tip()
                .attr('class', 'd3-tip')
                .offset([-10, 0])
                .html(function(d, i) {
                    if (i == 0) {
                        return "<span style='color:red'>" + Math.round((d / sum) * 100) + "%</span>";
                    } else {
                        return "<span style='color:green'>" + Math.round((d / sum) * 100) + "%</span>";
                    }

                });


            $('.d3-tip').hide();
            $(element).empty();

            var svg = d3.select("#" + $(element).attr("id"))
                .append("svg")
                .attr("width", w)
                .attr("height", h);

            svg.call(tip);

            var rect = svg.selectAll("rect")
                .data(dataset)
                .enter()
                .append("rect")
                .attr("height", function(d) {
                    return 50;
                })
                .attr("x", function(d, i) {
                    return (i * dataset[0] / sum) * 100 + i * barPadding;
                })
                .attr("y", 0)
                .attr("width", function(d) {
                    return (d / sum) * 100;
                })
                .attr("fill", function(d, i) {
                    if (i == 0) {
                        return "red"
                    } else {
                        return "green"
                    }
                })
                .on('mouseover', tip.show)
                .on('mouseout', tip.hide);
        }


    });


}

function drawdata(svg, dataset) {

}


function lineGraph(start, end, specific) {
    start = start || 0;
    end = end || 4;
    specific = specific || false;

    var series = [];

    var palette = new Rickshaw.Color.Palette({
        scheme: 'classic9'
    });

    var pushData = function() {
        series = [];
        for (var i = start; i < end; i++) {
            series.push({
                color: palette.color(),
                data: teamData[i],
                name: teamData[i][0].channel.charAt(0).toUpperCase() + teamData[i][0].channel.slice(1)
            });

        }
    };

    pushData();

    var graph = new Rickshaw.Graph({
        element: document.getElementById("line"),
        width: 1100,
        height: 500,
        renderer: 'line',
        stroke: true,
        preserve: true,
        interpolation: 'bundle',
        series: series
    });


    graph.render();


    var preview = new Rickshaw.Graph.RangeSlider({
        graph: graph,
        element: document.getElementById('line_slider'),
    });

    var hoverDetail = new Rickshaw.Graph.HoverDetail({
        graph: graph,
        xFormatter: function(x) {
            var d = new Date(0);
            d.setUTCSeconds(x / 1000);
            return d.getHours() + ":" + d.getMinutes() + ":" + d.getSeconds();
        }
    });

    var annotator = new Rickshaw.Graph.Annotate({
        graph: graph,
        element: document.getElementById('timeline')
    });

    var legend = new Rickshaw.Graph.Legend({
        graph: graph,
        element: document.getElementById('line_legend')

    });

    var shelving = new Rickshaw.Graph.Behavior.Series.Toggle({
        graph: graph,
        legend: legend
    });

    var order = new Rickshaw.Graph.Behavior.Series.Order({
        graph: graph,
        legend: legend
    });

    var highlighter = new Rickshaw.Graph.Behavior.Series.Highlight({
        graph: graph,
        legend: legend
    });



    var ticksTreatment = 'glow';

    var xAxis = new Rickshaw.Graph.Axis.X({
        graph: graph,
        tickFormat: function(x) {
            var d = new Date(0);
            d.setUTCSeconds(x / 1000);
            return d.getHours() + ":" + d.getMinutes() + ":" + d.getSeconds();

        }

    });

    xAxis.render();

    var yAxis = new Rickshaw.Graph.Axis.Y({
        graph: graph
    });

    yAxis.render();

    setInterval(function() {
        pushData();
        graph.update();
    }, 10000);


    $.each(gEvents, function(index, element) {


        annotator.add(teamData[2][teamData[2].length - 1].x, element.y);
        annotator.update();

    });

}

function scatterGraph(start, end, specific) {
    start = start || 0;
    end = end || 4;
    specific = specific || false;

    var series = [];

    var palette = new Rickshaw.Color.Palette({
        scheme: 'classic9'
    });


    for (i = start; i < end; i++) {
        series.push({
            color: palette.color(),
            data: teamData[i],
            name: teamData[i][0].channel.charAt(0).toUpperCase() + teamData[i][0].channel.slice(1)
        });

    }

    var graph = new Rickshaw.Graph({
        element: document.getElementById("scatter"),
        width: 1100,
        height: 500,
        renderer: 'scatterplot',
        stroke: true,
        preserve: true,
        series: series
    });



    graph.render();

    var preview = new Rickshaw.Graph.RangeSlider({
        graph: graph,
        element: document.getElementById('scatter_slider'),
    });

    var hoverDetail = new Rickshaw.Graph.HoverDetail({
        graph: graph,
        xFormatter: function(x) {
            var d = new Date(0);
            d.setUTCSeconds(x / 1000);
            return d.getHours() + ":" + d.getMinutes() + ":" + d.getSeconds();
        }
    });

    var annotator = new Rickshaw.Graph.Annotate({
        graph: graph,
        element: document.getElementById('timeline')
    });

    var legend = new Rickshaw.Graph.Legend({
        graph: graph,
        element: document.getElementById('scatter_legend')

    });

    var shelving = new Rickshaw.Graph.Behavior.Series.Toggle({
        graph: graph,
        legend: legend
    });

    var order = new Rickshaw.Graph.Behavior.Series.Order({
        graph: graph,
        legend: legend
    });

    var highlighter = new Rickshaw.Graph.Behavior.Series.Highlight({
        graph: graph,
        legend: legend
    });



    var ticksTreatment = 'glow';

    var xAxis = new Rickshaw.Graph.Axis.X({
        graph: graph,
        tickFormat: function(x) {
            var d = new Date(0);
            d.setUTCSeconds(x / 1000);
            return d.getHours() + ":" + d.getMinutes() + ":" + d.getSeconds();

        }

    });

    xAxis.render();

    var yAxis = new Rickshaw.Graph.Axis.Y({
        graph: graph
    });

    yAxis.render();

    // var timer = setInterval(function() {
    //     $.when(
    //             $.ajax(customSettings(instance_id, teamData[0][0].team), -1),
    //             $.ajax(customSettings(instance_id, teamData[2][0].team), -1)
    //         )
    //         .done(function(team1, team2) {
    //             console.log("Chala");
    //             pushData(team1, 0);
    //             pushData(team2, 2);
    //             graph.update();
    //         });

    // }, 10000);
    // console.log(team1);

    // setInterval(function() {
    //     $.when($.ajax(customSettings(instance_id, teams[0])), $.ajax(customSettings(instance_id, teams[1])))
    //         .done(function(team1, team2) {
    //             pushData(team1, 0);
    //             pushData(team2, 2);
    //             lineGraph();
    //         });

    // }, 10000);



    // var controls = new RenderControls({
    //     element: document.querySelector('form'),
    //     graph: graph
    // });

    // add some data every so often

    // var messages = [
    //     "That's a Six",
    //     "Wicket!",
    // ];

    // function addAnnotation(force) {
    //     if (messages.length > 0 && (force || Math.random() >= 0.95)) {
    //         annotator.add(teamData[2][teamData[2].length - 1].x, messages.shift());
    //         annotator.update();
    //     }
    // }

    // addAnnotation(true);

}



function clearIntervals() {

    var killId = setTimeout(function() {
        for (var i = killId; i > 0; i--) clearInterval(i)
    }, 10000);

}

function clearGraph() {
    $('#line_legend, #scatter_legend').empty();
    $('#line, #timeline, #line_slider, #scatter, #scatter_slider').empty();
}

function pushData(response, indexOfSeries) {
    var object = response[0];
    var channel = Object.keys(object)[1 - Object.keys(object).indexOf('instance_id')];

    var keysSorted = Object.keys(object[channel]).map(Number).sort();
    console.log(keysSorted);
    var maxKey = keysSorted[keysSorted.length - 1];

    // Line Chart Data
    $.each(keysSorted, function(index, timestamp) {

        teamData[indexOfSeries].push({
            x: object[channel][timestamp].reaction_index.time,
            y: object[channel][timestamp].reaction_index.pos,
            channel: channel

        });

        teamData[indexOfSeries + 1].push({
            x: object[channel][timestamp].reaction_index.time,
            y: object[channel][timestamp].reaction_index.neg,
            channel: channel

        });
    });

    barData[channel] = [
        object[channel][maxKey].reaction_index.neg,
        object[channel][maxKey].reaction_index.pos
    ];
}

function pushEventData(response) {

    var events = response[0];

    $.each(events, function(index, element) {
        gEvents.push({

            x: element.seconds,
            y: element.event
        });
    });
}

function customSettings(url, id, channel, second) {
    second = second || 0;
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
        "data": JSON.stringify({
            "instance_id": id,
            "channel": channel,
            "last_second": second
        })
    };
}

function urlGenerator(url) {
    return "http://bubble.social/" + url;
}