################################################################################
# Automatically-generated file. Do not edit!
################################################################################

# Add inputs and outputs from these tool invocations to the build variables 
CPP_SRCS += \
../src/DattaLogger/.metadata/.plugins/org.eclipse.cdt.make.core/specs.cpp 

C_SRCS += \
../src/DattaLogger/.metadata/.plugins/org.eclipse.cdt.make.core/specs.c 

OBJS += \
./src/DattaLogger/.metadata/.plugins/org.eclipse.cdt.make.core/specs.o 

C_DEPS += \
./src/DattaLogger/.metadata/.plugins/org.eclipse.cdt.make.core/specs.d 

CPP_DEPS += \
./src/DattaLogger/.metadata/.plugins/org.eclipse.cdt.make.core/specs.d 


# Each subdirectory must supply rules for building sources it contributes
src/DattaLogger/.metadata/.plugins/org.eclipse.cdt.make.core/%.o: ../src/DattaLogger/.metadata/.plugins/org.eclipse.cdt.make.core/%.c
	@echo 'Building file: $<'
	@echo 'Invoking: Cross ARM C Compiler'
	arm-none-eabi-gcc -mcpu=cortex-m4 -mthumb -mfloat-abi=hard -mfpu=fpv4-sp-d16 -O0 -fmessage-length=0 -fsigned-char -ffunction-sections -fdata-sections  -g3 -I"D:/G ing informatica/TFG/GPS/DataLogger/Static_Code/System" -I"D:/G ing informatica/TFG/GPS/DataLogger/Static_Code/PDD" -I"D:/G ing informatica/TFG/GPS/DataLogger/Static_Code/IO_Map" -I"C:\Freescale\KDS_v3\eclipse\ProcessorExpert/lib/Kinetis/pdd/inc" -I"D:/G ing informatica/TFG/GPS/DataLogger/Sources" -I"D:/G ing informatica/TFG/GPS/DataLogger/Generated_Code" -std=c99 -MMD -MP -MF"$(@:%.o=%.d)" -MT"$@" -c -o "$@" "$<"
	@echo 'Finished building: $<'
	@echo ' '

src/DattaLogger/.metadata/.plugins/org.eclipse.cdt.make.core/%.o: ../src/DattaLogger/.metadata/.plugins/org.eclipse.cdt.make.core/%.cpp
	@echo 'Building file: $<'
	@echo 'Invoking: Cross ARM C++ Compiler'
	arm-none-eabi-g++ -mcpu=cortex-m4 -mthumb -mfloat-abi=hard -mfpu=fpv4-sp-d16 -O0 -fmessage-length=0 -fsigned-char -ffunction-sections -fdata-sections  -g3 -I"D:/G ing informatica/TFG/GPS/DataLogger/Static_Code/System" -I"D:/G ing informatica/TFG/GPS/DataLogger/Static_Code/PDD" -I"D:/G ing informatica/TFG/GPS/DataLogger/Static_Code/IO_Map" -I"C:\Freescale\KDS_v3\eclipse\ProcessorExpert/lib/Kinetis/pdd/inc" -I"D:/G ing informatica/TFG/GPS/DataLogger/Sources" -I"D:/G ing informatica/TFG/GPS/DataLogger/Generated_Code" -std=gnu++11 -fabi-version=0 -MMD -MP -MF"$(@:%.o=%.d)" -MT"$@" -c -o "$@" "$<"
	@echo 'Finished building: $<'
	@echo ' '


