#include <ESP8266WiFi.h>
#include <Stepper.h>

// -- USER EDIT -- 
const char* ssid     = "2GJones";    // YOUR WIFI SSID
const char* password = "DJ1357r8";    // YOUR WIFI PASSWORD 

#define STEPS 200  // Max steps for one revolution
#define RPM 60     // Max RPM
#define DELAY 500    // Delay to allow Wifi to work
// -- END --


int STBY = 5;     // GPIO 5 TB6612 Standby
int LED = 0;      // GPIO 0 (built-in LED)

// GPIO Pins for Motor Driver board
Stepper stepper(STEPS, 16, 14, 12, 13);

// Create an instance of the server
WiFiServer server(80);

void setup() {
  Serial.begin(115200);
  delay(10);

  // prepare onboard LED
  pinMode(LED, OUTPUT);
  digitalWrite(LED, HIGH);

  // prepare STBY GPIO and turn on Motors
  pinMode(STBY, OUTPUT);
  digitalWrite(STBY, HIGH);
  
  // Set default speed to Max (doesn't move motor)
  stepper.setSpeed(RPM);
  
  // Connect to WiFi network
  Serial.println();
  Serial.println();
  Serial.print("STEPPER: Connecting to ");
  Serial.println(ssid);
  
  WiFi.begin(ssid, password);
  
  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
  }
  Serial.println("");
  Serial.println("WiFi connected");
  
  // Start the server
  server.begin();
  Serial.println("Server started");

  // Print the IP address
  Serial.println(WiFi.localIP());

  // Blink onboard LED to signify its connected
  blink();
  blink();
  blink();
}

void loop() {
  // Check if a client has connected
  WiFiClient client = server.available();
  if (!client) {
    return;
  }

  String respMsg = "";    // HTTP Response Message
  
  // Wait until the client sends some data
  Serial.println("new client");
  while(!client.available()){
    delay(1);
  }
  
  // Read the first line of the request
  String req = client.readStringUntil('\r');
  Serial.println(req);
  client.flush();
  
  // Match the request 
  // Stop request
  if (req.indexOf("/stepper/stop") != -1) {
    digitalWrite(STBY, LOW);
    respMsg = "OK: MOTORS OFF";
  } 
  // Start request
  else if (req.indexOf("/stepper/start") != -1) {
    digitalWrite(STBY, HIGH);
    blink();
    respMsg = "OK: MOTORS ON";
  } 
  // Set RPM value request
  else if (req.indexOf("/stepper/rpm") != -1) {
    int rpm = getValue(req);
    // Make sure RPM is more than 1 and less than max specificed above
    if ((rpm < 1) || (rpm > RPM)) {
      respMsg = "ERROR: rpm out of range 1 to "+ String(RPM);
    } else {
      stepper.setSpeed(rpm);
      respMsg = "OK: RPM = "+String(rpm);
    }
  }
  // Set step value request
  else if (req.indexOf("/stepper/steps") != -1) {
    int steps = getValue(req);
    // Make sure a number is set
    if ((steps == 0) || (steps < 0 - STEPS) || ( steps > STEPS )) {
      respMsg = "ERROR: steps out of range ";
    } else {  
      digitalWrite(STBY, HIGH);       // Make sure motor is on
      respMsg = "OK: STEPS = "+String(steps);
      delay(DELAY); 
      if ( steps > 0) { // Forward
        for (int i=0;i<steps;i++) {   // This loop is needed to allow Wifi to not be blocked by step
          stepper.step(1);
          delay(DELAY);   
        }
      } else {         // Reverse
          for (int i=0;i>steps;i--) {   // This loop is needed to allow Wifi to not be blocked by step
            stepper.step(-1);
            delay(DELAY); 
          }  
      }
    }
  }
  else {
    respMsg = printUsage();
  }
    
  client.flush();

  // Prepare the response
  String s = "HTTP/1.1 200 OK\r\nContent-Type: text/plain\r\n\r\n";
  if (respMsg.length() > 0)
    s += respMsg;
  else
    s += "OK";
   
  s += "\n";

  // Send the response to the client
  client.print(s);
  delay(1);
  Serial.println("Client disconnected");
}

int getValue(String req) {
  int val_start = req.indexOf('?');
  int val_end   = req.indexOf(' ', val_start + 1);
  if (val_start == -1 || val_end == -1) {
    Serial.print("Invalid request: ");
    Serial.println(req);
    return(0);
  }
  req = req.substring(val_start + 1, val_end);
  Serial.print("Request: ");
  Serial.println(req);
   
  return(req.toInt());
}

String printUsage() {
  // Prepare the usage response
  String s = "Stepper usage:\n";
  s += "http://{ip_address}/stepper/stop\n";
  s += "http://{ip_address}/stepper/start\n";
  s += "http://{ip_address}/stepper/rpm?[1 to " + String(RPM) + "]\n";
  s += "http://{ip_address}/stepper/steps?[-" + String(STEPS) + " to " + String(STEPS) +"]\n";
  return(s);
}

// Visual indication of connection
void blink() {
  digitalWrite(LED, LOW);
  delay(100); 
  digitalWrite(LED, HIGH);
  delay(100);
}

