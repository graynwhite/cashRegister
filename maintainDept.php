<!DOCTYPE html> 
<html> 
	<head>

	<title>Maintain Cash Register Department Table</title> 
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
	
        $('#DeptTableContainer').jtable({
            title: 'Table of Cash Register Departments',
            actions: {
                listAction: 'Deptlist.php',
                createAction: 'Deptcreate.php',
                updateAction: 'Deptupdate.php',
                deleteAction: 'Deptdelete.php'
            },
            fields: {
                id: {
                    key: true,
                    list: false
                },
                name: {
                    title: ' Name',
                    width: '20%'
                },
                taxid1: {
                    title: 'Tax ID 1',
                    width: '10%'
                },
                taxid2: {
                    title: 'Tax ID 2',
                    width: '10%',
                    
                },
				taxid3: {
                    title: 'Tax ID 3',
                    width: '10%',
                    
                },
				taxid4: {
                    title: 'Tax ID 4',
                    width: '10%',
                    
                }
            }
        });
	$('#DeptTableContainer').jtable('load');	
    });
</script>
<style>
	   @media only screen and (min-width: 1025px){
   
       .ui-page {     width: 600px !important;     margin: 0 auto !important;     position: relative !important;     border-right: 5px #666 outset !important;     border-left: 5px #666 outset !important;
	       }
	</style>	
</head> 
<body>
<div id="DeptTableContainer"></div>
</body>
</html>




