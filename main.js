var viewer = new Cesium.Viewer('cesiumContainer');

var source = new EventSource('stream.php');
// source.onopen = 
source.onmessage = function(e) { 
	/*var received_msg = evt.data;
	var coordinates = JSON.parse(received_msg);
	console.log(coordinates[0]);
	console.log(coordinates[1]);
	console.log(coordinates[2]);*/
	console.log(e.data);
	console.log(e.extra);
};

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
