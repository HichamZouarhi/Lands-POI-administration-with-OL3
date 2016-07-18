$(function() {
	$.ajax({
		url: 'php_scripts/chartData.php',
		type: 'POST',
		dataType: "json",
		success:function(response){
			//console.log(response);
			Morris.Area({
				element: 'morris-area-chart',
				data: response,
				xkey: "day",
				ykeys: ["exprops","lands","estates"],
				labels: ["expropriations","terrains","ribaas"],
				pointSize: 2,
				hideHover: 'auto',
				resize: true
			});
		}
	});	
});
