 !function(){

    function ajaxSetup(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    }

    function setGraphTable(){
        var html = '';
        ajaxSetup();
        $.ajax({
            type: "GET",
            url: "http://localhost/graphproject/public/getGraphList",
            data : {},
            success: function(e){
                console.log(e);
                for(var row in e['graph_name']) {
                    html += '<tr>\r\n<td>' + e['graph_name'][row] + '</td>\r\n';
                    html += '<td><button id="graph1_'+ e['graph_name'][row] +'" type="button">Graph 1</button><button id="graph2_'+ e['graph_name'][row] +'" type="button">Graph 2</button><button id="delete_'+ e['graph_name'][row] +'" type="button">Delete</button></td>\r\n</tr>\r\n';
                }
                $('#table tbody').html(html);

                for(var row in e['graph_name']) {
                    $('#graph1_'+ e['graph_name'][row]).click(function(){
                        visualizeGraph(this.id);
                    });
                    $('#graph2_'+ e['graph_name'][row]).click(function(){
                        visualizeGraph(this.id);
                    });
                    $('#delete_'+ e['graph_name'][row]).click(function(){
                        deleteDatabase(this.id);
                    });
                }
            },
            error: function(rs, e){
                console.log(rs.responseText);
                alert('Problem occurs during fetch data.');
            },
            async: false,
        })
    }

    function createDatabase() {
        var label = $('#database_name').val();
        ajaxSetup();
        $.ajax({
            type: "GET",
            url: "http://localhost/graphproject/public/createDatabase",
            data : {database_name: label},
            success: function(e){
                console.log(e);
            },
            error: function(rs, e){
                console.log(rs.responseText);
                alert('Problem occurs during fetch data.');
            },
            async: false,
        })
        setGraphTable();
    }

    function deleteDatabase(databaseName) {
        var label = databaseName.substring(7,databaseName.length);
        ajaxSetup();
        $.ajax({
            type: "GET",
            url: "http://localhost/graphproject/public/deleteDatabase",
            data : {database_name: label},
            success: function(e){
                console.log(e);
            },
            error: function(rs, e){
                console.log(rs.responseText);
                alert('Problem occurs during fetch data.');
            },
            async: false,
        })
        setGraphTable();
    }

    function handleFileSelect(evt) {
        createDatabase();
        var label = $('#database_name').val();
        var files = evt.target.files; // FileList object
        var file = files[0];

        var reader = new FileReader();

        reader.readAsText(file);
        reader.onload = function(event){
            var csv = event.target.result;
            var data = $.csv.toArrays(csv);
            var preparedData = {};

            for(var i = 1; i < data.length; i++) {
                preparedData[data[i][0]] = data[i][1]
            }

            ajaxSetup();
            $.ajax({
                type: "GET",
                url: "http://localhost/graphproject/public/importGraphData",
                data : {graph_data: preparedData, database_name: label},
                success: function(e){
                    console.log(e);
                },
                error: function(rs, e){
                    console.log(rs.responseText);
                    alert('Problem occurs during fetch data.');
                },
                async: false,
            })
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

    !function(undefined){
        setGraphTable();
        $(document).ready(function() {
            if(isAPIAvailable()) {
                $('#files').bind('change', handleFileSelect);
            }
        });
    }();
}();

