#include <ESP8266HTTPClient.h>
#include <ESP8266WiFi.h>
#include <WiFiClient.h>

String url = "http://192.168.0.101/roadiot/overspeed.php";

WiFiClient client;
const char* ssid = "";
const char* password = "";


int ir_s1 = 5; //D1
int ir_s2 = 4; //D2

int timer1;
int timer2;

float Time;

int flag1 = 0;
int flag2 = 0;

float distance = 5.0;
float speed;
float overspeed;

void setup(){

  pinMode(ir_s1, INPUT);
  pinMode(ir_s2, INPUT);

  Serial.begin(115200);

  WiFi.begin(ssid, password);
  Serial.println("Connecting to the Wifi Network");
  while(WiFi.status() != WL_CONNECTED) { 
    delay(500);
    Serial.print(".");
  }
  Serial.println("");
  Serial.print("WiFi is Connected at this IP Address : ");
  Serial.println(WiFi.localIP());

}
void loop() {

  if(digitalRead (ir_s1) == LOW && flag1==0){timer1 = millis(); flag1=1;}

if(digitalRead (ir_s2) == LOW && flag2==0){timer2 = millis(); flag2=1;}

if (flag1==1 && flag2==1){
     if(timer1 > timer2){Time = timer1 - timer2;}
else if(timer2 > timer1){Time = timer2 - timer1;}
 Time=Time/1000;//convert millisecond to second
 speed=(distance/Time);//v=d/t
 speed=speed*3600;//multiply by seconds per hr
 speed=speed/1000;//division by meters per Km

 overspeed = speed - 50 ;
}

if(speed==0){

if(flag1==0 && flag2==0){Serial.println("No car  detected");}
                    else{Serial.println("Searching...    ");} 
}
else{
    Serial.print("Speed:");
    Serial.print(speed,1);
    Serial.print("Km/Hr  ");
  if(speed > 50){
    
    Serial.print("  Over Speeding  "); 

    if (WiFi.status() == WL_CONNECTED) {

  HTTPClient http;
    http.begin(client, url);
    http.addHeader("Content-Type", "application/x-www-form-urlencoded");

    String data = "speed=" + String(speed) + "&" + "overspeed="+ String(overspeed);

  int httpCode = http.POST(data);
  String payload = http.getString();

  Serial.print("URL : "); Serial.println(url);
  Serial.print("Data : "); Serial.println(data);
  Serial.print("httpCode : "); Serial.println(httpCode);
  Serial.print("payload : "); Serial.println(payload);
  Serial.println("------------------------------------");

  http.end();
 }
 else {
  Serial.println("WiFi Disconnected");
 }
  
  }
            else{Serial.print("  Normal Speed   "); }    
    delay(3000);

  speed = 0;
  flag1 = 0;
  flag2 = 0;
  overspeed = 0; 
    
 }

}
