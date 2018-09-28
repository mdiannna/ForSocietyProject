#include <ESP8266WiFi.h>
#include <ESP8266WiFiMulti.h>
#include <Wire.h>
#include <MPU6050.h>

ESP8266WiFiMulti wifiMulti;
boolean connectioWasAlive = true;
const char* host = "23.97.237.11/sensor-data";                        //server to send data to

MPU6050 mpu;
boolean ledState = false;
boolean freefallDetected = false;
int freefallBlinkCount = 0;

boolean alert = false;

void setup()
{
  Serial.begin(115200);
  
  wifiMulti.addAP("no", "14151415");                                 //mobile hotspot
  wifiMulti.addAP("guest", "");                                      //home wi-fi       
  wifiMulti.addAP("another wi-fi", "password");                      //another disponible wi-fi

  while(!mpu.begin(MPU6050_SCALE_2000DPS, MPU6050_RANGE_16G))
  {
    Serial.println("sensor not respond");
    delay(500);
  }
  mpu.setAccelPowerOnDelay(MPU6050_DELAY_3MS);
  
  mpu.setIntFreeFallEnabled(true);
  mpu.setIntZeroMotionEnabled(false);
  mpu.setIntMotionEnabled(false);
  
  mpu.setDHPFMode(MPU6050_DHPF_5HZ);

  mpu.setFreeFallDetectionThreshold(17);
  mpu.setFreeFallDetectionDuration(2);  
  
  checkSettings();

  pinMode(4, OUTPUT);
  digitalWrite(4, LOW);
  
  attachInterrupt(0, doInt, RISING);
}

void doInt()
{
  freefallBlinkCount = 0;
  freefallDetected = true;  
}

void monitorWiFi()
{
  if (wifiMulti.run() != WL_CONNECTED)
  {
    if (connectioWasAlive == true)
    {
      connectioWasAlive = false;                                   //searching for disponible wi-fi   
    }
    delay(1000);                               
  }
  else if (connectioWasAlive == false)
  {
    connectioWasAlive = true;
    Serial.printf(" connected to %s\n", WiFi.SSID().c_str());     //view on serial port if there is a connection
  }
}

void checkSettings()
{
  Serial.print(" * Accelerometer offsets:     ");
  Serial.print(mpu.getAccelOffsetX());
  Serial.print(" / ");
  Serial.print(mpu.getAccelOffsetY());
  Serial.print(" / ");
  Serial.println(mpu.getAccelOffsetZ());
}

void loop()
{
  WiFiClient client;
  monitorWiFi();
  if (client.connect(host, 80))
  {
    Serial.printf("\nconnected to  %s ... ", host);              //view on serial port if there is a connection with host
    Serial.println("[Sending a request]");
    client.print(String("GET /") + " HTTP/1.1\r\n" +
                 "Host: " + host + "\r\n" +
                 "Connection: close\r\n" +
                 "\r\n"
                );

    Serial.println("[Response:]");
    while (client.connected())
    {
      if (client.available())
      {
        String line = client.readStringUntil('\n');
        Serial.println(line);
      }
    }
  }
  delay(1000);
  
  Vector rawAccel = mpu.readRawAccel();
  Activites act = mpu.readActivites();
  Serial.print(act.isFreeFall);
  Serial.print("\n");
  if (freefallDetected)
  {
    ledState = !ledState;

    digitalWrite(4, ledState);

    freefallBlinkCount++;

    if (freefallBlinkCount == 15)
    {
      alert = true;                                     //we have a damaged roof
      client.print(String("ALERT"));                   //send the message to server
      freefallDetected = false;
      ledState = false;
      digitalWrite(4, ledState);
      alert = false;
    }
  }
  delay(100);
}
