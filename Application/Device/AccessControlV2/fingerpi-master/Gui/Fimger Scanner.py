from tkinter import *
from tkinter import ttk
import time;
windows = Tk()
windows.geometry("1024x600")
windows.title("WINDOWS")

#addlabel=ttk.Button(windows).pack()111
#mi = PhotoImage(file="D:\\gui\\unlog.png")
#addlabel.config(image=mi,compound=RIGHT)
Scan=Button(text="Finger Scanner",font=("",25),width="20",height="5").place(x=330, y=150)




windows.mainloop()