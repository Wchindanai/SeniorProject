var net = require('net');
var client = new net.Socket();
var data = ['2','0','560107030023'];
data.push(data[0].length+data[1].length+data[2].length);
client.connect(5555, '127.0.0.1', function() {
    console.log('Connected');
    client.write(data.toString());
});

client.on('data', function(data) {
    console.log('Received: ' + data);
    var decodeData = data.toString();
    client.destroy();
});
client.on('error',function(err) {
  console.log(err.stack);
});
client.on('close', function() {
    console.log('Connection closed');
});
