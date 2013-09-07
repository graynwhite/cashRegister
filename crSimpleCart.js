simpleCart({
  checkout: { 
    type: "SendForm" , 
    url: "sendcart.php" ,
    method: "POST" , 
    extra_data: {
	deptid: simpleCart.deptid,
	clerkid: simpleCart.clerkid,
	pluid: simpleCart.pluid
	}
  },
  cartStyle				: "table",
  cartColumns			: [
						{ attr: "name", label: " Name " },
						{ attr: "deptid", label: " Dept " },
						{ attr: "clerkid", label: " Clerk "},
						{ attr: "pluid", label: " PLU "},
						{ attr: "price", label: " Price ", view: 'currency' },
						{ view: "decrement", label: false },
						{ attr: "quantity", label: "Qty" },
						{ view: "increment", label: false },
						{ attr: "total", label: "SubTotal", view: 'currency' },
						{ view: "remove",  text: "<i class='icon-remove-sign'></i> Remove Product" , label: false  }
						]		
  
});
