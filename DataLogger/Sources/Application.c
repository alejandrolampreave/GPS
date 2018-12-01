/*
 * Application.c
 *
 *  Created on:29/10/2018
 *      Author: Alejandro
 */

#include "Application.h"
#include "WAIT1.h"
#include "FX1.h"
#include "FAT1.h"
#include "UTIL1.h"
#include "PORT_PDD.h"
#include "AS1.h"
#include "GPS.h"
#include "LEDR.h"
#include "LEDG.h"
#include "FX1.h"

static FAT1_FATFS fileSystemObject;
static FIL file;


void APP_Run(void) {
  int16_t x,y,z;
  uint8_t ack;
  byte err;
  AS1_TComData ch;

  /* Deteccion de la tarjeta SD: PTE6 con pull-down! */
  PORT_PDD_SetPinPullSelect(PORTE_BASE_PTR, 6, PORT_PDD_PULL_DOWN);
  PORT_PDD_SetPinPullEnable(PORTE_BASE_PTR, 6, PORT_PDD_PULL_ENABLE);

  ack = FX1_Enable(); /* Activa el acelerometro */
  if (ack!=ERR_OK) {
    Err();
  }
  if (FAT1_Init()!=ERR_OK) { /* Comprueba FAT */
    Err();
  }
  if (FAT1_mount(&fileSystemObject, "0", 1) != FR_OK) { /* Comprueba el archivo del sistema */
    Err();
  }

  for(;;) {
    /* Captura los datos del acelerometro */
    x = FX1_GetX();
    y = FX1_GetY();
    z = FX1_GetZ();
    /* Los mete en el archivo de la SD */
    //LogToFile(x, y, z);

    /* Repite la operacion cada segundo */
    //WAIT1_Waitms(1000);
    if (GPS_GetCharsInRxBuf()==0) {
          LEDR_Neg(); LEDG_Off(); /* blink red led if no GPS data */
        } else {
          LEDR_Off(); LEDG_Neg(); /* blink green led if we have GPS data */
        }
    do {
    	    err = GPS_RecvChar(&ch);
    	    //err2 = AS1_RecvChar(&ch);
    	  } while((err != ERR_OK));
    	  //LogToFileGPS(ch);
    	  AS1_SendChar(ch);
  }
}
