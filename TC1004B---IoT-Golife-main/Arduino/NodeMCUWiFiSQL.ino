#include <ESP8266WiFi.h>
#include <ESP8266HTTPClient.h>
#include "DHTesp.h"

#define WifiPin 4
#define SQLPin 5
#define DataPin 16
#define HOST "iot.niubycraft2.playit.gg:6286"        //HOST URL

#define WIFI_SSID "632aNiX3 0cop"                    // WIFI SSID                                   
#define WIFI_PASSWORD "patitos123"                   // WIFI password here

#define DHTpin 14

// Variables which will be uploaded to server

float val1 = 1;
float val2 = 1;
String sendval, sendval2, postData;

DHTesp dht;                                           // Initialize DHT Sensor

void setup(){
Serial.begin(115200);                                 // Information transfer rate from Arduino Code to NodeMCU
Serial.println("Communication Started \n\n");  
delay(1000);

dht.setup(DHTpin, DHTesp::DHT11); // GPIO14
  
pinMode(LED_BUILTIN, OUTPUT);                         // Initialize NodeMCU LED
pinMode(WifiPin, OUTPUT);                             // Initialize WiFi LED
pinMode(SQLPin, OUTPUT);                              // Initialize SQL LED
pinMode(DataPin, OUTPUT);                             // Initialize Data LED
 
WiFi.mode(WIFI_STA);           
WiFi.begin(WIFI_SSID, WIFI_PASSWORD);

Serial.print("Connecting to: ");
Serial.print(WIFI_SSID);
  
  // Try to connect with WiFi
while (WiFi.status() != WL_CONNECTED){ 
    Serial.print(".");
    digitalWrite(WifiPin, HIGH);
    delay(400);
    digitalWrite(WifiPin, LOW);
    delay(400);
  }

Serial.println();
Serial.print("\nSuccess!");
digitalWrite(WifiPin, HIGH);
Serial.print("\nIP Address is: ");
Serial.println(WiFi.localIP());                     // Print local IP address
Serial.println("\n");
delay(300);
}

void loop() { 

HTTPClient http;                                    // Http object of clas HTTPClient
WiFiClient wclient;                                 // Wifi-Client object of class HTTPClient
  
val1 = dht.getTemperature();                        // Gets the values of the temperature
val2 = dht.getHumidity();                           // Gets the values of the humidity
  
//Check if values are NaN or invalid
if(isnan(val1) || isnan(val2)){
 Serial.println("Error reading values from DHT Sensor");
 Serial.println("Sending 1's to Database");
  for (int i=0; i < 3; i++){
    digitalWrite(SQLPin, LOW);
    delay(400);
    digitalWrite(SQLPin, HIGH);
    delay(400);
  }
 sendval = String(1);  
 sendval2 = String(1);
}
else{
 // Convert float variables to string
 sendval = String(val1);
 sendval2 = String(val2);
   for (int i=0; i < 3; i++){
    digitalWrite(SQLPin, LOW);
    delay(400);
    digitalWrite(SQLPin, HIGH);
    delay(400);
  }
}
  
// We can post values to PHP files as  example.com/dbwrite.php?name1=val1&name2=val2&name3=val3
postData = "sendval=" + sendval + "&sendval2=" + sendval2;
http.begin(wclient, "http://iot.niubycraft2.playit.gg:6286/dbwrite.php");                    // Connect to host where dbwrite is located (PHP File to Write into SQL Database)
http.addHeader("Content-Type", "application/x-www-form-urlencoded");                         // Specify content-type header

int httpCode = http.POST(postData);                                                          // Send POST request to php file and store server response code in variable named httpCode
Serial.println("\nValues to send are: Temperature = " + sendval + " && Humidity = "+sendval2 );
delay(2500);

// Connection stablished with SQL Database
if (httpCode == 200){
 Serial.println("Values uploaded successfully.");
 digitalWrite(DataPin, HIGH);
 digitalWrite(SQLPin, LOW);
 delay(2500);
 digitalWrite(DataPin, LOW);
 delay(2000);
}

  // Connection failed with SQL Database
else {
  Serial.println("Values may (or not) be uploaded with an Unexpected Exception.Error code: ");
  digitalWrite(DataPin, HIGH);
  digitalWrite(SQLPin, LOW);
  delay(2500);
  digitalWrite(DataPin, LOW);
  delay(2000);
  Serial.println(httpCode);
  //http.end();
  //return;
}
  
delay(2500); 
digitalWrite(LED_BUILTIN, LOW);
delay(2500);
digitalWrite(LED_BUILTIN, HIGH);
delay(5000);

}
