/**
 *  Gerald Sandoval 

 *  
 *  File:  readFile.h
 *  This is a header file for binary.cpp which include the following:
 *     convertNum() - converts multiple byte data to an integer number
 *         parameters: overloaded operator - byte data
 *         return: converted integer value
 *     data structure - that contains the blockette 310 data.
 */

#ifndef BINARY_H_H
#define BINARY_H

//containers
#include <vector>       // binary file 
#include <list>         // blockette 310 data
//input-output
#include <fstream>      // open file
#include <iostream>     // std::cout

// bit mask
enum { BIT2 = 4, BIT4 = 16 };

// overloaded operators to convert hex bytes to an integer number
unsigned int convertNum(int byte1, int byte0) {

    unsigned int number;

    number = (( byte1 * 256) + byte0 );
    return number;
}
unsigned int convertNum(int byte3, int byte2, int byte1, int byte0) {

    unsigned int  number;

    number = (byte3 * 16777216) + (byte2 * 65536) + 
             (byte1 * 256) + (byte0);
    return number;
}

// Structure to contain the 310 data
struct data {
    int record = 0;
    bool automatic;
    bool p2pAplitude;
    unsigned int duration;
    char coupling[13];
}; 

#endif
