/**
 *  Gerald Sandoval  -  gsandoval.net
 *  Programming Challenge
 *
 *  File:  binary.cpp
 *  This program extracts the individual bytes of a binary file '00_LHZ.512.seed'
 *  and subsequently parses out the desired data then and displays this data on
 *  the terminal.
 *
 *  This program was built and compiled on a Raspberry Pi
 */

#include "binaryCPP.h"

using namespace std;

int main()
{
    const char* filename = "00_LHZ.512.seed";
    unsigned int fileSize;
    unsigned int record, block, next;
    int byte3, byte2, byte1, byte0;
    bool finished;
    int numDec, flags;
    int recordNum = 0;
    int numBlocks = 0;
    int index = 0;

    // list container for blockette 310 data objects
    std::list<data> listContainer;

    // blockette 310 data structure object
    struct data objectBuffer;

    // Open the binary file
    ifstream bin(filename);
    bin.seekg(0, ios::end); // move to end of file
    fileSize = bin.tellg();

    /*************************************************
     *  Open file the binary file utilizing the 'ifstream' library
     *  Each RECORD will be indexed and searched
     *
     *  RECORD:  byte[x thru (x + 511]
     *  where, x: record number < x < number of records
     *
     *  RECORD header: byte[x thru (x+47)]
     *  "1000" type bolckette: byte[(x+48), (x+49)]
     *  "next" bolckette: byte[(x+51), (x+51)]
     *  next = 0 indicates the last blockette of the record
     *************************************************/

     for (record  = 0; record < fileSize; record += 512) {
        finished = false;
        numBlocks++;

        // the "next" index from the 1000 type blockette
        index = record + 50;

        // the "next" blockette index data
        bin.seekg(index);
        byte1 = bin.get();
        bin.seekg(index+1);
        byte0 = bin.get();
        next = convertNum (byte1, byte0);

        // use the "next' index to scroll the next blockette
        while (finished == false) {
            index = record +  next;

            // get the blockette type and the "next" index
            bin.seekg(index);
            byte1 = bin.get();
            bin.seekg(index+1);
            byte0 = bin.get();
            block = convertNum (byte1, byte0);

            bin.seekg(index+2);
            byte1 = bin.get();
            bin.seekg(index+3);
            byte0 = bin.get();
            next = convertNum (byte1, byte0);

            numBlocks++;

  /**
   *  When a type "310" blockette has been found.  The data is extracted
   *  and a dynamic link list is created to store the data
   *
   *  Blockette tpye "310":
   *  Calibration flags bits:  byte[(index+15)]
   *    - bit 2: calibration was automatic
   *    - bit 4: peak-to-peak amplitude
   * Calibration duration (integer): byte[(index+16) thru (index+19)]
   * Calibration coupling (string): byte[(index+36) thru (index+47)]
   */
            if(block == 310) {

                objectBuffer.record = recordNum;

                //Calibration flag bits
                bin.seekg(index+15);
                flags = bin.get();

                if ( (flags & BIT2) ) {
                    objectBuffer.automatic = true;
                }
                else {
                    objectBuffer.automatic = false;
                }

                if ( (flags & BIT4) ) {
                    objectBuffer.p2pAplitude = true;
                }
                else {
                    objectBuffer.p2pAplitude = false;
                }

                //Extract the Calibration Duration data
                bin.seekg(index+16);
                byte3 = bin.get();
                bin.seekg(index+17);
                byte2 = bin.get();
                bin.seekg(index+18);
                byte1 = bin.get();
                bin.seekg(index+19);
                byte0 = bin.get();
                objectBuffer.duration = convertNum (byte3, byte2, byte1, byte0);

                // Calibration coupling 12 byte string data
                for (int j = 0 ; j < 13; j++) {
                    bin.seekg(index+36+j);
                    numDec = bin.get();
                    if (numDec == 0) {
                        objectBuffer.coupling[j] = '\0';
                        j = 14;
                    }
                    else {
                       objectBuffer.coupling[j] = static_cast<char>(numDec);
                    }
                }

                //place data object inside vector container
                listContainer.push_back(objectBuffer);
            }
            // 310 blockette is complete
            // exit the while loop when the 'next' index is 0
            if (next == 0)
                finished = true;

        }
        //blockette search complete, go to next record
        recordNum++;
    }

    // All records have been searched
    bin.close();        // close file
    cout << "C++ 11 Output:  " << endl;
    cout << "File size:  " << fileSize << endl;
    printf("\nNumber of Blockettes in the file: %i\n ", numBlocks);

    // If the input file is empty, then print message.  
    //    Else: Print the Blockette Data 
    if (!listContainer.size())
    {
        cout << "type 310 blockettes not found" << endl;
    }
    else
    {
        list<data>::iterator it;
        for( it = listContainer.begin(); it != listContainer.end(); ++it) {
            cout << "\nRecord:  " << dec << it->record << endl;
            cout << "Calibration Automatic:  " << boolalpha << it->automatic << endl;
            cout << "peak to peak Amplitude:  " << it->p2pAplitude << endl;
            cout << "Calibration Duration:  " << it->duration << endl;
            cout << "Calibration Coupling:  " << it->coupling << endl;
        }
    }
    
    return 0;
}
