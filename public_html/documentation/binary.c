/**
 *  Gerald Sandoval - gsandoval.net 
 *  Programming Challenge
 *  
 *  File:  binary.c    C Programming Language (C99)
 *  This program extracts the individual bytes of a binary file 
 *  '00_LHZ.512.seed' and subsequently parses out the disired data
 *  then and displays this data on the terminal.
 */
#include "binary.h"

int main() {

    FILE *file = NULL;      // File pointer
    char *fileBuf = NULL;   // Pointer to the buffered data
    int record, block, next, finished;
    int fileSize = 0;
    int numBlocks = 0;
    int index = 0;
    int recordNum = 0;
    int flags, numDec;

    // Data Link List
    data * head = NULL;
    data * current = NULL;
    data * previous = NULL;

    // Open the file in binary mode using the "rb" format string
    // This also checks if the file exists and/or can be opened for reading
    file = fopen("00_LHZ.512.seed", "rb");
    if (file == NULL)
        fputs("Could not open specified file\n", stderr);
    else {
        // Go to the end of the file.
        if (fseek(file, 0L, SEEK_END) == 0) {
            // Get the size of the file.
            fileSize = ftell(file);
            if (fileSize == -1)
                fputs("##Error with the specified file\n", stderr);

            // Allocate our buffer to that size.
            fileBuf = malloc(sizeof(char) * (fileSize + 1));

            // Read the entire file into memory.
            fseek(file, 0L, SEEK_SET); // Go back to the start of the file.
            size_t newLen = fread(fileBuf, sizeof(char), fileSize, file);
            if (newLen == 0) {
                fputs("Error reading file", stderr);
            } else {
                fileBuf[++newLen] = '\0'; // Just to be safe.
            }
        }
        fclose(file);
    }
    /*************************************************
     *  Now that the file has been buffered into an array
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
        finished = FALSE;
        numBlocks++;

        // the "next" index from the 1000 type blockette
        index = record + 50;
        next = hexToDec ( fileBuf[index], fileBuf[index+1] );


        // use the "next' index to scroll the next blockette
        while (finished == FALSE) {
            index = record +  next;

            // get the blockette type and the "next" index
            block  = hexToDec ( fileBuf[index], fileBuf[index+1] );
            numBlocks++;
            next = hexToDec ( fileBuf[index+2], fileBuf[index+3] );

   /**
    *  When a type "310" blockette has been found.  The data is
    *  extracted and a dynamic link list is created to store the data
    *
    *  Blockette tpye "310":
    *  Calibration flags bits:  byte[(index+15)]
    *    - bit 2: calibration was automatic
    *    - bit 4: peak-to-peak amplitude
    * Calibration duration (integer): byte[(index+16) thru (index+19)]
    * Calibration coupling (string): byte[(index+36) thru (index+47)]
    */
            if(block == 310) {

                // create dynamic link list
                current = (data *)malloc(sizeof(data));
                if(head == NULL){
                    head = current;
                }
                else{
                    previous->next = current;
                }
                current->next = NULL;
                previous = current;

                //Record Number
                current->record = recordNum;

                //Calibration flag bits
                //flags = int (fileBuf[index+15]);
                flags = fileBuf[index+15];
                if (flags & BIT2)  {
                	current->automatic = TRUE;
                }

                if (flags & BIT4)  {
                	current->p2pAplitude = TRUE;
                }

                // 4 byte Calibration duration integer data
                current->duration =  hexToDec4Byte ( fileBuf[index+16],
                                                     fileBuf[index+17],
                                                     fileBuf[index+18],
                                                     fileBuf[index+19] );

                // Calibration coupling 12 byte string data
                for (int j = 0 ; j < 13; j++) {
                    //numDec =  int ( fileBuf[index+36+j]);
                    numDec =   fileBuf[index+36+j];
                    if (numDec == 0) {
                        current->coupling[j] = '\0';
                        j = 14;
                    }
                    else {
                        //current->coupling[j] = char ( numDec );
                        current->coupling[j] =  numDec ;
                    }
                }

            }// end of IF 310 block

            // exit the while loop when the 'next' index is 0
            if (next == 0) finished = TRUE;
        }//end of WHILE loop
        recordNum++;
    }//end of FOR loop

    printf("C99 Output:\n");
    printf("File size: %i \n", fileSize);
    printf("\nNumber of Blockettes in the file: %i\n ", numBlocks);

    /* If the input file is empty, then print message.
     * Else: Print the Paragraph Data
     */
    if (head == NULL)
    {
    	printf("type 310 blockettes not found\n");
    }
    else
    {
    	current = head;


        while(current != NULL) {
            printf("\nRecord %i: \n", current->record);
            printf("   Calibration Automatic:  ");
            if ( current->automatic == TRUE)
            	printf("true\n");
            else
            	printf("false\n");

            printf("   peak to peak Amplitude:  " );
            if ( current->p2pAplitude == TRUE)
            	printf("true\n");
            else
            	printf("false\n");
            printf("   Calibration Duration: %i\n", current->duration);
            printf("   Calibration Coupling: %s\n", current->coupling);
            current = current->next;
		}
	}

	free(current);
	free(fileBuf);

}
