var margin = {
    top: 20,
    right: 10,
    bottom: 20,
    left: 50
};
var width = document.getElementById('viz').offsetWidth*0.7 - margin.left - margin.right;
var height = width / 2 - margin.top - margin.bottom;
var svg = d3.select('#viz').append('svg')
    .attr('width', document.getElementById('viz').offsetWidth + margin.left + margin.right)
    .attr('height', height + margin.top + margin.bottom)
    .append('g')
    .attr("transform", "translate(" + margin.left + "," + margin.top + ")");


var teams; 
var max_points; 


var y = d3.scaleLinear().range([height, 0]);
var x = d3.scaleLinear().range([0, width]);

var valueline = d3.line() 
    .x(function(d) {
        return x(d[0]);
    })
    .y(function(d) {
        return y(d[1]);
    });

var line_points = []; 
var team_colors = {}; 


svg.append("g")
    .attr('class', 'x-axis')
    .attr("transform", "translate(0," + height + ")")
    .style('stroke', '#757575')
    .style('stroke-width', '0.7px')
    .style('font-size', '11px')
    .call(d3.axisBottom(x));
svg.append("g")
    .attr('class', 'y-axis')
    .attr('fill', '#757575')
    .style('font-size', '17px')
    .call(d3.axisLeft(y));

var g; 
var c;
var l;
var line = {}; // Dict containing all lines
var points = {}; // Dict containing all points
var fd;

create_line_graph();
// create_years();

function create_line_graph() {
    line = {};
    points = {};

    $("#ipl-lines").remove(); // remove all lines already present
    $("#ipl-legend").remove(); // remove all legend already present

    d3.csv('data/' + 'scorelist' + '.csv', function(full_data) {

        data = full_data;
        fd = $.extend(true, [], full_data);

        g = svg.append('g')
            .attr('id', 'ipl-lines');
        c = g.append('g')
            .selectAll('circle')
            .data(data)
            .enter();
        l = svg.append('g')
            .attr('id', 'ipl-legend');

        teams = Object.keys(data[0]); 
        for (i = 0; i < teams.length; i++) {
            if (teams[i].split('_')[1] == "comments") {
                teams = removeA(teams, teams[i]);
            }
        }
        teams.forEach(function(d) { 
            data.forEach(function(i) {
                i[d] = +i[d];
            })
        })
        teams = removeA(teams, 'match'); 
        max_points = 0;
        for (i in teams) { 
            if (parseInt(data[data.length - 1][teams[i]]) > max_points) {
                max_points = parseInt(data[data.length - 1][teams[i]])
            }
        }
        x.domain([0, 17]);
        for (i in teams) { 
            team_colors[teams[i]] = d3.scaleOrdinal(d3.schemeCategory10).range()[i]; 
        }
        teams.forEach(function(t) { 
            data.forEach(function(d) {
                line_points.push([d['match'], 0]);
            })
            line[t] = g.append('path') // Create Line
                .attr('class', 'ipl_line-' + valid_id(t))
                .attr('stroke', team_colors[t])
                .attr('fill', 'none')
                .attr('stroke-width', '3px')
                .attr('opacity', '0.5')
                .attr("d", valueline(line_points));

            
            line_points = [];

           
            l.append('text')
              .attr('id', 'legend-' + valid_id(t))
              .attr('x', width + 20)
              .attr('y', height - (teams.indexOf(t) + 1)/teams.length*height)
              .style('font-size', '17px')
              .style('cursor', 'default')
              .attr('fill', team_colors[t])
              .text(t)
        });
        
        create_transition();
    });

}

function create_transition() {

    points_mode = true;
    if (points_mode == true) {
        y.domain([0, max_points]);
        d3.select('.y-axis')
            .call(d3.axisLeft(y).ticks(max_points / 2));
        get_points_data(fd);
    } else {
        console.log(team.length)
        y.domain([teams.length, 1]);
        d3.select('.y-axis')
            .call(d3.axisLeft(y).ticks(teams.length));
        data = get_ranking_data(data);
    }

    teams.forEach(function(t) {
        //Create transition of lines
        data.forEach(function(d) {
            line_points.push([d['match'], d[t]]);
        });
        line[t]
            .attr("d", valueline(line_points));
        
        line_points = [];

        if(points_mode != true){
          d3.select('#legend-' + valid_id(t))
              .attr('y', y(data[data.length-1][t]));
        }
    });

    d3.select('.x-axis')
        .call(d3.axisBottom(x));

}




function removeA(arr) {
    
    var what, a = arguments,
        L = a.length,
        ax;
    while (L > 1 && arr.length) {
        what = a[--L];
        while ((ax = arr.indexOf(what)) !== -1) {
            arr.splice(ax, 1);
        }
    }
    return arr;
}

function valid_id(name) {
    if (name) {
        var n = name.replace('&', '')
        n = n.split(' ').join('');
        n = n.split('.').join('');
        n = n.split(',').join('');
        n = n.split('/').join('');
        n = n.toLowerCase();
        return n;
    }
}

function get_ranking_data(full_data) {
    var k = [];
    var d = {};
    var res = full_data;
    res.forEach(function(i) {
        teams.forEach(function(t) {
            d[t] = i[t];
        });
        var items = Object.keys(d).map(function(key) {
            return [key, d[key]];
        });
        items.sort(function(first, second) {
            return second[1] - first[1];
        });
        k.push(items)
    })

    for(i in k) {
        for (j in k[i]) {
            res[i][k[i][j][0]] = (parseInt(j)) + 1;
        }
    }
    return res;
}

function get_points_data(fd) {
    for (i in fd) {
        for (j in fd[i]) {
            data[i][j] = fd[i][j];
        }
    }
    return data;
}
d3.selection.prototype.moveToFront = function() {
    return this.each(function() {
        this.parentNode.appendChild(this);
    });
};