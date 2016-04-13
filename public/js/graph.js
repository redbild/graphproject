var graphData = [];
var computeGraphOne = true;

function ajaxSetup(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
}

function initSigma() {
    s1 = new sigma({ renderers: [{
                container: document.getElementById('container1'),
                type: 'canvas'
            }]
        });
    s1.settings({
        defaultEdgeType: "curvedArrow",
        minEdgeSize : 0.003,
        maxEdgeSize : 0.1,
        minNodeSize : 0.5,
        maxNodeSize : 5,
    });

    s2 = new sigma({ renderers: [{
                container: document.getElementById('container2'),
                type: 'canvas'
            }]
        });
    s2.settings({
        defaultEdgeType: "curvedArrow",
        minEdgeSize : 0.003,
        maxEdgeSize : 0.1,
        minNodeSize : 0.5,
        maxNodeSize : 5,
    });
}

function addNode(n) {
    if(computeGraphOne) {
        if(s1.graph.nodes(n.id) !== undefined) {
            throw 'Node#' + n.id + '(' + n.label + ')' + ' is duplicated.';
        }
        
        s1.graph.addNode({
            id: n.id,
            label: n.label,
            x: n.x,
            y: n.y,
            size: 0.5,
            color: '#a5adb0',
        })
    } else {
        if(s2.graph.nodes(n.id) !== undefined) {
            throw 'Node#' + n.id + '(' + n.label + ')' + ' is duplicated.';
        }
        
        s2.graph.addNode({
            id: n.id,
            label: n.label,
            x: n.x,
            y: n.y,
            size: 0.5,
            color: '#a5adb0',
        })
    }
}

 function addEdge(e) {
    if(computeGraphOne) {
        if(s1.graph.nodes(e.source) == undefined) {
            throw 'Node#' + e.source + ' is undefined.';
        }
        if(s1.graph.nodes(e.target) == undefined) {
            throw 'Node#' + e.target + ' is undefined.';
        }

        s1.graph.addEdge({
            id: e.id,
            source: e.source,
            target: e.target,
            color: '#a5adb0',
            type: "curvedArrow",
            size: 0.005
        })
    } else {
        if(s2.graph.nodes(e.source) == undefined) {
            throw 'Node#' + e.source + ' is undefined.';
        }
        if(s2.graph.nodes(e.target) == undefined) {
            throw 'Node#' + e.target + ' is undefined.';
        }

        s2.graph.addEdge({
            id: e.id,
            source: e.source,
            target: e.target,
            color: '#a5adb0',
            type: "curvedArrow",
            size: 0.005
        })
    }
}


// function removeNode(n) {
//     s.graph.dropNode(n.id);
// }

function clearGraph() {
    if(computeGraphOne){
        s1.graph.clear();
    } else {
        s2.graph.clear();
    }
}

function plotFullGraph(){
    numIDMapper = {};
    clearGraph();
    //Add all returned nodes to sigma object
    graphData.nodes.forEach(function(node) {
        addNode(node);
        numIDMapper[node.label] = node.id;
    });

    // Add all return edges to sigma object
    graphData.edges.forEach(function(edge) {
        addEdge(edge); 
    });

    // Display Graph using sigma object
    if(computeGraphOne) {
        s1.startForceAtlas2({adjustSizes: true, linLogMode:  true});
        setTimeout(function () {
            s1.killForceAtlas2();
        }, 1000);
    } else {
        s2.startForceAtlas2({adjustSizes: true, linLogMode:  true});
        setTimeout(function () {
            s2.killForceAtlas2();
        }, 1000);
    }
}

function visualizeGraph(graphName) {
    if(graphName.substring(0,6) == "graph1"){
        computeGraphOne = true;
    } else {
        computeGraphOne = false;
    }
    fetchData(graphName.substring(7,graphName.length));
}

function fetchData(graphName) {
    var preparedData = [];
    ajaxSetup();
    $.ajax({
        type: "GET",
        url: "http://localhost/graphproject/public/getGraphData",
        data : {graph_name : graphName},
        success: function(e){
            console.log(e);
            graphData = e;
            plotFullGraph();
        },
        error: function(rs, e){
            console.log(rs.responseText);
            alert('Problem occurs during fetch data.');
        },
        async: false,
    })
}

/**
 *  @brief Main function of this file
 *
 *  @param undefined
 *  @return void
 */
!function(undefined){
    initSigma();
}();

