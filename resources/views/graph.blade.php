<!DOCTYPE html>
<html lang="en">
    <head>
    	<meta charset="UTF-8">
    	{!! Html::style('css/bootstrap.min.css'); !!}
    	{!! Html::style('css/style.css'); !!}
        
        <title>Graph App</title>
    </head>
    <body>

    	<div id="container"></div>
	    <div class="select-button-wrapper text-left col-sm-6">
	    	<input type="file" id="files" name="files[]" multiple />
	    </div>
	    <!--Bottom Script -->
		{!! Html::script('js/jquery-1.12.0.min.js'); !!}
		{!! Html::script('js/bootstrap.min.js'); !!}
		{!! Html::script('js/sigmajs/sigma.min.js'); !!}
		{!! Html::script('js/sigmajs/plugins/sigma.layout.forceAtlas2.min.js'); !!}
		{!! Html::script('js/main.js'); !!}
		{!! Html::script('js/jquery-csv/jquery.csv.js'); !!}

    </body>
</html>