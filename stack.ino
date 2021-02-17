#include <HX711.h>

#include <ESP8266WiFi.h>
#include <ESP8266WebServer.h>


const char* ssid = "Kecoa Terbang Anti Corona";
const char* password = "memew123";
const char* host = "192.168.119.1"; //IP PC

// Scale Settings
const int SCALE_DOUT_PIN = D2;  //pada pin dout, load cell maasukkan ke D2
const int SCALE_SCK_PIN = D1; //sama seperti diatas pin SCK masukkan ke D1



HX711 scale(SCALE_DOUT_PIN, SCALE_SCK_PIN);

void setup() {
  Serial.begin(115200);
  
  Serial.print("Connecting to ");
  Serial.println(ssid);
  
  WiFi.begin(ssid, password);
  while(WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
  }
  Serial.println("");
  Serial.println("WiFi terhubung ");
  Serial.print("SSID: ");
  Serial.println(WiFi.SSID());
  Serial.print("IP Address: ");
  Serial.println(WiFi.localIP());

  scale.set_scale(22  );// <- tentukan disini nilai kalibrasinya
  scale.tare();   
  

}

void loop() {
  delay(5000);
  float berat = scale.get_units(1);
  Serial.println(String(berat, 3));
  
  Serial.print("connecting to ");
  Serial.println(host);
 
  WiFiClient client;  
  const int httpPort = 8080;
  if (!client.connect(host, httpPort)) {
    Serial.println("connection failed");
    return;
  }
// We now create a URI for the request
  String url = "/node_water/tambah.php?berat=";  // disini akan di akses file tambah.php yang berada di folder node_water
  url += berat;
 
 Serial.print("Requesting URL: ");
  Serial.println(url);

 // This will send the request to the server

client.print(String("GET ") + url + " HTTP/1.1\r\n" +
               "Host: " + host + "\r\n" +
               "Connection: close\r\n\r\n");    // ini akan menandakan masuk ke URL mana dan Host siapa
 
               
 unsigned long timeout = millis();
  while (client.available() == 0) {
    if (millis() - timeout > 1000) {
      Serial.println("Bisa !");
      client.stop();
      delay(1000);
      return;  // disini merupakan code untuk memasukkan nilai nya ke database, dan akan mereturn terus menerus
    }
  }
 
 // Read all the lines of the reply from server and print them to Serial
  while (client.available()) {
    String line = client.readStringUntil('\r');
    Serial.print(line);
  } //disini merupakan cek biasa

  Serial.println();
  Serial.println("closing connection");   //ketika salah menset nama wifi atau pass nya atau yang lain, maka akan close connection. dan akan berhenti.
}
