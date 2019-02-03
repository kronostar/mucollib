#!/usr/local/bin/python3
# 
# Program: mucollib.py
#  Author: Steve Martin
# License: MIT
# Copyright (c) 2018,2019 Steve Martin
#

import tkinter as tk
from tkinter import messagebox, Button, Listbox, Label, Scrollbar, Toplevel, Frame
import sqlite3 as lite
import sys

import crud
import dbimport

win = tk.Tk()
win.geometry("+30+30")
win.title("Music Collection Library")

def msgImportData(db):
    result = messagebox.askyesno('Database Created', \
        'Do you wish to import a CSV file to populate the database?')
    if result is True:
        dbimport.importCSV(db)
    
def startPage():
    # frames for layout
    topFrame = Frame(win,relief=tk.RAISED, borderwidth=1, bg = "black")
    topFrame.grid(column = 0, row = 1, columnspan = 27)
    listFrame = Frame(win)
    listFrame.grid(column = 0, row = 2)
    sideFrame = Frame(win, borderwidth=1)
    sideFrame.grid(column = 1, row = 2)

    label1 = Label(listFrame, text = "Artists", font = ("Helvetica", 16))
    label1.grid(column = 0, row = 0)
    scrollbar1 = Scrollbar(listFrame, orient = tk.VERTICAL)
    scrollbar1.grid(column = 1, row = 1, sticky = 'NS')
    listbox1 = Listbox(listFrame, width = 60, yscrollcommand = scrollbar1.set)
    listbox1.grid(column = 0, row = 1)
    scrollbar1.config(command = listbox1.yview)

    label2 = Label(listFrame, text = "Albums", font = ("Helvetica", 16))
    label2.grid(column = 2, row = 0)
    scrollbar2 = Scrollbar(listFrame, orient = tk.VERTICAL)
    scrollbar2.grid(column = 3, row = 1, sticky = 'NS')
    listbox2 = Listbox(listFrame, width = 60, yscrollcommand = scrollbar2.set)
    listbox2.grid(column = 2, row = 1)
    scrollbar2.config(command = listbox2.yview)

    listbox1.bind('<<ListboxSelect>>', lambda e : crud.selectArtist(e, listbox1, listbox2, db))
    listbox2.bind('<<ListboxSelect>>', lambda e : crud.selectAlbum(e, db))

    btext = ('ABCDEFGHIJKLMNOPQRSTUVWXYZ')
    label3 = Label(topFrame, text = "Select Artist Group", bg = "black", fg = "white")
    label3.grid(column = 0, row = 0)
    artistButton0 = Button(topFrame, text="All")
    artistButton0.configure(command = lambda: crud.selectArtistGroup(db, 'All', listbox1, listbox2))
    artistButton0.grid(column = 1, row = 0)
    button = list()
    for i in range(26):
        button.append(Button(topFrame, text = btext[i]))
        button[i].configure(command = lambda x = btext[i]: crud.selectArtistGroup(db, x, listbox1, listbox2))
        button[i].grid(column = i + 2, row = 0)
    crud.selectArtistGroup(db, 'All', listbox1, listbox2)
    
    addButton = Button(sideFrame, text = "Add Album")
    addButton.grid(column = 1, row = 0)
    closeButton = Button(sideFrame, text = "Quit", command = win.destroy)
    closeButton.grid(column = 1, row = 1)

with lite.connect('music.db') as con:
    db = con.cursor()
    try:
        crud.selectRow(db, '*', 'Artist', '', '', ())
    except:
        crud.createDatabase(db)
        msgImportData(db)

    startPage()

win.mainloop()
