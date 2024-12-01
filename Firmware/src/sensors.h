#ifndef SENSORS_H
#define SENSORS_H

void initSensors();
int getSoilMoisture();
int getHumidity();
int getTemperature();
int getBrightness();
void activatePump(int duration);

#endif