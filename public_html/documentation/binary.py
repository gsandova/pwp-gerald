#!/usr/bin/python
#  Gerald Sandoval  -  gsandoval.net
#  Programming Challenge
#
#  File:  Binary.py   (Python)
#  This program extracts the individual bytes of a binary file '00_LHZ.512.seed'
#  and subsequently parses out the desired data then and displays this data on
#  the terminal.
#
#  This program was built and ran on a Raspberry Pi
#

import function
from function import Block310Data

BIT2 = 4
BIT4 = 16

numBlocks = 0
index = 0
record = 0
recordNum = 0
finished = False
coupling = '\0'
dataList = []

# Open the input and output files.
infile = open("00_LHZ.512.seed", "rb")
byteArray = map (ord, infile.read () )

# Get size of binary file
fileSize = infile.tell();

#************************************************
#  Each RECORD will be indexed and searched
#
#  RECORD:  byte[x thru (x + 511]
#  where, x: record number < x < number of records
#
#  RECORD header: byte[x thru (x+47)]
#  "1000" type bolckette: byte[(x+48), (x+49)]
#  "next" bolckette: byte[(x+51), (x+51)]
#  next = 0 indicates the last blockette of the record
#************************************************/
for record in range(0, fileSize, 512):
    finished = 0
    numBlocks += 1

    # the "next" index from the 1000 type blockette
    index = record + 50

    # the "next" blockette index data
    byte1 = byteArray[index]
    byte0 = byteArray[index+1]
    if __name__ == "__main__":
        next = function.convertNum2Bytes(byte1, byte0)

    # use the "next' index to scroll the next blockette
    while finished == False:
        index = record + next

        # get the blockette type and the "next" index
        byte1 = byteArray[index]
        byte0 = byteArray[index+1]
        if __name__ == "__main__":
                block = function.convertNum2Bytes(byte1, byte0)

        byte1 = byteArray[index+2]
        byte0 = byteArray[index+3]
        if __name__ == "__main__":
            next = function.convertNum2Bytes(byte1, byte0)

        numBlocks += 1

   #  When a type "310" blockette has been found.  The data is extracted
   #  and a dynamic link list is created to store the data
   #
   #  Blockette tpye "310":
   #  Calibration flags bits:  byte[(index+15)]
   #    - bit 2: calibration was automatic
   #    - bit 4: peak-to-peak amplitude
   # Calibration duration (integer): byte[(index+16) thru (index+19)]
   # Calibration coupling (string): byte[(index+36) thru (index+47)]
        if(block == 310):
            coupling = '\0'

            # Calibration flag bits
            flags = byteArray[index+15]

            if (flags & BIT2):
                automatic = True
            else:
                automatic = False

            if (flags & BIT4):
                p2pAplitude = True
            else:
                p2pAplitude = False

            # Extract the Calibration Duration data
            byte3 = byteArray[index+16]
            byte2 = byteArray[index+17]
            byte1 = byteArray[index+18]
            byte0 = byteArray[index+19]

            if __name__ == "__main__":
                duration = function.convertNum4Bytes(byte3, byte2, byte1, byte0)

            # Calibration coupling 12 byte string data
            for j in range(0, 12):
                numDec = byteArray[index+36+j]
                coupling += str(unichr(numDec))

            dataList.append(Block310Data(recordNum, automatic, p2pAplitude, duration, coupling))

            # END of 'if' 310 block


        # 310 blockette is complete
        # exit the while loop when the 'next' index is 0
        if (next == 0):
            finished = True
        # END of while loop

    # blockette search complete, go to next record
    recordNum += 1
    # END of FOR loop

# All records have been searched

print "Python Output:"
print "File size:  ", fileSize
print "\nNumber of Blockettes in the file: " ,numBlocks
for i in range(0, len(dataList)):
    print "\nRecord:  " , dataList[i].recordNum
    print "Calibration Automatic:  " , dataList[i].automatic
    print "peak to peak Amplitude:  ", dataList[i].p2pAplitude
    print "Calibration Duration:  ", dataList[i].duration
    print "Calibration Coupling:  ", dataList[i].coupling

infile.close()
