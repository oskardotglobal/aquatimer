#include <Arduino.h>
#include <DHT.h>

#define soilMoistureSensePin 34
#define dhtDataPin 27
#define dhtType DHT22
#define photoDiodePin 32
#define pumpPin 25

DHT dht(dhtDataPin, dhtType);

void initSensors() {
    dht.begin();
    pinMode(pumpPin, OUTPUT);
}

int getSoilMoisture() { // value of 3500 = dry, 1300 = submerged in my vodka
    return analogRead(soilMoistureSensePin);
}

int getHumidity() { //unit is in % I guess???
    return (int)dht.readHumidity();
}

int getTemperature() { //not in freedom units (uses celsius)
  return (int)dht.readTemperature();
}

int getBrightness() {
    return analogRead(photoDiodePin);
}

void activatePump(int duration) {
    digitalWrite(pumpPin, HIGH);
    delay (duration);
    digitalWrite(pumpPin, LOW);
}