#include <Arduino.h>
#include <WiFi.h>
#include <HTTPClient.h>
#include <ArduinoJson.h>
#include <main.h>
#include <sensors.h>
#include <DHT.h>
#include <string.h>

const char* ssid = "TP-Link_98A2";
const char* password = "11409519";
String serverPath = "http://192.168.0.104:8000/api/measurements/create";
String CookieHeader;


WiFiClient wifiClient;
HTTPClient httpClient;
JsonDocument doc; //serialize

void setup() {
  Serial.begin(115200);
  initSensors();
  connectWifi(ssid, password);
}

void loop() {
  handleHTTP();
  delay(1000);
} 

void connectWifi(const char* ssid, const char* password) {
  WiFi.mode(WIFI_STA);
  WiFi.begin(ssid, password);
  Serial.println("");
  Serial.println("Started Wifi");
  while (WiFi.status() != WL_CONNECTED) {
    Serial.print(" connecting...");
    delay(5000);
  }
  // do not fucking print the ip address because else it dumps the core
  Serial.println("Connected");
}

void handleHTTP() {
  httpClient.begin(wifiClient, serverPath);

  httpClient.addHeader("Accept", "application/json");
  httpClient.addHeader("Content-Type", "application/json");
  httpClient.addHeader("Connection", "keepalive");

  doc["moisture"] = getSoilMoisture();
  doc["humidity"] = getHumidity();
  doc["temperature"] = getTemperature();
  doc["brightness"] = getBrightness();

  String serializedData;
  serializeJson(doc, serializedData);
  Serial.println(serializedData);
  
  // this is a comment
  httpClient.POST(serializedData);

  StaticJsonDocument<200> doc; //deserialize
  String response = httpClient.getString();
  deserializeJson(doc, response);
  Serial.println(response);

  if (doc["should_water"]) {
    // yes water
    Serial.println("Watering...");
    activatePump(15000);
  }

  httpClient.end();
}

