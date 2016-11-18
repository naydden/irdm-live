var viewer = new Cesium.Viewer('cesiumContainer');

var source = new EventSource('stream.php');
source.onmessage = function(e) { 
  /*var received_msg = evt.data;
  var coordinates = JSON.parse(received_msg);
  console.log(coordinates[0]);
  console.log(coordinates[1]);
  console.log(coordinates[2]);*/
  console.log(e);
};

var heading = Cesium.Math.toRadians(45.0);
var pitch = Cesium.Math.toRadians(15.0);
var roll = Cesium.Math.toRadians(0.0);
var positionInicial = changePos(1);

function changePos (iter) {
var longitude = -123;
var latitude  = 41;
var height = 2;

longitude = longitude + iter;
height = height + iter;
console.log(iter);
return Cesium.Cartesian3.fromDegrees(longitude,latitude, height);

}
var i = 0;

function myTimer() {
  i = i+1;
  var positionCalc = changePos(i);
  var entity = viewer.entities.add({
      position : positionCalc,
      orientation : Cesium.Transforms.headingPitchRollQuaternion(positionInicial, heading, pitch, roll),
      model : {
          uri : './assets/balloon_finalv4.glb'
      }
  });
  viewer.trackedEntity = entity;
}
viewer.infoBox.frame.sandbox = "allow-same-origin allow-top-navigation allow-pointer-lock allow-popups allow-forms allow-scripts";


setInterval(myTimer, 1000);
