#!/usr/local/bin/python3
# 
# Program: mucollib.py
#  Author: Steve Martin
# License: MIT
# Copyright (c) 2018,2019 Steve Martin
#

import tkinter as tk
from tkinter import messagebox, Button, Listbox, Label, Scrollbar
import sqlite3 as lite
import sys

import crud
import dbimport

win = tk.Tk()
#win.geometry("800x400")
win.title("Music Collection Library")

def msgImportData(db):
    result = messagebox.askyesno('Database Created', \
        'Do you wish to import a CSV file to populate the database?')
    if result is True:
        dbimport.importCSV(db)
    
def startPage():
    btnFrame = tk.Frame(win,relief=tk.RAISED, borderwidth=1, bg = "black")
    btnFrame.grid(column = 0, row = 1, columnspan = 27)

    label1 = Label(win, text = "Artists", font = ("Helvetica", 16))
    label1.grid(column = 0, row = 2)
    scrollbar1 = Scrollbar(win, orient = tk.VERTICAL)
    scrollbar1.grid(column = 1, row = 3, sticky = 'NS')
    listbox1 = Listbox(win, width = 60, yscrollcommand = scrollbar1.set)
    listbox1.grid(column = 0, row = 3)
    scrollbar1.config(command = listbox1.yview)

    label2 = Label(win, text = "Albums", font = ("Helvetica", 16))
    label2.grid(column = 2, row = 2)
    scrollbar2 = Scrollbar(win, orient = tk.VERTICAL)
    scrollbar2.grid(column = 3, row = 3, sticky = 'NS')
    listbox2 = Listbox(win, width = 60, yscrollcommand = scrollbar2.set)
    listbox2.grid(column = 2, row = 3)
    scrollbar2.config(command = listbox2.yview)

    listbox1.bind('<<ListboxSelect>>', lambda e : crud.selectArtist(e, listbox2, db))
    listbox2.bind('<<ListboxSelect>>', lambda e : crud.selectAlbum(e, db))

    btext = ('ABCDEFGHIJKLMNOPQRSTUVWXYZ')
    label3 = Label(btnFrame, text = "Select Artist Group", bg = "black", fg = "white")
    label3.grid(column = 0, row = 0)
    artistButton0 = Button(btnFrame, text="All")
    artistButton0.configure(command = lambda: crud.selectArtistGroup(db, 'All', listbox1, listbox2))
    artistButton0.grid(column = 1, row = 0)
    button = list()
    for i in range(26):
        button.append(Button(btnFrame, text = btext[i]))
        button[i].configure(command = lambda x = btext[i]: crud.selectArtistGroup(db, x, listbox1, listbox2))
        button[i].grid(column = i + 2, row = 0)
    crud.selectArtistGroup(db, 'All', listbox1, listbox2)



with lite.connect('music.db') as con:
    db = con.cursor()
    try:
        crud.selectRow(db, '*', 'Artist', '', '', ())
    except:
        crud.createDatabase(db)
        msgImportData(db)

    startPage()


win.mainloop()
