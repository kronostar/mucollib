#
# 
# Program: crud.py
#  Author: Steve Martin
# License: BSD-3-Clause
# Copyright (C) 2018,2019,2021,2025 Steve Martin
#
# Create, Read, Update, Display
#
import tkinter as tk
from tkinter import messagebox, Button, Entry, Listbox, Label, Scrollbar, Toplevel, ttk, Frame
import datetime
# from cgitb import text

myArtistData = []
myAlbumData = []

# Create
def createDatabase(db):
    db.execute("DROP TABLE IF EXISTS Album")
    db.execute("DROP TABLE IF EXISTS Artist")
    db.execute("DROP TABLE IF EXISTS Format")
    db.execute("DROP TABLE IF EXISTS Genre")
    db.execute("DROP TABLE IF EXISTS Label")

    db.execute("CREATE TABLE Artist(ArtistId INTEGER PRIMARY KEY ASC, Name TEXT NOT NULL, Sort TEXT NOT NULL)")
    db.execute("CREATE INDEX Sort ON Artist(Sort ASC)")

    db.execute("CREATE TABLE Format(FormatId INTEGER PRIMARY KEY ASC, Name TEXT NOT NULL)")
    db.execute("CREATE TABLE Genre(GenreId INTEGER PRIMARY KEY ASC, Name TEXT NOT NULL)")
    db.execute("CREATE TABLE Label(LabelId INTEGER PRIMARY KEY ASC, Name TEXT NOT NULL)")

    db.execute("CREATE TABLE Album(AlbumId INTEGER PRIMARY KEY ASC,\
        Name TEXT NOT NULL,\
        Year INTEGER NOT NULL,\
        OrigYear INTEGER NOT NULL,\
        ArtistId INTEGER NOT NULL,\
        FormatId INTEGER NOT NULL,\
        GenreId INTEGER NOT NULL,\
        LabelId INTEGER NOT NULL,\
        OrigLabelId INTEGER NOT NULL,\
        FOREIGN KEY(ArtistId) REFERENCES Artist(ArtistId),\
        FOREIGN KEY(FormatId) REFERENCES Format(FormatId),\
        FOREIGN KEY(GenreId) REFERENCES Genre(GenreId),\
        FOREIGN KEY(LabelId) REFERENCES Label(LabelId),\
        FOREIGN KEY(OrigLabelId) REFERENCES Label(LabelId))")
    db.execute("CREATE INDEX fk_Album_Artist ON Album(ArtistId ASC)")
    db.execute("CREATE INDEX fk_Album_Format ON Album(FormatId ASC)")
    db.execute("CREATE INDEX fk_Album_Genre ON Album(GenreId ASC)")
    db.execute("CREATE INDEX fk_Album_Label ON Album(LabelId ASC)")
    db.execute("CREATE INDEX fk_Album_OrigLabel ON Album(OrigLabelId ASC)")
    
    # insert start values for format, genre and label
    insertRow(db, 'Format(Name)', ("CD",))
    insertRow(db, 'Genre(Name)', ("Rock",))
    insertRow(db, 'Label(Name)', ("Enter/Choose a Record label",))

def insertRow(db, table, data):
    sql = "INSERT INTO " + table + " VALUES("
    i = 0
    while i < len(data):
        if i != 0: sql += ","
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

def albumPage(con, db, listbox1, listbox2, myId):
    now = datetime.datetime.now()
    year = now.year + 1

    # get album data
    if myId == 0:
        myAlbum = [(myId, "New Album", 1900, 1900, 0, 1, 1, 1, 1)]
        myArtist = [("Unknown",)]
    else:
        myAlbum = selectRow(db, 'AlbumId,Name,Year,OrigYear,ArtistId,FormatId,GenreId,LabelId,OrigLabelId', 'Album', 'AlbumId = ?', '', (myId,))
        myArtist = selectRow(db, 'Name', 'Artist', 'ArtistId = ?', '', (myAlbum[0][4],))
    myFormat = selectComboValues(db, 'Name', 'Format')
    myGenre = selectComboValues(db, 'Name', 'Genre')
    myLabel = selectComboValues(db, 'Name', 'Label')
    myOrigLabel = selectComboValues(db, 'Name', 'Label')
    
    # the window
    album = Toplevel()
    album.title(myAlbum[0][1])
    album.geometry("+150+300")

    # the frames for layout
    topFrame = Frame(album, width = 400, height = 100)
    topFrame.grid(column = 0, row = 0)
    buttonframe = Frame(album, width = 400, height = 10)
    buttonframe.grid(column = 0, row = 9)
    
    # the form
    Label(topFrame, text = "Artist").grid(column = 0, row = 1)
    Label(topFrame, text = "Title").grid(column = 0, row = 2)
    Label(topFrame, text = "This Release").grid(column = 0, row = 3)
    Label(topFrame, text = "Original Release").grid(column = 0, row = 4)
    Label(topFrame, text = "Format").grid(column = 0, row = 5)
    Label(topFrame, text = "Genre").grid(column = 0, row = 6)
    Label(topFrame, text = "Label").grid(column = 0, row = 7)
    Label(topFrame, text = "Original Label").grid(column = 0, row = 8)
    e1 = Entry(topFrame, width = 40)
    e2 = Entry(topFrame, width = 40)
    e3 = ttk.Combobox(topFrame, values = list(range(1900, year)))
    e4 = ttk.Combobox(topFrame, values = list(range(1900, year)))
    e5 = ttk.Combobox(topFrame, values = myFormat)
    e6 = ttk.Combobox(topFrame, values = myGenre)
    e7 = ttk.Combobox(topFrame, values = myLabel)
    e8 = ttk.Combobox(topFrame, values = myOrigLabel)
    e1.insert(32,myArtist[0][0])
    e2.insert(32,myAlbum[0][1])
    e3.current(myAlbum[0][2] - 1900)
    e4.current(myAlbum[0][3] - 1900)
    e5.current(myAlbum[0][5] - 1)
    e6.current(myAlbum[0][6] - 1)
    e7.current(myAlbum[0][7] - 1)
    e8.current(myAlbum[0][8] - 1)
    e1.grid(column = 1, row = 1)
    e2.grid(column = 1, row = 2)
    e3.grid(column = 1, row = 3)
    e4.grid(column = 1, row = 4)
    e5.grid(column = 1, row = 5)
    e6.grid(column = 1, row = 6)
    e7.grid(column = 1, row = 7)
    e8.grid(column = 1, row = 8)
    b1 = Button(buttonframe, text = "Save")
    b1.configure(command = lambda: updateAlbum(con, db, listbox1, listbox2, album, (myAlbum[0][0], e1, e2,e3,e4,e5,e6,e7,e8)))
    b2 = Button(buttonframe, text = "Close", command = album.destroy)
    b1.grid(column = 0, row = 0)
    b2.grid(column = 1, row = 0)

def artistPage(con, db, listbox1, listbox2, myId):
    myArtist = selectRow(db, 'ArtistId,Name,Sort', 'Artist', 'ArtistId = ?', '', (myId,))

    # the window
    artist = Toplevel()
    artist.title("Edit Artist")
    artist.geometry("+150+300")

    # the frames for layout
    topFrame = Frame(artist, width = 400, height = 100)
    topFrame.grid(column = 0, row = 0)
    buttonframe = Frame(artist, width = 400, height = 10)
    buttonframe.grid(column = 0, row = 6)
    
    # the form
    Label(topFrame, text = "Name").grid(column = 0, row = 1)
    Label(topFrame, text = "Sort").grid(column = 0, row = 2)
    e1 = Entry(topFrame, width = 40)
    e2 = Entry(topFrame, width = 40)
    e1.insert(32,myArtist[0][1])
    e2.insert(32,myArtist[0][2])
    e1.grid(column = 1, row = 1)
    e2.grid(column = 1, row = 2)
    b1 = Button(buttonframe, text = "Save")
    b1.configure(command = lambda: updateArtist(con, db, listbox1, listbox2, artist, (myArtist[0][0], e1, e2)))
    b2 = Button(buttonframe, text = "Close", command = artist.destroy)
    b1.grid(column = 0, row = 0)
    b2.grid(column = 1, row = 0)
    
# Read
def selectComboValues(db, field, table):
    sql = "SELECT " + field + " FROM " + table
    db.execute(sql)
    data = []
    for row in db.fetchall():
        data.append(row[0])
    return data

def selectRow(db, field, table, condition, ordering, data):
    sql = "SELECT " + field + " FROM " + table
    if condition != '':
        sql += " WHERE " + condition
    if ordering != '':
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

def getLabelByName(db, myName):
    return selectRow(db, 'LabelId', 'Label', 'Name = ?', '', (myName,))

def getAlbumsByArtist(db, myID):
    if myID == 0:
        return selectRow(db, 'AlbumId,Album.Name', 'Artist, Album', \
                            'Album.ArtistId = Artist.ArtistId', \
                            'Artist.Sort COLLATE NOCASE, Album.OrigYear', ())
    else:
        return selectRow(db, 'AlbumId,Name', 'Album', \
                            'ArtistId = ?', 'OrigYear', (myID,))

def selectArtistGroup(db, group, l1, l2):
    if group == 'All':
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


def selectArtistById(db, myId, l1, l2):
    global myArtistData
    global myAlbumData
    myArtists = getArtistById(db, myId)
    myAlbums = getAlbumsByArtist(db, myId)
    displayDataInList(l1, myArtists)
    displayDataInList(l2, myAlbums)
    myAlbumData = myAlbums
    myArtistData = myArtists

def editArtist(event, con, listbox1, listbox2, db):
    try:
        global myArtistData
        artistPage(con, db, listbox1, listbox2, myArtistData[0][0])
    except:
        return

def selectAlbum(event, con, db, listbox1, listbox2):
    w = event.widget
    try:
        idx = int(w.curselection()[0])
        global myAlbumData
        albumPage(con, db, listbox1, listbox2, myAlbumData[idx][0])
    except:
        return

# Update
def updateArtist(con, db, listbox1, listbox2, myWindow, data):
    detail = (data[1].get(), data[2].get(), data[0])
    sql = "UPDATE Artist\n"
    sql += "SET Name = ?, Sort = ? "
    sql += "WHERE ArtistId = ?"
    db.execute(sql,(detail))
    
    con.commit()
    selectArtistById(db, data[0], listbox1, listbox2)
    myWindow.destroy()

def updateAlbum(con, db, listbox1, listbox2, myWindow, data):
    artistName = data[1].get()
    artistid = getArtistByName(db, artistName)
    if len(artistid) == 0: # new artist
        detail = (artistName, artistName)
        insertRow(db, 'Artist(Name, Sort)', detail)
        artistid = getArtistByName(db, artistName)
        
    year = int(data[3].get())
    origyear = int(data[4].get())

    formatName = data[5].get()
    formatid = getFormatByName(db, formatName)
    if len(formatid) == 0: # new format
        insertRow(db, 'Format(Name)', (formatName,))
        formatid = getFormatByName(db, formatName)    
    
    genreName = data[6].get()
    genreid = getGenreByName(db, genreName)
    if len(genreid) == 0: # new genre
        insertRow(db, 'Genre(Name)', (genreName,))
        genreid = getGenreByName(db, genreName)
        
    labelName = data[7].get()
    labelid = getLabelByName(db, labelName)
    if len(labelid) == 0: # new label
        insertRow(db, 'Label(Name)', (labelName,))
        labelid = getLabelByName(db, labelName)

    origlabelName = data[8].get()
    origlabelid = getLabelByName(db, origlabelName)
    if len(origlabelid) == 0: # new label
        insertRow(db, 'Label(Name)', (origlabelName,))
        origlabelid = getLabelByName(db, origlabelName)

    if data[0] == 0: # new album
        detail = (data[2].get(), year, origyear, artistid[0][0], formatid[0][0], genreid[0][0], labelid[0][0], origlabelid[0][0])
        insertRow(db, 'Album(Name, Year, OrigYear, ArtistId, FormatId, GenreId, LabelId, OrigLabelId)', detail)
    else:
        detail = (data[2].get(), year, origyear, artistid[0][0], formatid[0][0], genreid[0][0], labelid[0][0], origlabelid[0][0], data[0])
        sql = "UPDATE Album\n"
        sql += "SET Name = ?, Year = ?, OrigYear = ?, ArtistId = ?, FormatId = ?, GenreId = ?, LabelId = ?, OrigLabelId = ? "
        sql += "WHERE AlbumId = ?"
        db.execute(sql,(detail))
    
    cleanArtists(db)
    con.commit()
    selectArtistGroup(db, 'All', listbox1, listbox2)
    myWindow.destroy()

def cleanArtists(db):
    # remove artists with no albums
    myArtists = getAllArtistsByName(db)
    for key, value in myArtists:
        myAlbums = getAlbumsByArtist(db, key)
        if len(myAlbums) == 0:
            sql = 'DELETE FROM Artist WHERE ArtistId = ?'
            db.execute(sql, (key,))

    
