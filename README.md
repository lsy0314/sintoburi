# Sintoburi 란?
우리의 프로젝트는 신토불이라는 IoT Software를 이용하여 전통적인 시장의 상점주인들이 시장을 활성화하고 수익을 더 높일수 있도록 돕는 것입니다. **Sintoburi**  는 몸과 태어난 땅은 하나라는 것을 의미합니다. 즉, 제 땅에서 산출된 것이라야 체질에 잘 맞으므로 우리의 전통 음식들을 애용하자라는 뜻을 가지고 있습니다. 
<br><br>
* 신토불이 로고:
<img src=https://github.com/lsy0314/sintoburi/blob/master/pic/carrot.png width=100 height=100 border=0> </img> 


# 소개
전통 시장을 활성화하기 위하여 우리의 아이디어를 기존 시장에 적용함으로써  더 현대화 된 전통 시장을 만들고자 하였습니다. 현재의 전통 시장은 대형 마트에 비해 맛있는 과일을 많이 가지고 있더라도, 고객에게 유용할 수 있는 정보를 효과적으로 홍보를 하지 못하고 있었습니다. 이러한 문제를 해결하고 시장 경쟁력을 잃어 가고있는 전통적인 시장 활성화를 가능하게 할 수있는 전통 시장 도우미 시스템을 개발하려 합니다.
 
전통 시장의 활성화를 방해하는 시장 요인을 알아낸 후 문제를 해결하기위한 아이디어를 도출해 냅니다. 인터넷 사이트를 통해서 먼저 사전 조사를 하고 실제로 전통 시장에 도입하기 위한 아이디어를 개발하는 데 필요한 기술이 무엇인지 조사를 하였습니다. 하드웨어 및 소프트웨어 프로그래밍 언어는 실제로 아이디어를 개발하기위하여 사용되어야 하는 구성요소입니다. 우리는 개발한 프로그램을 반복된 실험을 통하여 오류가 없는 완벽한 프로그램을 개발 하였습니다. 완벽한 프로그램을 실현하기 위하여 우리는 가장 먼저 소프트웨어의 동작구조를 설계하였습니다. 이 후 우리는 시장에 직접 방문하여 반복된 실험과 프로그램 오류를 수정함으로써 어떠한 경우에도 소프트웨어가 안정적으로 동작할 수 있도록 완성도를 높였습니다.


* 유튜브 비디오를 보려면 [HERE](https://youtu.be/r2Oou_AUoKo?t=0s)를 누르십시오.

* https://youtu.be/r2Oou_AUoKo?t=0s (유튜브 동영상 데모 3분)

우리는 우리의 아이디어를 알기 쉽게 소개하기 위하여 유튜브 비디오를 만들었습니다. 이 비디오는 3 분 동안 재생이 됩니다.
* https://youtu.be/r2Oou_AUoKo?t=0s (유튜브 동영상 데모 3분)

# 디자인
* https://github.com/lsy0314/sintoburi/blob/master/pic/idea-sketch.jpg

이 사이트는 전통 시장을 돕는 우리의 제품을 설명하고 있습니다. 신토불이(제품명)를 사용하여 전통 시장을 현대화 할 수 있습니다. 신토불이는 4차 산업 혁명에 따라 전통 시장을 활성화하고 차별화하기 위해 고안되었습니다. 시장을 방문하는 고객에게 시장 정보를 자동으로 홍보하는 IOT 제품이라고 할 수 있습니다.
신토불이는 휴대 전화에서만 사용이 가능하며 화면에는 매시간마다 행사가 표시됩니다.


신토불이를 만들기 위하여 우선 php 파일을 업로드하기위한 웹프로그램인 php와 html을 사용해아 합니다. 라즈베리파이보드의 가격은 5만원이며, OS는 무료인 우분투 OS를 사용했습니다. 시장 입구에서 제품의 pir 센서라고 불리는 모션 센서가 고객을 감지하고 오늘의 할인 정보를 알려줍니다. 광고 모니터를 통해 고객들은 오늘의 할인 정보나 행사등을 알 수 있습니다. " 신토불이는 전통 시장의 현대화와 상점 홍보의 자동화가 가능하므로 상점 주인에게 이익을 증대시켜주는 효과를 가지고 있습니다. 또한 고객들은 저렴한 상품을 구매할 정보를 얻을 수 있습니다. 그러므로 신토불이는 전통 시장의 현대화를 도모하여 상인과 고객들 모두에게 혜택을 줍니다.


# 설치 방법

### Raspberry Pi3 개발보드에 우분투 OS 설치
먼저 [doc](doc/README.md) 폴더에 업로드 한 문서를 읽으십시오. 그런 다음 Raspberry Pi3 장치에 Ubuntu OS를 설치하십시오.


### 신토불이 소프트웨어 설치
신토불이는 주로 Python (모션 인식 프로그램) 및 PHP (웹 응용 프로그램)에 의해 개발되었습니다.
다음과 같이 설치하십시오.

```bash
# windows7 PC에서 mobaxterm 소프트웨어로 ssh 세션을 실행하십시오

$ cd /var/www/html
$ git clone https://github.com/hjoon0510/SmartSecretary.git
$ cd ./sintoburi 
$ sudo chown -R www-data:www-data /var/www/html/sintoburi/audio/
$ sudo visudo
--------------- /etc/sudoers: start ----------------
#includedir /etc/sudoers.d
user01          ALL=(ALL) NOPASSWD: ALL <---- Please append your id here.!!!!
user02          ALL=(ALL) NOPASSWD: ALL <---- Please append your id here.!!!!
www-data        ALL=(ALL) NOPASSWD: ALL <---- Please append your id here.!!!!
--------------- /etc/sudoers: ending ---------------
```

# 실행방법
웹 응용 프로그램 및 PIR Sensor 프로그램을 시작하는 방법에 대해 설명합니다. 신토불이 소프트웨어는 launcher라는 프로그램을 통해서 실행됩니다. 그러므로, 아래처럼 gcc 명령으로 launcher.c를 컴파일하여주세요. 그 다음으로  컴파일하여 생성된 `launcher` 파일을 실행만 하면 됩니다.
```bash
$ cd sintoburi
$ gcc launcher.c -o launcher 
$ ./launcher
```


# 데모 비디오 (유투브 동영상)

* 우리는 프로젝트를 개발하면서 IP 주소를 왜우는 것은 번거롭기 때문에 http://sintoburi.mooo.com 라는 웹주소를 만들었습니다. 우리는 https://freedns.afraid.org/를 통해 웹주소를 무료로 생성하였습니다. 사용자의 불편을 최소화하기 위해서 우리는  테스트 및 디버깅을 반복하여 프로그램의 버그들을 찾는데 노력을 하였습니다. 
* rpi board's screen
 <img src=https://github.com/lsy0314/sintoburi/blob/master/pic/rpi3-board.jpg width=650 height=400 border=0 />
* moblie phone screen
 <img src=https://github.com/lsy0314/sintoburi/blob/master/pic/demo02.png width=650 height=400 border=0 />
* https://youtu.be/lLKUPmY19pU (유튜브 동영상 데모 5분)

# 팀 멤버
* 임현준: 하드웨어 개발 분야 및 디자인을 맡았습니다. 
  * 담당: 라즈베리 파이 보드의 우분투 OS 설치, PIR모션 센서 프로그램, 딥러닝 음성인식 프로그램 개발
  
* 임수연: 소프트웨어 개발 분야을 맡음
  * 담당: 상점관리용 데이타베이스 설계, 음성파일 관리 웹앱 개발, 이벤트 관리 웹앱 개발, 회원관리 기능 개발
  
* 공통: 웹앱 디자인작업, 테스트/디버깅, 작업(연구) 일지 작성

* 개발방법:우리는 학업을 병행하면서 신토불이 프로젝트 개발을 효과적으로 협업하기 위하여 원활한 의사소통 수단이 필요하였습니다. 그래서 우리는 세계적으로 모든 개발자들이 활발하게 쓰고있는 github.com 사이트를 이용하기로 하였습니다. 우리는 github.com 사이트를 이용하여 실시간으로 각자의 개발 진행 상황을 공유하며 체크할수 있었습니다. 또한 진행상황을 쉽게 꼼꼼히 서로 체크할수 있게되어 공동 개발 작업을 편하게 할수 있었습니다. 우리는 팀웍과 공동 작업의 산출물인 프로그램의 완성도를 높이기 위하여 github.com의 issue 페이지 기능을 활용했습니다. 
 
