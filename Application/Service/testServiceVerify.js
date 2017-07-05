var net = require("net");
var client = new net.Socket();
var data = [2,'560107030023',0,0];
client.connect(6969,'localhost',function () {
    console.log("Connected");
    client.write(data.toString());
});
client.on('data',function (data) {
    console.log("Recieve : "+data);
    var decodeData = data.toString();
    var packet = decodeData.split(",");
    if(packet[2]==0){
        if(packet[3]==0){
            console.log("FingerID is : " + packet[4]);
        }
        else if (packet[3] == 1){
            console.log("FingerID not enroll");
        }
        else if (packet[3]==2){
            console.log("StudentID not register");
        }
    }
    client.destroy();
});
client.on('close', function() {
    console.log('Connection closed');
});