#!/usr/bin/env python
import base64
import os
import matplotlib.pyplot as plt
import numpy as np
import pymysql

#compare IMG
import testWrite

#TCP CONNECTION
import socket
TCP_IP = '127.0.0.1'
TCP_PORT = 5555

sock = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
#
sock.connect((TCP_IP,TCP_PORT))
import fingerpi as fp

import time
import pickle
def printByteArray(arr):
    return map(hex, list(arr))

def enroll():
    print 'Opening connection...'
    f.Open(extra_info=True, check_baudrate=True)

    print('Changing baudrate...')
    f.ChangeBaudrate(115200)

    # print 'Student Id'
    # print sid
    while True:
        print 'Place the finger on the scanner and press <Enter>'
        _ = raw_input()
        f.CmosLed(True)
        # response = f.IsPressFinger()
        response = f.CaptureFinger()
        if response[0]['ACK']:
            break
        f.CmosLed(False)
        if response[0]['Parameter'] != 'NACK_FINGER_IS_NOT_PRESSED':
            print 'Unknown Error occured', response[0]['Parameter']

    print 'Image captured!'
    f.CmosLed(False)
    # #
    print 'Transmitting image...'
    t = time.time()
    raw_img = f.GetImage()
    tx_time = time.time() - t
    print 'Time to transmit:', tx_time
    print 'Closing connection...'
    f.Close()

    dim = raw_img[1]['Data'][1]
    img = bytearray(raw_img[1]['Data'][0])
    img = np.reshape(img, dim)
    fig = plt.imshow(img, cmap='gray')
    fig.axes.get_xaxis().set_visible(False)
    fig.axes.get_yaxis().set_visible(False)
    plt.axis('off')
    plt.savefig('enrollImage.png',
                bbox_inches='tight',
                pad_inches=-.1,
                frameon=False,
                transparent=False
                )
    del img, raw_img, sid, t, dim, fig

    stringImage = open("enrollImage.png", "r").read()
    encodeImage = base64.b64encode(stringImage)
    connection = pymysql.connect(host='192.168.1.2',
                                 user='root',
                                 password='mysql',
                                 db='AccessControl',
                                 charset='utf8mb4',
                                 cursorclass=pymysql.cursors.DictCursor)

    try:
        with connection.cursor() as cursor:
            sql = "SELECT * FROM Student WHERE StudentID = %s"
            cursor.execute(sql, sid)
            result = cursor.fetchone()
            if not result:
                print "StudentID not register"
            else:
                sql = "SELECT FingerprintImg FROM Student WHERE StudentID = %s"
                cursor.execute(sql, sid)
                result = cursor.fetchone()
                if not result:
                    sql = "INSERT INTO Student VALUES (%s, %s)"
                    cursor.execute(sql, (sid, encodeImage))
                    connection.commit()
                else:
                    sql = "UPDATE StudentFingerprint SET Student = %s WHERE StudentID = %s"
                    cursor.execute(sql, (encodeImage, sid))
                    connection.commit()
    finally:
        connection.close()

def verify(sid):
    print 'Opening connection...'
    f.Open(extra_info=True, check_baudrate=True)

    print('Changing baudrate...')
    f.ChangeBaudrate(115200)

    print sid
    sock.send("2,0,"+sid)
    recv = sock.recv()
    if(recv):
        recv = recv.split(",")
        if(recv[1]=="0"):
            while True:
                f.CmosLed(True)
                # response = f.IsPressFinger()
                response = f.CaptureFinger()
                if response[0]['ACK']:
                    break
                f.CmosLed(False)
                if response[0]['Parameter'] != 'NACK_FINGER_IS_NOT_PRESSED':
                    print 'Unknown Error occured', response[0]['Parameter']

            print 'Image captured!'
            f.CmosLed(False)
            # #
            print 'Transmitting image...'
            t = time.time()
            raw_img = f.GetImage()
            tx_time = time.time() - t
            print 'Time to transmit:', tx_time
            print 'Closing connection...'
            f.Close()

            dim = raw_img[1]['Data'][1]
            img = bytearray(raw_img[1]['Data'][0])
            img = np.reshape(img, dim)
            fig = plt.imshow(img, cmap='gray')
            fig.axes.get_xaxis().set_visible(False)
            fig.axes.get_yaxis().set_visible(False)
            plt.axis('off')
            plt.savefig('verifyImg.png',
                        bbox_inches='tight',
                        pad_inches=-.1,
                        frameon=False,
                        transparent=False
                        )
            del img, raw_img, sid, t, dim, fig

            connection = pymysql.connect(host='192.168.1.2',
                                         user='root',
                                         password='mysql',
                                         db='AccessControl',
                                         charset='utf8mb4',
                                         cursorclass=pymysql.cursors.DictCursor)

            try:
                with connection.cursor() as cursor:
                    sql = "SELECT FingerprintImg From Student WHERE StudentID = %s"
                    cursor.execute(sql, ("560107030023"))
                    result = cursor.fetchone()
                    ImgEnroll = result['FingerprintImg']
            finally:
                connection.close()
                print ImgEnroll;
                print base64.b64encode(open('enrollImage.png', 'r').read())
                ImgEnroll = base64.b64decode(ImgEnroll)
                open("enrollImg.png", "w").write(ImgEnroll)
            testWrite.compare()

        else:
            print "NOT HAVE PERMISSION ALERT"


    # open("enrollImage.png","w") as


f = fp.FingerPi()
enroll()

