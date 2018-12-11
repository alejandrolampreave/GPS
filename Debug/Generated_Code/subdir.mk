################################################################################
# Automatically-generated file. Do not edit!
################################################################################

# Add inputs and outputs from these tool invocations to the build variables 
C_SRCS += \
../Generated_Code/AS1.c \
../Generated_Code/ASerialLdd1.c \
../Generated_Code/ASerialLdd2.c \
../Generated_Code/BitIoLdd1.c \
../Generated_Code/BitIoLdd2.c \
../Generated_Code/CD1.c \
../Generated_Code/CI2C1.c \
../Generated_Code/CS1.c \
../Generated_Code/Cpu.c \
../Generated_Code/ExtIntLdd1.c \
../Generated_Code/FAT1.c \
../Generated_Code/FRTOS1.c \
../Generated_Code/FX1.c \
../Generated_Code/GI2C1.c \
../Generated_Code/GPS.c \
../Generated_Code/KSDK1.c \
../Generated_Code/LEDG.c \
../Generated_Code/LEDR.c \
../Generated_Code/LEDpin1.c \
../Generated_Code/LEDpin2.c \
../Generated_Code/MCUC1.c \
../Generated_Code/PE_LDD.c \
../Generated_Code/PPS.c \
../Generated_Code/SD1.c \
../Generated_Code/SM1.c \
../Generated_Code/SS1.c \
../Generated_Code/TI1.c \
../Generated_Code/TMOUT1.c \
../Generated_Code/TU1.c \
../Generated_Code/TimerIntLdd1.c \
../Generated_Code/TmDt1.c \
../Generated_Code/UTIL1.c \
../Generated_Code/UTIL2.c \
../Generated_Code/WAIT1.c \
../Generated_Code/croutine.c \
../Generated_Code/event_groups.c \
../Generated_Code/ff.c \
../Generated_Code/heap_1.c \
../Generated_Code/heap_2.c \
../Generated_Code/heap_3.c \
../Generated_Code/heap_4.c \
../Generated_Code/heap_5.c \
../Generated_Code/heap_useNewlib.c \
../Generated_Code/list.c \
../Generated_Code/mpu_wrappers.c \
../Generated_Code/port.c \
../Generated_Code/queue.c \
../Generated_Code/tasks.c \
../Generated_Code/timers.c 

OBJS += \
./Generated_Code/AS1.o \
./Generated_Code/ASerialLdd1.o \
./Generated_Code/ASerialLdd2.o \
./Generated_Code/BitIoLdd1.o \
./Generated_Code/BitIoLdd2.o \
./Generated_Code/CD1.o \
./Generated_Code/CI2C1.o \
./Generated_Code/CS1.o \
./Generated_Code/Cpu.o \
./Generated_Code/ExtIntLdd1.o \
./Generated_Code/FAT1.o \
./Generated_Code/FRTOS1.o \
./Generated_Code/FX1.o \
./Generated_Code/GI2C1.o \
./Generated_Code/GPS.o \
./Generated_Code/KSDK1.o \
./Generated_Code/LEDG.o \
./Generated_Code/LEDR.o \
./Generated_Code/LEDpin1.o \
./Generated_Code/LEDpin2.o \
./Generated_Code/MCUC1.o \
./Generated_Code/PE_LDD.o \
./Generated_Code/PPS.o \
./Generated_Code/SD1.o \
./Generated_Code/SM1.o \
./Generated_Code/SS1.o \
./Generated_Code/TI1.o \
./Generated_Code/TMOUT1.o \
./Generated_Code/TU1.o \
./Generated_Code/TimerIntLdd1.o \
./Generated_Code/TmDt1.o \
./Generated_Code/UTIL1.o \
./Generated_Code/UTIL2.o \
./Generated_Code/WAIT1.o \
./Generated_Code/croutine.o \
./Generated_Code/event_groups.o \
./Generated_Code/ff.o \
./Generated_Code/heap_1.o \
./Generated_Code/heap_2.o \
./Generated_Code/heap_3.o \
./Generated_Code/heap_4.o \
./Generated_Code/heap_5.o \
./Generated_Code/heap_useNewlib.o \
./Generated_Code/list.o \
./Generated_Code/mpu_wrappers.o \
./Generated_Code/port.o \
./Generated_Code/queue.o \
./Generated_Code/tasks.o \
./Generated_Code/timers.o 

C_DEPS += \
./Generated_Code/AS1.d \
./Generated_Code/ASerialLdd1.d \
./Generated_Code/ASerialLdd2.d \
./Generated_Code/BitIoLdd1.d \
./Generated_Code/BitIoLdd2.d \
./Generated_Code/CD1.d \
./Generated_Code/CI2C1.d \
./Generated_Code/CS1.d \
./Generated_Code/Cpu.d \
./Generated_Code/ExtIntLdd1.d \
./Generated_Code/FAT1.d \
./Generated_Code/FRTOS1.d \
./Generated_Code/FX1.d \
./Generated_Code/GI2C1.d \
./Generated_Code/GPS.d \
./Generated_Code/KSDK1.d \
./Generated_Code/LEDG.d \
./Generated_Code/LEDR.d \
./Generated_Code/LEDpin1.d \
./Generated_Code/LEDpin2.d \
./Generated_Code/MCUC1.d \
./Generated_Code/PE_LDD.d \
./Generated_Code/PPS.d \
./Generated_Code/SD1.d \
./Generated_Code/SM1.d \
./Generated_Code/SS1.d \
./Generated_Code/TI1.d \
./Generated_Code/TMOUT1.d \
./Generated_Code/TU1.d \
./Generated_Code/TimerIntLdd1.d \
./Generated_Code/TmDt1.d \
./Generated_Code/UTIL1.d \
./Generated_Code/UTIL2.d \
./Generated_Code/WAIT1.d \
./Generated_Code/croutine.d \
./Generated_Code/event_groups.d \
./Generated_Code/ff.d \
./Generated_Code/heap_1.d \
./Generated_Code/heap_2.d \
./Generated_Code/heap_3.d \
./Generated_Code/heap_4.d \
./Generated_Code/heap_5.d \
./Generated_Code/heap_useNewlib.d \
./Generated_Code/list.d \
./Generated_Code/mpu_wrappers.d \
./Generated_Code/port.d \
./Generated_Code/queue.d \
./Generated_Code/tasks.d \
./Generated_Code/timers.d 


# Each subdirectory must supply rules for building sources it contributes
Generated_Code/%.o: ../Generated_Code/%.c
	@echo 'Building file: $<'
	@echo 'Invoking: Cross ARM C Compiler'
	arm-none-eabi-gcc -mcpu=cortex-m4 -mthumb -mfloat-abi=hard -mfpu=fpv4-sp-d16 -O0 -fmessage-length=0 -fsigned-char -ffunction-sections -fdata-sections  -g3 -I"D:/G ing informatica/TFG/GPS/DataLogger/Static_Code/System" -I"D:/G ing informatica/TFG/GPS/DataLogger/Static_Code/PDD" -I"D:/G ing informatica/TFG/GPS/DataLogger/Static_Code/IO_Map" -I"C:\Freescale\KDS_v3\eclipse\ProcessorExpert/lib/Kinetis/pdd/inc" -I"D:/G ing informatica/TFG/GPS/DataLogger/Sources" -I"D:/G ing informatica/TFG/GPS/DataLogger/Generated_Code" -std=c99 -MMD -MP -MF"$(@:%.o=%.d)" -MT"$@" -c -o "$@" "$<"
	@echo 'Finished building: $<'
	@echo ' '


