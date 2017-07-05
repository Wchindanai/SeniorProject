import time
import tkMessageBox

from tkinter import *
import demo



def raise_frame(frame):
    frame.tkraise()

root = Tk()
root.attributes('-fullscreen', True)

p1 = Frame(root,height="1000", width="900")
p2 = Frame(root,height="1000", width="900")
p3 = Frame(root,height="1000", width="900")
#
for frame in (p1, p2, p3):
    frame.grid(row=0, column=0, sticky='news')

raise_frame(p1)

##############PAGE1
timelocal = StringVar()
Time = Label(p1, textvariable=timelocal, font=('', 50), width="20", height="3").pack()
localtime = time.strftime("%H:%M:%S", time.gmtime())
timelocal.set(localtime)
Button(p1, text="Add Figger", font="1", width="20", height="10", fg="red", bg="black", command=lambda: raise_frame(p3)).pack()
Button(p1, text="Scanner Finger", font="1", fg="red", bg="black", width="20", height="10", command=lambda :raise_frame(p2)).pack()



###############PAGE2 SCANNER FINGER
def sid(id):
    idLabel['text'] = idLabel['text'] + id

def delSid():
    id = idLabel['text']
    idLabel['text'] = idLabel['text'].replace(id, "")
def BtnVerify():
    id = idLabel['text']
    if (len(id) == 12):
        demo.verify(id)
    else:
        tkMessageBox.showerror("Wrong StudentID"," StudentID")

idLabel = Label(p2, text="", font=('', 40), bg="#FFFFFF")
idLabel.place(x=152, y=13)
b1 = Button(p2,text="1", font=('', 25), width="7", height="2", fg="black", bg="#FFFFFF",
                 command=lambda b='1': sid(b)).place(x=150, y=100)
b2 = Button(p2,text="2", font=('', 25), width="7", height="2", fg="black", bg="#FFFFFF",
                 command=lambda b='2': sid(b)).place(x=350, y=100)
b3 = Button(p2,text="3", font=('', 25), width="7", height="2", fg="black", bg="#FFFFFF",
                 command=lambda b='3': sid(b)).place(x=550, y=100)  # 250/125
b4 = Button(p2,text="4", font=('', 25), width="7", height="2", fg="black", bg="#FFFFFF",
                 command=lambda b='4': sid(b)).place(x=150, y=225)
b5 = Button(p2,text="5", font=('', 25), width="7", height="2", fg="black", bg="#FFFFFF",
                 command=lambda b='5': sid(b)).place(x=350, y=225)
b6 = Button(p2,text="6", font=('', 25), width="7", height="2", fg="black", bg="#FFFFFF",
                 command=lambda b='6': sid(b)).place(x=550, y=225)
b7 = Button(p2,text="7", font=('', 25), width="7", height="2", fg="black", bg="#FFFFFF",
                 command=lambda b='7': sid(b)).place(x=150, y=350)
b8 = Button(p2,text="8", font=('', 25), width="7", height="2", fg="black", bg="#FFFFFF",
                 command=lambda b='8': sid(b)).place(x=350, y=350)
b9 = Button(p2,text="9", font=('', 25), width="7", height="2", fg="black", bg="#FFFFFF",
                 command=lambda b='9': sid(b)).place(x=550, y=350)
back = Button(p2,text="BACK", font=('', 25), width="7", height="2", fg="black", bg="#FFFFFF",
                    command=lambda: raise_frame(p1) ).place(x=150, y=475)
b0 = Button(p2,text="0", font=('', 25), width="7", height="2", fg="black", bg="#FFFFFF",
                 command=lambda b='0': sid(b)).place(x=350, y=475)
bDel = Button(p2,text="Del", font=('', 25), width="7", height="2", fg="black", bg="#FFFFFF",
                   command=lambda b=' ': delSid()).place(x=550, y=475)
bOK = Button(p2,text="OK", font=('', 23), width="7", height="13", fg="black", bg="#FFFFFF",
                  command=lambda: BtnVerify()).place(x=750, y=100)
###############PAGE2 SCANNER FINGER

############### Enroll PAGE3
def callback(str):
    disp['text'] = disp['text'] + str

def calldel():
    id = disp['text']
    disp['text'] = disp['text'].replace(id, "")

def callOK():
    id = disp['text']
    if (len(id) == 12):
        print id
    else:
        tkMessageBox.showerror("Wrong StudentID", "Wrong StudentID")

disp = Label(p3, text="", font=('', 40), bg="#FFFFFF")
disp.place(x=152, y=13)

Button1 = Button(p3,text="1", font=('', 25), width="7", height="2", fg="black", bg="#FFFFFF",
                 command=lambda b='1': callback(b)).place(x=150, y=100)
Button2 = Button(p3,text="2", font=('', 25), width="7", height="2", fg="black", bg="#FFFFFF",
                 command=lambda b='2': callback(b)).place(x=350, y=100)
Button3 = Button(p3,text="3", font=('', 25), width="7", height="2", fg="black", bg="#FFFFFF",
                 command=lambda b='3': callback(b)).place(x=550, y=100)  # 250/125
Button4 = Button(p3,text="4", font=('', 25), width="7", height="2", fg="black", bg="#FFFFFF",
                 command=lambda b='4': callback(b)).place(x=150, y=225)
Button5 = Button(p3,text="5", font=('', 25), width="7", height="2", fg="black", bg="#FFFFFF",
                 command=lambda b='5': callback(b)).place(x=350, y=225)
Button6 = Button(p3,text="6", font=('', 25), width="7", height="2", fg="black", bg="#FFFFFF",
                 command=lambda b='6': callback(b)).place(x=550, y=225)
Button7 = Button(p3,text="7", font=('', 25), width="7", height="2", fg="black", bg="#FFFFFF",
                 command=lambda b='7': callback(b)).place(x=150, y=350)
Button8 = Button(p3,text="8", font=('', 25), width="7", height="2", fg="black", bg="#FFFFFF",
                 command=lambda b='8': callback(b)).place(x=350, y=350)
Button9 = Button(p3,text="9", font=('', 25), width="7", height="2", fg="black", bg="#FFFFFF",
                 command=lambda b='9': callback(b)).place(x=550, y=350)
Buttonback = Button(p3,text="BACK", font=('', 25), width="7", height="2", fg="black", bg="#FFFFFF",
                    command=lambda: raise_frame(p1) ).place(x=150, y=475)
Button0 = Button(p3,text="0", font=('', 25), width="7", height="2", fg="black", bg="#FFFFFF",
                 command=lambda b='0': callback(b)).place(x=350, y=475)
Buttondel = Button(p3,text="Del", font=('', 25), width="7", height="2", fg="black", bg="#FFFFFF",
                   command=lambda b=' ': calldel()).place(x=550, y=475)
ButtonOK = Button(p3,text="OK", font=('', 23), width="7", height="13", fg="black", bg="#FFFFFF",
                  command=lambda: callOK()).place(x=750, y=100)



root.mainloop()