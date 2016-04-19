<!DOCTYPE html>
<html lang="en">
    <head>
    	<meta charset="UTF-8">
    	{!! Html::style('css/bootstrap.min.css'); !!}
    	{!! Html::style('css/style.css'); !!}
        
        <title>Graph App</title>
    </head>
    <body>
    	<div class="row">
	    	<div class="col-sm-4" id="controller">
	    		<!-- header content -->
		    	<div class="col-sm-12" style="top:20px;">
		    		<img src="pic/neo4j_logo.png" class="img-rounded pull-right">
		    		<h1>Graph Visualize</h1>
		    		<h3>Data Relatiohship Visualized by Neo4j</h3>
		    		<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal2">About</button>
		    		<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Tutorial</button>
		    	</div>

		    	<!-- upload tool -->
			    <div class="select-button-wrapper text-left col-sm-12"><h3>Upload your data and see what happens!</h3>
			    	Graph Name : <input class="form-control" placeholder="Please Enter Your Graph's Name" type="text" id="database_name">
			    	<input type="file" id="files" name="files[]" multiple />
			    </div>

			    <!-- database tool -->
			    <div class="col-sm-12">
			    	Graph List	
				    <table class="table table-hover" border="1" id="table" style="width:100%;">
						<thead>
							<th>Graph Name</th>
							<th>Visualize</th>
	                    </thead>
	                    <tbody>
	                    </tbody>
					</table>
				</div>
			</div>

			<div class="col-sm-8">
	    		<!-- Graph Content -->
		    	<div class="col-sm-12">
			    	<div id="container1"></div>
			    	<div id="container2"></div>
		    	</div>
		    	<div class="col-sm-12">
		    		<button type="button" class="btn btn-info btn-lg" id="pop1">Graph 1</button>
		    		<button type="button" class="btn btn-info btn-lg" id="pop2">Graph 2</button>
		    	</div>
	    	</div>
		</div>
    	


		<!-- Modal content-->
		<div class="modal fade" id="myModal" role="dialog">
    		<div class="modal-dialog">
			    <div class="modal-content">
			        <div class="modal-header">
			        	<button type="button" class="close" data-dismiss="modal">&times;</button>
			            <h4 class="modal-title">Modal Header</h4>
			        </div>
			        <div class="modal-body">
			            <p>Some text in the modal.</p>
			        </div>
			        <div class="modal-footer">
			            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			        </div>
			    </div>
			</div>
    	</div>
    	<div class="modal fade" id="myModal2" role="dialog">
    		<div class="modal-dialog">
			    <div class="modal-content">
			        <div class="modal-header">
			        	<button type="button" class="close" data-dismiss="modal">&times;</button>
			            <h4 class="modal-title">Modal Header2</h4>
			        </div>
			        <div class="modal-body">
			            <p>some text (ABOUT).</p>
			        </div>
			        <div class="modal-footer">
			            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			        </div>
			    </div>
			</div>
    	</div>
	    <!--Bottom Script -->
		{!! Html::script('js/jquery-1.12.0.min.js'); !!}
		{!! Html::script('js/bootstrap.min.js'); !!}
		{!! Html::script('js/sigmajs/sigma.min.js'); !!}
		{!! Html::script('js/sigmajs/plugins/sigma.layout.forceAtlas2.min.js'); !!}
		{!! Html::script('js/graph.js'); !!}
		{!! Html::script('js/main.js'); !!}
		{!! Html::script('js/jquery-csv/jquery.csv.js'); !!}

    </body>
</html>