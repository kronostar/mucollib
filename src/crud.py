#!/usr/local/bin/python3
# 
# Program: crud.py
#  Author: Steve Martin
# License: MIT
# Copyright (c) 2018,2019 Steve Martin
#
# Create, Read, Update, Display
#
import tkinter as tk
from tkinter import messagebox, Button, Entry, Listbox, Label, Scrollbar, Toplevel, ttk, Frame
import datetime
from idlelib import window


myArtistData = []
myAlbumData = []

# Create
def createDatabase(db):
    db.execute("DROP TABLE IF EXISTS Album")
    db.execute("DROP TABLE IF EXISTS Artist")
    db.execute("DROP TABLE IF EXISTS Format")
    db.execute("DROP TABLE IF EXISTS Genre")

    db.execute("CREATE TABLE Artist(ArtistId INTEGER PRIMARY KEY ASC, Name TEXT NOT NULL, Sort TEXT NOT NULL)")
    db.execute("CREATE INDEX Sort ON Artist(Sort ASC)")

    db.execute("CREATE TABLE Format(FormatId INTEGER PRIMARY KEY ASC, Name TEXT NOT NULL)")
    db.execute("CREATE TABLE Genre(GenreId INTEGER PRIMARY KEY ASC, Name TEXT NOT NULL)")

    db.execute("CREATE TABLE Album(AlbumId INTEGER PRIMARY KEY ASC, Name TEXT NOT NULL, Year INTEGER NOT NULL, ArtistId INTEGER NOT NULL, FormatId INTEGER NOT NULL, GenreId INTEGER NOT NULL, FOREIGN KEY(ArtistId) REFERENCES Artist(ArtistId), FOREIGN KEY(FormatId) REFERENCES Format(FormatId), FOREIGN KEY(GenreId) REFERENCES Genre(GenreId))")
    db.execute("CREATE INDEX fk_Album_Artist ON Album(ArtistId ASC)")
    db.execute("CREATE INDEX fk_Album_Format ON Album(FormatId ASC)")
    db.execute("CREATE INDEX fk_Album_Genre ON Album(GenreId ASC)")

def insertRow(db, table, data):
    sql = "INSERT INTO " + table + " VALUES("
    i = 0
    while i < len(data):
        if i is not 0: sql += ","
        sql += "?"
        i += 1
    sql += ") "
    db.execute(sql, (data))
    return db.lastrowid

# Display
def displayDataInList(l, data):
    # data is in format id,name
    l.delete(0, tk.END)
    for key,value in data:
        l.insert(tk.END, value)

def albumPage(db, myId):
    now = datetime.datetime.now()
    year = now.year + 1

    # get album data
    myAlbum = selectRow(db, 'AlbumId,Name,Year,ArtistId,FormatId,GenreId', 'Album', 'AlbumId = ?', '', (myId,))
    myArtist = selectRow(db, 'Name', 'Artist', 'ArtistId = ?', '', (myAlbum[0][3],))
    myFormat = selectRow(db, 'Name', 'Format', '', '', ())
    myGenre = selectRow(db, 'Name', 'Genre', '', '', ())
    album = Toplevel()
    album.title(myAlbum[0][1])
    album.geometry("+150+300")

    # the frames for layout
    topFrame = Frame(album, width = 400, height = 100)
    topFrame.grid(column = 0, row = 0)
    buttonframe = Frame(album, width = 400, height = 10)
    buttonframe.grid(column = 0, row = 6)
    
    # the form
    label1 = Label(topFrame, text = "Artist").grid(column = 0, row = 1)
    label2 = Label(topFrame, text = "Title").grid(column = 0, row = 2)
    label3 = Label(topFrame, text = "Year").grid(column = 0, row = 3)
    label4 = Label(topFrame, text = "Format").grid(column = 0, row = 4)
    label5 = Label(topFrame, text = "Genre").grid(column = 0, row = 5)
    e1 = Entry(topFrame, width = 40)
    e2 = Entry(topFrame, width = 40)
    e3 = ttk.Combobox(topFrame, values = list(range(1900, year)))
    e4 = ttk.Combobox(topFrame, values = myFormat)
    e5 = ttk.Combobox(topFrame, values = myGenre)
    e1.insert(32,myArtist[0][0])
    e2.insert(32,myAlbum[0][1])
    e3.current(myAlbum[0][2] - 1900)
    e4.current(myAlbum[0][4] - 1)
    e5.current(myAlbum[0][5] - 1)
    e1.grid(column = 1, row = 1)
    e2.grid(column = 1, row = 2)
    e3.grid(column = 1, row = 3)
    e4.grid(column = 1, row = 4)
    e5.grid(column = 1, row = 5)
    b1 = Button(buttonframe, text = "Save")
    b1.configure(command = lambda: updateAlbum(db, myAlbum, e1, e2, e3, e4, e5))
    b2 = Button(buttonframe, text = "Close", command = album.destroy)
    b1.grid(column = 0, row = 0)
    b2.grid(column = 1, row = 0)

# Read
def selectRow(db, field, table, condition, ordering, data):
    sql = "SELECT " + field + " FROM " + table
    if condition is not '':
        sql += " WHERE " + condition
    if ordering is not '':
        sql += " ORDER BY " + ordering
    db.execute(sql, (data))
    return db.fetchall()

def getAllArtistsByName(db):
    return selectRow(db, 'ArtistId,Name', 'Artist', '', 'Sort COLLATE NOCASE', ())

def getArtistById(db, myID):
    return selectRow(db, 'ArtistId,Name', 'Artist', 'ArtistId = ?', '', (myID,))

def getArtistByName(db, myName):
    return selectRow(db, 'ArtistId', 'Artist', 'Name = ?', '', (myName,))

def getFormatByName(db, myName):
    return selectRow(db, 'FormatId', 'Format', 'Name = ?', '', (myName,))

def getGenreByName(db, myName):
    return selectRow(db, 'GenreId', 'Genre', 'Name = ?', '', (myName,))

def getAlbumsByArtist(db, myID):
    if myID is 0:
        return selectRow(db, 'AlbumId,Album.Name', 'Artist, Album', \
                            'Album.ArtistId = Artist.ArtistId', \
                            'Artist.Sort COLLATE NOCASE, Album.Year', ())
    else:
        return selectRow(db, 'AlbumId,Name', 'Album', \
                            'ArtistId = ?', 'Year', (myID,))

def selectArtistGroup(db, group, l1, l2):
    if group is 'All':
        myArtists = getAllArtistsByName(db)
        myAlbums = getAlbumsByArtist(db, 0)
    else:
        myArtists = selectRow(db, 'ArtistId,Name', 'Artist', \
                                   'Sort LIKE "' + group + '%"', \
                                   'Sort COLLATE NOCASE', ())
        myAlbums = selectRow(db, 'AlbumId,Album.Name', 'Artist, Album', \
                                  'Artist.Sort LIKE "' + group + '%" AND Album.ArtistId = Artist.ArtistId', \
                                  'Artist.Sort COLLATE NOCASE, Album.Year', ())
    displayDataInList(l1, myArtists)
    displayDataInList(l2, myAlbums)
    global myArtistData
    global myAlbumData
    myArtistData = myArtists
    myAlbumData = myAlbums

def selectArtist(event, l1, l2, db):
    w = event.widget
    try:
        idx = int(w.curselection()[0])
        global myArtistData
        global myAlbumData
        myArtists = getArtistById(db, myArtistData[idx][0])
        myAlbums = getAlbumsByArtist(db, myArtistData[idx][0])
        displayDataInList(l1, myArtists)
        displayDataInList(l2, myAlbums)
        myAlbumData = myAlbums
        myArtistData = myArtists
    except:
        return

def selectAlbum(event, db):
    w = event.widget
    try:
        idx = int(w.curselection()[0])
        global myAlbumData
        albumPage(db, myAlbumData[idx][0])
    except:
        return
    

# Update
def updateAlbum(db, myAlbum, f1, f2, f3, f4, f5):
    print("Artist: %s\nAlbum: %s\nYear: %s\nFormat: %s\nGenre: %s\n" % (f1.get(), f2.get(), f3.get(), f4.get(), f5.get()))
    artistid = getArtistByName(db, f1.get())
    formatid = getFormatByName(db, f4.get())
    genreid = getGenreByName(db, f5.get())
    detail = (f2.get(), f3.get(), artistid[0][0], formatid[0][0], genreid[0][0],)
    print(detail)
#    updateRow(db, 'Album(Name, Year, ArtistId, FormatId, GenreId)', detail)

