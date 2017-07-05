#TCP CONNECTION
import socket
TCP_IP = '127.0.0.1'
TCP_PORT = 5555

sock = socket.socket(socket.AF_INET, socket.SOCK_STREAM)

import fingerpi as fps


def printByteArray(arr):
    return map(hex, list(arr))

def PressFinger():
    f.CmosLed(True)
    response = f.IsPressFinger()
    print response
    if not response[0]['Parameter']:
        return True
    else:
        return False

def Enroll():
    print f.GetEnrollCount
    while not PressFinger():
        print

f = fps.FingerPi()
f.Open(extra_info = True, check_baudrate = True)
print 'Changing baudrate...'
f.ChangeBaudrate(115200)
# print PressFinger()
Enroll()
f.Close()
