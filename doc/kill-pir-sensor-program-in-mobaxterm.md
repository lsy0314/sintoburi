## PIR 모션센서 프로그램을 Kill하는 방법
```bash
ps -ef | grep pir       // survey 
kill {process_number}   // kill a running process
ps -ef | grep pir       // check  
```

## PIR 모션센서 프로그램을 직접 실행하는 방법 
```bash
/var/www/html/sintoburi/sensor/detector.py
(or ./launcher )
```
