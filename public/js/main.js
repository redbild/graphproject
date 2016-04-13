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
                    html += '<td><button id="graph1_'+ e['graph_name'][row] +'" type="button">Graph 1</button><button id="graph2_'+ e['graph_name'][row] +'" type="button">Graph 2</button></td>\r\n</tr>\r\n';
                }
                $('#table tbody').html(html);

                for(var row in e['graph_name']) {
                    $('#graph1_'+ e['graph_name'][row]).click(function(){
                        visualizeGraph(this.id);
                    });
                    $('#graph2_'+ e['graph_name'][row]).click(function(){
                        visualizeGraph(this.id);
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

    !function(undefined){
        setGraphTable();
    }();
}();

