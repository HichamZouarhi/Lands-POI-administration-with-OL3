var basemap = new ol.layer.Tile({
        source: new ol.source.OSM()
      });

var map = new ol.Map({
	layers: [basemap],
	target: 'map',
	view: new ol.View({
		projection: "http://www.opengis.net/gml/srs/epsg.xml#4326",
        center: [-7.5607, 33.3770],
        zoom: 10
	})
});

var sphere = new ol.Sphere(6378137);//the geodesic sphere to compute area of polygons
var formatGeoJSON=new ol.format.GeoJSON();
//the land ribaas layer as a geojson layer
var ribaaSource=new ol.source.Vector({
	format: formatGeoJSON,
	loader: function(extent, resolution, projection) {
		var url='http://localhost:8080/geoserver/wfs?'+
						'service=WFS&request=GetFeature&'+
						'version=2.0.0&typename=habous:ribaa&'+
						'outputFormat=text/javascript&'+
						'format_options=callback:loadFeatures&' +
						'srsname=EPSG:4326';
		$.ajax({
			url: url,
			dataType: 'jsonp'
		});
	},
	strategy: ol.loadingstrategy.tile(ol.tilegrid.createXYZ({
		maxZoom: 19
	}))
});

var loadFeatures = function(response) {
	//console.log(response);
	ribaaSource.addFeatures(formatGeoJSON.readFeatures(response));
};

var ribaaLayer=new ol.layer.Vector({
	title: 'Land Parcels',
	source: ribaaSource,
	style: new ol.style.Style({
		fill: new ol.style.Fill({
			color: 'rgba(255, 255, 255, 0.2)'
		}),
		stroke: new ol.style.Stroke({
			color: '#737373',
			width: 2
		}),
		image: new ol.style.Circle({
			radius: 7,
			fill: new ol.style.Fill({
				color: '#ffcc33'
			})
		})
	})
});

map.addLayer(ribaaLayer);

// Editing Features code --------------------------------------------------

// Edits will be done on an Overlay and then will be saved
var features = new ol.Collection();
var featureOverlay = new ol.layer.Vector({
	source: new ol.source.Vector({features: features}),
	style: new ol.style.Style({
		fill: new ol.style.Fill({
			color: 'rgba(255, 255, 255, 0.2)'
		}),
		stroke: new ol.style.Stroke({
			color: '#ffcc33',
			width: 2
		}),
		image: new ol.style.Circle({
			radius: 7,
			fill: new ol.style.Fill({
				color: '#ffcc33'
			})
		})
	})
});
featureOverlay.setMap(map);
//we add a select interaction to the map so that we can use it later to modify the selected feature
var select = new ol.interaction.Select();
map.addInteraction(select);
var selectedFeature;

var popup = new ol.Overlay.Popup();
map.addOverlay(popup);
var singleClickListener=function(evt) {
	popup.hide();
	popup.setOffset([0, 0]);
	var feature = map.forEachFeatureAtPixel(evt.pixel, function(feature, layer) {
        	return feature;
    		});
	if (feature) {
		selectedFeature=feature;        
		//getting the center of the polygons to display the popup on its coordinates
		var ext=feature.getGeometry().getExtent();
		var center=ol.extent.getCenter(ext);
		var props = feature.getProperties();
		//var superficie=Math.round(Math.abs(sphere.geodesicArea(feature.getGeometry().getLinearRing(0).getCoordinates())));
		var info =  "<i class='fa fa-key fa-fw'></i>"+props.id+"</br>"+props.description;
        // Offset the popup so it points at the middle of the marker not the tip
		popup.setOffset([0, -22]);
		popup.show(center,info);
		/*map.setView( new ol.View({
			projection: "http://www.opengis.net/gml/srs/epsg.xml#4326",
        	center: [center[0] , center[1]+0.4],
        	zoom: 10
			}));*/
	}
	
}
var key=map.on('singleclick', singleClickListener);

//Drawing code starts here

var draw; // global so we can remove it later
var formatwfs = new ol.format.WFS();// here we declare the format WFS to be used later on the transaction
draw = new ol.interaction.Draw({
       		features: features, // we set the newly drawn feature on the overlay declared previously
       		type: /** @type {ol.geom.GeometryType} */ ('Point') // Type of the feature in our case it's polygon
       		});
// when a new feature has been drawn...
draw.on('drawend', function(event) {
	//var formatwkt = new ol.format.WKT();
	//var wkt = formatwkt.writeGeometry(event.feature.getGeometry());
	//console.log(wkt+"  "+Math.round(Math.abs(sphere.geodesicArea(event.feature.getGeometry().getLinearRing(0).getCoordinates()))));
	var feature = event.feature;// this variable feature will serve to store the attributes of the new zone
	var formatwkt = new ol.format.WKT();
	var geom=feature.getGeometry();
	var wkt = formatwkt.writeGeometry(geom);
	//alert(wkt);
	$.ajax({
		url: 'php_scripts/drawRibaa.php',
		type: 'POST',
		data: {
			Geometry: wkt 
		},
		success:function(response){
			alert("Ribaa ajoutée dans la base de données");
			window.location.reload();
		}
	});
	//and voila
	map.removeInteraction(draw);//Here we disable drawing
	key=map.on('singleclick',singleClickListener);//and re-enable the singleClickListener to display the popup form
});

$('#Draw').click( function(){
	map.unByKey(key);	
	map.removeInteraction(modify);// we disable the modify interaction so there can be no conflicts between events
	map.addInteraction(draw);//not to forget to add the interaction to the map
	//map.removeInteraction(draw);//Here we disable drawing
	//key=map.on('singleclick',singleClickListener);//and re-enable the singleClickListener to display the popup form	
});


// Drawing code ends here

//Modification code starts here

//we add the modify interaction to the selected feature
var modify = new ol.interaction.Modify({
	features: select.getFeatures(),
        // the SHIFT key must be pressed to delete vertices, so
        // that new vertices can be drawn at the same position
        // of existing vertices
        deleteCondition: function(event) {
        	return ol.events.condition.shiftKeyOnly(event) &&
              	ol.events.condition.singleClick(event);
        	}
      	});

$('#Modify_Attr').click( function(event){
	var feature=select.getFeatures().item(0);
	if(feature){
		$('#ID_Exprop_Edit').val(feature.get('id_expropriation'));
		$('#Type_Edit').val(feature.get('type'));
		$('#Num_Foncier_Edit').val(feature.get('num_foncier'));
		$('#Description_Edit').val(feature.get('description'));
		$('#Commune_Edit').val(feature.get('commune'));
		$('#Superficie_Edit').val(feature.get('superficie'));
		$('#Province_Edit').val(feature.get('province'));
		$('#Region_Edit').val(feature.get('region'));
		$('#Coords_Edit').val(feature.getGeometry().getCoordinates());
	}
	else{
		event.stopPropagation();
		alert("Veuillez séléctionner l'élément à modifier");
	}
});

$('#Save').click( function(e){
	e.preventDefault();
	var coords=$('#Coords_Edit').val();
	var res;
	var points = [];
	res=coords.split(",");
	points=[parseFloat(res[0]), parseFloat(res[1])];
	//console.log(points);
	var formatwkt = new ol.format.WKT();
	var geom=new ol.geom.Point(points);
	var wkt = formatwkt.writeGeometry(geom);
	//alert(wkt);
	$.ajax({
			url: 'php_scripts/updateRibaa.php',
			type: 'POST',
			data: {
				ID: selectedFeature.get('id'),
				ID_Expropriation: $('#ID_Exprop_Edit').val(),
				Type: $('#Type_Edit').val(),
				Num_Foncier: $('#Num_Foncier_Edit').val(),
				Superficie: $('#Superficie_Edit').val(),
				Description: $('#Description_Edit').val(),
				Commune: $('#Commune_Edit').val(),
				Province: $('#Province_Edit').val(),
				Region: $('#Region_Edit').val(),
				Geometry: wkt 
			},
			success:function(response){
				alert("Ribaa modifiée dans la base de données");
				window.location.reload();
			}
		});
});

$('#Insert').click( function(e){
	e.preventDefault();
	var coords=$('#Coords_Add').val();
	var res;
	var points = [];
	res=coords.split(",");
	points=[parseFloat(res[0]), parseFloat(res[1])];
	var formatwkt = new ol.format.WKT();
	var geom=new ol.geom.Point(points);
	var wkt = formatwkt.writeGeometry(geom);
	$.ajax({
			url: 'php_scripts/addRibaa.php',
			type: 'POST',
			data: {
				ID_Expropriation: $('#ID_Exprop_Add').val(),
				Type: $('#Type_Add').val(),
				Num_Foncier: $('#Num_Foncier_Add').val(),
				Description: $('#Description_Add').val(),
				Superficie: $('#Superficie_Add').val(),
				Commune: $('#Commune_Add').val(),
				Province: $('#Province_Add').val(),
				Region: $('#Region_Add').val(),
				Geometry: wkt 
			},
			success:function(response){
				alert("Ribaa ajoutée dans la base de données");
				window.location.reload();
			}
		});
});

$('#Modify_map').click( function(){
	if(select.getFeatures()){
		select.getFeatures().clear();
		popup.hide();
	}
	map.unByKey(key);
	map.removeInteraction(draw);
	map.addInteraction(modify);
	var id;
	select.getFeatures().on('add', function(e) {
		e.element.on('change', function(e) {
			id=e.target.get('id');
		});
	});
	var clone;
	select.getFeatures().on('remove', function(e) {
		var feature = e.element;
		var formatwkt = new ol.format.WKT();
		var geom=feature.getGeometry();
		if(id){
			var wkt = formatwkt.writeGeometry(geom);
			$.ajax({
				url: 'php_scripts/modifyRibaa.php',
				type: 'POST',
				data: {
					ID: id,
					Geometry: wkt 
				},
				success:function(response){
					alert("Ribaa modifiée dans la base de données");
					window.location.reload();
				}
			});	
		}
	});
});

//Delete Feature code starts here
$('#Delete').click( function(){
	if(!select.getFeatures()){
		alert("Veuillez séléctionner la ribaa à supprimer");
	}
	else{
		var OK=confirm("êtes vous sûr de vouloir supprimer cette ribaa ?");
		if(OK){
			var feature = select.getFeatures().item(0);
			$.ajax({
				url: 'php_scripts/deleteRibaa.php',
				type: 'POST',
				data: {
					ID: feature.get('id')
				},
				success:function(response){
					alert("Ribaa supprimée de la base de données");
					window.location.reload();
				}
			});
		}
	}
});
// Delete code ends here
// Editing code ends here

//Toggles the search form
//Insert a feature by its coordinates ( code starts here )


//Insert code ends here

//Search features by ID starts here
$('#Search').click( function(evt){
	ribaaSource.forEachFeature(function(feature) {
		if(feature.get('ID')==$('#ID_Search').val()){
			select.getFeatures().clear();
			select.getFeatures().push(feature);
		}
	});
	var extent = select.getFeatures().item(0).getGeometry().getExtent();
	features.forEach(function(feature){ ol.extent.extend(extent,feature.getGeometry().getExtent())});
	map.getView().fit(extent, map.getSize());
	$('#Search_Modal').modal('hide');
});
//Search code ends here
// Hover Interaction code starts here
hoverInteraction = new ol.interaction.Select({
	condition: ol.events.condition.pointerMove,
	layers:[ribaaLayer]	//Setting layers to be hovered
	});
map.addInteraction(hoverInteraction);

// Hover interaction ends here
