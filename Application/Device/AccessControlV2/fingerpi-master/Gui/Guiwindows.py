from tkinter import *
import sys
import time
root = Tk()
root.attributes('-fullscreen', True)

def Page1(root):
   page1 = Frame(root)
   page1.tkraise()
   timelocal = StringVar()
   Time = Label( page1, textvariable=timelocal,font=('',50), width="20",height="3").pack()
   localtime = time.strftime("%H:%M:%S",time.gmtime())
   timelocal.set(localtime)
   Add = Button(page1, text="Add Figger", font="1", width="20", height="10", fg="red", bg="black").place(x=600, y=250)
   Scan = Button(page1, text="Scanner Finger", font="1", fg="red", bg="black", width="20", height="10").place(x=230, y=250)



# def Page2():



Page1(root)
root.mainloop()