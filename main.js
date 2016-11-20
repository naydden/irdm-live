var viewer = new Cesium.Viewer('cesiumContainer');

if (typeof(EventSource) !== 'undefined') {
	var source = new EventSource('merged_test.php');
	source.onmessage = function(e) { 
		var coordinates = JSON.parse(e.data);
		console.log(coordinates);
	};
} else {
	console.log("I'm sorry. Your browser sucks.");
}

var position = Cesium.Cartesian3.fromDegrees(-123.0744619, 44.0503706, 0);
var heading = Cesium.Math.toRadians(45.0);
var pitch = Cesium.Math.toRadians(15.0);
var roll = Cesium.Math.toRadians(0.0);
var orientation = Cesium.Transforms.headingPitchRollQuaternion(position, heading, pitch, roll);

var entity = viewer.entities.add({
	position    : position,
	orientation : orientation,
	model : {
		uri : './assets/balloon_finalv4.glb'
	}
});
viewer.trackedEntity = entity;
