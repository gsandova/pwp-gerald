/**
 *  Gerald Sandoval - gsandoval.net
 *  Programming Challenge
 *
 *  File:  binary.h    C Programming Language (C99)

 *  This is a header file for binary.c which include the data
 *  link list that contains the paragraph data. Also are the
 *  functions to convert Byte data into a decimal number.
 */
#ifndef BINARY_H_H
#define BINARY_H

#include <stdio.h>
#include <stdlib.h>

#define FALSE 0
#define TRUE 1
#define BIT2 4
#define BIT4 16

// An unsigned char can store 1 Bytes (8bits) of data (0-255)
typedef unsigned char BYTE;

// convert hex bytes to an integer number
int hexToDec(BYTE byte1, BYTE byte0) {
     int msb, lsb, number;

     msb = byte1;
     lsb = byte0;

     number = (( msb * 256) + lsb );
     return number;
}
int hexToDec4Byte (BYTE byte3, BYTE byte2,
                   BYTE byte1, BYTE byte0) {
     int num3, num2, num1, num0;
     int  number;

     num3 = byte3;
     num2 = byte2;
     num1 = byte1;
     num0 = byte0;

     number = (num3 * 16777216) + (num2 * 65536) +
              (num1 * 256) + (num0);
     return number;
}
// Link List to contain the 310 data
typedef struct threeTenData data;
struct threeTenData {
     int record;
     int automatic;
     int p2pAplitude;
     unsigned int duration;
     char coupling[13];
     struct threeTenData *next;
} ;

#endif
