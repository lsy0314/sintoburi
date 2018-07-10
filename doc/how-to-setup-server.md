 
 
**Table Of Contents**
- [운영체제 설치하기](#운영체제-설치하기)
- [와이파이 설정하기](#와이파이-설정하기)
- [SSH Server](#ssh-server)
- [Raspberry Pi 화면 180도 회전시키기](#raspberry-pi-화면-180도-회전시키기)
- [터치스크린 보정을 위해 xinput_calibrator 설치](#터치스크린-보정을-위해-xinput_calibrator-설치)
- [웹서버 설치하기](#웹서버-설치하기)
- [날씨정보 습득프로그램 wttr설치](#날씨정보-습득프로그램-wttr설치)
- [PHP 개발환경 설치](#php-개발환경-설치)
- [VNC Server Setup on Raspberry Pi 3](#vnc-server-setup-on-raspberry-pi-3)
- [How to do realtime streamming service with camera and gstreamer software](#how-to-do-realtime-streamming-service-with-camera-and-gstreamer-software)
- [How to make live stream video using vlc from webcam on Linux](#how-to-make-live-stream-video-using-vlc-from-webcam-on-linux)
- [How to record your voice from microphone of USB webcam using ALSA](#how-to-record-your-voice-from-microphone-of-usb-webcam-using-alsa)
- [Play wma file with cvlc and mplayer command](#play-wma-file-with-cvlc-and-mplayer-command)
- [이메일 발송하기](#이메일-발송하기)
- [How to convert sound file from wma to wav](#how-to-convert-sound-file-from-wma-to-wav)
- [터미널을 통한 WiFi 연결](#터미널을-통한-wifi-연결)



# 운영체제 설치하기

* 인기 있는 OS 종류: 1) 라즈비안, 2) 우분투(마테버젼)*
OS 이미지를 다운로드하기 위하여 https://www.raspberrypi.org/downloads/ 에 접속후 2) 우분투(마테버젼)을 다운로드 한다.

* 보관장소(OS): `D:\raspberrypi3\`
보관장소(유틸리티): `\\192.168.219.2\work\scratch\정보올림피아드문제-공모전\raspberry-pi3-board-sw`


* SD_CardFormatter0500SetupEN.exe 프로그램으로 micro SDcard를 포맷해야 한다.
다운로드 주소: https://www.download3k.com/Install-SDFormatter.html 


* 그리고나서, win32diskimager-1.0.0-install.exe 프로그램으로 다운로드한 OS을 micro SDcard에 설치해야 한다.
다운로드 주소: https://sourceforge.net/projects/win32diskimager/files/Archive/ 


# 와이파이 설정하기

라즈베리파이3는 WiFi 와 블루투스가 자체 내장되어있다.

라즈비안 OS의 경우에는 WiFI SSID를 정상적으로 scanning하기 위하여 WiFi Country에서 반드시 US (United State)를 선택해야 한다.
```bash
* 기본설정 - Raspberry Configuration - Localisation - WiFi Country - US (United State) 선택
```

# SSH Server
```bash
  sudo apt -y install openssh-server openssh-client
  sudo systemctl restart ssh
  sudo systemctl enable ssh  
  ifconfig
```  
이제 windows7 PC에서 mobaxterm 프로그램을 실행한후에 RaspBerry Pi 3보드의 SSH 서버에 접속하면 된다.


# Raspberry Pi 화면 180도 회전시키기 

```bash
sudo vi /boot/config.txt 
display_rotate=2 
(0:0도, 1:90도, 2:180도, 3: 270도) 
```

# 터치스크린 보정을 위해 xinput_calibrator 설치 

필요한 프로그램 설치
```bash
sudo apt-get install libx11-dev libxext-dev libxi-dev x11proto-input-dev 
```
xinput_calibrator 다운로드
```bash
wget http://github.com/downloads/tias/xinput_calibrator/xinput_calibrator-0.7.5.tar.gz 
ls 
```
설치...(압축 풀고 해당 폴더에서...)
```bash
tar xvzf xinput_calibrator-0.7.5.tar.gz
cd xinput_calibrator-0.7.5
./configure 
make 
sudo make install 
```
실행 (Rasp Berry Pi3 보드에서 실행해야함.)
```bash
xinput_calibrator 
```
터치 4번 손으로 직접 조정하면 보정됨.
터치스크린 보정한 것을 부팅할때마다 자동으로 항상 불러오기
```bash
# mkdir /etc/X11/xorg.conf.d
# vi /etc/X11/xorg.conf.d/99-calibration.conf
 
Section "InputClass"
  Identifier "calibration"
  MatchProduct "FT5406 memory based driver"   
  Option "Calibration" "801 14 463 -12"
EndSection
```
재부팅시에 그래픽 화면이 나오지 않고 콘솔 화면으로 나온다면, 이 경우 대부분 99-calibration.conf 파일의 내용에 오타가 있었다.
```bash
# cd /etc/X11/xorg.conf.d/
# mv 99-calibration.conf 99-calibration.conf.disable
```
# 웹서버 설치하기 
라즈베리 파이 보드를 이용하여 자신만의 웹서버를 운영할 수 있다.
```bash
sudo apt install apache2
sudo systemctl restart apache2 
sudo systemctl enable apache2
firefox http://192.168.219.104 
sudo vi /var/www/html/index.html
<H2> This webserver is created by Gildong Hong</H2>
<br>
<img src=./now.jpg></img> 
User1 &nbsp; &nbsp; &nbsp; User2 &nbsp; &nbsp; &nbsp; User3
<br> 

<br>
<br>
1. [사용자1]<br>
오늘 수학숙제를 내는 날 입니다.<br>
오늘은 고양이를 병원에 데려가는 날입니다.<br>
5시에 수학학원을 가야 합니다.<br>
```
# 날씨정보 습득프로그램 wttr설치 

예제)
```bash
firefox https://github.com/chubin/wttr.in
curl http://wttr.in/:help
curl  wttr.in/suwon?0
curl wttr.in/suwon?n
curl wttr.in/suwon?lang=ko
wget wttr.in/suwon_0tqp_lang=suwon.png
convert -resize 800x600 suwon.png suwon-big.png
wget wttr.in/suwon_0tqp_lang=suwon.html
wget wttr.in/suwon.png
```

예제)
```bash
firefox https://github.com/fcambus/ansiweather
sudo apt-get install ansiweatherr
ansiweather -l London,GB -f 3
London forecast => Sat Jan 13: 7/2 °C ☔ - Sun Jan 14: 4/1 °C ☔ - Mon Jan 15: 9/6 °C ☔
```

예제)
```bash
firefox https://weather.com/weather/hourbyhour/l/USIL0074
```


예제)
```bash
$ cat ./weather.sh
#!/bin/bash
weather(){ curl -s "http://api.wunderground.com/auto/wui/geo/ForecastXML/index.xml?query=${@:-<YOURZIPORLOCATION>}"|perl -ne '/<title>([^<]+)/&&printf "%s: ",$1;/<fcttext>([^<]+)/&&print $1,"\n"';}
weather $1

$ bash weather.sh  suwon
```


# PHP 개발환경 설치

```bash
$ sudo apt-get -y install php php-cgi libapache2-mod-php php-common php-pear php-mbstring
$ sudo a2enconf php7.0-cgi 
$ sudo systemctl restart apache2 
$ sudo cd /var/www/html
$ sudo vi /var/www/html/index.php

<html>
<body>
<?php
  print Date("Y/m/d");
?>
</body>
</html 
```
 
 
# VNC Server Setup on Raspberry Pi 3

Install VNC Server
```bash
sudo apt install tightvncserver   (OR sudo apt install vnc4server)
vi ~/vnc.sh
---------- vnc server:start ---------------
#!/bin/sh
vncserver :1 -geometry 1280x1024 -depth 24
---------- vnc server: end ----------------

vi ~/.vnc/xstartup
---------- start ---------------
#!/bin/sh
xrdb $HOME/.Xresources
xsetroot -solid grey -cursor_name left_ptr
#x-terminal-emulator -geometry 80x24+10+10 -ls -title "$VNCDESKTOP Desktop" &
#x-window-manager &
# Fix to make GNOME work
export XKL_XMODMAP_DISABLE=1
/etc/X11/Xsession
---------- end ----------------

vncserver -kill :1
```
Run VNC client
```bash
firefox https://www.realvnc.com/en/connect/download/viewer/에서 프로그램을 다운로드한다.
접속할때 아래의 IP 및 암호를 입력하면 된다. 
 * IP 192.168.219.104:5901
 * password: ***
```
# How to do realtime streamming service with camera and gstreamer software
* http://www.icbanq.com/P007122889 (라즈베리파이 카메라 모듈 V2 8MegaPixel) 

Install gstreamer
```bash
sudo apt update
sudo apt upgrade

sudo apt install gstreamer1.0
----gstreamer installation: start ------------
The following NEW packages will be installed:
  debhelper dh-strip-nondeterminism freepats gstreamer1.0-clutter gstreamer1.0-doc
  gstreamer1.0-dvswitch gstreamer1.0-espeak gstreamer1.0-fluendo-mp3 gstreamer1.0-hybris
  gstreamer1.0-libav gstreamer1.0-libav-dbg gstreamer1.0-packagekit gstreamer1.0-plugins-bad
  gstreamer1.0-plugins-bad-dbg gstreamer1.0-plugins-bad-doc gstreamer1.0-plugins-bad-faad
  gstreamer1.0-plugins-bad-videoparsers gstreamer1.0-plugins-base-apps
  gstreamer1.0-plugins-base-dbg gstreamer1.0-plugins-base-doc gstreamer1.0-plugins-good-dbg
  gstreamer1.0-plugins-good-doc gstreamer1.0-plugins-ugly gstreamer1.0-plugins-ugly-amr
  gstreamer1.0-plugins-ugly-dbg gstreamer1.0-plugins-ugly-doc gstreamer1.0-pocketsphinx
  gstreamer1.0-vaapi gstreamer1.0-vaapi-doc intltool-debian libandroid-properties1
  libarchive-zip-perl libavfilter-ffmpeg5 libavresample-ffmpeg2 libde265-0
  libfile-stripnondeterminism-perl libglib2.0-dev libglib2.0-doc libgstreamer-plugins-bad1.0-0
  libgstreamer1.0-0-dbg libgstreamer1.0-dev libhybris-common1 libmail-sendmail-perl libmedia1
  libmimic0 libmjpegutils-2.1-0 libmms0 libmpeg2encpp-2.1-0 libmpg123-0 libmplex2-2.1-0 libofa0
  libopencore-amrnb0 libopencore-amrwb0 libopencv-calib3d2.4v5 libopencv-contrib2.4v5
  libopencv-features2d2.4v5 libopencv-flann2.4v5 libopencv-highgui2.4v5 libopencv-legacy2.4v5
  libopencv-ml2.4v5 libopencv-objdetect2.4v5 libopencv-video2.4v5 libpcre3-dev libpcre32-3
  libpcrecpp0v5 libpocketsphinx3 libsidplay1v5 libsoundtouch1 libspandsp2 libsphinxbase3 libsrtp0
  libsys-hostname-long-perl libva-wayland1 libvo-aacenc0 libvo-amrwbenc0 libwildmidi-config
  libwildmidi1 libzbar0 po-debconf zlib1g-dev
----gstreamer installation: end ------------
```
Run shell script to stream captured image files
```bash
gst-launch-1.0 --version
vi camera_test.sh
#---------- script code: start -------------------
#!/usr/bin/env bash
MY_IP=$(hostname -I)
echo "My IP Addr is $MY_IP"
raspivid -t 0 -h 720 -w 1280 -fps 25 -hf -b 2000000 -o - | gst-launch-1.0 \
-v fdsrc ! h264parse ! rtph264pay config-interval=1 pt=96 ! gdppay ! tcpserversink host=$MY_IP port=5000
#---------- script code: end -------------------

chmod +x camera_test.sh
./camera_test.sh
```
라즈베리파이 보드에 연결된 터치스크린/모니터에 카메라의 촬영 창이 실행되는 것을 볼수 있다.

안드로이드 모바일 폰은 구글스토어에서 "RaspberryPi Camera viewer"라는 애플리케이션을 검색/설치하면 된다.
그리고나서 해당 모바일 앱을 실행한후에 "+" 아이콘을 클릭하여 메뉴버턴을 생성한다. 생성된 메뉴버턴을 클릭한후 아래의 정보를 입력한다.
* Name: 192.168.219.104
* IP Address: 192.168.219.104
* Port: 5000
* Description: New Raspberry Pi device
* Aspect ratio: 1.6 

# How to make live stream video using vlc from webcam on Linux
```bash
# Verify Webcam Device on VLC
$ ls /dev/video*
$ vlc v4l2:///dev/video0

# Live Stream Webcam from the Command Line
$ cvlc v4l2:///dev/video0 :v4l2-standard= :input-slave=alsa://hw:0,0 :live-caching=300 :sout="#transcode{vcodec=WMV2,vb=800,scale=1,acodec=wma2,ab=128,channels=2,samplerate=44100}:http{dst=:8080/stream.wmv}"


# Security Protections for Your Webcam Feed
$ vlc http://<ip_address_of_webcam_host>:8080/stream.wmv
$ mplayer http://<ip_address_of_webcam_host>:8080/stream.wmv


```
# How to record your voice from microphone of USB webcam using ALSA

* Record a voice
```bash
 # make sure your microphone is connected to device
alsamixer
# capture microphone input with arecord

sudo apt install alsa-utils
# check probed audio devices
arecord -l
vi ~/.asoundrc
# http://auction.kr/iBV35PO (Logitech, HD Pro Webcam C920)
# hw:<card-val>,<device-val>
pcm.copy { type plug slave { pcm "hw:2,0" } } ctl.!default { type hw card 2 }


arecord -D copy -d 10 foo.wav
```
Play recorded audio file
```bash
aplay foo.wav
```

# Play wma file with cvlc and mplayer command
```bash
Please make *.wma file by running recording software on winodws7.
# gksu -u hjoon0510 cvlc ../sound/sound-rain.wma
# mplayer  ./sound/weather-rain.wma
```



# 이메일 발송하기



## ssmtp 프로그램 이용하기

[ssmtp install]
```bash
$ sudo apt-get install ssmtp (smtp를 이용하여 이메일 메세지 발송 프로그램)
$ sudo chmod 755 /etc/ssmtp
$ cd /etc/ssmtp
$ sudo cp ssmtp.conf ssmtp.conf.bak
```

[/etc/ssmtp/ssmtp.conf 파일 설정 변경]
```bash
root=hjoon0510@gmail.com
mailhub=smtp.gmail.com:587
rewriteDomain=
hostname=localhost
UseTLS=YES
UseSTARTTLS=YES
AuthUser=hjoon0510@gmail.com
AuthPass=xxxxxxxxx
FromLineOverride=YES
```

[구글 계정에서 이메일 SMTP 설정권한 변경]

gmail smtp을 사용하여 정상적으로 이메일을 발송할수 있으려면, 
보안 수준을 낮추어 주어야 ssmtp (Simple SMTP)접근 가능하고 이메일 전송이 가능하다.
구글 계정 설정 -> 내 계정 -> 로그인 및 보안 -> 연결된 앱 및 사이트 - [v]보안 수준이 낮은 앱 허용 
* https://myaccount.google.com/security?utm_source=OGB&pli=1


[콘솔 테스트 예제]
ssmtp 명령이 정상적으로로 동작하는지 알기 위해서 -v 옵션을 활용하는 것이 좋다. 
```bash
$ echo "Hi, This is test email." | ssmtp -v 이메일주소

$ vim ./msg.txt
To: myemailaddress@gmail.com
From: myemailaddress@gmail.com
Subject: alert

The server is down!

$ ssmtp 이메일주소  < ./msg.txt
```

[그림파일을 이메일로 첨부하여 보내는 방법: mpack, uuencode]
```bash
$ sudo apt-get install mpack (이메일을 보낼때 파일을 첨부하여주는 프로그램)
$ mpack -s "제목" ./happy.jpg 이메일주소

$ sudo apt install shareutils
$ uuencode file.txt myfile.txt | sendmail user@example.com
```

[디폴트 mta 변경방법]
출력되는 목록들중에서 "sendmail.ssmtp"을 선택해야 한다. 
만약 선택가능한 MTA가 오직 1개이라면 " error: no alternative for mta" 메세지가 나올수 있으며, 
이것은 오류가 없는 정상적인 결과라고 이해하면 된다. 
```bash
$ sudo update-alternatives --config mta
```

[PHP /etc/php/7.0/apache2/php.ini 파일 설정변경]
```bash
수정 전 --> ;sendmail_path = /usr/sbin/sendmail -t -i
수정 후 --> sendmail_path = /usr/sbin/ssmtp -t
```

[Apache 웹서버 재시작하기]
```bash
sudo /etc/init.d/apache2 restart
```

[php언어로 이메일 발송하는 프로그램 코드 예제]
```bash
$ vi gmail_send.php 
<?php
$uname = "PyeongAn_Security";  //받는 사람에게 보여줄 이름을 적는다
$uemail = "MyMail@gmail.com";  //gmail smtp 서버에 등록한 계정의 이메일주소
$from ="=?UTF-8?B?".base64_encode($uname)."?=<$uemail>\r\n";
$headers  = 'MIME-Version: 1.0' ."\r\n";
$headers.='Content-type: text/html; charset=UTF-8' . "\r\n"; 
$headers.='From:  '.$from."\r\n";  
$createday = date("Y-m-d"); 
$to='Receiver@naver.com'; // 받을 사람 이메일 주소 
$subject='Raspberrypi test mail'; // 제목 
$subject = "=?UTF-8?B?".base64_encode($subject)."?=";  // 이메일 제목 깨지지 않도록 인코딩 작업 하기 
$msg="man의 자유공간<br>\n"; // 서명   
mail($to,$subject,$msg,$headers);
?>
```

## PHPMailer 프로그램 이용하기
* https://github.com/PHPMailer/PHPMailer 에서 PHPMailer이라는 오픈소스 라이브러리를 다운로드한다. 
* 예제 프로그램은 ./PHPMailer-master/examples/ 폴더에 위치하여 있다. 
* 이제 아래와 같이 php 소스코드를 작성하여 사용하기마만 하면 된다. 
```bash
 require_once("./PHPMailer/class.phpmailer.php");
 $mail                  = new PHPMailer();
 $mail->IsHTML(true);                         // HTML의 형식으로보냄
 $mail->IsSMTP();
 $mail->SMTPSecure      = "ssl";
 $mail->Port            = 465;                    // 465 or 587 set the SMTPport for the GMAIL server
 $mail->Host            = "smtp.gmail.com";
 $mail->ContentType     = "text/html";
 $mail->Charset         = "utf-8";
 $mail->Encoding        = "base64";
 $mail->SMTPAuth        = true;                   // turn on  SMTP authentication
 $mail->Username        = 구글계정;    
 $mail->Password        = 구글계정SMTP비밀번호;   // SMTP 비밀번호
 $mail->setFrom($mail->Username, "보내는사람");
 $mail->addAddress(받을이메일주소);               // 받을 이메일 주소
 $mail->Subject         = '제목';
 $mail->Body            = '내용';  
 if(!$mail->Send()){
    echo "메일 전송에 실패 하였습니다.\n\n" .
    $mail->ErrorInfo;
 }
 else{ 
    echo "메일 전송에 성공 하였습니다.";
 }

```

구글의 gmail stmp 서비스 설정에 설문제가 있다면 오류가 발생할수 있다. 
```bash
bash$mail->SMTPSecure = "ssl";
$mail->Port = 465; // 465 or 587 set the SMTP port for the GMAIL server
```
위 소스가 안된다면
```bash
$mail->SMTPSecure = "tls";
$mail->Port = 587; // 465 or 587 set the SMTP port for the GMAIL server
```
위 소스를 사용하면 된다. 
stream_socket_enable_crypto 에러가 발생한다면 , php.ini 에서 extension=php_openssl.dll위 php_openssl 모듈을 활성화해야 한다.

실제로 실행을 하면 위의  if(!$mail->Send()) 부분에서 에러가 발생한다. 이문제를 해결하기 위해서 구글 시큐리티로 접속후에  "내 Windows 컴퓨터의 메일"을 생성한다. 그리고나서 만들어진 시큐리티 암호 16값을 제공받아서 위의 소스코드  $mail->Password 에 적용하면 정상적으로 이메일이 발송됨을 확인할수 있다.
* 참고:
   * http://stackoverflow.com/questions/17227532/gmail-530-5-5-1-authentication-required-learn-more-at 
   * https://support.google.com/mail/answer/185833?hl=en&visit_id=1-636532191943049589-646099977&rd=1#
   
```bash
- Select app: smart_secrectary
- Select device: default (don't select)
```

"GENERATE" 버턴을 클릭하면 아래와 같은 app password가 생성된다. 
```bash
- app password: rqnzataqgkdigxxx
```


# How to convert sound file from wma to wav
```
$ ffmpeg -i test.wma test.wav
$ mpalyer test.wav
```


# 터미널을 통한 WiFi 연결

다음 명령을 실행하여 wpa_supplicant.conf 파일을 엽니다. 
wpa_supplicant.conf는 와이파이의 이름과 비밀번호에 대한 정보를 갖고 있는 파일입니다.

```bash
    sudo nano /etc/wpa_supplicant/wpa_supplicant.conf
```

새 이미지의 SD카드일 경우 파일 안에 아무 내용이 없고, 사용하시던 것이라면 기존에 사용하시던 와이파이에 대한 정보가 있을 것입니다. 
다음과 같이 연결할 와이파이에 대한 내용을 추가해 줍니다.

```bash
    network = {
        ssid = "<와이파이 이름>"
        psk = "<와이파이 비밀번호>"
    }
```

ssid 는 와이파이 이름, psk 는 비밀번호에 해당하는 변수 같은 것이 되겠습니다. 비밀번호가 없다면,
```bash
    network = {
        ssid = "<와이파이 이름>"
        key_mgmt = NONE
    }
```

숨겨진 네트워크(공유기 세팅에서 와이파이 이름이 다른 사람에게 뜨지 않게 한 경우)일 경우
```bash
   network = {
        ssid = "<와이파이 이름>"
        scan_ssid = 1
        psk = "<와이파이 비밀번호>"
    }
```
로 해줍니다.

와이파이와 연결이 되었다면 ifconfig wlan0 명령을 통해 확인할 수 있습니다. 
연결이 되지 않았다면 sudo reboot 명령을 통해 재부팅을 해봅니다.
