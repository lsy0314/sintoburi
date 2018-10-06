/**
 * @Author: Hyunjun Lim, Suyeon Lim
 * @Date: Jun-17-2018
 * @Title: Launcher to start (1) apache web-server and (2) pir sensor program
 * @License: Star
 * @Prequisites: PHP web-application, Python PIR motion sensor application
 * @Description:
 * - How to compile: $ gcc -o launcher launcher.c
 * - How to run:     $ launcher
 */ 

#include <stdio.h>  // printf()
#include <stdlib.h> // system()

int main(void){
    int result;
  
    // Start sintoburi
    printf ("Starting sintoburi Launcher...\n");
    printf ("Press CTRL+C if you want to stop.\n");
    printf ("\n");
    printf ("\n");
    printf ("\n");
    printf ("\n");

    // Step1: run Apache web-server
    // * $ sudo systemctl restart apache2
    printf("(1/2)[webapp] Starting Apache web-server...\n");
    result = system("sudo systemctl daemon-reload");
    result = system("sudo systemctl restart apache2");
    if (result == -1){
        printf("[ERROR] apache2: A web-server process could not be created. return value is %d.\n",result); exit(0);
    }
    else if (result == 127){
        printf("[ERROR] apache2: A web-server process could not be executed. return value is %d\n",result); exit(0);
    }
    else
        printf("[webapp] Apache web-server is successfully started.\n");

    // Step2: run PIR motion sensor
    // * with background: exec /var/www/html/sintoburi/sensor/detector &> /dev/null &
    // * with foreground: /var/www/html/sintoburi/sensor/detector.py 
    printf("(2/2)[sensor] Starting PIR sensor program...\n");
    result = system("/var/www/html/sintoburi/sensor/detector.py");
    if (result == -1){
        printf("[ERROR] pir sensor: A PIR sensor process could not be created. return value is %d.\n",result); exit(0);
    }
    else if (result == 127){
        printf("[ERROR] pir sensor: A PIR sensor process could not be executed. return value is %d.\n",result); exit(0);
    }
    else
        printf("[sensor] A PIR sensor process is successfully started.\n");
            
    // display help message to users.
    printf("Please visit http://localhost/ to use web-application.\n");
            
    return 0;
}
