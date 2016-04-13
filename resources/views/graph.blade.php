<!DOCTYPE html>
<html lang="en">
    <head>
    	<meta charset="UTF-8">
    	{!! Html::style('css/bootstrap.min.css'); !!}
    	{!! Html::style('css/style.css'); !!}
        
        <title>Graph App</title>
    </head>
    <body>
    	<div class="col-sm-12">
    		<div class="col-sm-6">
	    		<div id="container1"></div>
	    	</div>
	    	<div class="col-sm-6">
	    		<div class="col-sm-6" id="container2"></div>
	    	</div>
    	</div>
    	<div class="row">
		    <div class="select-button-wrapper text-left col-sm-3">
		    	<input type="file" id="files" name="files[]" multiple />
		    </div>
		    <div class="col-sm-3">
		    	Graph List
			    <table border="1" id="table" style="width:100%;">
					<thead>
						<th>Graph Name</th>
						<th>Visualize</th>
                    </thead>
                    <tbody>
                    </tbody>
				</table>
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