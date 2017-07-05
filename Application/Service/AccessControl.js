//Init Variable
var mysql = require('mysql');
var moment = require('moment');
var mysql = mysql.createConnection({
    host : 'localhost',
    user : 'root',
    port : 3306,
    password : 'root',
    database : 'AccessControl'
});
var net = require('net');
var clients = [];
var HOST = '0.0.0.0';
var PORT = 5555;
var processEnroll = 0;
var debug = true;
var date ;
var device = [];
var countPermit=0;
var permit = false;
var deviceID;
var countImage =1;
var Image = '';
var sendingImage = false;
///////////////////////////////////////////////////
//////////////////////////////////////////////////
mysql.connect();
mysql.query('SELECT * FROM Device', function (err,rows) {
    if(err) throw err;
    var i = 0;
    rows.forEach(function () {
        device[i] = rows[i].ip;
        i++;
    });
    console.log("IP already enroll is "+ device);
});

function statusDevice(status,address) {
    if(status==true){
       for(var i = 0; i<device.length; i++){
            if(device[i] == address){
                console.log("Connected Device IP : "+device[i]);
                mysql.query("UPDATE Device SET status = 1 WHERE ip = '"+device[i]+"'",function (err) {
                    if(err) throw err;
                });
                return true;
            }
       }
        return false;
    }
    else if(status==false){
        for (var i=0 ; i <= device.length; i++){
            if(device[i] == address){
                console.log("IP : "+ device[i]+" Disconnected" );
                mysql.query("UPDATE Device SET status = 0 WHERE ip = '"+device[i]+"'",function (err) {
                    if(err) throw (err);
                });
            }
        }
    }
}

// Create a server instance, and chain the listen function to it
// The function passed to net.createServer() becomes the event handler for the 'mysql' event
// The sock object the callback function receives UNIQUE for each mysqltion Enroll() {
net.createServer(function(sock) {
    if(!statusDevice(true,sock.remoteAddress)){
        console.log("Not Register Device IP: "+sock.remoteAddress);
        return;
    }
    // Add a 'data' event handler to this instance of socket
    sock.on('data', function(data) {
        // console.log('DATA ' + sock.remoteAddress + ': ' + data);
        var decodeData = function (rawData) {
            var data = rawData.toString();
            var packet = data.split(",");
            if (debug){
                console.log("recieve: "+packet+" from: "+sock.remoteAddress);
            }
            function calChksum() {
                var chkSum = 0 ;
                for (var i=0 ; i<packet.length-1 ;  i++ ){
                    chkSum += packet[i].length;
                }
                // console.log(chkSum);
                return chkSum;
            }

            if(packet[packet.length-1] != calChksum()){
                // sock.write("NACK");
                // console.log("NACK");
                // return;
            }
            else {
                // var ack = "acknowledge".toUpperCase();
                // sock.write(ack,0,ack.length-0,'utf8');
                // sock.end();
                // console.log(ack);
            }
            switch (packet[0]){
                case '1' : Enroll();break;
                case '2' : verify();break;
                default : console.log("Error Input");
            }
            function Enroll() {
                // console.log(packet);
                processEnroll=1;
                date = moment().format('YYYY-MM-DD HH:mm:ss');
                if(packet[1]==0){

                    // console.log(processEnroll);
                    mysql.query("SELECT * FROM StudentFingerprint WHERE StudentID = '"+packet[2]+"'",function (err, rows) {
                        if(err) throw (err);
                        // console.log(rows.length);
                        if(rows.length==0){
                            mysql.query("SELECT * FROM Student WHERE StudentID = '"+packet[2]+"'",function (err,rows2) {
                                if(err) throw err;
                                //console.log(rows2.length);
                                if(rows2.length==0){
                                     console.log("Student ID Not Register");
                                    sock.write("1,2,"+packet[2]);
                                    mysql.query("INSERT INTO Log VALUES ('','"+packet[2]+"','"+date+"','1')");
                                }
                                else{
                                     console.log("This Student ID Can Enroll");
                                    sock.write("1,0,"+packet[2]);
                                }
                            });
                        }
                        else{
                             console.log("Student Has already enrolled");
                            sock.write("1,1,"+packet[2]+rows[0].FingerprintID.toString());
                            mysql.query("INSERT INTO Log VALUES ('','"+packet[2]+"','"+date+"','1')");
                        }
                    });
                }
                else if(packet[2]==1){
                    if (processEnroll<1||processEnroll>1){
                        console.log("Error Process Enroll");
                    }
                    if(countImage <= 4){
                        sendingImage = true;
                        Image += packet[3];
                        countImage++;
                    }
                    else {
                        console.log(Image);
                        mysql.query("SELECT * FROM Fingerprint WHERE FingerprintID = '"+packet[3]+"'",function (err,rows) {
                                    if (rows.length == 0){
                                        // mysql.query("INSERT INTO Fingerprint VALUES ('"+packet[3]+"','"+packet[4]+"')",function (err) {
                                        //     if(err)throw err;
                                        // });
                                        mysql.query("INSERT INTO StudentFingerprint VALUES ("+"'"+packet[1]+"','"+packet[3]+"')",function (err) {
                                            if (err) throw err;
                                        });
                                        console.log("Enroll Success");
                                    }
                                    else {
                                        console.log("FingerprintID is used");
                                    }
                                });
                    }

                    // else {
                    //     mysql.query("SELECT * FROM Fingerprint WHERE FingerprintID = '"+packet[3]+"'",function (err,rows) {
                    //         if (rows.length == 0){
                    //             // mysql.query("INSERT INTO Fingerprint VALUES ('"+packet[3]+"','"+packet[4]+"')",function (err) {
                    //             //     if(err)throw err;
                    //             // });
                    //             mysql.query("INSERT INTO StudentFingerprint VALUES ("+"'"+packet[1]+"','"+packet[3]+"')",function (err) {
                    //                 if (err) throw err;
                    //             });
                    //             console.log("Enroll Success");
                    //         }
                    //         else {
                    //             console.log("FingerprintID is used");
                    //         }
                    //     });
                    // }
                    processEnroll = 0;
                }
            }
            function verify() {
                //INIT VARIABLE//
                var sID;
                ////////////////
                date = moment().format('YYYY-MM-DD dddd HH:mm:ss');
                date = date.split(' ');
                dateLog = moment().format('YYYY-MM-DD HH:mm:ss');
                if(packet[1]=='0'){
                    mysql.query("SELECT * FROM StudentFingerprint WHERE StudentID = '"+packet[2]+"'",function (err, rows) {
                        if (err) throw err;
                        if(rows.length==0) {
                            console.log("Student doesn't enroll fingerprint");
                            mysql.query("INSERT INTO Log VALUES ('','','"+dateLog+"',2)");
                            sock.write("2,2,"+packet[2]);
                            return;
                        }
                        sID = rows[0].StudentID.toString();
                        console.log(sID+" "+ sock.remoteAddress);
                        mysql.query("SELECT * FROM StudentRecord WHERE StudentID = '"+sID+"' AND deviceIP = '"+sock.remoteAddress+"'",function (err, rows) {
                            if (err) throw err;
                            if(rows.length == 0){
                                console.log("Don't Have permission");
                                mysql.query("INSERT INTO Log VALUES('','"+sID+"','"+dateLog+"',1)");
                                sock.write("2,1,"+sID);
                            }
                            var permission;
                            var recordID ;
                            var i;
                            var count = rows.length;
                            function checkPermission(count, permission) {
                                if(permission){
                                    permit = true;
                                }
                                countPermit++;
                                if(countPermit==count){
                                    if(permit){
                                        console.log("Can enter the room");
                                        console.log(sID+" "+ dateLog);
                                        mysql.query("INSERT INTO Log VALUES('','"+sID+"','"+dateLog+"',0)");
                                        sock.write("2,0,"+sID);
                                    }
                                    else {
                                        console.log("don't have permission");
                                        mysql.query("INSERT INTO Log VALUES('','"+sID+"','"+dateLog+"',1)");
                                        sock.write("2,1,"+sID);
                                    }
                                    countPermit=0;
                                    permit = false;
                                }

                            }
                            for ( i = 0; i < rows.length; i++){
                                recordID = rows[i].RecordID;
                                mysql.query("SELECT * FROM Permission WHERE RecordID = '"+recordID+"'", function (err, rows) {
                                    var perDate = [];
                                    var perTime = [];
                                    var perDay = [];
                                    var str = [];
                                    if (err) throw err;
                                    console.log(date);
                                    str = rows[0].RecordStartDate.toISOString().replace('T',' ');
                                    str = str.split(' ');
                                    perDate.push(str[0]);
                                    str = rows[0].RecordEndDate.toISOString().replace('T',' ');
                                    str = str.split(' ');
                                    perDate.push(str[0]);
                                    perTime.push(rows[0].RecordStartTime.toString());
                                    perTime.push(rows[0].RecordEndTime.toString());
                                    str = rows[0].RecordDoW.toString();
                                    perDay = str.split('/');
                                    perDay.pop();
                                    console.log(perDate);
                                    console.log(perTime);
                                    console.log(perDay);
                                    if(date[0] >= perDate[0] && date[0] <= perDate[1]  ){
                                        for (var i = 0 ; i < perDay.length ; i++){
                                            if(date[1] == perDay[i]){
                                                if(date[2] >= perTime[0] && date[2] <= perTime[1]){
                                                    permission = true;
                                                    break;
                                                    // console.log("Have Permission ");
                                                }
                                                else {
                                                    // console.log("Don't Have Permission fail at time");
                                                    permission = false;
                                                    break;
                                                    // return;
                                                }
                                            }
                                            else {
                                                permission = false;

                                                // console.log("Don't Have Permission fail at day of week");
                                                // return;

                                            }
                                        }
                                    }
                                    else {
                                        permission = false;
                                        // console.log("Don't Have Permission fail at Date");
                                        // return;
                                    }
                                    checkPermission(count,permission);
                                });

                            }



                        })
                    });
                }



                
            }
            // function verify() {
            //     if(packet[2]==0){
            //         if(packet[1].length < 12 || packet[1].length > 12){
            //             console.log("Wrong ID");
            //             return;
            //         }
            //         if(packet[3]==0){
            //             mysql.query("SELECT * FROM StudentFingerprint WHERE StudentID = '"+packet[1]+"'",function (err,rows) {
            //                 if (err) throw err;
            //                 if(rows.length==1){
            //                         console.log("Verify normally");
            //                         sock.write("2,"+packet[1]+",0,0,"+rows[0].FingerprintID);
            //                 }
            //                 else if (rows.length==0){
            //                     mysql.query("SELECT * FROM Student WHERE StudentID = '"+packet[1]+"'",function (err,rows) {
            //                         if (err) throw err;
            //                         console.log(rows);
            //                         if(rows.length != 1 ){
            //                             console.log("StudentID doesn't register");
            //                             sock.write("2,"+packet[1]+",0,2");
            //                         }
            //                         else {
            //                                 console.log("Don't enroll yet. StudentID : "+packet[1]);
            //                                 sock.write("2,"+packet[1]+",0,1,");
            //                         }
            //                     });
            //                 }
            //             });
            //         }
            //     }
            //     else if(packet[2]==1){
            //         if(packet[3]==0){
            //
            //         }
            //     }
            // }

        };
        decodeData(data);
        // Write the data back to the socket, the client will receive it as data from the server
        // sock.write('"Length Data : ' + data.length +'"');

    });

    // Add a 'close' event handler to this instance of socket
    sock.on('close', function(data) {
        delete clients[sock.remoteAddress];
        statusDevice(false,sock.remoteAddress);
        console.log('CLOSED: ' + sock.remoteAddress +' '+ sock.remotePort);
    });
    sock.on('error', function (err) {
        console.log(err);
    });
    sock.on('uncaughtException', function (err) {
        console.error(err.stack);
        console.log("Node NOT Exiting...");
    });

}).listen(PORT, HOST);

console.log('Server listening on ' +':'+ PORT);


