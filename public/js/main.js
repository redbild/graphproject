 !function(){
    var graphData = [];
    var node_id = {};

    function initSigma() {
        s = new sigma({ renderers: [{
                    container: document.getElementById('container'),
                    type: 'canvas'
                }]
            });
        s.settings({
            defaultEdgeType: "curvedArrow",
            minEdgeSize : 0.003,
            maxEdgeSize : 0.1,
            minNodeSize : 0.5,
            maxNodeSize : 5,
        });
    }

    function addNode(n) {

        if(s.graph.nodes(n.id) !== undefined) {
            throw 'Node#' + n.id + '(' + n.label + ')' + ' is duplicated.';
        }
        
        s.graph.addNode({
            id: n.id,
            label: n.label,
            x: n.x,
            y: n.y,
            size: 0.5,
            color: '#a5adb0',
        })
    }

     function addEdge(e) {
        if(s.graph.nodes(e.source) == undefined) {
            throw 'Node#' + e.source + ' is undefined.';
        }
        if(s.graph.nodes(e.target) == undefined) {
            throw 'Node#' + e.target + ' is undefined.';
        }

        s.graph.addEdge({
            id: e.id,
            source: e.source,
            target: e.target,
            color: '#a5adb0',
            type: "curvedArrow",
            size: 0.005
        })
    }


    function removeNode(n) {
        s.graph.dropNode(n.id);
    }

    function clearGraph() {
        s.graph.clear();
    }

    function plotFullGraph(){
        numIDMapper = {};
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
        s.startForceAtlas2({adjustSizes: true, linLogMode:  true});

        setTimeout(function () {
            s.killForceAtlas2();
        }, 1000);
    }

    function handleFileSelect(evt) {
        var files = evt.target.files; // FileList object
        var file = files[0];

        var reader = new FileReader();

        reader.readAsText(file);
        reader.onload = function(event){
            var csv = event.target.result;
            var data = $.csv.toArrays(csv);
            var preparedData = {};

            var nid = 1;
            for(var i = 1; i < data.length; i++) {
                node_id[data[i][0]] = nid;
                nid++;
                node_id[data[i][1]] = nid;
                nid++;
            }

            var node_data = [];
            for(i in node_id){ 
                var user_info = {
                    "label": i,
                    "id" : node_id[i],
                    "x" : Math.floor((Math.random() * 10) + 1),
                    "y" : Math.floor((Math.random() * 10) + 1),
                    "color" : '#a5adb0',
                    "size" : 1
                };
                node_data.push(user_info);
            }
            var eid = 10000;
            var edge_data = [];
            for(var i = 1; i < data.length; i++) {
                var edge_info = {
                    "label" : "",
                    "id" : eid,
                    "source" : node_id[data[i][0]],
                    "target" : node_id[data[i][1]],
                    "color" : '#a5adb0',
                    "size" : 1
                };
                eid++;
                edge_data.push(edge_info);
            }

            preparedData["nodes"] = node_data;
            preparedData["edges"] = edge_data;
            clearGraph();
            graphData = preparedData;
            console.log(graphData);
            plotFullGraph();
        }
        reader.onerror = function(){ alert('Unable to read ' + file.fileName); };
    }

    function isAPIAvailable() {
        // Check for the various File API support.
        if (window.File && window.FileReader && window.FileList && window.Blob) {
            // Great success! All the File APIs are supported.
            return true;
        } else {
            // source: File API availability - http://caniuse.com/#feat=fileapi
            // source: <output> availability - http://html5doctor.com/the-output-element/
            document.writeln('The HTML5 APIs used in this form are only available in the following browsers:<br />');
            // 6.0 File API & 13.0 <output>
            document.writeln(' - Google Chrome: 13.0 or later<br />');
            // 3.6 File API & 6.0 <output>
            document.writeln(' - Mozilla Firefox: 6.0 or later<br />');
            // 10.0 File API & 10.0 <output>
            document.writeln(' - Internet Explorer: Not supported (partial support expected in 10.0)<br />');
            // ? File API & 5.1 <output>
            document.writeln(' - Safari: Not supported<br />');
            // ? File API & 9.2 <output>
            document.writeln(' - Opera: Not supported');
            return false;
        }
    }

    /**
     *  @brief Main function of this file
     *
     *  @param undefined
     *  @return void
     */
    !function(undefined){
        initSigma();
        $(document).ready(function() {
            if(isAPIAvailable()) {
                $('#files').bind('change', handleFileSelect);
            }
        });

    }();
}();

