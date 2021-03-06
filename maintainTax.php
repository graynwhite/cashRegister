<!DOCTYPE html> 
<html> 
	<head>

	<title>Maintain Cash Register Tax Table</title> 
	<meta name="viewport" content="width=device-width, initial-scale=1"> 
	<link rel="stylesheet" href="http://code.jquery.com/mobile/1.0/jquery.mobile-1.0.min.css" />
	<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css"/>
	<link href="http://www.graynwhite.com/jtable/jtable/lib/themes/metro/blue/jtable.min.css" rel="stylesheet" type="text/css" />
 
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	<script src="http://code.jquery.com/mobile/1.0/jquery.mobile-1.0.min.js"></script>
	<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
	<script src="../jtable/jtable/lib/jquery.jtable.min.js"></script>
	   
	<script type="text/javascript">
    $(document).ready(function () {
	
        $('#TaxTableContainer').jtable({
            title: 'Table of Cash Register Taxes',
            actions: {
                listAction: 'Taxlist.php',
                createAction: 'Taxcreate.php',
                updateAction: 'Taxupdate.php',
                deleteAction: 'Taxdelete.php'
            },
            fields: {
                id: {
					title: 'Tax ID. ',
                    key: true,
                    list: true
                },
                name: {
                    title: ' Name',
                    width: '20%'
                },
                percent: {
                    title: 'Tax Percentage',
                    width: '10%'
                }
                
            }
        });
	$('#TaxTableContainer').jtable('load');	
    });
</script>
<style>
	   @media only screen and (min-width: 1025px){
   
       .ui-page {     width: 600px !important;     margin: 0 auto !important;     position: relative !important;     border-right: 5px #666 outset !important;     border-left: 5px #666 outset !important;
	       }
	</style>	
</head> 
<body>
<div id="TaxTableContainer"></div>
</body>
</html>




