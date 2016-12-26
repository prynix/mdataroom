(function (lib, img, cjs) {

var p; // shortcut to reference prototypes

// library properties:
lib.properties = {
	width: 300,
	height: 250,
	fps: 24,
	color: "#FFFFFF",
	manifest: [
		{src:"images/SoftWindTech_Logo_Color.png", id:"SoftWindTech_Logo_Color"}
	]
};



// symbols:



(lib.SoftWindTech_Logo_Color = function() {
	this.initialize(img.SoftWindTech_Logo_Color);
}).prototype = p = new cjs.Bitmap();
p.nominalBounds = new cjs.Rectangle(0,0,1500,512);


(lib.logo = function() {
	this.initialize();

	// Layer 1
	this.instance = new lib.SoftWindTech_Logo_Color();
	this.instance.setTransform(-150,-51.2,0.2,0.2);

	this.addChild(this.instance);
}).prototype = p = new cjs.Container();
p.nominalBounds = new cjs.Rectangle(-150,-51.2,300,102.5);


// stage content:
(lib.html_test_local_news = function(mode,startPosition,loop) {
	this.initialize(mode,startPosition,loop,{});

	// Layer 1
	this.instance = new lib.logo();
	this.instance.setTransform(-131.9,125);

	this.timeline.addTween(cjs.Tween.get(this.instance).to({x:445},49).wait(1));

}).prototype = p = new cjs.MovieClip();
p.nominalBounds = new cjs.Rectangle(-131.9,198.8,300,102.5);

})(lib = lib||{}, images = images||{}, createjs = createjs||{});
var lib, images, createjs;