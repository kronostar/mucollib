#!/usr/local/bin/python3
# 
# Program: mucollib.py
#  Author: Steve Martin
# License: MIT
# Copyright (c) 2018 Steve Martin
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
    
def selectArtistGroup(group, l1, l2):
    if group is 'All':
        myArtists = crud.getAllArtistsByName(db)
        myAlbums = crud.getAlbumsByArtist(db, 0)
    else:
        myArtists = crud.selectRow(db, 'Name', 'Artist', \
                                   'Sort LIKE "' + group + '%"', \
                                   'Sort COLLATE NOCASE', ())
        myAlbums = crud.selectRow(db, 'Album.Name', 'Artist, Album', \
                                  'Artist.Sort LIKE "' + group + '%" AND Album.ArtistId = Artist.ArtistId', \
                                  'Artist.Sort COLLATE NOCASE, Album.Year', ())
    l1.delete(0, tk.END)
    for item in myArtists:
        l1.insert(tk.END, item[0])
    l2.delete(0, tk.END)
    for item in myAlbums:
        l2.insert(tk.END, item[0])

def selectArtist(event, l2):
    w = event.widget
    try:
        idx = int(w.curselection()[0])
        value = w.get(idx)
        print('Artist selected', value)
        myAlbums = crud.selectRow(db, 'Album.Name', 'Artist, Album', \
                                  'Artist.Name LIKE "' + value + '" AND Album.ArtistId = Artist.ArtistId', \
                                  'Album.Year', ())
        l2.delete(0, tk.END)
        for item in myAlbums:
            l2.insert(tk.END, item[0])
    except:
        return

def selectAlbum(event):
    w = event.widget
    try:
        idx = int(w.curselection()[0])
        value = w.get(idx)
        print('Album selected', value)
    except:
        return

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
    myArtists = crud.getAllArtistsByName(db)
    for item in myArtists:
        listbox1.insert(tk.END, item[0])

    label2 = Label(win, text = "Albums", font = ("Helvetica", 16))
    label2.grid(column = 2, row = 2)
    scrollbar2 = Scrollbar(win, orient = tk.VERTICAL)
    scrollbar2.grid(column = 3, row = 3, sticky = 'NS')
    listbox2 = Listbox(win, width = 60, yscrollcommand = scrollbar2.set)
    listbox2.grid(column = 2, row = 3)
    scrollbar2.config(command = listbox2.yview)
    myAlbums = crud.getAlbumsByArtist(db, 0)
    for item in myAlbums:
        listbox2.insert(tk.END, item[0])

    listbox1.bind('<<ListboxSelect>>', lambda e, arg=listbox2 : selectArtist(e, arg))
    listbox2.bind('<<ListboxSelect>>', selectAlbum)

    btext = ('ABCDEFGHIJKLMNOPQRSTUVWXYZ')
    label3 = Label(btnFrame, text = "Select Artist Group", bg = "black", fg = "white")
    label3.grid(column = 0, row = 0)
    artistButton0 = Button(btnFrame, text="All")
    artistButton0.configure(command = lambda: selectArtistGroup('All', listbox1, listbox2))
    artistButton0.grid(column = 1, row = 0)
    button = list()
    for i in range(26):
        button.append(Button(btnFrame, text = btext[i]))
        button[i].configure(command = lambda x = btext[i]: selectArtistGroup(x, listbox1, listbox2))
        button[i].grid(column = i + 2, row = 0)
    



with lite.connect('music.db') as con:
    db = con.cursor()
    try:
        crud.selectRow(db, '*', 'Artist', '', '', ())
    except:
        crud.createDatabase(db)
        msgImportData(db)

    startPage()


win.mainloop()
