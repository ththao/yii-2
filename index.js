var app                 = require('http').createServer(function(req, res) {}),
    io                  = require('socket.io').listen(app),
    fs                  = require('fs'),
    mysql               = require('mysql'),
    connectionsArray    = [],
    db_config = {
		host: '127.0.0.1',
		user: 'root',
		password: '',
		database: 'yii2template',
        port: '3306'
	},
    connection,
    POLLING_INTERVAL = 1000,
    pollingTimer;

function handleDisconnect() {
	connection = mysql.createConnection(db_config); // Recreate the connection,
													// since
	// the old one cannot be reused.

	connection.connect(function(err) { // The server is either down
		if (err) { // or restarting (takes a while sometimes).
			console.log('error when connecting to db:', err);
			setTimeout(handleDisconnect, 2000); // We introduce a delay before
												// attempting to reconnect,
		} // to avoid a hot loop, and to allow our node script to
	}); // process asynchronous requests in the meantime.
	// If you're also serving http, display a 503 error.
	connection.on('error', function(err) {
		console.log('db error', err);
		if (err.code === 'PROTOCOL_CONNECTION_LOST') { // Connection to the
														// MySQL server is
														// usually
			handleDisconnect(); // lost due to either server restart, or a
		} else { // connnection idle timeout (the wait_timeout
			throw err; // server variable configures this)
		}
	});
}

handleDisconnect();

// create a new nodejs server ( localhost:8000 )
app.listen(3000);

/*
 * 
 * HERE IT IS THE COOL PART This function loops on itself since there are
 * sockets connected to the page sending the result of the database query after
 * a constant interval
 * 
 */
var pollingLoop = function () {
    // Make the database query
    var query = connection.query('SELECT * FROM users WHERE (UNIX_TIMESTAMP() - updated_time) <= 2'),
        requests = []; // this array will contain the result of our db query
    
    // set up the query listeners
    query.on('error', function(err) {
        // Handle error, and 'end' event will be emitted after this as well
        console.log( err );
        updateSockets( err );
        
    }).on('result', function( request ) {
        // it fills our array looping on each user row inside the db
    	requests.push( request );
        
    }).on('end',function() {
        // loop on itself only if there are sockets still connected
        if (connectionsArray.length) {
            pollingTimer = setTimeout( pollingLoop, POLLING_INTERVAL );
            
            if (requests.length) {
            	//console.log(new Date());
            	updateSockets({requests:requests});
            }
        }
    });
};

// create a new websocket connection to keep the content updated without any AJAX request
io.sockets.on( 'connection', function ( socket ) {
    
    console.log('Number of connections:' + connectionsArray.length);
    // start the polling loop only if at least there is one user connected
    if (!connectionsArray.length) {
        pollingLoop();
    }
    
    socket.on('disconnect', function () {
        var socketIndex = connectionsArray.indexOf( socket );
        console.log('socket = ' + socketIndex + ' disconnected');
        if (socketIndex >= 0) {
            connectionsArray.splice( socketIndex, 1 );
        }
    });

    console.log( 'A new socket is connected!' );
    connectionsArray.push( socket );
    
});

var updateSockets = function (data) {
    // store the time of the latest update
    data.time = new Date();
    // send new data to all the sockets connected
    connectionsArray.forEach(function( tmpSocket ){
        tmpSocket.volatile.emit( 'notification' , data );
    });
};