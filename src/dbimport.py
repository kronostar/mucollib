#
# 
# Program: dbimport.py
#  Author: Steve Martin
# License: MIT
# Copyright (C) 2018,2019,2021 Steve Martin
#
# CSV file format:
# 0 = Artist Name
# 1 = Artist Sort
# 2 = Album Name
# 3 = Format
# 4 = Genre
# 5 = Year
# 6 = Original Year
# 7 = Label
# 8 = Original Label
#

import csv

import crud

csvFields = {
    'artist':0,
    'sort':1,
    'album':2,
    'format':3,
    'genre':4,
    'year':5,
    'released':6,
    'label':7,
    'olabel':8,
}

def importCSV(db):
    with open('Music.csv') as csvfile:
        records = 0
        line = csv.reader(csvfile, delimiter = ',')
        for data in line:
            records += 1
            if records is not 1:
                result = crud.selectRow(db, 'ArtistId', 'Artist', 'Name = ?', '', \
                    (data[csvFields['artist']],))
                if len(result) is 0:
                    detail = (data[csvFields['artist']], data[csvFields['sort']],)
                    artistid = crud.insertRow(db, 'Artist(Name, Sort)', detail)
                else:
                    artistid = result[0][0]

                result = crud.selectRow(db, 'FormatId', 'Format', 'Name = ?', '', \
                    (data[csvFields['format']],))
                if len(result) is 0:
                    formatid = crud.insertRow(db, 'Format(Name)', (data[csvFields['format']],))
                else:
                    formatid = result[0][0]

                result = crud.selectRow(db, 'GenreId', 'Genre', 'Name = ?', '', \
                    (data[csvFields['genre']],))
                if len(result) is 0:
                    genreid = crud.insertRow(db, 'Genre(Name)', (data[csvFields['genre']],))
                else:
                    genreid = result[0][0]
                
                myYear = data[csvFields['released']]
                if myYear is '':
                    myYear = 1900
                detail = (data[csvFields['album']], myYear, artistid, formatid, genreid,)
                crud.insertRow(db, 'Album(Name, Year, ArtistId, FormatId, GenreId)', detail)
