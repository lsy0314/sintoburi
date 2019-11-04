
# RPI3와 RPI Zero간에 UART Serial 연결하기

* How to use USB-UARt serial on Raspberry Pi zero
   * http://osoyoo.com/2017/10/23/raspberry-pi-zerow-basic-kit-lesson-3/
   * https://www.thepolyglotdeveloper.com/2017/02/connect-raspberry-pi-pi-zero-usb-ttl-serial-cable/
   
* Setting Up UART Serial Communication between Raspberry Pi3 and Raspberry Pi Zero.
   * https://scribles.net/setting-up-uart-serial-communication-between-raspberry-pis/

* How to connect UART Serial between RPI3 and Ardunio
   * https://www.teachmemicro.com/raspberry-pi-serial-uart-tutorial
   


# RPi Zero의 Wireless 모니터없이 설정하기


sd카드의 boot 폴더로 이동하여 config.txt, cmdline.txt 파일을 편집한다. 

절차1: 
microSD의 config.txt 파일을 열어 아래 내용을 마지막에 첨가 합니다.
dtoverlay=dwc2


절차2:
microSD의 commandline.txt 파일을 열어 수정합니다.
rootwait 뒤에 아래를 추가하면 됩니다. 꼭 앞뒤에 띄어쓰기가 있어야 하니 주의하십시오.
modules-load=dwc2,g_ether

절차3:
2분정도 기다려보고 cmd를 켜고 다음 커멘드를 통해서 확인해보자
ping raspberrypi.local
ping이 보내지면, 연결된거고 안되면 컴터에서 제대로 인식 못한거다.

절차4:
이때 컴퓨터에서 라즈베리 파이의 연결을 인식하지 못한다면 다음 문제에 해당한다.
윈도우 컴퓨터에 "USB Ethernet/RNDIS Gadget" 드라이브가 안깔려있는 겁니다. 

윈도우에서 인식하지 못한다면 드라이버를 장치에 설정해주어야 합니다.
컴퓨터 오른쪽 클릭 -> 속성 -> 장치관리자 -> 기타 장치 -> 물음표가 있는 RNDIS/Ethernet Gadget 더블클릭.
드라이버 업데이트 -> 컴퓨터에서 드라이버 소프트웨어 찾아보기 -> 컴퓨터의 장치 드라이버 목록에서 직접 선택
여러 장치 목록의 유형 중 네트워크 어댑터 선택한다.
Microsoft Corporation 선택 후, Remote NDIS compatible Device 선택 
-> 다음 완료 -> 닫기


절차5: 

그리고 putty를 다운받습니다.
http://www.putty.org

그리고 다음의 정보로 로그인 합니다.
서버주소 : raspberrypi.local
로그인 아이디 : pi
로그인 패스워드 : raspberry 입니다

절차6: 
이제 무선 WIFI가 왜 안잡히는지 아래의 같은 방법으로 코솔 디버깅을 하도록 한다. 
$ sudo wpa_supplicant -d -B -c/etc/wpa_supplicant/wpa_supplicant.conf -iwlan0 


이상. 
