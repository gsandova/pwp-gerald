 /* Gerald Sandoval  -  gsandoval.net
 *  Programming Challenge
 *
 *  File:  Binary.java   (Java)
 *  This program extracts the individual bytes of a binary file '00_LHZ.512.seed'
 *  and subsequently parses out the desired data then and displays this data on
 *  the terminal.
 *
 *  This program was built and compiled on a Raspberry Pi
 */
import java.io.File;
import java.io.FileInputStream;
import java.util.*;

class Binary {
     public static void main (String[] args)  {

          long fileSize;
          int record, block, next;
          short byte3, byte2, byte1, byte0;
          boolean finished;
          int numDec, flags, result;
          int recordNum = 0;
          int numBlocks = 0;
          int num310Blocks = 0;
          int index = 0;

          boolean automatic = false;
          boolean p2pAplitude = false;
          long duration;
          char[] charBuffer = new char[13];

          //Bit mask
          final int BIT2 = 4;
          final int BIT4 = 16;
          final int BIT2_AND_BIT4 = 20;

          //Array List to contain the 310 blockette data
          ArrayList<Data310> obj = new ArrayList<Data310>();

          // Open the binary file and place data into a buffer array
          File file = new File("00_LHZ.512.seed");
          byte[] bFile = readContentIntoByteArray(file);
          fileSize = file.length();
          System.out.print( "File size:  " + fileSize + "\n\n");

          for (record  = 0; record < fileSize; record += 512) {
               finished = false;
               numBlocks++;

               // the "next" index from the 1000 type blockette
               index = record + 50;

               // the "next" blockette index data
               byte1 = getUnsignedByte( bFile[index] );
               byte0 = getUnsignedByte( bFile[index+1] );
               next = convertByteToNum (byte1, byte0);

               // use the "next' index to scroll the next blockette
               while (finished == false) {
                    index = record +  next;

                    // get the blockette type and the "next" index

                    byte1 = getUnsignedByte( bFile[index] );
                    byte0 = getUnsignedByte( bFile[index+1] );
                    block = convertByteToNum (byte1, byte0);

                    byte1 = getUnsignedByte( bFile[index+2] );
                    byte0 = getUnsignedByte( bFile[index+3] );
                    next = convertByteToNum (byte1, byte0);

                    numBlocks++;

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
                         num310Blocks++;

                         //Calibration flag bits
                         flags = bFile[index+15];
                         result = flags & 20;

                         if (result == 0)  {
                              automatic = false;
                              p2pAplitude = false;
                         }
                         else if (result == BIT2) {
                              automatic = true;
                              p2pAplitude = false;
                         }
                         else if (result == BIT4)  {
                              automatic = false;
                              p2pAplitude = true;
                         }
                         else if (result == BIT2_AND_BIT4) {
                              automatic = true;
                              p2pAplitude = true;
                         }

                         //Extract the Calibration Duration data
                         byte3 = getUnsignedByte( bFile[index+16] );
                         byte2 = getUnsignedByte( bFile[index+17] );
                         byte1 = getUnsignedByte( bFile[index+18] );
                         byte0 = getUnsignedByte( bFile[index+19] );
                         duration = convertByteToNum (byte3, byte2, byte1, byte0);

                         // Calibration coupling 12 byte string data
                         for (int j = 0 ; j < 13; j++) {
                              numDec = bFile[index+36+j];
                              if (numDec == 0) {
                                   charBuffer[j] = '\0';
                                   j = 14;
                              }
                              else {
                                   charBuffer[j] = (char) numDec;
                              }
                         }

                         String coupling = new String(charBuffer);

                         // Add the object data to the Array List
                         obj.add(new Data310(recordNum, automatic, p2pAplitude, duration, coupling) );

                    } //END 310 IF

                    // 310 blockette is complete
                    // exit the while loop when the 'next' index is 0
                    if (next == 0)
                         finished = true;
               } //END WHILE LOOP

               //blockette search complete, go to next record
               recordNum++;
          } // END FOR LOOP

          System.out.println( "Number of Blockettes in the file:  " + numBlocks );

          // iterate via "for loop"
          for (int i = 0; i < obj.size(); i++) {
               System.out.println( "\nRecord:  " + obj.get(i).getRecord() );
               System.out.println( "Calibration Automatic:  " + obj.get(i).getAautomatic() );
               System.out.println( "peak to peak Amplitude:  " + obj.get(i).getP2pAplitude() );
               System.out.println( "Calibration Duration:  " + obj.get(i).getDuration() );
               System.out.println( "Calibration Coupling:  " + obj.get(i).getCoupling() );
          }
     } // END MAIN

     private static byte[] readContentIntoByteArray(File file) {
          FileInputStream fileInputStream = null;
          byte[] bFile = new byte[(int) file.length()];
          try {
               //convert file into arrnay of bytes
               fileInputStream = new FileInputStream(file);
               fileInputStream.read(bFile);
               fileInputStream.close();

               long len = file.length();
          }
          catch (Exception e)  {
               e.printStackTrace();
          }
          return bFile;
     }

     private static int convertByteToNum (short byte1, short byte0) {
          int number;

          number = (( byte1 * 256) + byte0 );
          return number;
     }
     static long convertByteToNum (int byte3, int byte2, int byte1, int byte0) {
          long  number;

          number = (byte3 * 16777216) + (byte2 * 65536) +
          (byte1 * 256) + (byte0);

          return number;
     }
     public static class Data310 {
          int record;
          boolean automatic, p2pAplitude;
          long duration;
          String coupling ;

          // constructor
          public Data310( int record, boolean automatic, boolean p2pAplitude, long duration, String coupling ) {
               this.record = record;
               this.automatic = automatic;
               this.p2pAplitude = p2pAplitude;
               this.duration = duration;
               this.coupling = coupling;
          }

          // set accessors
          public int getRecord() { return record; }
          public boolean getAautomatic() { return automatic; }
          public boolean getP2pAplitude() { return p2pAplitude; }
          public long getDuration() { return duration; }
          public String getCoupling () { return coupling; }
     }

     public static short getUnsignedByte(byte byteData) {
          return (short) (byteData & 0xFF);
     }

} // END CLASS
