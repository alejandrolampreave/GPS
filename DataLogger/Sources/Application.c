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

static FAT1_FATFS fileSystemObject;
static FIL file;

static void Err(void) {
  for(;;){}
}

static void LogToFile(int16_t x, int16_t y, int16_t z) {
  UINT bandwidth;
  TIMEREC hora;
  uint8_t buffer[48];

  /* Abrir fichero */
  if (FAT1_open(&file, "./log_ac.txt", FA_OPEN_ALWAYS|FA_WRITE)!=FR_OK) {
    Err();
  }
  /* Nos posicionamos en el final del archivo */
  if (FAT1_lseek(&file, f_size(&file)) != FR_OK || file.fptr != f_size(&file)) {
    Err();
  }
  /* Obtener la hora */
  if (TmDt1_GetTime(&hora)!=ERR_OK) {
	printf("%i",(hora));
    Err();
  }
  /* Escribir la informacion */
  buffer[0] = '\0';
  UTIL1_strcatNum8u(buffer, sizeof(buffer), hora.Hour);
  UTIL1_chcat(buffer, sizeof(buffer), ':');
  UTIL1_strcatNum8u(buffer, sizeof(buffer), hora.Min);
  UTIL1_chcat(buffer, sizeof(buffer), ':');
  UTIL1_strcatNum8u(buffer, sizeof(buffer), hora.Sec);
  UTIL1_chcat(buffer, sizeof(buffer), '\t');

  UTIL1_strcatNum16s(buffer, sizeof(buffer), x);
  UTIL1_chcat(buffer, sizeof(buffer), '\t');
  UTIL1_strcatNum16s(buffer, sizeof(buffer), y);
  UTIL1_chcat(buffer, sizeof(buffer), '\t');
  UTIL1_strcatNum16s(buffer, sizeof(buffer), z);
  UTIL1_strcat(buffer, sizeof(buffer), (unsigned char*)"\r\n");
  if (FAT1_write(&file, buffer, UTIL1_strlen((char*)buffer), &bandwidth)!=FR_OK) {
    (void)FAT1_close(&file);
    Err();
  }
  /* Cerrar el fichero */
  (void)FAT1_close(&file);
}

void APP_Run(void) {
  int16_t x,y,z;
  uint8_t ack;

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
    LogToFile(x, y, z);
    /* Repite la operacion cada segundo */
    WAIT1_Waitms(1000);
  }
}