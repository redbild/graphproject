<!DOCTYPE html>
<html lang="en">
    <head>
    	<meta charset="UTF-8">
    	{!! Html::style('css/bootstrap.min.css'); !!}
    	{!! Html::style('css/style.css'); !!}
        <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">
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
		    		<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal2">About Us</button>&nbsp;&nbsp;&nbsp;&nbsp;
		    		<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Tutorial</button>
		    		<hr style="margin-top:10px;">
		    	</div>

		    	<!-- upload tool -->
			    <div class="select-button-wrapper text-left col-sm-12" style="top:10px;">
			    	<h4>Upload your data and see what happens!</h4>
			    	Graph Name : <input class="form-control" placeholder="Enter Your Graph's Name. (No more than 12 characters)" type="text" id="database_name">
			    	<input type="file" id="files" name="files[]" multiple style="margin-top:5px;">Choose your file and it's ready to go!</input>
			    	<hr style="margin-top:10px;">
			    </div>

			    <!-- database tool -->
			    <div class="col-sm-12 divcontaintable" style="top:10px;">
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
			    	<div id="container1">
			    		<div class="zoom-section1">
	                        <button class="btn btn-danger" id="zoomin1">
	                            <i class="fa fa-search-plus"></i>
	                        </button>
	                        <button class="btn btn-danger" id="zoomout1">
	                            <i class="fa fa-search-minus"></i>
	                        </button>
	                        <button class="btn btn-danger" id="nozoom1">
	                            <i class="fa fa-refresh"></i>
	                        </button>
	                    </div>
			    	</div>
			    	<div id="container2">
			    		<div class="zoom-section2">
	                        <button class="btn btn-primary" id="zoomin2">
	                            <i class="fa fa-search-plus"></i>
	                        </button>
	                        <button class="btn btn-primary" id="zoomout2">
	                            <i class="fa fa-search-minus"></i>
	                        </button>
	                        <button class="btn btn-primary" id="nozoom2">
	                            <i class="fa fa-refresh"></i>
	                        </button>
	                    </div>
			    	</div>
		    	</div>
		    	<div class="btn-group" role="group">
		    		<button type="button" class="btn btn-default" id="pop1">Graph 1</button>
		    		<button type="button" class="btn btn-default active" id="pop2">Graph 2</button> <!-- graph2 is always in front when open webpage -->
		    	</div>
	    	</div>
		</div>
    	
		<!-- Modal content-->
		<div class="modal fade" id="myModal" role="dialog">
    		<div class="modal-dialog">
			    <div class="modal-content">
			        <div class="modal-header">
			        	<button type="button" class="close" data-dismiss="modal">&times;</button>
			            <h4 class="modal-title">Tutorial</h4>
			        </div>
			        <div class="modal-body">
			            <p style="font-weight:bold;">Import Data</p>
			            <p>1. Fill database name (No more than 12 characters).</p>
			            <p>2. Choose CSV file to import. Import file should have two coloumns of data including source and target of each relation.</p>
			            <p>3. After choosing your file, our system will automatically import your data into Neo4J 	(Graph Database). </p>
			            <br>
			            <p style="font-weight:bold;">Visualize Graphs</p>
			            <p>1. All graphs are listed in graph list table. Choose one or two of them to visualize.<br>
			            Graph one is red color, Graph two is blue color.</p>
			            <p>2. In graph panel, user can zoom in and out of graph one at the bottom left corner, and graph two at bottom right corner.</p>
			            <p>3. User can move wanted graph to the font by choosing graph at the top left corner.</p>

			            <p style="font-weight:bold; color:red;">Note : Time depend on size of the data.</p>
			        </div>
			        <div class="modal-footer">
			            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
			        </div>
			    </div>
			</div>
    	</div>
    	<div class="modal fade" id="myModal2" role="dialog">
    		<div class="modal-dialog">
			    <div class="modal-content">
			        <div class="modal-header">
			        	<button type="button" class="close" data-dismiss="modal">&times;</button>
			            <h4 class="modal-title">About Us</h4>
			        </div>
			        <div class="modal-body">
			            <p style="font-weight:bold;">2110593 Web Programming (2/2015) Final Project</p>
			            <p>5530166321 Nattapon Werayawarangura</p>
			            <p>5531024021 Tittasin Sukcharoen</p>
			            <p style="font-weight:bold;">Powered by</p>
			            <img src="pic/laravel.png" class="img-rounded pull-left" style="width:100px;height:100px;">
			            <img src="pic/sigmajs.png" class="img-rounded pull-left" style="width:100px;height:100px;">
			            <img src="pic/neo4j_logo.png" class="img-rounded pull-left" style="width:100px;height:100px;">
			            <img src="pic/bootstrap.png" class="img-rounded pull-left" style="width:100px;height:100px;">
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