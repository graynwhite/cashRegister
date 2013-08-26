<!DOCTYPE html> 
<html> 
	<head>

	<title>Maintain TRX table</title> 
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
	
        $('#TRXTableContainer').jtable({
            title: 'Cash Register Transactions',
			pageSize: 10, //Set page size (default: 10)
            actions: {
                listAction: 'TRXlist.php',
                createAction: 'TRXcreate.php',
                updateAction: 'TRXupdate.php',
                deleteAction: 'TRXdelete.php'
            },
            fields: {
                id: {
					key: true,
                    list: false
					
                },
				date: {
                    title: 'date',
                    width: '10%'
                },
                type: {
                    title: 'Type',
                    width: '5%'
                },
                clerkId: {
                    title: 'Clerk',
                    width: '5%'
                },
                deptId: {
                    title: 'Dept',
                    width: '5%',
                    
                },
				pluId: {
                    title: 'PLU',
                    width: '5%',
                    
                },
				descr: {
                    title: 'Description',
                    width: '15%',
                    
                },
				quantity: {
                    title: 'Qty',
                    width: '5%',
                    
                },
				price: {
                    title: 'Price',
                    width: '10%',
                    
                },
				tax: {
                    title: 'Tax Amount',
                    width: '10%',
                    
                },
				amount: {
                    title: 'Trans. Amount',
                    width: '10%',
                    
                }
            }
        });
	$('#TRXTableContainer').jtable('load');	
    });
</script>
<style>
	   @media only screen and (min-width: 1025px){
   
       .ui-page {     width: 600px !important;     margin: 0 auto !important;     position: relative !important;     border-right: 5px #666 outset !important;     border-left: 5px #666 outset !important;
	       }
	</style>	
</head> 
<body>
<div id="TRXTableContainer"></div>
</body>
</html>




