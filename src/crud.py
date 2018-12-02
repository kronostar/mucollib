#!/usr/local/bin/python3
# 
# Program: crud.py
#  Author: Steve Martin
# License: MIT
# Copyright (c) 2018 Steve Martin
#
# Create, Read, Update, Display
#

# Create
def createDatabase(db):
    db.execute("DROP TABLE IF EXISTS Artist")
    db.execute("DROP TABLE IF EXISTS Format")
    db.execute("DROP TABLE IF EXISTS Album")
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

# Read
def selectRow(db, field, table, condition, ordering, data):
    sql = "SELECT " + field + " FROM " + table
    if condition is not '':
        sql += " WHERE " + condition
    if ordering is not '':
        sql += " ORDER BY " + ordering
    print(sql)
    db.execute(sql, (data))
    return db.fetchall()

def getAllArtistsByName(db):
    return selectRow(db, 'Name', 'Artist', '', 'Sort COLLATE NOCASE', ())

def getAlbumsByArtist(db, myID):
    if myID is 0:
        return selectRow(db, 'Album.Name', 'Artist, Album', \
            'Album.ArtistId = Artist.ArtistId', \
            'Artist.Sort COLLATE NOCASE, Album.Year', ())
    else:
        return selectRow(db, 'Album.Name', 'Artist, Album', \
            'Album.ArtistId = ?', 'Album.Year', (myID,))

# Update

# Display
