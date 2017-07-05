from tkinter import *
import sys


windowsAdd = Tk()
windowsAdd.geometry("1024x600")
windowsAdd.title("WINDOWS")


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
        print "Wrong StudentID"

disp = Label(windowsAdd, text="", font=('', 40), bg="#FFFFFF")
disp.place(x=152, y=13)

Button1 = Button(text="1", font=('', 25), width="7", height="2", fg="black", bg="#FFFFFF",
                 command=lambda b='1': callback(b)).place(x=150, y=100)
Button2 = Button(text="2", font=('', 25), width="7", height="2", fg="black", bg="#FFFFFF",
                 command=lambda b='2': callback(b)).place(x=350, y=100)
Button3 = Button(text="3", font=('', 25), width="7", height="2", fg="black", bg="#FFFFFF",
                 command=lambda b='3': callback(b)).place(x=550, y=100)  # 250/125
Button4 = Button(text="4", font=('', 25), width="7", height="2", fg="black", bg="#FFFFFF",
                 command=lambda b='4': callback(b)).place(x=150, y=225)
Button5 = Button(text="5", font=('', 25), width="7", height="2", fg="black", bg="#FFFFFF",
                 command=lambda b='5': callback(b)).place(x=350, y=225)
Button6 = Button(text="6", font=('', 25), width="7", height="2", fg="black", bg="#FFFFFF",
                 command=lambda b='6': callback(b)).place(x=550, y=225)
Button7 = Button(text="7", font=('', 25), width="7", height="2", fg="black", bg="#FFFFFF",
                 command=lambda b='7': callback(b)).place(x=150, y=350)
Button8 = Button(text="8", font=('', 25), width="7", height="2", fg="black", bg="#FFFFFF",
                 command=lambda b='8': callback(b)).place(x=350, y=350)
Button9 = Button(text="9", font=('', 25), width="7", height="2", fg="black", bg="#FFFFFF",
                 command=lambda b='9': callback(b)).place(x=550, y=350)
Buttonback = Button(text="BACK", font=('', 25), width="7", height="2", fg="black", bg="#FFFFFF",
                    command=lambda b=' ': callback(b)).place(x=150, y=475)
Button0 = Button(text="0", font=('', 25), width="7", height="2", fg="black", bg="#FFFFFF",
                 command=lambda b='0': callback(b)).place(x=350, y=475)
Buttondel = Button(text="Del", font=('', 25), width="7", height="2", fg="black", bg="#FFFFFF",
                   command=lambda b=' ': calldel()).place(x=550, y=475)
ButtonOK = Button(text="OK", font=('', 23), width="7", height="13", fg="black", bg="#FFFFFF",
                  command=lambda: callOK()).place(x=750, y=100)

windowsAdd.mainloop()
