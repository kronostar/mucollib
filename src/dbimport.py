#
# 
# Program: dbimport.py
#  Author: Steve Martin
# License: BSD-3-Clause
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
            if records != 1:
                result = crud.selectRow(db, 'ArtistId', 'Artist', 'Name = ?', '', (data[csvFields['artist']],))
                if len(result) == 0:
                    detail = (data[csvFields['artist']], data[csvFields['sort']])
                    artistid = crud.insertRow(db, 'Artist(Name, Sort)', detail)
                else:
                    artistid = result[0][0]

                result = crud.selectRow(db, 'FormatId', 'Format', 'Name = ?', '', (data[csvFields['format']],))
                if len(result) == 0:
                    formatid = crud.insertRow(db, 'Format(Name)', (data[csvFields['format']],))
                else:
                    formatid = result[0][0]

                result = crud.selectRow(db, 'GenreId', 'Genre', 'Name = ?', '', (data[csvFields['genre']],))
                if len(result) == 0:
                    genreid = crud.insertRow(db, 'Genre(Name)', (data[csvFields['genre']],))
                else:
                    genreid = result[0][0]
                    
                result = crud.selectRow(db, 'LabelId', 'Label', 'Name = ?', '', (data[csvFields['label']],))
                if len(result) == 0:
                    labelid = crud.insertRow(db, 'Label(Name)', (data[csvFields['label']],))
                else:
                    labelid = result[0][0]
                    
                result = crud.selectRow(db, 'LabelId', 'Label', 'Name = ?', '', (data[csvFields['olabel']],))
                if len(result) == 0:
                    origlabelid = crud.insertRow(db, 'Label(Name)', (data[csvFields['olabel']],))
                else:
                    origlabelid = result[0][0]

                thisRelease = data[csvFields['year']]
                if thisRelease == '':
                    thisRelease = 1900

                myYear = data[csvFields['released']]
                if myYear == '':
                    myYear = 1900
                    
                detail = (data[csvFields['album']], thisRelease, myYear, artistid, formatid, genreid, labelid, origlabelid)
                crud.insertRow(db, 'Album(Name, Year, OrigYear, ArtistId, FormatId, GenreId, LabelId, OrigLabelId)', detail)
