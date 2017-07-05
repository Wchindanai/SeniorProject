var net = require('net');
var client = new net.Socket();
var data = ['1','560107030023'];
data.push(data[0].length)
client.connect(6969, '127.0.0.1', function() {
    console.log('Connected');
    client.write(data.toString());
});

client.on('data', function(data) {
    console.log('Received: ' + data);
    var decodeData = data.toString();
    decodeData = decodeData.split(",");
    if(decodeData[2] == 0){
        var data2 = ['1','560107030023','1','1','1'];
        console.log(client.write(data2.toString()));
    }
});
client.on('close', function() {
    console.log('Connection closed');
});