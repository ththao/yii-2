var ProfileIndex = function(options) {
    var config = {
        url: ''
    };

    var settings = $.extend(config, options || {});
    var el = this;

    this.init = function() {
        el.createAlert();
    };
    
    this.createAlert = function() {
    	console.log("test");
    };
};